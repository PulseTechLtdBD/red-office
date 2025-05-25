<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
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
        $csvFilePath = base_path("database/data/users.csv");
        $csvFile     = fopen($csvFilePath, 'r');

        while(($data = fgetcsv($csvFile, 2000, ',')) !== false){
            if(!$firstLine){
            $modelObj           = new User;
            $modelObj->name     = $data[0];
            $modelObj->email    = $data[1];
            $modelObj->password = $data[2];
            $modelObj->save();
        }
        $firstLine = false;
        }
    fclose($csvFile);
    }
}
