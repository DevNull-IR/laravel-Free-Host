<?php

namespace DevNullIr\LaravelFreeHost;

use DevNullIr\LaravelFreeHost\core\bot\botConnection;
use DevNullIr\LaravelFreeHost\core\database\Models\Telegram_file;
use DevNullIr\LaravelFreeHost\core\traits\botMethod;
use DevNullIr\LaravelFreeHost\core\traits\setDefault;
use Illuminate\Support\Facades\Crypt;

class LaravelFreeHost
{
    use setDefault, botMethod;
    final protected function token(): string
    {
        return config("laravel-free-host.token");
    }

    final protected function bot($method, $datas = []){
        foreach ($datas as $Default => $value){
            if (isset($this->Default[$Default])){
                unset($this->Default[$Default]);
            }
        }
        $datas = [...$this->Default, ...$datas];

        $ch = curl_init("https://api.telegram.org/bot".config("laravel-free-host.token")."/$method");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
        $res = json_decode(curl_exec($ch));
        curl_close($ch);
        return $res;
    }
    final public function connect(array|object $data = [], string $method = "sendMessage"): object|array|int|bool
    {
        return $this->bot($method, $data);
    }

    /**
     * @throws core\Exceptions\FreeHostException
     */
    public function uploadFile(array $data = []): object|bool
    {
        if (!isset($data['name'])){
            return false;
        }
        if (isset($data['chat_id'])){
            unset($data['chat_id']);
        }
        $name_file = $data['name'];
        unset($data['name']);
        $sendFile = $this->sendDocument([
            'chat_id' => config("laravel-free-host.channel_id"),
            ...$data
        ]);
//        dd($sendFile);
        if ($sendFile->ok){
            $file = ($sendFile->result->document)->file_id;
            $caption = "NULL";
            if (isset($sendFile->result->caption)){
                $caption = $sendFile->result->caption;
            }
            $getfile = $this->connect(['file_id' => $file], 'getfile')->result->file_path;
            $filePath = "https://api.telegram.org/file/bot" . config("laravel-free-host.token") . "/$getfile";
            return Telegram_file::create([
                "url" => base64_encode(Crypt::encrypt($filePath)),
                "name" => $name_file
            ]);
        }
        return false;
    }
}
