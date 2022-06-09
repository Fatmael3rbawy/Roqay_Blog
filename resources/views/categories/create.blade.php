@extends('layouts.admin')
@section('title')
    Create Category
@endsection
@section('content') 
    <div class="container-fluid py-4">
        <form method="POST" action="{{route('category.store')}}">
            @csrf
          
            <div class="row mt-4">
                <div class="col-lg-8 mt-lg-0 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="font-weight-bolder">Category Information</h5>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label>Name</label>
                                    <input class="form-control" type="text" name="name"  />
                                </div>
                                @error('name')
                                    <div style="color:red">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-6 text-right d-flex flex-column justify-content-center">
                    <button type="submit"
                        class="btn bg-gradient-primary mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2 ">Save</button>
                </div>
            </div>
        </form>
    </div>
    <br><br><br><br><br><br><br>
@endsection

