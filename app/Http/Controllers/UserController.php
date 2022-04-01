<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
    public function getAll() 
    {
        Log::info('GetAll users');
        try {
            $users = User::all();
            
            Log::info('Users done');

            return $users;
        } catch (\Exception $exception) {
            Log::error('Error-> '.$exception->getMessage());

            return ['error' => $exception->getMessage()];
        }
    }

    public function getOne($id)
    {
        $user = User::findOrFail($id);

        return $user;
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return 'User deleted';
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }   

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ];

        $user = User::create($data);

        return $user;
    }
    public function getRolByUser()
    {
        $userId = auth()->user()->id;

        $userRoles = User::find($userId)->roles->toArray();
    
        return $userRoles;
    }

}
