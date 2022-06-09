@extends('layouts.admin')
@section('title')
    Posts
@endsection
@section('content')
    @if (session('message'))
        <div class='alert alert-success'>
            <h6>
                <center>{{ session('message') }}</center>
            </h6>
        </div>
    @endif
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header pb-0">
                        <div class="d-lg-flex">
                            <div>
                                <h5 class="mb-0">All Posts</h5>

                            </div>
                            <div class="ms-auto my-auto mt-lg-0 mt-4">
                                <div class="ms-auto my-auto">
                                    <a href="{{ route('posts.create') }}"
                                        class="btn bg-gradient-primary btn-sm mb-0">+&nbsp;
                                        New
                                        Post</a>
                                    <button type="button" class="btn btn-outline-primary btn-sm mb-0" data-bs-toggle="modal"
                                        data-bs-target="#import">
                                        Import
                                    </button>
                                    <div class="modal fade" id="import" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog mt-lg-10">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ModalLabel">Import CSV</h5>
                                                    <i class="fas fa-upload ms-3"></i>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>You can browse your computer for a file.</p>
                                                    <input type="text" placeholder="Browse file..."
                                                        class="form-control mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="importCheck" checked="">
                                                        <label class="custom-control-label" for="importCheck">I accept the
                                                            terms and conditions</label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn bg-gradient-secondary btn-sm"
                                                        data-bs-dismiss="modal">Close
                                                    </button>
                                                    <button type="button" class="btn bg-gradient-primary btn-sm">Upload
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv"
                                        type="button" name="button">Export
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body px-0 pb-0">
                        <div class="table-responsive">
                            <table class="table table-flush" id="products-list">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Post</th>
                                        <th>Category</th>
                                        <th>Created_at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $key => $post)
                                        <tr>
                                            <td class="text-sm">{{ ++$key }}</td>
                                            <td>
                                                <div class="d-flex">

                                                    <img class="w-10 ms-3"
                                                        src="{{ asset('images\posts/' . $post->image) }}"
                                                        alt="post image">
                                                    <h6 class="ms-3 my-auto">{{ $post->title }}</h6>
                                                </div>
                                            </td>
                                            <td class="text-sm">{{ $post->category->name }}</td>
                                            <td class="text-sm">{{ $post->created_at }}</td>


                                            <td class="text-sm ">
                                                <div class="flex">
                                                    <a href="{{ route('posts.show', $post->id) }}"
                                                        data-bs-toggle="tooltip" data-bs-original-title="Preview Post">
                                                        <i class="fas fa-eye text-secondary"></i>
                                                    </a>
                                                    <a href="{{ route('posts.edit', $post->id) }}" class="mx-3"
                                                        data-bs-toggle="tooltip" data-bs-original-title="Edit Post">
                                                        <i class="fas fa-user-edit text-secondary"></i>
                                                    </a>
                                                    
                                                        <form >
                                                           

                                                            <button type="submit"
                                                                class="fas fa-trash text-secondary delete" post_id='{{$post->id}}'>
                                                            </button>
                                                        </form>
                                               
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{-- <script>
    $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        console.log('8');
        var id = $(this).attr('post_id');
        swal({
                title: "Are you sure!",
                type: "error",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes!",
                showCancelButton: true,
            },
            function() {
                $.ajax({
                    type: "POST",
                    url: "{{url('/post/destroy')}}",
                    data: {id:id},
                    success: function (data) {
                                  //
                        }         
                });
        });
    });
    </script> --}}
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            var post_id = $(this).attr('post_id');
            swal({
                title: "Are you sure you want to delete this post?",
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                type: "warning",
                buttons: ["Cancel", "Yes!"],
                confirmButtonColor: '#3085d6', 
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'

            }, function() {

                $.ajax({
                    type: 'DELETE',
                    data: [ 'id' : post_id],
                    dataType: 'json',
                   
                    url: "{{ route('posts.destroy') }}",
                    success: function(data) {

                        // if ($.isEmptyObject(data.error)) {
                        //     $('#success_msg').show();
                        //     //alert(data.success);
                        //     // location.reload();
                        // } else {
                        //     alert(data.error);
                        }

                    
                });
            });

        });
    </script>  
@endsection
