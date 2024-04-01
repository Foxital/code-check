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
                            <div class="col-md-10">
                                <h6 class="m-0 mt-2 font-weight-bold text-primary">Offer List</h6>
                            </div>
                            <div class="col-md-2 text-right">
                                <a href="{{ url('admin/offers/create') }}" class="btn btn-primary">Create Offer</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dt-admin" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Name</th>
                                        <th>Validity From</th>
                                        <th>Validity To</th>
                                        <th>Update date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Name</th>
                                        <th>Validity From</th>
                                        <th>Validity To</th>
                                        <th>Update date</th>
                                        <th>Status</th>
                                        <th>Action</th>
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
                ajax: "{{ route('admin.offers.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'validity_from',
                        name: 'validity_from'
                    },
                    {
                        data: 'validity_to',
                        name: 'validity_to'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                columnDefs:[
                    {
                        targets:2, render:function(data){
                            return moment(data).format('DD-MM-YYYY HH:mm:ss');
                        }
                    },
                    {
                        targets:3, render:function(data){
                            return moment(data).format('DD-MM-YYYY HH:mm:ss');
                        }
                    },
                    {
                        targets:4, render:function(data){
                            return moment(data).format('MMM Do YYYY');
                        }
                    },
                    {
                        targets:5, render:function(data){
                            return data=='1'?'<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">Inactive</span>';
                        }
                    }
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

        function del(id, token){
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
                    url: "{{ url('admin/offers/') }}/"+id,
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
