<?php

use Illuminate\Support\Facades\Crypt as Crypt;
use Illuminate\Support\Facades\Route;

Route::get("/" . config("laravel-free-host.viewer") . "/{name}", function (string $name){
    $getFile = \DevNullIr\LaravelFreeHost\core\database\Models\Telegram_file::where("name", $name)->get();
    if ($getFile->count() == 1){
        $getFile = $getFile->first();
//        dd($getFile);
        $fileData = file_get_contents(Crypt::decrypt(base64_decode($getFile->url)));
        return response($fileData)->withHeaders([
            "Content-Type" => " application/octet-stream"
        ]);
    }
    abort(404);
});








