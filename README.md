# Free Host in laravel


---
---
---
#about


With this package, you can save your files in Telegram and use its link

This file can be a photo sticker and all kinds of files with different extensions

Telegram Id Developer: [@Dev_Null](https://t.me/laravel_city)

Telegram Id Group: [@laravel_city](https://t.me/laravel_city)

---

# Usage

We always used Facade, but this time you and we should not use Facades

Of course, there may be a change later and Facade will be completed, but do not use Facade for now


The namespace is: `DevNullIr\LaravelFreeHost;`

Change the config file and set the value of token to the value of your robot token and enter the value of channel_id to a numeric ID and the value of channel_username to your half-channel user without @ (at).

Now we create a new object of the class

To upload the file, we use the uploadFile method:

```php
$newObject = new \DevNullIr\LaravelFreeHost\LaravelFreeHost();

$newObject->uploadFile([
    "name" => "myimg.png",
    "chat_id" => $newObject->channel_id(),
    "document" => "https://cdn01.zoomit.ir/2022/8/galaxy-buds-2-pro-2.jpg?w=768"
]);
```
 Ok Down!


Now the file has been uploaded, but you encountered an error!

What is the reason for this error? Yes, you did not add the table to the database, use the following command:

```shell
php artisan migrate
```

Now make a request to send the file again and you will see that the file has been uploaded and added to the database

## get File


In order to receive the file you uploaded, you need to enter the following address:

[`http://127.0.0.1:8000/assets/images/myimg.png`](http://127.0.0.1:8000/assets/images/myimg.png)

Now the desired file has started to be downloaded and the work is finished =))


When uploading the file, the value of chat_id and document and name must be entered in the array

# Defaults

## set Default Method

```php
$newObject = new \DevNullIr\LaravelFreeHost\LaravelFreeHost();
$newObject->setDefault([
    "chat_id" => $newObject->channel_id()
]);
$newObject->uploadFile([
    "name" => "myimg.png",
    "document" => "https://cdn01.zoomit.ir/2022/8/galaxy-buds-2-pro-2.jpg?w=768"
]);
```
We can set a value that is always the same by default so that we don't need to call it in every request and complicate our work.


If you use setDefault like me, you can use the following methods without adding chat_id
But the priority is not with the setDefault value and the value you use in the method section has a higher priority, that is, if you use it like this, a message will be sent to my pv:

```php
$newObject = new \DevNullIr\LaravelFreeHost\LaravelFreeHost();
$newObject->setDefault([
    "chat_id" => $newObject->channel_id()
]);
$newObject->uploadFile([
    "name" => "myimg.png",
    "chat_id" => 997471963,
    "document" => "https://cdn01.zoomit.ir/2022/8/galaxy-buds-2-pro-2.jpg?w=768"
]);
```


You can customize the robot or use our robot

To use our robot, you must set the value of token equal to Default in the configuration file, otherwise enter your robot token.

If you use our bot and have your own channel, you must administrate our bot in your channel and give the bot access to send messages


Be sure to enter the config file information completely so as not to get into trouble
