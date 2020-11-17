<?php

use Illuminate\Database\Seeder;
use App\Dzialy;


class DzialySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dzialy::create(
            [
                'nazwa' => 'EE.08'
            ]
        );
        Dzialy::create([
                'nazwa' => 'EE.09'
        ]);
    }
}
