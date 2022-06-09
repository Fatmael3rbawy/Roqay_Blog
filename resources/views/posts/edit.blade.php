
@extends('layouts.admin')
@section('title')
    Edit Post
@endsection
@section('content')
    <div class="container-fluid py-4">
        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" id="postForm">
            @csrf
            <div class="row">
              
                <div class="col-lg-6 text-right d-flex flex-column justify-content-center">
                    <button type="submit"
                        class="btn bg-gradient-primary mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2" id="save" >Save</button>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="font-weight-bolder">Post Image</h5>
                            <div class="row">

                                <div class="col-12">
                                    <img class="w-100 border-radius-lg shadow-lg mt-3"
                                        src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
                                        alt="product_image">
                                </div>
                                <div class="col-12 mt-4">
                                    <div class="d-flex">
                                        <input type="file" name="image" class="btn bg-gradient-primary btn-sm mb-0 me-2" />
                                    </div>
                                </div>
                                @error('image')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mt-lg-0 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="font-weight-bolder">Post Information</h5>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label>Title</label>
                                    <input class="form-control" type="text" name="title" value="{{ $post->title }}" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="mt-4">Body</label>

                                    <div id="edit-deschiption-edit" class="h-50">
                                        <textarea name="body">{{ $post->body }}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="mt-4">Category</label>
                                    <select class="form-control" name="category" id="choices-category-edit">
                                        <option value="{{ $post->category->id }}" selected="">
                                            {{ $post->category->name }}
                                        </option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label class="mt-4">Tags</label>
                                    <select class="form-control" name="tags[]" id="choices-tags-edit" multiple>
                                        @foreach ($post->tags as $tag)
                                            <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
                                        @endforeach
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
 @endsection
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '#save', function(e) {
        console.log( $(this).attr('action'));
        e.preventDefault();
        $.ajax({
            type: 'POST',
            data: new FormData($('#postForm')[0]),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
           // url: "{{ route('posts.update') }}",
            url:  $(this).attr('action'),
            success: function(data) {
                if ($.isEmptyObject(data.error)) {
                        console.log(data.success);
                        $('#success_msg').show();
                        // $('#success_msg').innerHTML(data.success);
                        // location.reload();
                    } else {
                       
                        console.log(data.error);
                        for (var error in data.error) {
                            var div = document.getElementById(error);
                            (data.error[error]).forEach(element => {
                                div.style.display = 'block';
                                div.innerHTML = element;
                            });
                        }
                    }

            }
        });
    });
</script>
<br><br><br>
<script>
    if (document.getElementById('edit-deschiption-edit')) {
        var quill = new Quill('#edit-deschiption-edit', {
            theme: 'snow' // Specify theme in configuration
        });
    };

    if (document.getElementById('choices-category-edit')) {
        var element = document.getElementById('choices-category-edit');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };



    if (document.getElementById('choices-currency-edit')) {
        var element = document.getElementById('choices-currency-edit');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };

    if (document.getElementById('choices-tags-edit')) {
        var tags = document.getElementById('choices-tags-edit');
        const examples = new Choices(tags, {
            removeItemButton: true
        });

        examples.setChoices(
            [{
                    value: 'One',
                    label: 'Expired',
                    disabled: true
                },
                {
                    value: 'Two',
                    label: 'Out of Stock',
                    selected: true
                }
            ],
            'value',
            'label',
            false,
        );
    }
</script>

<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
