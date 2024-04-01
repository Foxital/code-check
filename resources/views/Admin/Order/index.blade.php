@extends('Admin.layouts.app')

@section('content')
@include('Admin.parts.nav')

@php
$status = '';
if(isset($_REQUEST['fstatus'])){
    $status = $_REQUEST['fstatus'];
}
@endphp

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
                            <h6 class="m-0 mt-2 font-weight-bold text-primary">orders List</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="get" class="row mb-3">
                        <div class="col-md-2">
                            <label>From</label>
                            <input class="form-control" value="{{ $_REQUEST['form_date'] ?? '' }}" type="date" name="form_date" id="form_date" />
                        </div>
                        <div class="col-md-2">
                            <label>To</label>
                            <input class="form-control" value="{{ $_REQUEST['to_date'] ?? '' }}" type="date" name="to_date" id="to_date" />
                        </div>
                        <div class="col-md-3">
                            <label>Location</label>
                            <input class="form-control" type="text" name="location" value="{{ $_REQUEST['location'] ?? '' }}" id="location" />
                        </div>
                        <div class="col-md-3">
                            <label>Status</label>
                            <select class="form-control" name="fstatus" id="fstatus">
                                <option value="">All Status</option>
                                <option {{ $status=='1' ? 'selected':'' }} value="1">Order Accepted</option>
                                <option {{ $status=='2' ? 'selected':'' }} value="2">Shipped</option>
                                <option {{ $status=='3' ? 'selected':'' }} value="3">Delivered</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Coupon</label>
                            <input class="form-control" type="text" name="coupon" value="{{ $_REQUEST['coupon'] ?? '' }}" id="coupon" />
                        </div>
                        <div class="col-md-2 pt-4 text-center">
                            <button type="submit" class="btn btn-block btn-success mt-2">Fliter</button>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dt-admin" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>User</th>
                                    <th>Items</th>
                                    <th>Coupon Used</th>
                                    <th>Pay Status</th>
                                    <th>Status</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Order Id</th>
                                    <th>User</th>
                                    <th>Items</th>
                                    <th>Coupon Used</th>
                                    <th>Pay Status</th>
                                    <th>Status</th>
                                    <th>#</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>
   
        <!-- /.container-fluid -->
    </section>
</div>

<script type="text/javascript">
   
    $(function() {

        var table = $('#dt-admin').DataTable({
            processing: true,
            serverSide: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            ajax: "{{ route('admin.orders.index') }}?form_date={{ $_REQUEST['form_date'] ?? '' }}&&to_date={{ $_REQUEST['to_date'] ?? '' }}&&location={{ $_REQUEST['location'] ?? '' }}&&coupon={{ $_REQUEST['coupon'] ?? '' }}&&status={{ $_REQUEST['fstatus'] ?? '' }}",
            columns: [{
                    data: 'oid',
                    name: 'oid'
                },
                {
                    data: 'userdetails',
                    name: 'userdetails'
                },
                {
                    data: 'product_order_list_details',
                    name: 'product_order_list_details'
                },
                {
                    data: 'ship_address_details',
                    name: 'ship_address_details'
                },
                {
                    data: 'paid_details',
                    name: 'paid_details'
                },
                {
                    data: 'status_details',
                    name: 'status_details'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            responsive: true,
            autoWidth: true,
            order: [
                [0, "desc"]
            ],
            select: {
                style: "multi"
            },
            pageLength: 10
        });

        $('a.toggle-vis').on('click', function(e) {
            e.preventDefault();
            // Get the column API object
            var column = dtable.column($(this).attr('data-column'));
            // Toggle the visibility
            column.visible(!column.visible());
        });

    });

    function del(id, token) {
        swal({
            title: "Are you sure to delete ?",
            text: "You will not be able to recover this user !!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it !!",
            closeOnConfirm: !1
        }, function() {
            $.ajax({
                url: "{{ url('admin/orders/') }}/" + id,
                type: 'POST',
                data: {
                    "id": id,
                    "_method": 'DELETE',
                    "_token": token,
                },
                error: function() {
                    alert('An error has occurred.Please Try Again');
                },
                success: function(data) {
                    $('#dt-admin').DataTable().draw(false);
                    swal("Deleted !!", "Hey, your imaginary file has been deleted !!", "success")
                }
            });

        });
    }
</script>
@endsection
