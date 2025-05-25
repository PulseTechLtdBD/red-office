<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Organization;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $driver = config("seed.default");

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
        $csvFilePath = base_path("database/data/organizations.csv");
        $csvFile     = fopen($csvFilePath, 'r');

        while(($data = fgetcsv($csvFile, 2000, ',')) !== false){
            if(!$firstLine){
            $modelObj                         = new Organization;
            $modelObj->name                   = $data[0];
            $modelObj->slug                   = Str::slug($data[0], '-');
            $modelObj->parent_id              = $data[1];
            $modelObj->type                   = $data[2];
            $modelObj->contact_email          = $data[3];
            $modelObj->contact_name           = $data[4];
            $modelObj->website_url            = $data[5];
            $modelObj->founded_at             = $data[6];
            $modelObj->save();
            }
            $firstLine = false;
        }
        fclose($csvFile);
    }
}
