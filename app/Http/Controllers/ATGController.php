<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAtgRequest;
use App\User;


class ATGController extends Controller
{
    public function userForm(){

        $title = 'User Form';

        return view('user-form',compact('title'));
    }

    public function userFormAdd(AddAtgRequest $request){


        if(User::create($request->all())){

            return redirect()->route('user-form')->with('success-status','Form submitted successfully');
        }
        else{

            return redirect()->route('user-form')->with('error-status','Something went wrong');
        }
    }
}
