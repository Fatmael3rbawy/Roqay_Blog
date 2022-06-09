@extends('layouts.admin')
@section('title')
    Edit Profile
@endsection
@section('content')
    <div class="container-fluid py-4">
        <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6">

                </div>
                <div class="col-lg-6 text-right d-flex flex-column justify-content-center">

                    <button type="submit"
                        class="btn bg-gradient-primary mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2">Save</button>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="font-weight-bolder">Profile Image</h5>
                            <div class="row">
                                <div class="col-12">
                                    <img class="w-100 border-radius-lg shadow-lg mt-3" name='image'
                                        src="{{asset('images\users/'.Auth::user()->image)}}" alt="profile_image">
                                </div>
                                <div class="col-12 mt-4">
                                    <div class="d-flex">
                                        <input type="file" name="image" class="btn bg-gradient-primary btn-sm mb-0 me-2"  />
                                    </div>
                                </div>
                                @error('image')
                                    <div style="color:red" >{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mt-lg-0 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="font-weight-bolder">Profile Information</h5><br>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label>Name</label><br>
                                    <input class="form-control" type="text" name='name' value="{{ Auth::user()->name }}" />
                                </div>
                            </div>
                            @error('name')
                                <div style="color:red" >{{ $message }}</div>
                            @enderror
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label>Email</label><br>
                                    <input class="form-control" type="email" name='email' value="{{ Auth::user()->email }}" />
                                </div>
                            </div>
                            @error('email')
                                <div style="color:red" >{{ $message }}</div>
                            @enderror
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label>Address</label><br>
                                    <input class="form-control" type="text"  />
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </form>
    </div>
    <br><br><br><br>
@endsection
