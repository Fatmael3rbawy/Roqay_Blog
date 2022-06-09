@extends('layouts.admin')
@section('title')
    Create Tag
@endsection
@section('content')
    <div class="container-fluid py-4">

        <div class="alert alert-success text-center" id='success_msg' style='display:none;'>
            Tag created successfully.
        </div>
        <form method="POST" id='tagForm'>
        @csrf
            <div class="row mt-4">
                <div class="col-lg-8 mt-lg-0 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="font-weight-bolder">Tag Information</h5>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <label>Name</label>
                                    <input class="form-control" type="text" name="name" />
                                </div>
                                    <div style="color:red" id="name"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-lg-6 text-right d-flex flex-column justify-content-center">
                    <button type="submit" class="btn bg-gradient-primary mb-0 ms-lg-auto me-lg-0 me-auto mt-lg-0 mt-2 "
                        id='save'>Save</button>
                </div>
            </div>
        </form>
    </div>
    <br><br><br><br><br><br><br>
@endsection
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
            data: new FormData($('#tagForm')[0]),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            url: "{{ route('tag.store') }}",
            
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
