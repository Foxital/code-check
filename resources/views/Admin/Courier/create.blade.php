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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">{{ isset($data->id)?'Update':'Create' }} Couriers</h6>
                            </div>
                            <div class="card-body">
                                <form id="adminuser" action="/admin/couriers{{ isset($data->id)?'/'.$data->id:'' }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @isset($data->id)
                                        @method('PUT')
                                    @endisset
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul class="m-0">
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $data->name ?? '') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Price</label>
                                                        <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', $data->price ?? '') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <select name="status" class="form-control" required>
                                                            <option {{ isset($data->status)&&$data->status=='1'?'selected':'' }} value="1">Active</option>
                                                            <option {{ isset($data->status)&&$data->status=='0'?'selected':'' }} value="0">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="text-right pt-md-4 mt-2">
                                                        <button style="width:100px;" type="submit"
                                                            class="btn btn-success mr-3">Save</button>
                                                        <a style="width:100px;" href="{{ url('/admin/couriers') }}"
                                                            class="btn btn-danger">Cancel</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection
