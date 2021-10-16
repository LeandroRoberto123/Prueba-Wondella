<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilePost extends Model
{
    use HasFactory;
    protected $table = 'files_posts';
    protected $primaryKey = 'id';
    protected $fillable = ['id_post', 'title_file', 'name_file', 'type_file', 'route_file'];
}
