@extends('Admin.layouts.app')

@section('content')
    @include('Admin.parts.nav')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
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
                                <h6 class="m-0 mt-2 font-weight-bold text-primary">Settings</h6>
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
                                        <th>Email Id</th>
                                        <th>Message</th>
                                        <th>Update date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Name</th>
                                        <th>Email Id</th>
                                        <th>Message</th>
                                        <th>Update date</th>
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
                ajax: "{{ route('admin.contact.users') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'message',
                        name: 'message'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                columnDefs:[{targets:4, render:function(data){
                    return moment(data).format('MMM Do YYYY');
                }}],
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
    </script>
@endsection
