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
                                <h6 class="m-0 font-weight-bold text-primary">{{ isset($data->id)?'Update':'Create' }} Faqs</h6>
                            </div>
                            <div class="card-body">
                                <form id="adminuser" action="/admin/faqs{{ isset($data->id)?'/'.$data->id:'' }}" method="POST"
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
                                            <div class="form-group ">
                                                <label class="">Link</label>
                                                <input type="text" class="form-control @error('link_code') is-invalid @enderror" name="link_code" value="{{ old('link_code', $data->link_code ?? '') }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Question</label>
                                                <input type="text" class="form-control @error('question') is-invalid @enderror" name="question" value="{{ old('question', $data->question ?? '') }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Answer</label>
                                                <textarea class="form-control summernote @error('answer') is-invalid @enderror" name="answer" required>{{ old('answer', $data->answer ?? '') }}</textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group ">
                                                        <label class="">Order</label>
                                                        <input type="number" class="form-control @error('lineup') is-invalid @enderror" name="lineup" value="{{ old('lineup', $data->lineup ?? '') }}" required>
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
                                                <div class="col-md-4">
                                                    <div class="text-right pt-md-4 mt-2">
                                                        <button style="width:100px;" type="submit"
                                                            class="btn btn-success mr-3">Save</button>
                                                        <a style="width:100px;" href="{{ url('/admin/faqs') }}"
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

    <div class="modal fade" id="frmaddpickup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pick images</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="dt-admin2" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tbody id="getimageslist">
                                        @foreach (File::allfiles(public_path('uploads/Category')) as $file)
                                            <tr>
                                                <td>
                                                    <label>
                                                        <span style="display:inline-block"><input type="radio"
                                                                name="pickimg"
                                                                value="{{ basename($file) }}"></span>
                                                        <span style="display:inline-block"><img style="width:100px"
                                                                src="{{ asset('uploads/Category/'.basename($file)) }}"
                                                                class="item lazy" /></span>
                                                        <span class="ml-2" style="display:inline-block">
                                                            <p class="m-0">{{ basename($file) }} </p>
                                                        </span>
                                                    </label>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Close</button>
                    <button type="button" onclick="setimagedb()" id="savebtn" style="width:150px;"
                        class="btn btn-success">Pick Image</button>
                </div>
            </div>
        </div>
    </div>





    <script>
        
        $(document).ready(function() {
            $(".summernote").summernote({
                height: 150,
                minHeight: null,
                maxHeight: null,
                focus: !1
            });
        });
        var setimagedbid = '';
        var setimagepv = '';

        function getimagedb(pickid, pv) {
            setimagedbid = pickid;
            setimagepv = pv;
        }

        function setimagedb() {
            var image = $("input[name='pickimg']:checked").val();
            var urlimg = "{{ asset('uploads/Category/') }}"+"/"+image;
            console.log(setimagedbid);
            $("#" + setimagedbid).hide();
            $('#img_' + setimagepv).attr('src', urlimg);
            $('#val_' + setimagepv).val(image);
            $("#" + setimagepv).show();
            setimagedbid = '';
            setimagepv = '';
            $('#frmaddpickup').modal("toggle");
        }

        function removeimgdb(pickid, pv) {
            $('#' + pv).hide();
            $('#img_' + pv).attr('src', "");
            $('#val_' + pv).val("");
            $("#" + pickid).show();
            setimagedbid = '';
            setimagepv = '';
        }
        $('.dropify').dropify({
            messages: {
                default: 'Add Image',
            }
        });
        $('#dt-admin2').DataTable();
    </script>
@endsection
