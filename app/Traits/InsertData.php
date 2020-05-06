<?php


namespace App\Traits;

use App\Http\Requests\AddAtgRequest;
use App\Notifications\EmailNotification;
use App\User;
use Illuminate\Support\Facades\Log;

trait InsertData
{
  public function formAdd(AddAtgRequest $request){

      if($user = User::create($request->all())){

          // send email notification to the user
          $user->notify(new EmailNotification());

          // Log when email sent
          Log::alert('Email sent');
          return true;

      }
      else{
          Log::alert('Email sent fail');
          return false;
      }

  }
}
