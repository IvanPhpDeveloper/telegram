<?php

namespace App\Http\Controllers;

use App\Models\Milks;
use App\Models\Stics;
use App\Models\TelegramUsers;
use App\Traits\Messages;
use Illuminate\Http\Request;

class SticksController extends Controller
{
    use Messages;
    public function index(){
        return view('pages.stick',[
            'records'=>Stics::all(),
            'tgUsers' => TelegramUsers::doesnthave('getSticks')->get(),


        ]);
    }
    public function delete()
    {
        $users = Stics::All();
        return redirect()->back();
    }

    public function destroy($id)
    {
        $user = Stics::where('id', $id)->firstorfail()->delete();
        echo ("User Record deleted successfully.");
        return redirect()->back();
    }



    public function update(){
        $sticks          = Stics::where('active',1);  //все записи с таблицы Stics
        $currentUser    = null;
        if($sticks->count() === 0) {
            $currentUser = Stics::inRandomOrder()->first();
        } else {
            $currentUser = $sticks->first();
        }
        $nextUser = Stics::where('id', ++$currentUser->id)->first();
        if(is_null($nextUser)) {
            $nextUser = Stics::limit(1)->first();
        }
        $sticks->update(['active' => 0]);
        $nextUser->update(['active' => 1]);
        $this->sendMessage('Здравствуйите, '.$nextUser->getTelegramUser()->first()->first_name.'. Меня зовут Анастасия, служба поддержки monobank. По братски,купи стики. Благодарим за сотрудничество!', $nextUser->getTelegramUser()->first()->chat_id);
    }


    public function createStickUser(Request $request){

        $userStick=$request->validate([
           'userStick'=>[
               'int','required', 'exists:telegram_users,id'
           ]

        ]);
        if(Stics::where('telegram_user_id', $request->userStick)->count() > 0) {
            return redirect()->back();
        }
        $userStick = Stics::insert([
            'telegram_user_id' => $request->userStick,
        ]);
        return redirect()->back();
    }
}
