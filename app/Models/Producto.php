<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre',
        'categoria',
        'stock',
        'precio',
    ];

    /**
     * Relación: Un producto tiene muchos movimientos
     */
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }
}
