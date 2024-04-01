@extends('Admin.layouts.app')

@section('content')
@include('Admin.parts.nav')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header py-1">
        <div class="container-fluid">
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <div class="row">
                        <div class="col-md-12">
                            <h6 class="m-0 mt-2 font-weight-bold text-primary">order Id: REYO{{ sprintf("%06d", $data['id']) }}</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-7">
                      @php
                      $prods = json_decode($data['product_order_list'],true);
                      @endphp
                      @foreach ($prods as $k=>$prod)
                      <div class="row m-0 {{ $k!='0'?'border-top':'' }}">
                          <div class="col-2 p-0 ">
                              <img src="{{ asset('uploads/Product/' . $prod['image']) }}" class="img-fluid" alt="" />
                          </div>
                          <div class="col-10 position-relative text-left">
                            <h5 class="f15 my-1">{{ $prod['name'] }}</h5>
                            <p>₹ {{ $prod['price'] }} x {{ $prod['qty'] }} = ₹ {{ $prod['paid_price'] }}</p>
                          </div>
                      </div>
                      @endforeach
                      <div class="row m-0 border-bottom">
                        <div class="col-12 text-right">Sub Total: {{ $data['sub_total_amount'] }}</div>
                        <div class="col-12 text-right">Delivery Fees: {{ $data['delivery_fees'] }}</div>
                        <div class="col-12 text-right">Total: {{ $data['total_amount'] }}</div>
                      </div>
                      <br>
                      <br>
                    </div>
                    <div class="col-md-3">
                      <h4>Shipping Address</h4>
                      @php
                          $addr = json_decode($data['ship_address'],true);
                      @endphp
                      <span class="smallspan">
                          {{ $addr['fname'] }} {{ $addr['lname'] }},<br> ({{ $addr['mobile_num'] }}), <br>{{ $addr['address'] }},  <br>{{ $addr['optional_name'] != '' ? $addr['optional_name'].',' : '' }}{{ $addr['city'] }},{{ $addr['state'] }}, <br> {{ $addr['country'] }} - {{ $addr['pin_code'] }}
                      </span>
                      <br>
                    </div>
                    <div class="col-md-2">
                      @if($data['paid']=='1')
                          <span class="badge badge-success">Paid</span>
                      @else
                          <span class="badge badge-danger">Payment Failed</span>
                      @endif
                      <br><small>{{ date_format(date_create($data['created_at']),"d-m-Y H:i:s") }}</small><br>

                      @if($data['paid']=='1')
                          @if ($data['status']=='1')
                              <span class="badge badge-success">Order Accepted</span>
                          @elseif ($data['status']=='2')
                              <span class="badge badge-info">Preparing for Dispatch</span>
                          @elseif ($data['status']=='3')
                              <span class="badge badge-info">Ready for Dispatch</span>
                           @elseif ($data['status']=='4')
                              <span class="badge badge-info">Dispatched</span>
                          @elseif ($data['status']=='5')
                              <span class="badge badge-info">Delivered</span>
                          @elseif ($data['status']=='0')
                              <span class="badge badge-danger">Cancelled</span>
                          @endif
                      @endif
                      <br>
                      <form class="row mt-3" id="statusupdate">
                        @csrf
                        @method('PUT')
                        <div class="form-group col-12">
                          <select id="status" name="status" class="form-control">
                            <option value="1" {{ $data['status']=='1'?'selected':'' }}>Order Accepted</option>
                            <option value="2" {{ $data['status']=='2'?'selected':'' }}>Preparing for Dispatch</option>
                            <option value="3" {{ $data['status']=='3'?'selected':'' }}>Ready for Dispatch</option>
                            <option value="4" {{ $data['status']=='4'?'selected':'' }}>Dispatched</option>
                            <option value="5" {{ $data['status']=='5'?'selected':'' }}>Delivered</option>
                            <option value="0" {{ $data['status']=='0'?'selected':'' }}>Cancelled</option>
                          </select>
                        </div>
                        <div class="form-group col-12 text-right">
                          <button type="submit" class="btn btn-success">Update</button>
                        </div>
                      </form>
                    </div>
                    
                    @if($data['status']=='3')
                    <div class="form-group col-12 text-right">
                         <button onclick="generate()" class="btn btn-success">Generate Manifest</button>
                    </div>
                    @endif
                    
                    @if($data['status']=='3' && $data['is_manifested']=='1')
                    <div class="form-group col-12 text-right">
                         <button onclick="print()" class="btn btn-success">Print Manifest</button>
                    </div>
                    @endif
                    
                    <div class="col-md-3">
                      <h4>razorpay_order_id</h4>
                      <p>{{ $data['razorpay_order_id'] }}</p>
                    </div>
                    <div class="col-md-3">
                      <h4>razorpay_payment_id</h4>
                      <p>{{ $data['razorpay_payment_id'] }}</p>
                    </div>
                    <div class="col-md-3">
                      <h4>coupon</h4>
                      <p>{{ $data['coupon'] }}</p>
                    </div>
                    <div class="col-md-3">
                      <h4>coupon_price</h4>
                      <p>{{ $data['coupon_price'] }}</p>
                    </div>
                    <div class="col-md-3">
                      <h4>wallet_taken</h4>
                      <p>{{ $data['wallet_taken'] }}</p>
                    </div>
                    <div class="col-md-3">
                      <h4>paid_to_wallet</h4>
                      <p>{{ $data['paid_to_wallet'] }}</p>
                    </div>

                    <div class="col-md-3">
                      <h4>return_status</h4>
                      <p>{{ $data['return_status'] }}</p>
                    </div>
                    <div class="col-md-3">
                      <h4>return_txt</h4>
                      <p>{{ $data['return_txt'] }}</p>
                    </div>

                    <div class="col-md-12">
                      <h5 class="text-danger">Notes: {{ $data['notepay'] }}</h5>
                    </div>
                      
                    <div class="col-md-12">
                      <h4>Pay Response</h4>
                      <p>{{ $data['pay_res'] }}</p>
                    </div>

                  </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </section>
