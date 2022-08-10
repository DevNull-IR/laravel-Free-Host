<?php

namespace DevNullIr\LaravelFreeHost\core\database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telegram_file extends Model
{
    use HasFactory;
    protected $fillable = [
        "url",
        "name"
    ];
}
