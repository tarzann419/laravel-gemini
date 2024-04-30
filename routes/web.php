<?php

use Gemini\Data\Blob;
use Gemini\Enums\MimeType;
use Illuminate\Support\Facades\Route;
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Http\Request;

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


Route::get('/gemini-image-text-input', function(Request $request){
    // dd($request->message);
    $result = Gemini::geminiProVision()
    ->generateContent([
        $request->content,
        new Blob(
            mimeType: MimeType::IMAGE_JPEG,
            data: base64_encode(
                file_get_contents($request->image)
            )
        )
    ]);

    // you can pass this in your postman
    // {
    // "image": "https://storage.googleapis.com/generativeai-downloads/images/scones.jpg",
    // "content": "What is this picture?"
    // }   

    echo $result->text();
});
