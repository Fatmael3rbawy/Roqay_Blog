<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Categories') }}
        </h2>
        <a href="{{route('category.create')}}">
            <center><b style="color:green">Create a new Category</b> </center>
        </a>
    </x-slot>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/post.css') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <div class="table-responsive">
                        @if(session('message'))
                        <div class='alert alert-success'>
                            <h6>
                                <center>{{session('message')}}</center>
                            </h6>
                        </div>
                        @endif
                        <center>
                            <br>
                            @if($categories->isEmpty())
                            <h3>
                                <b style="color:red ;font-size: 3em;"> There are no Categories </b>
                            </h3>
                            @else

                            <table class="table user-list">
                                <thead>
                                    <tr>
                                        <th><span>ID</span></th>
                                        <th><span> Name</span></th>
                                        <th><span>Created</span></th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $key => $category)
                                    <tr>
                                        <td>
                                            {{$key+1}}
                                        </td>
                                        <td>
                                            <a href="#" class="user-link">{{$category->name}}</a>
                                        </td>
                                        <td>
                                            {{$category->created_at}}
                                        </td>


                                        <td style="width: 20%;">

                                            <a href="{{route('category.edit',$category->id)}}" class="table-link">
                                                <span class="fa-stack">
                                                    <i class="fa fa-square fa-stack-2x"></i>
                                                    <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                </span>
                                            </a>
                                            <a class="table-link danger">

                                                <form method="POST"
                                                    action="{{ route('category.destroy',$category->id) }}">
                                                    @csrf
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit"
                                                        class="btn btn-xs btn-danger btn-flat show-alert-delete-box btn-sm"
                                                        data-toggle="tooltip" title='Delete'>
                                                        <span class="fa-stack">
                                                            <i class="fa fa-square fa-stack-2x"></i>
                                                            <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                                        </span>
                                                    </button>
                                                </form>
                                            </a>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @endif
                        </center>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <center>
        {{$categories->links()}}
    </center>
</x-app-layout>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.show-alert-delete-box').click(function(event){
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: "Are you sure you want to delete this category?",
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            type: "warning",
            buttons: ["Cancel","Yes!"],
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
    });
</script>