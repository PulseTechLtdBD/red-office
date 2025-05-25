<?php

namespace App\Http\Controllers;

use DB;
use Exception;
use App\Models\Department;
use App\Models\Organization;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Requests\IndexDepartmentRequest;
use Illuminate\Support\Str;

class DepartmentController extends CRUDController
{
    protected $modelName = "Department";
    /**
     * Display a listing of the resource.
     */
    public function index(IndexDepartmentRequest $request)
    {
        try{
            $validated = $request->validated();

            $paginate = $validated['paginate']??$this->paginate;
            $orderBy  = $validated['order_by']??$this->orderBy;
            $order    = $validated['order']??$this->order;

            $data = Department::orderBy($orderBy, $order)->paginate($paginate);

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request)
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
    public function show(int $id)
    {
        try{
            $dept = Department::find($id);
            if($dept){
                return $this->sendResponseShowSuccess($dept);
            } else{
                return $this->sendResponseShowFailed();
            }
        } catch(Exception $e){
            return $this->sendExceptionError($e);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, int $id)
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
    public function destroy(int $id)
    {
        try{
            $dept = Department::find($id);
            if($dept){
                $dept->delete();
                return $this->sendResponseDeleteSuccess();
            } else{
                return $this->sendResponseDeleteFailed();
            }
        } catch(Exception $e){
            return $this->sendExceptionError($e);
        }
    }

    private function storeOrUpdate($request, int $id = 0) : mixed
    {
        try{
            if($id > 0) {
                $create = false;
                $dept   = Department::find($id);

                if(!$dept) {
                    return $this->sendResponseShowFailed();
                }
            } else {
                $create = true;
                $dept   = new Department;
            }

            $validated = $request->validated();
    
            DB::beginTransaction();

            $dept->name                  = $validated['name'];
            $dept->slug                  = Str::of($validated['name'])->slug('-');
            $dept->code                  = $validated['code'];
            $dept->description           = $validated['description'];
            $dept->head_of_department_id = $validated['head_of_department_id'];
            $dept->parent_department_id  = $validated['parent_department_id'];
            $dept->budget                = $validated['budget'];
            $dept->contact_email         = $validated['contact_email'];
            $dept->contact_phone         = $validated['contact_phone'];
            
            $res = $dept->save();

            if ($res) {
                DB::commit();

                return $this->sendResponsestoreOrUpdateSuccess($dept, $create);
            } else {
                return $this->sendResponsestoreOrUpdateFailed($create);
            }
        } catch(Exception $e){
            return $this->sendExceptionError($e);
        }
    }

    public function assignOrganization(int $deptId, int $orgId) : mixed
    {
        $dept = Department::find($id);
        $org  = Organization::find($id);

        if(!$dept || !$org){

        }

        $res = $dept->syncRoles($dept->id);

        if($res){

        } else{
            
        }
    }
}
