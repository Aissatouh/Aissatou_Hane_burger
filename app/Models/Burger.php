<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Burger extends Model
{
    protected $fillable = [
        'nom', 'prix', 'image', 'description', 'stock'
    ];
    public function commandes() {
        return $this->belongsToMany(Commande::class);
    }
    //
}
