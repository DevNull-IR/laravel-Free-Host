<?php

namespace DevNullIr\LaravelFreeHost\core\bot;

class botConnection {
    public $res, $ch, $sock, $exec;
    public function __construct($ch, $sock){
        $this->ch = $ch;
        $this->sock = $sock;
    }
    public function read(){
        if(!$this->exec){
            if($this->sock){
                $res = "";
                while($pack = fread($this->ch, 4096)){
                    $res .= $pack;
                    if(strlen($pack) < 4096)break;
                }
                $res = explode("\r\n\r\n", $res, 2);
                $this->res = json_decode($res[1]);
                fclose($this->ch);
            }else{
                $this->res = json_decode(curl_exec($this->ch));
                curl_close($this->ch);
            }
            $this->exec = true;
        }
    }
    public function __get($param){
        if($param == 'result')
            return $this;
        $this->read();
        if(isset($this->res->$param))
            return $this->res->$param;
        return $this->res->result->$param;
    }
    public function __set($param, $val){
        $this->read();
        return $this->res->$param = $val;
    }
    public function __destruct(){
        if($this->sock && !$this->exec){
            fgetc($this->ch);
            fclose($this->ch);
        }
    }
}
