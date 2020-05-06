<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAtgRequest;
use Illuminate\Http\Request;
use App\Traits\InsertData;

class WebServicesController extends Controller
{
    use InsertData;

    public function apiForm(AddAtgRequest $request){

        $data = $this->formAdd($request);

        if ($data){

            return response([
                'status' => 1,
                'message' => 'Form submitted successfully',
            ]);
        }
        else{

            return response([
                'status' => 0,
                'message' => 'Something went wrong',
            ]);
        }


    }
}
