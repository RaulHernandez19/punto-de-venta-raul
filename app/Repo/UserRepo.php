<?php

namespace App\Repo;

use App\Models\User;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserRepo
{
    public function getAllNonAdmins()
    {
        return User::whereDoesntHave('roles', function($query) {
            $query->where('name', 'admin');
        })->get();
    }

    public function save($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']), // Contraseña temporal
        ]);

        // Crear cliente asociado
        Cliente::create([
            'user_id' => $user->id,
            'username' => strtolower(str_replace(' ', '_', $data['name'])),
            'telefono' => '0000000000' // Valor temporal
        ]);

        $user->assignRole('client');
        return $user;
    }

    public function getUser($id){
        return User::findOrFail($id);
    }

    public function edit($id, $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->cliente()->delete(); // Eliminar cliente asociado
        $user->delete();
    }
}
