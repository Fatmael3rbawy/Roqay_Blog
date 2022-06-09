{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Post') }}
        </h2>
    </x-slot>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">

    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">

    <div class="container blog-page">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12">
                <div class="card single_post">
                  
                    <div class="body">
                        <h3 class="m-t-0 m-b-5"><a href="blog-details.html">Title: {{$post->title}}</a>
                        </h3>
                        <ul class="meta">
                            <li><a ><i class="zmdi zmdi-account col-blue"></i>Posted By:
                                  {{ $post->user->name}} </a></li>
                            <li><a ><i class="zmdi zmdi-label col-amber"></i>Tags</a>
                            </li>
                            <li><a ><i class="zmdi zmdi-comment-text col-blue"></i>Category:
                                    {{$post->category->name}}</a></li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="img-post m-b-15">
                            <img src="{{asset('images\posts/'.$post->image)}}" alt="post image">

                        </div>
                        <p>Body :{{$post->body}}</p>
                    </div>
                </div>
            </div>
           
        </div>
    </div>

</x-app-layout> --}}

@extends('layouts.admin')
@section('title')
    Post
@endsection
@section('content')
    <div class="container-fluid py-4">
            
           
            <div class="row mt-4">
                <div class="col-lg-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="font-weight-bolder">Post Image</h5>
                            <div class="row">
                                <div class="col-12">
                                    <img class="w-100 border-radius-lg shadow-lg mt-3" name='image'
                                        src="{{asset('images\posts/'.$post->image)}}" alt="post_image">
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mt-lg-0 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="font-weight-bolder">Post Information</h5><br>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label>Title</label><br>
                                    <p>{{ $post->title}} </p>
                                </div>
                            </div>
                         
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label>Body</label><br>
                                    <p>{{ $post->body }} </p>                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label>Category</label><br>
                                    <p>{{ $post->category ->name }} </p>                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </form>
    </div>
    <br><br><br><br>
@endsection
