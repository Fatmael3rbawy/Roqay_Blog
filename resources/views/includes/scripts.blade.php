@push('scripts')
 {{-- create/update AJAX --}}

 <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#Form').on('submit', function(e) {
      
        console.log( $(this).attr('method'));
        console.log( $(this).attr('action'));
      //  var form_data = new FormData($('#Form')[0]);
        e.preventDefault();
        // $.ajax({
        //         type:  $(this).attr('method'),
        //         data: form_data ,
        //         dataType: 'json',
        //         contentType: false,
        //         cache: false,
        //         processData: false,
        //         url:  $(this).attr('action'),
        //         success: function(data) {

        //             if ($.isEmptyObject(data.error)) {
        //                 console.log(data.success);
        //                //  $('#success_msg').innerHTML(data.success);
        //                 // location.reload();
        //             } else {
        //                 console.log(data.error);
        //                 for (var error in data.error) {
        //                     var div = document.getElementById(error);
        //                     (data.error[error]).forEach(element => {
        //                         div.style.display = 'block';
        //                         div.innerHTML = element;

        //                     });

        //                 }


        //             }
        //         }
            

        //     // ,
        //     // error:function(response){

        //     //    console.log(response);
        //     // }
        // });
    });
</script>

@endpush