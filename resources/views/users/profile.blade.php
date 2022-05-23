<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Profile') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    @if(session('message'))
    <div class='alert alert-success'>
        <h6>
            <center>{{session('message')}}</center>
        </h6>
    </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="well well-sm">
                    <center>
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <img src="{{asset('images\users/'.Auth::user()->image)}}" alt="User Image"
                                    class="img-rounded img-responsive" />
                            </div>
                            <div class="col-sm-6 col-md-8">
                                <h3>
                                    {{ Auth::user()->name }}</h3><br>
                                <small><cite title="San Francisco, USA">San Francisco, USA <i
                                            class="glyphicon glyphicon-map-marker">
                                        </i></cite></small>
                                <p>
                                    <i class="glyphicon glyphicon-envelope"></i>{{ Auth::user()->email }}
                                    <br />

                                    <i class="glyphicon glyphicon-gift"></i>{{ Auth::user()->updated_at }}
                                </p>
                                <br>
                                <!-- Split button -->
                                <div class="btn-group">
                                    <a href="{{route('user.edit',Auth::user()->id)}}"> <button type="button"
                                            class="btn btn-primary">
                                            Update My Profile</button></a>
                                    <br>

                                    <form method="POST" action="{{ route('user.destroy',Auth::user()->id) }}">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <br><button type="submit"
                                            class="btn btn-xs btn-danger btn-flat show-alert-delete-box btn-sm"
                                            data-toggle="tooltip" title='Delete'>
                                            Delete My Account
                                        </button>
                                    </form>

                                    <br><br>
                                </div>
                    </center>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.show-alert-delete-box').click(function(event){
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: "Are you sure you want to delete your account?",
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