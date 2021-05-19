<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stics extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getTelegramUser() {
        return $this->belongsTo(TelegramUsers::class, 'telegram_user_id', 'id'); //Получаем данные и устанавливаем связь
    }
}
