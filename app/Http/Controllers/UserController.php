<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Throwable;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'sometimes|nullable|telefone_com_ddd',
            'cpf' => 'required|cpf'
        ];
        try {

            $requestData = $request->validate($rules);
            $requestData['cpf'] = preg_replace('/[.-]/', '', $requestData['cpf']);
            if (isset($requestData['phone'])){
                $requestData['phone'] = preg_replace('/[()-]/', '', $requestData['phone']);
            }
            

            $hashedPassword = Hash::make($requestData['password']);


            $user = new User($requestData);
            $user->password = $hashedPassword;
            $user->save();

            return response()->json($user, 201);
        } catch (Throwable $e) {
            if ($e instanceof ValidationException){
                return response()->json($e->errors(), 400);
            }
            return response()->json(['message' => $e->getMessage()], 500);

        }
        
        
    }
}
