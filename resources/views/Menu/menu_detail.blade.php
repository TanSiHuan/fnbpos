<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Menu</title>
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
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Menu</a></li>
                    <li class="breadcrumb-item active"><a href="{{url('/menu/menu_list')}}">Menu List</a></li>
                    <li class="breadcrumb-item active"><a href="{{url('menu/menu_list/detail').'/'.$menu_id}}">Menu Detail</a></li>
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
                                        <h5 class="modal-title" id="edit">Edit Price</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{url('menu/menu_list/detail/'.$menu_id.'/updateItem')}}" method="post" id="branch_edit" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="edit_price">Price</label>
                                                <input type="text" class="form-control" id="edit_item_code" name="edit_item_code"
                                                       required="required" hidden>
                                                <input type="number" min="0" max="99999999" class="form-control" id="edit_price" name="edit_price"
                                                       required="required">

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
                        <h4 class="card-title">Menu Detail</h4>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Add Item to Menu</button>
                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Add Item to Menu</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>×</span>
                                        </button>
                                    </div>
                                    <form action="{{url('menu/menu_list/detail/'.$menu_id.'/storeItem')}}" method="post" id="item_store" enctype="multipart/form-data">
                                        @csrf
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>Select</th>
                                                    <th>Item Code</th>
                                                    <th>Item Description</th>
                                                    <th>Price</th>
                                                    <th>Category</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                                                @foreach($item as $items)
                                                                                    <tr>
                                                                                        <td><input value="{{$items->item_code}}" name="item_code[]" type="checkbox"></td>
                                                                                        <td>{{$items->item_code}}</td>
                                                                                        <td>{{$items->item_description}}</td>
                                                                                        <td>{{$items->item_ref_price}}</td>
                                                                                        <td>{{$items->itemCtg_description}}</td>
                                                                                    </tr>
                                                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                </tfoot>
                                            </table>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <button type="submit" name="submit" class="btn btn-primary">Select</button>
                                    </div>
                                    </form>
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
                                    <th>Category</th>
{{--                                    <th>Modifier Group</th>--}}
                                    <th>Price</th>
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
                "url": "{{url('menu/menu_list/detail/'.$menu_id.'/menudtllist')}}",
                "type": "GET",
                'data': "",
                "dataSrc": "",
            },
        // <th>Item Code</th>
        // <th>Item Description</th>
        // <th>Category</th>
        // <th>Modifier Group</th>
        // <th>Price</th>
        // <th>Action</th>
            "columns": [{
                "data": "MenuDtl_itemID"
            },
                {
                    "data": "MenuDtl_description"
                },
                {
                    "data": "itemCtg_description"
                },
                // {
                //     "data": "modifier_grp_code"
                // },
                {
                    "data": "MenuDtl_price"
                },
                {
                    data: 'MenuDtl_id',
                    "class": "cbcell",
                    "render": function (MenuDtl_id) {
                        return '<button type="button" id="action" class="btn btn-primary" data-toggle="modal" data-target="#Action">Action</button>';
                    }
                },
            ],
        });


        baseTable.on("click", "td button[id=action]", function() {



            var data = baseTable.row($(this).closest("tr")).data();
            document.getElementById('edit_price').value = data['MenuDtl_price'];
            document.getElementById('edit_item_code').value = data['MenuDtl_itemID'];

            let item_code = data['item_code'];

            $(document).on("click","#delete", function(){
                window.location.href = "{{url('item/item_master_destroy').'/'}}"+item_code;
                console.log(item_code);
            });

            $(document).on("click","#active", function(){
                window.location.href = "{{url('item/item_master_active').'/'}}"+item_code;
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