</div>
<script type="text/javascript">
    function edit(id, token) {

    }
</script>
<script>
$('#statusupdate').submit(function(e) {
    e.preventDefault();
    swal({
        title: "Are you sure to Update ?",
        text: "You will not be able to recover this user !!",
        type: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Do it !!",
        closeOnConfirm: !1
    }, function() {
      $.ajax({
          url: "{{ env('APP_URL') }}admin/orders/{{ $data['id'] }}",
          type: 'PUT',
          data: $('#statusupdate').serialize(),
          error: function(err) {
              alert('Error');
          },
          success: function(obj,status, xhr) {
                  if(obj.failure==0){
                      errorMessage = obj.message;
                      alert(errorMessage);
                  }else if(obj.success==1){
                      //window.location.reload();
                  }else{
                      alert("unexpected error occured");
                  }
              
          }
      });
    });
});

function generate(){
    var orderId = <?php echo $data['id']; ?>;
    $.ajax({
          url: "{{ route('generateManifest') }}",
          type: 'POST',
          data: {
              id: orderId,
              _token: "{{ csrf_token() }}",
          },
          error: function(err) {
              alert('Error');
          },
          success: function(obj,status, xhr) {
                  if(obj.success==0){
                      errorMessage = obj.message;
                      alert(errorMessage);
                  }else if(obj.success==1){
                      //window.location.reload();
                  }else{
                      alert("unexpected error occured");
                  }
              
          }
      });
}

function print(){
    var orderId = <?php echo $data['id']; ?>;
    $.ajax({
          url: "{{ route('printManifest') }}",
          type: 'POST',
          data: {
              id: orderId,
              _token: "{{ csrf_token() }}",
          },
          error: function(err) {
              alert('Error');
          },
          success: function(obj,status, xhr) {
                  if(obj.success==0){
                      errorMessage = obj.message;
                      alert(errorMessage);
                  }else if(obj.success==1){
                      window.open(obj.url, "_blank");
                  }else{
                      alert("unexpected error occured");
                  }
              
          }
      });
}
</script>

@endsection
