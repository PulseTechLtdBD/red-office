<?php

namespace App\Http\Controllers;

use DB;
use Exception;
use App\Models\UserProfile;
use App\Models\Department;
use App\Http\Requests\IndexUserProfileRequest;
use App\Http\Requests\StoreUserProfileRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use Illuminate\Support\Str;
use Inertia\Inertia;

class UserProfileController extends CRUDController
{
    protected $modelName = "UserProfile";
    /**
     * Display a listing of the resource.
     */
    public function index(IndexUserProfileRequest $request) : mixed
    {
        try{
            $validated = $request->validated();

            $paginate = $validated['paginate']??$this->paginate;
            $orderBy  = $validated['order_by']?? 'id';
            $order    = $validated['order']?? 'asc';

            $data = UserProfile::orderBy($orderBy, $order)->get();
            if($data){
                return Inertia::render('Admin/UserProfiles/Index', [
                    'user_profiles' => $data,
                ]);
                // return $this->sendResponseIndexSuccess($data);
            } else{
                return Inertia::render('Admin/UserProfiles/Index', [
                    'user_profiles' => [],
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
        return Inertia::render('Admin/UserProfiles/CreateUpdate', [
            'pageTitle' => 'User Profile Create',
            'user_profiles' => null,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserProfileRequest $request)
    {
        try{
            return $this->storeOrUpdate($request, 0);
        } catch(Exception $e){
            return $this->sendExceptioError($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id) : mixed
    {
        try{
            $userProfile = UserProfile::find($id);
            if($userProfile){
                return $this->sendResponseShowSuccess($userProfile);
            } else{
                return $this->sendResponseShowSuccess();
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
        $userProfiles = UserProfile::find($id);
        if($userProfiles){
            return Inertia::render('Admin/UserProfiles/CreateUpdate', [
                'user_profiles' => $userProfiles,
            ]);
        } else {
            return Inertia::render('Admin/UserProfiles/CreateUpdate', [
                'user_profiles' => [],
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserProfileRequest $request, int $id)
    {
        try{
            $userProfile = UserProfile::find($id);
            if($userProfile){
                return $this->storeOrUpdate($request, $id);
            }
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
            $userProfile = UserProfile::find($id);
            if($userProfile){
                $userProfile->delete();
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
                $create       = false;
                $userProfile  = UserProfile::find($id);

                if(!$userProfile) {
                    return $this->sendResponseShowFailed();
                }
            } else {
                $create       = true;
                $userProfile  = new UserProfile;
            }

            $validated = $request->validated();
    
            DB::beginTransaction(); 
            $userProfile->user_id                  = $validated['user_id'];
            $userProfile->first_name               = $validated['first_name'];
            $userProfile->middle_name              = $validated['middle_name'];
            $userProfile->last_name                = $validated['last_name'];
            $userProfile->father_name              = $validated['father_name'];
            $userProfile->mother_name              = $validated['mother_name'];
            $userProfile->spouse_name              = $validated['spouse_name'];
            $userProfile->designation_id           = $validated['designation_id'];
            $userProfile->department_id            = $validated['department_id'];
            $userProfile->joined_at                = $validated['joined_at'];
            $userProfile->employee_type            = $validated['employee_type'];
            $userProfile->date_of_birth            = $validated['date_of_birth'];
            $userProfile->gender                   = $validated['gender'];
            $userProfile->blood_group              = $validated['blood_group'];
            $userProfile->national_id              = $validated['national_id'];
            $userProfile->employee_id              = $validated['employee_id'];
            $userProfile->passport_no              = $validated['passport_no'];
            $userProfile->driving_license_no       = $validated['driving_license_no'];
            $userProfile->employee_status          = $validated['employee_status'];
            $userProfile->marital_status           = $validated['marital_status'];
            $userProfile->religion                 = $validated['religion'];
            $userProfile->nationality              = $validated['nationality'];
            $userProfile->emergency_contact_name   = $validated['emergency_contact_name'];
            $userProfile->emergency_contact_number = $validated['emergency_contact_number'];
            $userProfile->profile_picture_src      = $validated['profile_picture_src'];

            
            $res = $userProfile->save();

            if ($res) {
                DB::commit();
                return $this->sendResponsestoreOrUpdateSuccess($validated, $create);
            } else {
                return $this->sendResponsestoreOrUpdateFailed($create);
            }
        } catch(Exception $e){
            return $this->sendExceptionError($e);
        }
    }

    public function assignDepartment(int $userId, int $deptId) : mixed
    {
        $user = User::find($userId);
        $dept = Department::find($deptId);
        
        if (!$user || !$dept) {
            // No user or dept found
        }
        
        $userProfile = $user->profile()->id;
        $res         = $userProfile->syncRoles([$dept->id]);

        if ($res) {

        } else {
            
        }
    }
}
