<?php

use Illuminate\Database\Seeder;
use App\schoolsModel;
use App\schoolType;
use App\regionsModell;
use App\citiesModel;
use App\regionsModel;

class SchoolSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        regionsModel::create([
            'name' => 'Śląskie'
        ]);

        citiesModel::create([
            'name' => 'Bielsko-Biała',
            'region_id' => 1
        ]);

        schoolType::create([
            'name' => 'Technikum'
        ]);

        schoolsModel::create([
            'name' => "ZSEEiM",
            'id_city' => 1,
            'id_school_type' => 1
        ]);
    }
}
