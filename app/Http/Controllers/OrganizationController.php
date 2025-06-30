<?php

namespace App\Http\Controllers;

use DB;
use Exception;
use App\Models\Organization;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
use App\Http\Requests\IndexOrganizationRequest;
use Illuminate\Support\Str;
use Inertia\Inertia;

class OrganizationController extends CRUDController
{
    protected $modelName = 'Organization';
    /**
     * Display a listing of the resource.
     */
    public function index(IndexOrganizationRequest $request): mixed
    {
        try{
            $validated = $request->validated();

            $paginate = $validated['paginate'] ?? $this->paginate;
            $orderBy  = $validated['order_by'] ?? 'id';
            $order    = $validated['order'] ?? 'asc';

            $data = Organization::with('parent')->orderBy($orderBy, $order)->get();

            if($data){
                return Inertia::render('Admin/Organizations/Index', [
                    'organizations' => $data
                ]);
            } else{
                return Inertia::render('Admin/Organizations/Index', [
                    'organizations' => []
                ]);
            }
        } catch(Exception $e){
            return $this->sendExceptionError($e);
        }
    }

    public function create() : mixed
    {
       return Inertia::render('Admin/Organizations/CreateUpdate', [
        'organizations' => null,
        'allOrganizations' => Organization::select('id', 'name')->orderBy('name')->get(),
       ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrganizationRequest $request) : mixed
    {
        try{
            return $this->storeOrUpdate($request, 0);
        } catch(Exception $e){
            return $this->sendExceptionError($e);
        }
    }

    public function edit($id) : mixed
    {
        $org = Organization::find($id);
        if($org){
            return Inertia::render('Admin/Organizations/CreateUpdate', [
                'organizations' => $org,
                'allOrganizations' => Organization::where('id', '!=', $id)->select('id', 'name')->orderBy('name')->get(),
            ]);
        } else {
            return Inertia::render('Admin/Organizations/CreateUpdate', [
                'organizations' => [],
                'allOrganizations' => Organization::select('id', 'name')->orderBy('name')->get(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id) : mixed
    {
        try{
            $org = Organization::find($id);
            if($org){
                return $this->sendResponseShowSuccess($org);
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
    public function update(UpdateOrganizationRequest $request, int $id) : mixed
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
            $org = Organization::find($id);
            if($org){
                $org->delete();
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
                $org    = Organization::find($id);

                if(!$org) {
                    return $this->sendResponseShowFailed();
                }
            } else {
                $create = true;
                $org    = new Organization;
            }

            $validated = $request->validated();
    
            DB::beginTransaction();

            $org->name          = $validated['name'];
            $org->slug          = Str::slug($validated['name'], '-');
            $org->parent_id     = $validated['parent_id'] ?? null;
            $org->type          = $validated['type'];
            $org->contact_email = $validated['contact_email'] ?? null;
            $org->contact_name  = $validated['contact_name'];
            $org->website_url   = $validated['website_url'];
            $org->founded_at    = $validated['founded_at'];
            
            $res = $org->save();

            if ($res) {
                DB::commit();

                return $this->sendResponsestoreOrUpdateSuccess($org, $create);
            } else {
                return $this->sendResponsestoreOrUpdateFailed($create);
            }

        } catch(Exception $e){
            DB::rollBack();

            return $this->sendExceptionError($e);
        }
    }
}
