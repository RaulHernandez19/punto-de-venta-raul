<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListaDeseos extends Model
{
    public function user()
        {
            return $this->belongsTo(User::class);
        }
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function wishlist()
    {
        return $this->belongsToMany(Producto::class, 'lista_deseos')
                ->withTimestamps();
    }
}
