<?php

use Illuminate\Support\Facades\Route;
use Gemini\Laravel\Facades\Gemini;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/gemini', function () {
    // $gemini = Gemini::geminiPro()->generateContent('hello');
    $stream = Gemini::geminiPro()
    ->streamGenerateContent('complete the sentence: i fell down from the eiffel tower.');

    foreach ($stream as $response) {
        echo $response->text();
    }
    // dd($gemini->text());
}); 
