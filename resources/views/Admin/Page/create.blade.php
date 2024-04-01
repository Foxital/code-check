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
                                <h6 class="m-0 font-weight-bold text-primary">{{ isset($data->id) ? 'Update' : 'Create' }}
                                    pages</h6>
                            </div>
                            <div class="card-body">
                              <div>
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
                                <form id="adminuser" action="/admin/pages{{ isset($data->id) ? '/' . $data->id : '' }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @isset($data->id)
                                        @method('PUT')
                                    @endisset
                                    <div class="row">

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ old('name', $data->name ?? '') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control" required>
                                                    <option {{ isset($data->status) && $data->status == '1' ? 'selected' : '' }}
                                                        value="1">Active</option>
                                                    <option {{ isset($data->status) && $data->status == '0' ? 'selected' : '' }}
                                                        value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group ">
                                                <label class="">Link Code</label>
                                                <input type="text" onchange="linkcode()" id="link_code" class="form-control"
                                                    name="link_code" value="{{ old('link_code', $data->link_code ?? '') }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group ">
                                                <label class="">Description</label>
                                                <textarea class="form-control summernote"
                                                    name="description">{{ old('description', $data->description ?? '') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            @isset($data->image)
                                                <div class="">
                                                    <div class="form-group setimage"
                                                        style="{{ !empty($data->image) ? 'display:none;' : '' }}"
                                                        id="setimage_0">
                                                        <label>Image: <button onclick="getimagedb('setimage_0','setimage_pv_0')"
                                                                type="button" data-backdrop="static" data-keyboard="false"
                                                                data-toggle="modal" data-target="#frmaddpickup"
                                                                class="btn btn-link">Use DB Image ?</button></label>
                                                        <input type="file" class="form-control dropify" name="image" />
                                                    </div>
                                                    <div class="form-group setimage_pv text-center"
                                                        style="{{ empty($data->image) ? 'display:none;' : '' }}"
                                                        id="setimage_pv_0">
                                                        <input class="val_setimage_pv" id="val_setimage_pv_0" name="imagepv"
                                                            type="hidden" value="{{ $data->image }}" />
                                                        <img src="{{ asset('uploads/Category/' . $data->image) }}"
                                                            id="img_setimage_pv_0" class="img-fluid" style="margin:auto;" />
                                                        <br /><br />
                                                        <button class="btn btn-sm btn-danger" type="button"
                                                            onclick="removeimgdb('setimage_0', 'setimage_pv_0')">Remove</button>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="">
                                                    <div class="form-group setimage" id="setimage_0">
                                                        <label>Image: <button onclick="getimagedb('setimage_0','setimage_pv_0')"
                                                                type="button" data-backdrop="static" data-keyboard="false"
                                                                data-toggle="modal" data-target="#frmaddpickup"
                                                                class="btn btn-link">Use DB Image ?</button></label>
                                                        <input type="file" class="form-control dropify" name="image" />
                                                    </div>
                                                    <div class="form-group setimage_pv text-center" style="display:none"
                                                        id="setimage_pv_0">
                                                        <input class="val_setimage_pv" id="val_setimage_pv_0" name="imagepv"
                                                            type="hidden" value="" />
                                                        <img src="" id="img_setimage_pv_0" class="img-fluid"
                                                            style="margin:auto;" />
                                                        <br /><br />
                                                        <button class="btn btn-sm btn-danger" type="button"
                                                            onclick="removeimgdb('setimage_0', 'setimage_pv_0')">Remove</button>
                                                    </div>
                                                </div>
                                            @endisset
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Meta Title</label>
                                                        <input type="text" class="form-control" name="meta_title"
                                                            value="{{ old('meta_title', $data->meta_title ?? '') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Meta Description</label>
                                                        <textarea type="text" class="form-control" name="meta_descp"
                                                            required>{{ old('meta_descp', $data->meta_descp ?? '') }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Meta Keyword</label>
                                                        <input type="text" class="form-control" name="meta_keyword"
                                                            value="{{ old('meta_keyword', $data->meta_keyword ?? '') }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class=" text-right">
                                        <button type="submit" class="btn btn-info mr-3">Save</button>
                                        <a href="{{ url('/admin/pages') }}" class="btn btn-danger">Cancel</a>
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
                                        @foreach (File::allfiles(public_path('uploads/Blog')) as $file)
                                            <tr>
                                                <td>
                                                    <label>
                                                        <span style="display:inline-block"><input type="radio"
                                                                name="pickimg" value="{{ basename($file) }}"></span>
                                                        <span style="display:inline-block"><img style="width:100px"
                                                                src="{{ asset('uploads/Blog/' . basename($file)) }}"
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
            $('.dropify').dropify({
                messages: {
                    default: 'Add Image',
                }
            });
            $('#dt-admin2').DataTable();
        });
    </script>

    <script>
        function linkcode() {
            var getval = $('#link_code').val().replace(' ', '-');
            $('#link_code').val(getval);
        }

        var setimagedbid = '';
        var setimagepv = '';

        function getimagedb(pickid, pv) {
            setimagedbid = pickid;
            setimagepv = pv;
        }

        function setimagedb() {
            var image = $("input[name='pickimg']:checked").val();
            var urlimg = "{{ asset('uploads/Blog/') }}" + "/" + image;
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
    </script>

@endsection
