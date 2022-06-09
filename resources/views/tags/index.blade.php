
@extends('layouts.admin')
@section('title')
    Tags
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
                                <h5 class="mb-0">All Tags</h5>

                            </div>
                            <div class="ms-auto my-auto mt-lg-0 mt-4">
                                <div class="ms-auto my-auto">
                                    <a href="{{ route('tag.create') }}"
                                        class="btn bg-gradient-primary btn-sm mb-0">+&nbsp;
                                        New
                                        Tag</a>
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
                                        <th>Tag</th>
                                        <th>User</th>
                                        <th>Created_at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tags as $key => $tag)
                                        <tr>
                                            <td class="text-sm">{{ ++$key }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <h6 class="ms-3 my-auto">{{ $tag->name }}</h6>
                                                </div>
                                            </td>
                                            <td class="text-sm">{{ $tag->user->name }}</td>
                                            <td class="text-sm">{{ $tag->created_at }}</td>


                                            <td class="text-sm ">
                                                <div class="flex">
                                                    
                                                    <a href="{{ route('tag.edit', $tag->id) }}" class="mx-3"
                                                        data-bs-toggle="tooltip" data-bs-original-title="Edit Tag">
                                                        <i class="fas fa-user-edit text-secondary"></i>
                                                    </a>
                                                    <a data-bs-toggle="tooltip" data-bs-original-title="Delete Tag">
                                                        <form method="POST"
                                                            {{-- action="{{ route('tag.destroy', $tag->id) }}" --}}
                                                            >
                                                            @csrf
                                                            {{-- <input name="_method" type="hidden" value="DELETE"> --}}
                                                             <button type="submit" data-bs-toggle="tooltip"
                                                                data-bs-original-title="Delete Account"
                                                                class="fas fa-trash text-secondary show-alert-delete-box" tag_id='{{$tag->id}}'>
                                                            </button>
                                                        </form>
                                                    </a>
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
    <script type="text/javascript">
        $('.show-alert-delete-box').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            var id = $(this).attr('tag_id');
            event.preventDefault();
            swal({
                title: "Are you sure you want to delete this tag?",
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                type: "warning",
                buttons: ["Cancel", "Yes!"],
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }) function() {
                $.ajax({
                    type: "POST",
                    url: "{{url('/tag/destroy')}}",
                    data: {id:id},
                    success: function (data) {
                                  //
                        }         
                });
            }
        });
    </script>
@endsection
