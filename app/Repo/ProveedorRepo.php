<?php

namespace App\Repo;

use App\Models\Proveedor;

class ProveedorRepo{
    public function save($data){
        return Proveedor::create($data);
    }

    public function edit($id, $data){
        $proveedor= $this -> getProveedor($id);
        $proveedor->update($data);
    }

    public function getProveedor($id){
        return Proveedor::findOrFail($id);
    }

    public function getAll(){

    return Proveedor::latest()->paginate(10);
    }

    public function getProvByNames(){
        return Proveedor::orderBy('name')->get();
    }

    //Delete
    public function delete($id)
    {

    $proveedor = $this->getProveedor($id);
    return $proveedor->delete();
    }


}
