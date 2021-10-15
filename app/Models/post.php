<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;
    protected $table = 'posts'; // Nombre de la tabla
    protected $primaryKey = 'id';      // Nombre de la llave primaria
    protected $fillable = [
        'id_usuarioSession','title','description', 'photo', 'video'
    ];
}
