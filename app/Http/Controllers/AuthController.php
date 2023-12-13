<?php

namespace App\Http\Controllers;
// php artisan make:controller AuthController

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuthController extends BaseController
{
    public function register(Request $request){

        $validator = Validator::make($request -> all(), [
            'name' => 'required'
        ]);

        $input = $request ->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['name'] = $user -> name;
        $success['token'] = $user -> createToken('Secret') -> plainTextToken;

        return $this -> sendResponse('','Sikeres regisztáció!');
    }
}
