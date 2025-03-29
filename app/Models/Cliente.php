<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'username', 'telefono',
    ];

    // Relación inversa con User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
