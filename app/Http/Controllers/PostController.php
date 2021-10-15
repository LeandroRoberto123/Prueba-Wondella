<?php

namespace App\Http\Controllers;
use App\Models\post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function guardarPost (Request $request){
        //dd($request->key4);
        $guardarInfo = new post();
        $guardarInfo->description=$request->key1;
        $guardarInfo->photo=$request->key2;
        $guardarInfo->video=$request->key3;
        $guardarInfo->id_usuarioSession=$request->key4;
        $guardarInfo->save();
    }
}
