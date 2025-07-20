<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\Role;
use App\Http\Requests\IndexRoleRequest;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RoleController extends CRUDController
{
    protected $modelName = 'Role';

    public function index(IndexRoleRequest $request): mixed
    {
        try {
            $validated = $request->validated();

            $paginate = $validated['paginate'] ?? $this->paginate;
            $orderBy  = $validated['order_by'] ?? $this->orderBy;
            $order    = $validated['order'] ?? $this->order;

            $data = Role::orderBy($orderBy, $order)->paginate($paginate);

            if ($data) {
                return $this->sendResponseIndexSuccess($data);
            } else {
                return $this->sendResponseIndexFailed();
            }
        } catch (Exception $e) {
            return $this->sendExceptionError($e);
        }
    }

    public function store(StoreRoleRequest $request): mixed
    {
        try {
            return $this->storeOrUpdate($request, 0);
        } catch (Exception $e) {
            return $this->sendExceptionError($e);
        }
    }

    public function show(int $id): mixed
    {
        try {
            $role = Role::find($id);

            if ($role) {
                return $this->sendResponseShowSuccess($role);
            } else {
                return $this->sendResponseShowFailed();
            }
        } catch (Exception $e) {
            return $this->sendExceptionError($e);
        }
    }

    public function update(UpdateRoleRequest $request, int $id): mixed
    {
        try {
            return $this->storeOrUpdate($request, $id);
        } catch (Exception $e) {
            return $this->sendExceptionError($e);
        }
    }

    public function destroy(int $id): mixed
    {
        try {
            $role = Role::find($id);
            if ($role) {
                $role->delete();
                return $this->sendResponseDeleteSuccess();
            } else {
                return $this->sendResponseDeleteFailed();
            }
        } catch (Exception $e) {
            return $this->sendExceptionError($e);
        }
    }

    private function storeOrUpdate($request, int $id = 0): mixed
    {
        try {

            if ($id > 0) {
                $create = false;
                $role   = Role::find($id);

                if (!$role) {
                    return $this->sendResponseShowFailed();
                }
            } else {
                $create = true;
                $role   = new Role;
            }

            $validated = $request->validated();

            DB::beginTransaction();

            $role->name         = $validated['name'];
            $role->display_name = $validated['display_name'];
            $role->description  = $validated['description'];

            $res = $role->save();

            if ($res) {
                DB::commit();

                return $this->sendResponsestoreOrUpdateSuccess($res, $create);
            } else {
                return $this->sendResponsestoreOrUpdateFailed($create);
            }
        } catch (Exception $e) {
            DB::rollBack();

            return $this->sendExceptionError($e);
        }
    }
}
