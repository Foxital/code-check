<!--
<section class="py-5 newslatter-inner" style="background:#e7f3cd;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="main-title text-center mb-4">
                <span class="text-center text-black">GET STARTED INSTANTLY!</span>
                <h2 class="text-center text-black">Get only new update from this newsletter</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7">
                <form class="w-100 position-relative d-flex align-items-center" method="POST" id="cusnewsletterform" >
                    @csrf
                    <input type="text" placeholder="Enter your email" class="form-control shadow-4-strong" id="cusnewsletterformemail" name="email" required="">
                    <div class="button d-flex align-items-center">
                        <button type="submit" class="btn btn-dark">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
-->
<script>
    /*
$('#cusnewsletterform').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: "{{ route('user.save.subscribe') }}",
        type: 'POST',
        data: $('#cusnewsletterform').serialize(),
        error: function(err) {
            var geterr = err.responseJSON.errors;
            var erromg = '<ul>';
            for (var prop in geterr) {
                erromg += '<li>' + geterr[prop][0] + '</li>'
            }
            erromg += '</ul>';
            toastr.error(erromg);
        },
        success: function(obj) {
            toastr.clear();
            if (obj.success == '1') {
                toastr.success('Success');
                $('#cusnewsletterform')[0].reset();
            } else {
                toastr.error('Error', 'Please Try Again!');
            }
        }
    });
});

@php
    $rfid = Request::get('referral_id');
@endphp
    
@if($rfid!=''&&$rfid!=null)
    $.ajax({
        url: "{{ route('user.save.setreferalid') }}",
        type: 'POST',
        data: {
            referral_id: '{{ $rfid }}',
            _token: '{{ csrf_token() }}'
        },
        error: function(err) {

        },
        success: function(obj) {

        }
    });
@endif
*/
</script>
