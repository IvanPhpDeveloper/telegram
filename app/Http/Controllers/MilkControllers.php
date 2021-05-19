<?php

namespace App\Http\Controllers;

use App\Models\Milks;
use App\Models\Stics;
use App\Models\TelegramUsers;
use App\Traits\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MilkControllers extends Controller
{
    use Messages;

    public function index(){

        return view('pages.milk',[
            'records' => Milks::all(),
            'tgUsers' => TelegramUsers::doesnthave('getMilk')->get()
        ]);
    }

    public function delete()
    {
        $users = Milks::All();
        return redirect()->back();
    }

    public function destroy($id)
    {
        $user = Milks::where('id', $id)->firstorfail()->delete();
        echo ("User Record deleted successfully.");
        return redirect()->route('delete');
    }




    public function update(){
        $milks          = Milks::where('active',1);  //все записи с таблицы Milk
        $currentUser    = null;
        if($milks->count() === 0) {
            $currentUser = Milks::inRandomOrder()->first();
        } else {
            $currentUser = $milks->first();
        }
        $nextUser = Milks::where('id', ++$currentUser->id)->first();
        if(is_null($nextUser)) {
            $nextUser = Milks::limit(1)->first();
        }
        $milks->update(['active' => 0]);
        $nextUser->update(['active' => 1]);
        $this->sendMessage('Здравствуйите, '.$nextUser->getTelegramUser()->first()->first_name.'. Меня зовут Анастасия, служба поддержки monobank. По братски,купи молочка. Благодарим за сотрудничество!', $nextUser->getTelegramUser()->first()->chat_id);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
           'user'   => [
               'int', 'required', 'exists:telegram_users,id'
           ]
        ]);
        if(Milks::where('telegram_user_id', $request->user)->count() > 0) {
            return redirect()->back();
        }
        $milks = Milks::insert([
           'telegram_user_id' => $request->user,
        ]);
        return redirect()->back();
    }

}
