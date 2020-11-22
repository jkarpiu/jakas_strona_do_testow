<?php

use Illuminate\Database\Seeder;
use App\Dzialy;
use App\Odpowiedzi;
use App\Pytania;
use Illuminate\Support\Facades\Storage;

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


        $jsonFile = Storage::disk('local')->get('data/zapis_pytan.json');
        $jsonData = json_decode($jsonFile);
        foreach ($jsonData as $question) {
            Pytania::create([
                'tresc' => $question->tresc,
                'image' => $question->image == "" ? "" : "/" . $question->image,
                'id_dzial' => 1
            ]);
        }
        $jsonFile = Storage::disk('local')->get('data/zapis_odpowiedzi.json');
        $jsonData = json_decode($jsonFile);
        foreach ($jsonData as $answer) {
            Odpowiedzi::create([
                'tresc' => $answer->tresc,
                'id_pytanie' => $answer -> id_pytanie,
                'poprawna' => $answer -> poprawna
            ]);
        }
    }
}
