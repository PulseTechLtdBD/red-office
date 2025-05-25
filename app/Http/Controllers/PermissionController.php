<?php

namespace App\Http\Controllers;

use DB;
use Exception;
use App\Models\Permission;
use App\Http\Requests\IndexPermissionRequest;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;

class PermissionController extends CRUDController
{
    protected $modelName = 'Permission';

    public function index(IndexPermissionRequest $request) : mixed
    {
        try{
            $validated = $request->validated();

            $paginate = $validated['paginate'] ?? $this->paginate;
            $orderBy  = $validated['order_by'] ?? $this->orderBy;
            $order    = $validated['order'] ?? $this->order;

            $data = Permission::orderBy($orderBy, $order)->paginate($paginate);

            if($data){
                return $this->sendResponseIndexSuccess($data);
            } else{
                return $this->sendResponseIndexFailed();
            }
        } catch(Exception $e){
            return $this->sendExceptionError($e);
        }
    }

    public function store(StorePermissionRequest $request) : mixed
    {
        try{
            return $this->storeOrUpdate($request, 0);
        } catch(Exception $e){
            return $this->sendExceptionError($e);
        }
    }

    public function show(int $id) : mixed
    {
        try{
            $perm = Permission::find($id);

            if($perm){
                return $this->sendResponseShowSuccess($perm);
            } else{
                return $this->sendResponseShowFailed();
            }
        } catch(Exception $e){
            return $this->sendExceptionError($e);
        }
    }
    public function update(UpdatePermissionRequest $request, int $id) :mixed
    {
        try{
            return $this->storeOrUpdate($request, $id);
        } catch(Exception $e){
            return $this->sendExceptionError($e);
        }
    }

    public function destroy(int $id) : mixed
    {
        try{
            $perm = Permission::find($id);
            if($perm){
                $perm->delete();
                return $this->sendResponseDeleteSuccess();
            } else{
                return $this->sendResponseDeleteFailed();
            }
        } catch(Exception $e){
            return $this->sendExceptionError($e);
        }
    }

    private function storeOrUpdate($request, int $id = 0): mixed
    {
        try{

            if($id > 0) {
                $create = false;
                $perm   = Permission::find($id);

                if(!$perm) {
                    return $this->sendResponseShowFailed();
                }
            } else {
                $create = true;
                $perm   = new Permission;
            }

            $validated = $request->validated();
    
            DB::beginTransaction();
            
            $perm->name         = $validated['name'];
            $perm->display_name = $validated['display_name'];
            $perm->description  = $validated['description'];
            
            $res = $perm->save();

            if ($res) {
                DB::commit();

                return $this->sendResponsestoreOrUpdateSuccess($res, $create);
            } else {
                return $this->sendResponsestoreOrUpdateFailed($create);
            }

        } catch(Exception $e){
            DB::rollBack();

            return $this->sendExceptionError($e);
        }
    }
}
