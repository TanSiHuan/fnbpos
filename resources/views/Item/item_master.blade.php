<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Focus - Bootstrap Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}.">
    <!-- Datatable -->
    <link href="{{asset('assets/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="{{asset('assets//css/style.css')}}" rel="stylesheet">

</head>

<body>

@include('layouts.top_nav')
<!--**********************************
        Header end ti-comment-alt
    ***********************************-->

<!--**********************************
    Sidebar start
***********************************-->
@include('layouts.side_nav')
<!--**********************************
        Sidebar end
    ***********************************-->

<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Item</a></li>
                    <li class="breadcrumb-item active"><a href="{{url('/item/item_master')}}">Item Master</a></li>
                </ol>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">

            </div>
        </div>
        <!-- row -->

        <div class="modal fade" id="Action" tabindex="-1" aria-labelledby="Action"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="Action">Action</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="edit"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="edit">Edit Item</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{route('itemMaster_create_update')}}" method="post" id="branch_edit" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="edit_item_code1">Item Code</label>
                                                <input type="text" class="form-control" disabled id="edit_item_code1" name="edit_item_code1"
                                                       required="required">
                                                <input type="text" class="form-control" hidden id="edit_item_code" name="edit_item_code"
                                                       required="required">
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_item_description">Item Description</label>
                                                <input type="text" class="form-control" id="edit_item_description" name="edit_item_description"
                                                       required="required">
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_item_price">Item Price</label>
                                                <input type="number" step="0.01" class="form-control" id="edit_item_price" name="edit_item_price"
                                                       required="required">
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_item_category">Item Category</label>
                                                <select class="form-control" name="edit_item_category" id="edit_item_category" required>
                                                    <option value="">Please Select a Category</option>
                                                    @foreach($item_category as $itemCtg)
                                                        <option value="{{$itemCtg->itemCtg_id}}">{{$itemCtg->itemCtg_description}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="edit_item_img">Item Image</label>
                                                <input type="file" accept="image/*" onchange="preview_images(event)" class="form-control" id="edit_item_img" name="edit_item_img">
                                            </div>
                                            <div class="form-group">
                                                <img id="output_images" src="{{url('assets/images/no_images.jpg')}}" class="img-thumbnail mr-3" width="150" height="150" />
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>


                        <div class="col-md-12 d-grid gap-2 d-md-block">
                            <button class="btn btn-primary col-md-12" type="button" id="edititembutton" name="edititembutton" data-toggle="modal" data-target="#edit">Edit</button>
                            <button class="btn btn-primary col-md-12 mt-1" type="button" id="active" name="active">Active/In-Active</button>
                            <button class="btn btn-danger col-md-12 mt-1" type="button" id="delete" name="delete">Delete</button>
                        </div>

                    </div>


                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Item Master</h4>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Create Item</button>
                        <div class="modal fade" id="exampleModalCenter" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Create Item</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url('item/item_master_store')}}" method="post" enctype="multipart/form-data" id="ItemCategory-create">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="item_code">Item Code</label>
                                                    <input type="text" class="form-control" id="item_code" name="item_code"
                                                           required="required">
                                                </div>
                                                <div class="form-group">
                                                    <label for="item_description">Item Description</label>
                                                    <input type="text" class="form-control" id="item_description" name="item_description"
                                                           required="required">
                                                </div>
                                                <div class="form-group">
                                                    <label for="item_price">Item Price</label>
                                                    <input type="number" step="0.01" class="form-control" id="item_price" name="item_price"
                                                           required="required">
                                                </div>
                                                <div class="form-group">
                                                    <label for="item_category">Item Category</label>
                                                    <select class="form-control" name="item_category" id="item_category" required>
                                                        <option value="">Please Select a Category</option>
                                                        @foreach($item_category as $itemCtg)
                                                            <option value="{{$itemCtg->itemCtg_id}}">{{$itemCtg->itemCtg_description}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="item_img">Card Image</label>
                                                    <input type="file" accept="image/*" onchange="preview_image(event)" class="form-control" id="item_img" name="item_img">
                                                </div>
                                                <div class="form-group">
                                                    <img id="output_image" src="{{asset('assets/images/no_images.jpg')}}" class="img-thumbnail mr-3" width="150" height="150" />
                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                                </button>
                                                <button type="submit" name="submit" class="btn btn-primary">Create</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="baseTable" class="display" style="min-width: 845px">
                                <thead>
                                <tr>
                                    <th>Item Code</th>
                                    <th>Item Description</th>
                                    <th>Item Price</th>
                                    <th>Item Category</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Active</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody >
                                {{--                                @foreach($branch as $branches)--}}
                                {{--                                    <tr>--}}
                                {{--                                        <td>{{$branches->branch_id}}</td>--}}
                                {{--                                        <td>{{$branches->branch_description}}</td>--}}
                                {{--                                        <td>{{$branches->branch_address}}</td>--}}
                                {{--                                        @if($branches->branch_active == '1')--}}
                                {{--                                            <td>yes</td>--}}
                                {{--                                        @else--}}
                                {{--                                            <td>no</td>--}}
                                {{--                                            @endif--}}
                                {{--                                        <td>{{$branches->create_at}}</td>--}}
                                {{--                                        <td>--}}
                                {{--                                            <button style="color: white" type="button" class="btn btn-warning" data-toggle="modal"--}}
                                {{--                                                    data-target="#exampleModal">Edit--}}
                                {{--                                            </button>--}}
                                {{--                                            <a type="button" href="{{url('/delete_branch').'/'.$branches->branch_id}}" class="btn btn-danger"--}}
                                {{--                                                    data-target="#exampleModal">Delete--}}
                                {{--                                            </a>--}}

                                {{--                                        </td>--}}
                                {{--                                    </tr>--}}
                                {{--                                @endforeach--}}
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--**********************************
    Content body end
***********************************-->


<!--**********************************
    Footer start
***********************************-->
@include('layouts.footer')
<!--**********************************
        Footer end
    ***********************************-->

<!--**********************************
   Support ticket button start
***********************************-->

<!--**********************************
   Support ticket button end
***********************************-->


</div>
<!--**********************************
    Main wrapper end
***********************************-->

<!--**********************************
    Scripts
***********************************-->
<!-- Required vendors -->
<script src="{{asset('assets/vendor/global/global.min.js')}}"></script>
<script src="{{asset('assets/js/quixnav-init.js')}}"></script>
<script src="{{asset('assets/js/custom.min.js')}}"></script>



<!-- Datatable -->
<script src="{{asset('assets/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/plugins-init/datatables.init.js')}}"></script>

<!-- Jquery Validation -->
<script src="{{asset('assets/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
<!-- Form validate init -->
<script src="{{asset('assets/js/plugins-init/jquery.validate-init.js')}}"></script>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
        baseTable = $('#baseTable').DataTable({
            stateSave: true,
            destroy: true,
            "ajax": {
                "url": "{{url('item/item_master_list')}}",
                "type": "GET",
                'data': "",
                "dataSrc": "",
            },
            // <th>Branch ID</th>
            // <th>Branch Description</th>
            // <th>Address</th>
            // <th>Active</th>
            // <th>Create at</th>
            // <th>Last Login</th>
            // <th>Action</th>
            "columns": [{
                "data": "item_code"
            },
                {
                    "data": "item_description"
                },
                {
                    "data": "item_ref_price"
                },
                {
                    "data": "itemCtg_description"
                },
                {
                    "data": "created_at"
                },
                {
                    "data": "updated_at"
                },
                {
                    "data": "item_active"
                },
                {
                    data: 'branch_id',
                    "class": "cbcell",
                    "render": function (item_code) {
                        return '<button type="button" id="action" class="btn btn-primary" data-toggle="modal" data-target="#Action">Action</button>';
                    }
                },
            ],
        });
        baseTable.on("click", "td button[id=action]", function() {



            var data = baseTable.row($(this).closest("tr")).data();
            document.getElementById('edit_item_code').value = data['item_code'];
            document.getElementById('edit_item_code1').value = data['item_code'];
            document.getElementById('edit_item_description').value = data['item_description'];
            document.getElementById('edit_item_price').value = data['item_ref_price'];
            var image = document.getElementById('output_images');
            var downloadingImage = new Image();
            downloadingImage.src = "{{asset('/')}}"+"/"+data['item_img'];
            downloadingImage.onload = function(){
                image.src = this.src;
            };

            let item_code = data['item_code'];

            $(document).on("click","#delete", function(){
                window.location.href = "{{url('item/item_master_destroy').'/'}}"+item_code;
                console.log(item_code);
            });

            $(document).on("click","#active", function(){
                window.location.href = "{{url('item/item_master_active').'/'}}"+item_code;
                console.log(item_code);
            });
        });


    } );
    function preview_image(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('output_image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
    function preview_images(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('output_images');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
</html>
