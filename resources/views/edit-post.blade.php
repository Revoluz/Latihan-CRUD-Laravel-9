@extends('layout.app')

@section('title')
    Tambah pos
@endsection

@section('addons-css')
@endsection

@section('content')
    <div class="card mt-5">
        <div class="card-header">
            Data pos
        </div>
        <div class="card-body">
            <a href="post/create" class="btn btn-primary"> Tambah data</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Edit</th>
                        <th scope="col">image</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->description }}</td>
                            <td><img src="{{ Storage::url('public/blogs/') . $post->image }}" class="rounded"
                                    style="width: 250px"></td>
                            <td>

                                <a href="post/{{ $post->id }}/edit" class="btn btn-primary">Update</a>
                                <form action="/post/{{ $post->id }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    {{-- <p>{{ $post->title }}</p> --}}
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('addons-js')
@endpush
