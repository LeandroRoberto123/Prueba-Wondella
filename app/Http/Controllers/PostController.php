<?php

namespace App\Http\Controllers;

use App\Models\FilePost;
use App\Models\post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function mostrarPost(Request $request)
    {
        $id_usuario = $request->id_usuario;
        return Post::with('multimedia')->orderBy('created_at', 'DESC')->get();
    }

    public function guardarPost(Request $request)
    {

        $description = $request->description;
        $id_usuario = $request->id_usuario;
        $img = $request->img;
        $video = $request->video;

        $nuevoPots = new Post();
        $nuevoPots->id_usuario = $id_usuario;
        $nuevoPots->description = $description;
        $nuevoPots->save();

        if (isset($img)) {
            foreach ($request->file('img') as $fileImg) {
                $name = uniqid() . '_' . time() . '.' . $fileImg->getClientOriginalExtension();
                $path_custom = "uploads/post/imagen/" . date("Y-m-d") . "/" . $id_usuario . "/";
                $path = storage_path() . '/app/public/' . $path_custom;
                $fileImg->move($path, $name);

                $insertFile = new FilePost();
                $insertFile->id_post = $nuevoPots->id;
                $insertFile->title_file = $name;
                $insertFile->name_file = $name;
                $insertFile->type_file = 'imagen';
                $insertFile->route_file = $path_custom . $name;
                $insertFile->save();
            }
        }

        if (isset($video)) {
            foreach ($request->file('video') as $fileVideo) {
                $name = uniqid() . '_' . time() . '.' . $fileVideo->getClientOriginalExtension();
                $path_custom = "uploads/post/video/" . date("Y-m-d") . "/" . $id_usuario . "/";
                $path = storage_path() . '/app/public/' . $path_custom;
                $fileVideo->move($path, $name);

                $insertFile = new FilePost();
                $insertFile->id_post = $nuevoPots->id;
                $insertFile->title_file = $name;
                $insertFile->name_file = $name;
                $insertFile->type_file = 'video';
                $insertFile->route_file = $path_custom . $name;
                $insertFile->save();
            }
        }

        //dd($request->key4);
        // $guardarInfo = new post();
        // $guardarInfo->description=$request->key1;
        // $guardarInfo->photo=$request->key2;
        // $guardarInfo->video=$request->key3;
        // $guardarInfo->id_usuarioSession=$request->key4;
        // $guardarInfo->save();
    }
}
