<?php

namespace App\Http\Controllers;

use DB;
use Exception;
use App\Models\Department;
use App\Models\Designation;
use App\Http\Requests\StoreDesignationRequest;
use App\Http\Requests\UpdateDesignationRequest;
use App\Http\Requests\IndexDesignationRequest;
use Illuminate\Support\Str;
use Inertia\Inertia;


class DesignationController extends CRUDController
{
    protected $modelName = "Designation";
    /**
     * Display a listing of the resource.
     */
    public function index(IndexDesignationRequest $request) : mixed
    {
        try{
            $validated = $request->validated();

            $paginate = $validated['paginate']??$this->paginate;
            $orderBy  = $validated['order_by']?? 'id';
            $order    = $validated['order']?? 'asc';

            $data = Designation::orderBy($orderBy, $order)->get();

            if($data){
                return Inertia::render('Admin/Designations/Index',[
                    'designations' => $data,
                ]);
                // return $this->sendResponseIndexSuccess($data);
            } else{
                return Inertia::render('Admin/Designations/Index',[
                    'designations' => []
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
    public function create()
    {
        return Inertia::render('Admin/Designations/CreateUpdate',[
            'pageTitle' => 'Designation Create',
            'designations' => null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDesignationRequest $request)
    {
        try{
            return $this->storeOrUpdate($request);
        } catch(Exception $e){
            return $this->sendExceptionError($e);
        }
    }

    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
            $desig = Designation::find($id);
            
            if($desig){
                return $this->sendResponseShowSuccess($desig);
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
        $desig = Designation::find($id);
        if($desig) {
            return Inertia::render('Admin/Designations/CreateUpdate', [
                'designations' => $desig
            ]);
        } else {
            return Inertia::render('Admin/Designations/CreateUpdate', [
                'designations' => []
            ]);
        }
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDesignationRequest $request, int $id)
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
            $desig = Designation::find($id);
            if($desig){
                $desig->delete();
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
                $desig   = Designation::find($id);

                if(!$desig) {
                    return $this->sendResponseShowFailed();
                }
            } else {
                $create = true;
                $desig   = new Designation;
            }

            $validated = $request->validated();
    
            DB::beginTransaction();

            $desig->name                   = $validated['name'];
            $desig->slug                   = Str::of($validated['name'])->slug('-');
            $desig->description            = $validated['description'];
            $desig->level                  = $validated['level'];
            $desig->contact_email          = $validated['contact_email'];
            $desig->contact_phone          = $validated['contact_phone'];
            
            $res = $desig->save();

            if ($res) {
                DB::commit();
                return $this->sendResponsestoreOrUpdateSuccess($desig, $create);
            } else {
                return $this->sendResponsestoreOrUpdateFailed($create);
            }
        } catch(Exception $e){
            return $this->sendExceptionError($e);
        }
    }

    public function assignDepartment(int $desigId, int $deptId) : mixed
    {
        $desigId = Designation::find($id);
        $deptId  = Department::find($id);

        if(!$desigId || $deptId){

        }

        $res = $desigId->syncRoles($dept->id);
        if($res){

        } else{
            
        }
    }
}
