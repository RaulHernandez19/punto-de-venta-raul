<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function crearCliente(int $userId,array $data)
    {
        Cliente::create([
            'user_id' => $userId,
            'username' => $data['username'],
        'telefono' => $data['telefono']
        ]);

        User::find($userId)->assignRole('client');
    }
}
