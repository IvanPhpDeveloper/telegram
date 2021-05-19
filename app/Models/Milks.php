<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milks extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getTelegramUser() {
        return $this->belongsTo(TelegramUsers::class, 'telegram_user_id', 'id'); //1 к 1 Телеграм юзер к молоку
    }




}
