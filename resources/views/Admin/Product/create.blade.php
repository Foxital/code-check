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
                                <h6 class="m-0 font-weight-bold text-primary">Create Products</h6>
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
                                <form id="adminuser" action="/admin/products" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Sector</label>
                                                <select name="category_id" id="category_id" onchange="getCatg()" class="form-control" required>
                                                    <option value="">Select Category</option>
                                                    @foreach ($catgs as $catg)
                                                        <option value="{{ $catg->id }}">{{ $catg->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Sub Category</label>
                                                <select name="sub_category_id" id="sub_category_id" class="form-control" required>
                                                    <option value="0">Select Sub Category</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control" required>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Featured</label>
                                                <select name="featured" class="form-control" required>
                                                    <option {{ isset($data->featured)&&$data->featured=='1'?'selected':'' }} value="1">Active</option>
                                                    <option {{ isset($data->featured)&&$data->featured=='2'?'selected':'' }} value="2">More Important</option>
                                                    <option {{ isset($data->featured)&&$data->featured=='0'?'selected':'' }} value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Best Seller</label>
                                                <select name="bestseller" class="form-control" required>
                                                    <option {{ isset($data->bestseller)&&$data->bestseller=='1'?'selected':'' }} value="1">Yes</option>
                                                    <option {{ isset($data->bestseller)&&$data->bestseller=='0'?'selected':'' }} value="2">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <label class="">Link Code</label>
                                                <input type="text" onchange="linkcode()" id="link_code" class="form-control"
                                                    name="link_code" value="{{ old('link_code') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 text-right">
                                            <button onclick="addmore()" type="button" class="btn btn-success btn-sm">Add
                                                Sizes</button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row" id="getvalappendrow">

                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group ">
                                                <label class="">Description</label>
                                                <textarea class="form-control summernote" name="description">{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group ">
                                                <label class="">How to Use</label>
                                                <textarea class="form-control summernote" name="how_to_use">{{ old('how_to_use') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
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
                                                    type="hidden" value="{{ old('imagepv') }}" />
                                                <img src="" id="img_setimage_pv_0" class="img-fluid"
                                                    style="width: 150px;margin:auto;" />
                                                <br />
                                                <button class="btn btn-sm btn-danger" type="button"
                                                    onclick="removeimgdb('setimage_0', 'setimage_pv_0')">Remove</button>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group setimage" id="setimage_1">
                                                <label>Image 2: <button onclick="getimagedb('setimage_1','setimage_pv_1')"
                                                        type="button" data-backdrop="static" data-keyboard="false"
                                                        data-toggle="modal" data-target="#frmaddpickup"
                                                        class="btn btn-link">Use DB Image ?</button></label>
                                                <input type="file" class="form-control dropify" name="image1" />
                                            </div>
                                            <div class="form-group setimage_pv text-center" style="display:none"
                                                id="setimage_pv_1">
                                                <input class="val_setimage_pv" id="val_setimage_pv_1" name="image1pv"
                                                    type="hidden" value="{{ old('image1pv') }}" />
                                                <img src="" id="img_setimage_pv_1" class="img-fluid"
                                                    style="width: 150px;margin:auto;" />
                                                <br />
                                                <button class="btn btn-sm btn-danger" type="button"
                                                    onclick="removeimgdb('setimage_1', 'setimage_pv_1')">Remove</button>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group setimage" id="setimage_2">
                                                <label>Image 3: <button onclick="getimagedb('setimage_2','setimage_pv_2')"
                                                        type="button" data-backdrop="static" data-keyboard="false"
                                                        data-toggle="modal" data-target="#frmaddpickup"
                                                        class="btn btn-link">Use DB Image ?</button></label>
                                                <input type="file" class="form-control dropify" name="image2" />
                                            </div>
                                            <div class="form-group setimage_pv text-center" style="display:none"
                                                id="setimage_pv_2">
                                                <input class="val_setimage_pv" id="val_setimage_pv_2" name="image2pv"
                                                    type="hidden" value="{{ old('image2pv') }}" />
                                                <img src="" id="img_setimage_pv_2" class="img-fluid"
                                                    style="width: 150px;margin:auto;" />
                                                <br />
                                                <button class="btn btn-sm btn-danger" type="button"
                                                    onclick="removeimgdb('setimage_2', 'setimage_pv_2')">Remove</button>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group setimage" id="setimage_3">
                                                <label>Image 4: <button onclick="getimagedb('setimage_3','setimage_pv_3')"
                                                        type="button" data-backdrop="static" data-keyboard="false"
                                                        data-toggle="modal" data-target="#frmaddpickup"
                                                        class="btn btn-link">Use DB Image ?</button></label>
                                                <input type="file" class="form-control dropify" name="image3" />
                                            </div>
                                            <div class="form-group setimage_pv text-center" style="display:none"
                                                id="setimage_pv_3">
                                                <input class="val_setimage_pv" id="val_setimage_pv_3" name="image3pv"
                                                    type="hidden" value="{{ old('image3pv') }}" />
                                                <img src="" id="img_setimage_pv_3" class="img-fluid"
                                                    style="width: 150px;margin:auto;" />
                                                <br />
                                                <button class="btn btn-sm btn-danger" type="button"
                                                    onclick="removeimgdb('setimage_3', 'setimage_pv_3')">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Meta Title</label>
                                                <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Meta Description</label>
                                                <textarea type="text" class="form-control" name="meta_descp" value="{{ old('meta_descp') }}"
                                                    required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Meta Keyword</label>
                                                <input type="text" class="form-control" name="meta_keyword" value="{{ old('meta_keyword') }}"
                                                    required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class=" text-right">
                                        <button type="submit" class="btn btn-info mr-3">Save</button>
                                        <a href="/admin/products" class="btn btn-danger">Cancel</a>
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
                                                                name="pickimg" value="{{ basename($file) }}"></span>
                                                        <span style="display:inline-block"><img style="width:100px"
                                                                src="{{ asset('uploads/Category/' . basename($file)) }}"
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
        function getCatg() {
            var cat_id = $('#category_id').val();
            $.get('/admin/ajax-subcat?cat_id='+ cat_id,function(data){
                var subcat =  $('#sub_category_id').empty().append('<option value ="">Select Sub Category</option>');
                $.each(data,function(index,item){
                    subcat.append('<option value ="'+item.id+'">'+item.name+'</option>');
                });
            });
            $('#sub_category_id').val("")
        }

        function linkcode() {
        var getval = $('#link_code').val().replace(' ', '-');
        $('#link_code').val(getval);
    }
    var rowcount = parseInt('1');

    function addmore() {
        rowcount++;
        var getval = '<div class="col-12" id="rowid_' + rowcount + '">\
                    <div class="row m-0">\
                    <div class="col-md-2">\
                        <input type="hidden" value="0" name="prid[]" />\
                        <div class="form-group ">\
                            <label class="">label</label>\
                            <input type="text" class="form-control" onkeydown="labelchange(this)" name="label[]" value="" required>\
                        </div>\
                    </div>\
                    <div class="col-md-5">\
                        <div class="row">\
                            <div class="form-group col-md-6">\
                                <label class="">Price</label>\
                                <input type="text" class="form-control" name="price[]" value="" required>\
                            </div>\
                            <div class="form-group col-md-6">\
                                <label class="">Discount</label>\
                                <input type="text" class="form-control" name="discount[]" value="" required>\
                            </div>\
                        </div>\
                    </div>\
                    <div class="col-md-2">\
                        <div class="form-group ">\
                            <label class="">Quantity</label>\
                            <input type="text" class="form-control" name="quantity[]" value="" required>\
                        </div>\
                    </div>\
                    <div class="col-md-2">\
                        <div class="form-group ">\
                            <label class="">Status</label>\
                            <select class="form-control" name="pstatus[]" required>\
                                <option value="1">Active</option>\
                                <option value="0">InActive</option>\
                            </select>\
                        </div>\
                    </div>\
                    <div class="col-md-1 pt-4 text-center">\
                        <button type="button" onclick="removeappend(' + rowcount + ')" class="btn btn-danger btn-sm mt-2"><i class="fa fa-trash"></i></button>\
                    </div>\
                    </div></div>';
        $('#getvalappendrow').append(getval);

    }
    function removeappend(id) {
        $('#rowid_' + id).remove();
    }

    function labelchange(get) {
        var getval = $(get).val().replace('|', '-');
        $(get).val(getval);
    }

    var setimagedbid = '';
        var setimagepv = '';

        function getimagedb(pickid, pv) {
            setimagedbid = pickid;
            setimagepv = pv;
        }

        function setimagedb() {
            var image = $("input[name='pickimg']:checked").val();
            var urlimg = "{{ asset('uploads/Product/') }}"+"/"+image;
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
