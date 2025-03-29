<?php

namespace App\Repo;

use App\Models\Venta;

class VentaRepo{

    public function save($data){
        return Venta::create($data);
    }

    public function getAll(){
        return Venta::all();
    }


}
