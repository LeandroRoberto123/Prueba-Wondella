<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $primaryKey = 'id'; 
    protected $fillable = ['id_usuario','description'];


    public function multimedia()
    {
        return $this->hasMany(FilePost::class, 'id_post', 'id')->orderBy('type_file', 'DESC');
    }
}
