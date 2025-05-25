<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Area;

class AreaSeeder extends Seeder
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
        $csvFilePath = base_path("database/data/areas.csv");
        $csvFile     = fopen($csvFilePath, 'r');
        
        while(($data = fgetcsv($csvFile, 2000, ',')) !== false){
            if(!$firstLine){
            $modelObj            = new Area;
            $modelObj->name      = $data[0];
            $modelObj->slug      = Str::of($data[0])->slug('-');
            $modelObj->parent_id = $data[1];
            $modelObj->latitude  = $data[2];
            $modelObj->longitude = $data[3];
            $modelObj->save();
            }
            $firstLine = false;
        }
        fclose($csvFile);
    }
}
