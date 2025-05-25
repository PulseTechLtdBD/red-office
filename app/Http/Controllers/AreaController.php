<?php

namespace App\Http\Controllers;

use DB;
use Exception;
use App\Models\Area;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Requests\UpdateAreaRequest;
use App\Http\Requests\IndexAreaRequest;
use Illuminate\Support\Str;

class AreaController extends CRUDController
{
    protected $modelName = 'Area';

    /**
     * Display a listing of the resource.
     */
    public function index(IndexAreaRequest $request): mixed
    {
        
        try{
            $validated = $request->validated();
    
            $paginate = $validated['paginate'] ?? $this->paginate;
            $orderBy  = $validated['order_by'] ?? $this->orderBy;
            $order    = $validated['order'] ?? $this->order;
    
            $data = Area::orderBy($orderBy, $order)->paginate($paginate);
    
            if($data){
                return $this->sendResponseIndexSuccess($data);
            } else{
                return $this->sendResponseIndexFailed();
            }     
        } catch(Exception $e){
            return $this->sendExceptionError($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAreaRequest $request): mixed
    {
        try{
            return $this->storeOrUpdate($request, 0);

        } catch(Exception $e){
            return $this->sendExceptionError($e);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id) : mixed
    {
        try{
            $area = Area::find($id);
            if($area){
                return $this->sendResponseShowSuccess($area);
            } else{
                return $this->sendResponseShowFailed();
            }
        } catch(Exception $e){
            return $this->sendExceptionError($e);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAreaRequest $request, int $id)
    {
        try{
            return $this->storeOrUpdate($request, $id);

        } catch(Exception $e){
            return $this->sendExceptionError($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id) : mixed
    {
        try{
            $area = Area::find($id);
            
            if($area) {
                $area->delete();

                return $this->sendResponseDeleteSuccess();
            } else {
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
                $area   = Area::find($id);

                if(!$area) {
                    return $this->sendResponseShowFailed();
                }
            } else {
                $create = true;
                $area   = new Area;
            }

            $validated = $request->validated();
    
            DB::beginTransaction();

            $area->name      = $validated['name'];
            $area->slug      = Str::slug($validated['name'], '-');
            $area->parent_id = $validated['parent_id'] ?? null;
            $area->latitude  = $validated['latitude'];
            $area->longitude = $validated['longitude'];
            
            $res = $area->save();

            if ($res) {
                DB::commit();

                return $this->sendResponsestoreOrUpdateSuccess($area, $create);
            } else {
                return $this->sendResponsestoreOrUpdateFailed($create);
            }

        } catch(Exception $e){
            DB::rollBack();

            return $this->sendExceptionError($e);
        }
    }
}
