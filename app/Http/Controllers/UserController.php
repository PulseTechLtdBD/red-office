<?php

namespace App\Http\Controllers;

use DB;
use Exception;
use App\Models\Role;
use App\Models\User;
use App\Models\Department;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\IndexUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Inertia\Inertia;

class UserController extends CRUDController
{
    protected $modelName = 'User';
    /**
     * Display a listing of the resource.
     */
    public function index(IndexUserRequest $request) : mixed
    {
        
        try{
            $validated = $request->validated();

            $paginate = $validated['paginate'] ?? $this->paginate;
            $orderBy  = $validated['order_by'] ?? 'id';
            $order    = $validated['order'] ?? 'asc';

            $data = User::orderBy($orderBy, $order)->get();

            if($data){
                return Inertia::render('Admin/Users/Index', [
                    'users' => $data
                ]);
            } else{
                return Inertia::render('Admin/Users/Index', [
                    'users' => []
                ]);
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
       return Inertia::render('Admin/Users/CreateUpdate', [
        'pageTitle' => 'User Create',
        'users' => null,
       ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        info($request->input('name'));
        // try{
        //     return $this->storeOrUpdate($request, 0);
        // } catch(Exception $e){
        //     return $this->sendExceptionError($e);
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $user = User::find($id);
            if($user){
                return $this->sendResponseShowSuccess($user);
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
    public function edit($id)
    {
        $user = User::find($id);
        if($user) {
            return Inertia::render('Admin/Users/CreateUpdate', [
                'users' => $user
            ]);
        } else {
            return Inertia::render('Admin/Users/CreateUpdate', [
                'users' => []
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, int $id)
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
    public function destroy(string $id)
    {
        try{
            $user = User::find($id);
            if($user){
                $user->delete();
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
                $org    = User::find($id);

                if(!$org) {
                    return $this->sendResponseShowFailed();
                }
            } else {
                $create = true;
                $org    = new User;
            }

            $validated = $request->validated();
    
            DB::beginTransaction();

            $org->name          = $validated['name'];
            $org->email         = $validated['email'];
            $org->password      = $validated['password'];
            
            $res = $org->save();

            if ($res) {
                DB::commit();

                return $this->sendResponsestoreOrUpdateSuccess($org, $create);
            } else {
                return $this->sendResponsestoreOrUpdateFailed($create);
            }
        } catch(Exception $e){
            return $this->sendExceptionError($e);
        }
    }

    public function assignRole(int $userId, int $roleId) : mixed
    {
        $user = User::find($userId);
        $role = Role::find($roleId);

        if (!$user || !$role) {
            // No user or role found
        }

        $res = $user->roles()->sync([$role->id]);

        if ($res) {

        } else {

        }
    }

    public function assignDesignation(int $userId, int $desigId) : mixed
    {
        $user  = User::find($userId);
        $desig = Designation::find($desigId);

        if (!$user || !$desig) {
            // No user or designation found
        }

        $res = $user->syncRoles([$desig->id]);

        if ($res) {

        } else {
            
        }
    }
}
