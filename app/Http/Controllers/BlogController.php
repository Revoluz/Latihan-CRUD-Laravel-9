<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
                $posts = post::all();
    return view('edit-post')->with('posts', $posts);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //create nampililin view
    public function create()
    {
                $posts = post::all();

        return view('create-post')->with('posts', $posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //store prosesnya
    public function store(Request $request)
    {
                // dd($request->all());
        //'title'= nama kolom
        //sesuai name html
        $validatedData = $request->validate([
        'title' => 'required|unique:posts|max:255',
        'description' => 'required',
        
    ]);
        $image = $request->file('image');
        $image->storeAs('public/blogs', $image->hashName());
        Post::create([
            'title'=> $request->title,
            //ynang sting yang di database 
            'description'=> $request->description,
            'image'     => $image->hashName(),

        ]);
        //membuat redirecet
        return redirect('/post')->with('success','Berhasil Menambah Pos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    //edit menampilkan view
    public function edit(post $post)
    {
        $posts = post::all();
        return view('update-post',[
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    //update proses nya
    public function update(Request $request, post $post)
    {
        $rules =[
            'description' => 'required',
        ];
        if($request->title != $post->title){
            $rules['title'] = 'required|unique:posts';
        }
        $validatedData = $request->validate($rules);
            // Post::where('id', $post->id)->update($validatedData);
        if($request->file('image') == "") {

        $post->update([
            'title'     => $request->title,
            'description'   => $request->description
        ]);

    } else {

        //hapus old image
        Storage::disk('local')->delete('public/blogs/'.$post->image);

        //upload new image
        $image = $request->file('image');
        $image->storeAs('public/blogs', $image->hashName());

        $post->update([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'description'   => $request->description
        ]);

    }

        //membuat redirecet
        return redirect('post')->with('success','Berhasil Update Pos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        // dd($post);
        post::destroy($post->id);
        // $blog = post::findOrFail($post);
        Storage::disk('local')->delete('public/blogs/'.$post->image);
        $post->delete();
        // $blog->delete();

        //membuat redirecet
        return redirect('/post')->with('success','Post has been deleted');
    }
}
