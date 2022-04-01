<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    
    public function getAll() 
    {
        Log::info('GetAll roles');
        try {
            $roles = Role::all();
            
            Log::info('Roles done');

            return $roles;
        } catch (\Exception $exception) {
            Log::error('Error-> '.$exception->getMessage());

            return ['error' => $exception->getMessage()];
        }
    }

    public function getOne($id)
    {
        $role = Role::findOrFail($id);

        return $role;
    }

    public function delete($id)
    {
        $role = Role::findOrFail($id);

        $role->delete();

        return 'Role deleted';
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }   

        $data = [
            'role' => $request->role
        ];

        $role = Role::create($data);

        return $role;
    }
}
