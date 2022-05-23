<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Post') }}
        </h2>
    </x-slot>


    <!------ Include the above in your HEAD tag ---------->

    <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">

                <h1>Create post</h1>

                <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="title">Title <span class="require">*</span></label>
                        <input type="text" class="form-control" name="title" />
                    </div>
                    @error ('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="description">Body</label>
                        <textarea rows="5" class="form-control" name="body"></textarea>
                    </div>
                    @error('body')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">

                        <label for="title">Tags <span >*</span></label>
                        <select class="form-control" multiple name="tags[]" required style="width:500px ">
                            @foreach($tags as $value)
                            <option value="{{$value->id}}"> {{$value->name}} </option>
                            @endforeach
                        </select>

                    </div>
                  
                    <div class="form-group">

                        <label for="title">Category <span class="require">*</span></label>
                        <select class="form-control" type="text" name="category" required style="width:500px ">
                            @foreach($categories as $value)
                            <option value="{{$value->id}}"> {{$value->name}} </option>
                            @endforeach
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="title">Upload Image <span class="require">*</span></label>
                        <input type="file" class="form-control" name="image" />
                    </div>
                    @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <p><span class="require">*</span> - required fields</p>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Create
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