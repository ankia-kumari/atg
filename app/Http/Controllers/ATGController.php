<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAtgRequest;
use App\User;
use App\Traits\InsertData;
use Illuminate\Support\Facades\Log;

class ATGController extends Controller
{
    use InsertData;

    public function userForm(){

        $title = 'User Form';

        return view('user-form',compact('title'));
    }

    public function userFormAdd(AddAtgRequest $request){

        $data = $this->formAdd($request);

        if ($data)
        {
            return redirect()->route('user-form')->with('success-status','Form submitted successfully');
        }
        else
            {
                return redirect()->route('user-form')->with('error-status','Something went wrong');
            }
    }
}
