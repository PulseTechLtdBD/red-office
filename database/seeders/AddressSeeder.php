<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Address;


class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $driver = config('seed.default');

        if($driver === 'csv'){
            $this->csvSeed();
        } else if($driver === 'factory'){
            $this->factorySeed();
        } else{
            $this->csvSeed();
            $this->factorySeed();
        }
    }

    public function csvSeed(){
        $firstLine   = true;
        $csvFilePath = base_path("database/data/addresses.csv");
        $csvFile     = fopen($csvFilePath, 'r'); 

        while(($data = fgetcsv($csvFile, 2000, ',')) !== false){
            if(!$firstLine){
            $modelObj                    = new Address;
            $modelObj->type              = $data[0];
            $modelObj->name              = $data[1];
            $modelObj->slug              = Str::slug($data[1],'-');
            $modelObj->street_address    = $data[2];
            $modelObj->apartment_address = $data[3];
            $modelObj->area_id           = $data[4];
            $modelObj->zip_code          = $data[5];
            $modelObj->latitude          = $data[6];
            $modelObj->longitude         = $data[7];
            $modelObj->is_primary        = $data[8];
            $modelObj->contact_name      = $data[9];
            $modelObj->contact_phone     = $data[10];
            $modelObj->addressable_type  = $data[11];
            $modelObj->addressable_id    = $data[12];
            $modelObj->save();
            }
            $firstLine = false;
        }
        fclose($csvFile);
    }
}
