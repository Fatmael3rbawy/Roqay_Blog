<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit My Profile') }}
        </h2>
    </x-slot>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/post.css') }}">

    <!------ Include the above in your HEAD tag ---------->

    <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">

                <h2>Update My Profile</h2><br>

                <form action="{{route('user.update',Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label >Name <span class="require">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}" />
                    </div>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label >Email <span class="require">*</span></label>
                        <input type="text" class="form-control" name="email" value="{{Auth::user()->email}}" />
                    </div>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="title">Upload Image <span class="require">*</span></label>
                        <input type="file" class="form-control" name="image" />
                    </div>
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <br>
                    <div class="form-group">
                        <p><span class="require">*</span> - required fields</p>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                        <button class="btn btn-default">
                            Cancel
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>