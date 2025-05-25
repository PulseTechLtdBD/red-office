<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserProfile;

class UserProfileSeeder extends Seeder
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
        } else {
            $this->csvSeed();
            $this->factorySeed();
        }
    }

    public function csvSeed(){
        $firstLine   = true;
        $csvFilePath = base_path("database/data/userprofiles.csv");
        $csvFile     = fopen($csvFilePath, 'r');
        
        while(($data = fgetcsv($csvFile, 2000, ',')) !== false){
            if(!$firstLine){
                $modelObj                           = new UserProfile;
                $modelObj->user_id                  = $data[0];
                $modelObj->first_name               = $data[1];
                $modelObj->middle_name              = $data[2];
                $modelObj->last_name                = $data[3];
                $modelObj->father_name              = $data[4];
                $modelObj->mother_name              = $data[5];
                $modelObj->spouse_name              = $data[6];
                $modelObj->designation_id           = $data[7];
                $modelObj->department_id            = $data[8];
                $modelObj->joined_at                = $data[9];
                $modelObj->employee_type            = $data[10];
                $modelObj->date_of_birth            = $data[11];
                $modelObj->gender                   = $data[12];
                $modelObj->blood_group              = $data[13];
                $modelObj->national_id              = $data[14];
                $modelObj->employee_id              = $data[15];
                $modelObj->passport_no              = $data[16];
                $modelObj->driving_license_no       = $data[17];
                $modelObj->employee_status          = $data[18];
                $modelObj->marital_status           = $data[19];
                $modelObj->religion                 = $data[20];
                $modelObj->nationality              = $data[21];
                $modelObj->emergency_contact_name   = $data[22];
                $modelObj->emergency_contact_number = $data[23];
                $modelObj->profile_picture_src      = $data[24];
                $modelObj->save(); 
            }
            $firstLine = false;
        }
        fclose($csvFile);
    }
}
