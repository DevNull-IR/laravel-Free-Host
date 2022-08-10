<?php

namespace DevNullIr\LaravelFreeHost\core\traits;

use DevNullIr\LaravelFreeHost\core\Exceptions\FreeHostException;

trait botMethod
{
    /**
     * @throws FreeHostException
     */
    public function sendMessage(array $data = []): object|array|bool|int
    {
        if (isset($data['text'])){
            if (is_string($data['text'])){
                if (isset($data['chat_id'])){
                    if (is_numeric($data['chat_id'])) {
                        return $this->connect($data);
                    }
                    throw new FreeHostException("please enter int chat_id in array");
                }elseif(isset($this->Default['chat_id'])){
                    if (is_numeric($this->Default['chat_id'])){
                        return $this->connect($data);
                    }
                    throw new FreeHostException("please enter int chat_id in array");
                } else
                    throw new FreeHostException("please enter chat_id in array");
            }
            throw new FreeHostException("please enter string text in array");
        }
        throw new FreeHostException("please enter text in array");
    }
    public function sendPhoto(array $data = []): object|array|bool|int
    {
        if (isset($data['photo'])){
            if (filter_var($data['photo'], 273)){
                if (isset($data['chat_id'])){
                    if (is_numeric($data['chat_id'])){
                        return $this->connect($data, 'sendphoto');
                    }
                    throw new FreeHostException("please enter int chat_id in array");
                }else{
                    if (isset($this->Default['chat_id'])){
                        if (is_numeric($this->Default['chat_id'])){
                            return $this->connect($data, "sendphoto");
                        }
                        throw new FreeHostException("please enter int chat_id in array");
                    }
                }
                throw new FreeHostException("please enter chat_id in array Or set Defult");
            }
            throw new FreeHostException("please enter url in photo array");
        }
        throw new FreeHostException("please enter url photo in array");
    }
    public function sendDocument(array $data = []): object|array|bool|int
    {
        if (isset($data['document'])){
            if (filter_var($data['document'], 273)){
                if (isset($data['chat_id'])){
                    if (is_numeric($data['chat_id'])){
                        return $this->connect($data, 'sendDocument');
                    }
                    throw new FreeHostException("please enter int chat_id in array");
                }else{
                    return $this->connect($data, 'sendDocument');
                }
                throw new FreeHostException("please enter chat_id in array");
            }
            throw new FreeHostException("please enter url in photo array");
        }
        throw new FreeHostException("please enter url photo in array");
    }
}
