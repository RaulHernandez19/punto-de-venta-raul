<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Proveedor extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'proveedors';
    protected $fillable = ['name','phone'];

    public function products()
    {
        return $this->hasMany(Producto::class);
    }
}
