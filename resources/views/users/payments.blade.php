{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Payments') }}
        </h2>
      
    </x-slot>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/post.css') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <div class="table-responsive">
                      
                        <center>
                            <br>
                            @if ($payments->isEmpty())
                                <h3>
                                    <b style="color:red ;font-size: 3em;"> There are no Payments </b>
                                </h3>
                            @else
                                <table class="table user-list">
                                    <thead>
                                        <tr>
                                            <th><span>ID</span></th>
                                            <th><span>Invoice Status</span></th>
                                            <th><span>Invoice Value </span></th>
                                            <th><span>Created Date</span></th>
                                            <th><span>Expiry Date</span></th>
                                            <th><span>Expiry Time</span></th>

                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payments as $key => $payment)
                                            <tr>
                                                <td>
                                                    {{ $key + 1 }}
                                                </td>
                                                
                                                <td>
                                                    {{ $payment->invoice_status }}
                                                </td>

                                                <td>
                                                    {{ $payment->invoice_value }}
                                                </td>
                                                <td>
                                                    {{ $payment->created_date }}
                                                </td>
                                                <td>
                                                    {{ $payment->expiry_date }}
                                                </td>
                                                <td>
                                                    {{ $payment->expiry_time }}
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


</x-app-layout> --}}

@extends('layouts.admin')
@section('title')
    My Payments
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
                       
                        @if ($payments->isEmpty())
                               <h5> <div class="text-center" style="color:darkred"> There are no Payments </div></h5>
                        @else
                        <div class="d-lg-flex">
                            <div>
                                <h5 class="mb-0" style="color:cadetblue">All Transactions</h5>
                            </div>
                        </div>
                            <div class="card-body px-0 pb-0">
                                <div class="table-responsive">
                                    <table class="table table-flush" id="products-list">
                                        <thead class="thead-light">
                                            <tr style="color:cadetblue">
                                                <th><span>ID</span></th>
                                                <th><span>Invoice Status</span></th>
                                                <th><span>Invoice Value </span></th>
                                                <th><span>Created Date</span></th>
                                                <th><span>Expiry Date</span></th>
                                                <th><span>Expiry Time</span></th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($payments as $key => $transaction)
                                                <tr>
                                                    <td class="text-sm">{{ ++$key }}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <h6 class="ms-3 my-auto">{{ $transaction->invoice_status }}
                                                            </h6>
                                                        </div>
                                                    </td>
                                                    <td class="text-sm">{{ $transaction->invoice_value }}</td>
                                                    <td class="text-sm">{{ $transaction->created_date }}</td>
                                                    <td class="text-sm">{{ $transaction->expiry_date }}</td>
                                                    <td class="text-sm">{{ $transaction->expiry_time }}</td>


                                                    <td class="text-sm ">
                                                        <div class="flex">
                                                            <a data-bs-toggle="tooltip"
                                                                data-bs-original-title="Delete transaction">
                                                                <form method="POST" action="{{ route('transaction.destroy', $transaction->id) }}">
                                                                    @csrf
                                                                    <input name="_method" type="hidden" value="DELETE">
                                                                    <button type="submit" data-bs-toggle="tooltip"
                                                                        data-bs-original-title="Delete Account"
                                                                        class="fas fa-trash text-secondary show-alert-delete-box">
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
<br><br><br><br><br><br>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.show-alert-delete-box').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: "Are you sure you want to delete this transaction?",
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                type: "warning",
                buttons: ["Cancel", "Yes!"],
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
@endsection
