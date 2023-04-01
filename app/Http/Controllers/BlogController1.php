<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $posts = post::all();
    return view('index')->with('posts', $posts);    
    }
    public function create(){
        $posts = post::all();

        return view('create-post')->with('posts', $posts);
    }
    //berfungsi menangkap request dari database
    public function store(Request $request)
    {
        // dd($request->all());
        //'title'= nama kolom
        //sesuai name html
        $validated = $request->validate([
        'title' => 'required|unique:posts|max:255',
        'deskripsi' => 'required',
    ]);
        Post::create([
            'title'=> $request->title,
            'description'=> $request->deskripsi,
        ]);
        //membuat redirecet
        return redirect()->route('pos')->with('success','Berhasil Menambah Pos');
    }
}
