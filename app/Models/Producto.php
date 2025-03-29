<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'descripcion',
        'price',
        'public_price',
        'stock',
        'image_path'
        ,'proveedor_id'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }

    public function wishlistedBy()
    {
        return $this->belongsToMany(User::class, 'lista_deseos')
                    ->withTimestamps()
                    ->withPivot('deleted_at');
    }

    public function enWishlist()
{
    return $this->belongsToMany(User::class, 'lista_deseos');
}
}
