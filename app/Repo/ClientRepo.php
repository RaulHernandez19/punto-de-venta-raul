<?php

namespace App\Repo;

use App\Models\Cliente;

class ClientRepo{

    public function edit($id, $data){
        $cliente= $this -> getClient($id);
        $cliente->update($data);
    }

    public function getClient($id){
        return Cliente::findOrFail($id);
    }

    public function delete($id)
    {

    $cliente = $this->getClient($id);
    return $cliente->delete();
    }


    public function getAll(){

    return Cliente::latest()->paginate(10);
    }




}
