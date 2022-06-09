@extends('layouts.admin')
@section('title')
    Create Post
@endsection
@section('content')
    <div class="alert alert-success text-center" id='success_msg' style='display:none;'>
        Post created successfully.
    </div>
    <div class="container-fluid py-4">
        {{-- <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" id='Form'> --}}
           
            <form id ='Form' enctype="multipart/form-data">
                @csrf
            <div class="row">
                <div class="col-lg-6 text-right d-flex flex-column justify-content-center">
                    <button type="submit" class="btn bg-gradient-primary mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2 "
                        id="save">Save</button>
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
                                    <div style="color:red" id="image"></div>
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
                                    <input class="form-control" type="text" name="title" />
                                </div>
                                    <div style="color:red" id="title"></div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="mt-4">Body</label>

                                    <div id="edit-deschiption-edit" class="h-50">
                                        <textarea name="body"></textarea>
                                    </div>
                                        <div style="color:red" id="body"></div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="mt-4">Category</label>
                                    <select class="form-control" name="category" id="choices-category-edit">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                        <div style="color:red" id="category"></div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label class="mt-4">Tags</label>
                                    <select class="form-control" name="tags[]" id="choices-tags-edit" multiple>

                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                               
                                    <div style="color:red" id='tags'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <br><br><br>
@endsection

<script>
    if (document.getElementById('choices-category-edit')) {
        var element = document.getElementById('choices-category-edit');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };

    if (document.getElementById('choices-tags-edit')) {
        var tags = document.getElementById('choices-tags-edit');
        const examples = new Choices(tags, {
            removeItemButton: true
        });

        // examples.setChoices(
        //     [{
        //             value: 'One',
        //             label: 'Expired',
        //             disabled: true
        //         },
        //         {
        //             value: 'Two',
        //             label: 'Out of Stock',
        //             selected: true
        //         }
        //     ],
        //     'value',
        //     'label',
        //     false,
        // );
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '#save', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            data: new FormData($('#Form')[0]),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            url: "{{ route('posts.store') }}",
            
            success: function(data) {
                if ($.isEmptyObject(data.error)) {
                        console.log(data.success);
                        $('#success_msg').show()
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
