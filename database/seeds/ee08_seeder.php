<?php

use Illuminate\Database\Seeder;
use App\Odpowiedzi;
use App\Pytania;
use Illuminate\Support\Facades\Storage;

class ee08_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jsonFile = Storage::disk('local')->get('data/zapis_pytan_dzial1.json');
        $jsonData = json_decode($jsonFile);
        foreach ($jsonData as $question) {
            Pytania::create([
                'tresc' => $question->tresc,
                'image' => $question->image == "" ? "" : "/" . $question->image,
                'id_dzial' => 1
            ]);
        }
        $jsonFile = Storage::disk('local')->get('data/zapis_odpowiedzi_dzial1.json');
        $jsonData = json_decode($jsonFile);
        foreach ($jsonData as $answer) {
            Odpowiedzi::create([
                'tresc' => $answer->tresc,
                'id_pytanie' => $answer->id_pytanie,
                'poprawna' => $answer->poprawna
            ]);
        }
        $jsonFile = Storage::disk('local')->get('data/zapis_pytan_dzial2.json');
        $jsonData = json_decode($jsonFile);
        foreach ($jsonData as $question) {
            Pytania::create([
                'tresc' => $question->tresc,
                'image' => $question->image == "" ? "" : "/" . $question->image,
                'id_dzial' => 2
            ]);
        }
        $jsonFile = Storage::disk('local')->get('data/zapis_odpowiedzi_dzial2.json');
        $jsonData = json_decode($jsonFile);
        foreach ($jsonData as $answer) {
            Odpowiedzi::create([
                'tresc' => $answer->tresc,
                'id_pytanie' => $answer->id_pytanie,
                'poprawna' => $answer->poprawna
            ]);
        }
    }
}
