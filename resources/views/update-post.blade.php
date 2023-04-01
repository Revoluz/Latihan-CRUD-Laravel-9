@extends('layout.app')

@section('title')
    Tambah pos
@endsection

@section('addons-css')
@endsection

@section('content')
    <div class="card mt-5">
        <div class="card-body">
            <form action="/post/{{ $post->id }}" method="post" enctype="multipart/form-data">
                {{-- mencegah hack --}}
                @method('put')
                @csrf
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input name="title" type="text" class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title', $post->title) }}" id="judul">
                    @error('title')
                        <div id="validationServer04Feedback" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror " id="description">{{ old('description', $post->description) }}</textarea>
                    @error('description')
                        <div id="validationServer04Feedback" class="invalid-feedback">
                            {{-- Please select a valid state. --}}
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image"
                            aria-describedby="inputGroupFileAddon01" name="image">
                        <label class="custom-file-label" for="image">Choose file</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection

@push('addons-js')
@endpush
