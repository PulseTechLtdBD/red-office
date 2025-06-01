<?php

namespace App\Http\Controllers;

use DB;
use Exception;
use App\Models\Address;
use App\Http\Requests\IndexAddressRequest;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AddressController extends CRUDController
{
    protected $modelName = 'Address';
    /**
     * Display a listing of the resource.
     */
    public function index(IndexAddressRequest $request) : mixed
    {
        try{
            $validated = $request->validated();

            $paginate = $validated['paginate']??$this->paginate;
            $orderBy  = $validated['order_by']?? 'id';
            $order    = $validated['order']?? 'asc';

            $data = Address::orderBy($orderBy, $order)->get();

            if($data){
                return Inertia::render('Admin/Addresses/Index', [
                    'addresses' => $data,
                ]);
                // return $this->sendResponseIndexSuccess($data);
            } else{
                return Inertia::render('Admin/Addresses/Index', [
                    'addresses' => [],
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
        return Inertia::render('Admin/Addresses/CreateUpdate', [
            'pageTitle' => 'Address Create',
            'address' => null,
           ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddressRequest $request) : mixed
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
            $add = Address::find($id);
    
            if($add){
                return $this->sendResponseShowSuccess($add);
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
    public function edit(int $id) : mixed
    {
        $address = Address::find($id);
        if($address){
            return Inertia::render('Admin/Addresses/CreateUpdate',[
                'address' => $address,
            ]);
        } else {
            return Inertia::render('Admin/Addresses/CreateUpdate',[
                'address' => [],
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddressRequest $request, int $id) : mixed
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
            $add = Address::find($id);
            if($add){
                $add->delete();
                return $this->sendResponseDeleteSuccess();
            } else{
                return $this->sendResponseDeleteFailed();
            }
        } catch(Exception $e){
            return $this->sendResponseError($e);
        }
    }
    private function storeOrUpdate($request, int $id = 0): mixed
    {
        try{
            if($id > 0) {
                $create = false;
                $add    = Address::find($id);

                if(!$add) {
                    return $this->sendResponseShowFailed();
                }
            } else {
                $create = true;
                $add    = new Address;
            }

            $validated = $request->validated();
    
            DB::beginTransaction();

            $add->type              = $validated['type'];
            $add->name              = $validated['name'];
            $add->slug              = Str::slug($validated['name'], '-');
            $add->street_address    = $validated['street_address'];
            $add->apartment_address = $validated['apartment_address'];
            $add->area_id           = $validated['area_id'];
            $add->zip_code          = $validated['zip_code'];
            $add->latitude          = $validated['latitude'];
            $add->longitude         = $validated['longitude'];
            $add->is_primary        = $validated['is_primary'];
            $add->contact_name      = $validated['contact_name'];
            $add->contact_phone     = $validated['contact_phone'];
            $add->addressable_type  = $validated['addressable_type'];
            $add->addressable_id    = $validated['addressable_id'];
            
            $res = $add->save();

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
