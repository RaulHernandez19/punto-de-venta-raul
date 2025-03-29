<?php

namespace App\Repo;

use App\Models\Producto;

class ProductoRepo{
    public function save($data){
        return Producto::create($data);
    }

    public function edit($id, $data){
        $producto= $this -> getProducto($id);
        $producto->update($data);
    }

    public function getProducto($id){
        return Producto::findOrFail($id);
    }

    public function getAll(){

    //return Producto::latest()->paginate(10);
    return Producto::latest()
    ->with('proveedor')
    ->paginate(10);
    }

    //Delete
    public function delete($id)
    {

    $producto = $this->getProducto($id);
    return $producto->delete();
    }


}
