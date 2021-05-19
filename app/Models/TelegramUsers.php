<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramUsers extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getMilk() {
        return $this->hasOne(Milks::class, 'telegram_user_id', 'id');  //получаем запись с таблицы Milk
    }

    public function getSticks() {
        return $this->hasOne(Stics::class, 'telegram_user_id', 'id'); //получаем запись с таблицы Sticks
    }


}
