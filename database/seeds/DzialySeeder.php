<?php

use Illuminate\Database\Seeder;
use App\Dzialy;
use App\Odpowiedzi;
use App\Pytania;


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
        Dzialy::create([
                'id' => 0,
                'nazwa' => 'Techniczny'
        ]);

        Pytania::create([
            'id' => 0,
            'tresc' =>  "0",
            'id_dzial' => 0,
            'image' => ''
        ]);
        Odpowiedzi::create([
            'id' => 0,
            'tresc' => 'Niepoprawna to jest pewne',
            'poprawna' => false,
            'id_pytanie' => 0
        ]);
    }
}
