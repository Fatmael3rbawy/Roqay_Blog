<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
   
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">

    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
    @foreach($posts as $post)
    <div class="container blog-page">
        <div class="row clearfix">
           
            <div class="col-lg-4 col-md-12 ">
                <div class="card single_post">
                    <div class="header">
                    </div>
                    <div class="body clearfix" ::after>
                        <h3 class="m-t-0 m-b-5"><a href="blog-details.html">Title: {{$post->title}}</a>
                        </h3>
                        <ul class="meta">
                            <li><a href="javascript:void(0);"><i class="zmdi zmdi-account col-blue"></i>Posted By:
                                    {{$post->user->name}}</a></li>
                            <li><a href="javascript:void(0);"><i class="zmdi zmdi-label col-amber"></i>Tags</a>
                            </li>
                            <li><a href="javascript:void(0);"><i class="zmdi zmdi-comment-text col-blue"></i>Category:
                                    {{$post->category->name}}</a></li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="img-post m-b-15">
                            <img src="{{asset('images\posts/'.$post->image)}}" alt="post image">

                        </div>
                        <p>Body: {{$post->body}}</p>
                        <a href="{{route('posts.show',$post->id)}}" title="read more" class="btn btn-round btn-info">Read More</a>
                    </div>
                </div>
            </div>
           
        </div>
    </div>            @endforeach

    {{$posts->links()}}

</x-app-layout>