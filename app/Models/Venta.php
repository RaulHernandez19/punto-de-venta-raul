<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venta extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'quantity'
        ,'producto_id'
    ];

    public function producto()
    {
        return $this->belongsTo(Proveedor::class, 'producto_id');
    }
}
