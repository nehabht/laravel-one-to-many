@extends('layouts.admin')

@section('content')

<h2 class="text-center m-4">Create a new Post</h2>

<div class="container w-50 pt-4 ">
    @include('partials.errors')
    <form action="{{ route('admin.posts.store')}}" method="post">
    @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Learn php article" aria-describedby="title" value="{{ old('title')}}">
            <small id="helpId" class="text-muted">Type post title, max 150 carachters</small>
        </div>
        <div class="mb-3">
            <label for="cover_image" class="form-label">Cover image</label>
            <input type="text" name="cover_image" id="cover_image" class="form-control @error('title') is-invalid @enderror" placeholder="Url image" aria-describedby="cover_image" value="{{old('cover_image')}}">
            <small id="helpId" class="text-muted">Url of the image</small>
        </div>
        <div class="mb-3">
          <label for="content" class="form-label">Content</label>
          <textarea class="form-control" name="content" id="content" rows="4" value="{{old('content')}}"></textarea>
        </div>
        <button type="submit" class="btn btn-primary text-white">Add Post</button> 

    </form>
</div>

@endsection
