<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $driver = config("seed.default");

        if($driver = 'csv'){
            $this->csvSeed();
        } else if($driver = 'factory'){
            $this->factorySeed();
        } else{
            $this->csvSeed();
            $this->factorySeed();
        }
    }

    public function csvSeed(){
        $firstLine   = true;
        $csvFilePath = base_path("database/data/departments.csv");
        $csvFile     = fopen($csvFilePath, 'r');

        while(($data = fgetcsv($csvFile, 2000, ',')) !== false){
            if(!$firstLine){
            $modelObj                        = new Department;
            $modelObj->name                  = $data[0];
            $modelObj->slug                  = Str::slug($data[0], '-');
            $modelObj->code                  = $data[1];
            $modelObj->description           = $data[2];
            $modelObj->head_of_department_id = $data[3];
            $modelObj->parent_department_id  = $data[4];
            $modelObj->budget                = $data[5];
            $modelObj->contact_email         = $data[6];
            $modelObj->contact_phone         = $data[7];
            $modelObj->save();
            }
            $firstLine = false;
        }
        fclose($csvFile);
    }
}
