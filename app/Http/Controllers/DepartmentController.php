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
use Inertia\Inertia;

class DepartmentController extends CRUDController
{
    protected $modelName = "Department";
    /**
     * Display a listing of the resource.
     */
    public function index(IndexDepartmentRequest $request) : mixed
    {
        try{
            $validated = $request->validated();

            $paginate = $validated['paginate']??$this->paginate;
            $orderBy  = $validated['order_by']?? 'id';
            $order    = $validated['order']?? 'asc';

            $data = Department::orderBy($orderBy, $order)->get();

            if($data){
                return Inertia::render('Admin/Departments/Index',[
                    'departments' => $data,
                ]);
                // return $this->sendResponseIndexSuccess($data);
            } else{
                return Inertia::render('Admin/Departments/Index',[
                    'departments' => []
                ]);
                // return $this->sendResponseIndexFailed();
            }
        } catch(Exception $e){
            return $this->sendExceptionError($e);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : mixed
    {
        return Inertia::render('Admin/Departments/CreateUpdate', [
            'pageCreate' => 'Department Create',
            'departments' => null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request) : mixed
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
    public function edit($id) : mixed
    {
        $department = Department::find($id);
        if($department){
            return Inertia::render('Admin/Departments/CreateUpdate', [
                'departments' => $department
            ]);
        } else {
            return Inertia::render('Admin/Departments/CreateUpdate', [
                'departments' => [],
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, int $id) : mixed
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
    public function destroy(int $id) :mixed
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
            $dept->head_of_department_id = $validated['head_of_department_id'] ?? null;
            $dept->parent_department_id  = $validated['parent_department_id'] ?? null;
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
