<?php

namespace App\Http\Controllers;

use App\Models\TelegramUsers;
use Illuminate\Http\Request;

class TelegramUsersController extends Controller
{
      public function index(){
          return view('pages.TGusers',[
              'records'=>TelegramUsers::all()
          ]);
      }
}
