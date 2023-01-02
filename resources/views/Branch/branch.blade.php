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
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Branch</a></li>
                    <li class="breadcrumb-item active"><a href="{{url('/item/item_category')}}">Branch List</a></li>
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
                                        <h5 class="modal-title" id="edit">Edit Branch</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{route('BranchList_create_update')}}" method="post" id="branch_edit">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="edit_branch_name">Branch Name</label>
                                                <input type="text" class="form-control" id="edit_branch_name" name="edit_branch_name"
                                                       required="required">
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_branch_contact">Branch Contact</label>
                                                <input type="tel" class="form-control" id="edit_branch_contact" name="edit_branch_contact"
                                                       required="required">
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_branch_address">Branch Address</label>
                                                <input type="text" class="form-control" id="edit_branch_address" name="edit_branch_address"
                                                       required="required">
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_branch_table_amount">Branch Table Amount</label>
                                                <input type="number" class="form-control" id="edit_branch_table_amount" name="edit_branch_table_amount"
                                                       required="required" maxlength="7">
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                    {{--                                    <form action="{{url('item/item_category_update')}}" method="post" id="ItemCategory-edit">--}}
                                    {{--                                        @csrf--}}
                                    {{--                                        <div class="modal-body">--}}
                                    {{--                                            <div class="form-group">--}}
                                    {{--                                                <label for="edit_itmCtg_id">Category Code</label>--}}
                                    {{--                                                <input type="text" class="form-control" id="edit_itmCtg_id" disabled name="edit_itmCtg_id1"--}}
                                    {{--                                                       required="required">--}}
                                    {{--                                                <input type="text" class="form-control" id="edit_itmCtg_id" hidden name="edit_itmCtg_id"--}}
                                    {{--                                                       required="required">--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <div class="form-group">--}}
                                    {{--                                                <label for="edit_itmCtg_description">Category Description</label>--}}
                                    {{--                                                <input type="text" class="form-control" id="edit_itmCtg_description" name="edit_itmCtg_description"--}}
                                    {{--                                                       required="required">--}}
                                    {{--                                            </div>--}}


                                    {{--                                        </div>--}}
                                    {{--                                        <div class="modal-footer">--}}
                                    {{--                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close--}}
                                    {{--                                            </button>--}}
                                    {{--                                            <button type="submit" name="submit" class="btn btn-primary">Update</button>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </form>--}}
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
                        <h4 class="card-title">Branch List</h4>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Create Branch</button>
                        <div class="modal fade" id="exampleModalCenter" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Create Branch</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url('branch/branch_list_store')}}" method="post" id="Branch-create">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="branch_name">Branch Name</label>
                                                    <input type="text" class="form-control" id="branch_name" name="branch_name"
                                                           required="required">
                                                </div>
                                                <div class="form-group">
                                                    <label for="branch_contact">Branch Contact</label>
                                                    <input type="tel" class="form-control" id="branch_contact" name="branch_contact"
                                                           required="required">
                                                </div>
                                                <div class="form-group">
                                                    <label for="branch_address">Branch Address</label>
                                                    <input type="text" class="form-control" id="branch_address" name="branch_address"
                                                           required="required">
                                                </div>
                                                <div class="form-group">
                                                    <label for="branch_table_amount">Branch Table Amount</label>
                                                    <input type="number" class="form-control" id="branch_table_amount" name="branch_table_amount"
                                                           required="required" maxlength="7">
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
                                    <th>Branch Name</th>
                                    <th>Branch Contact</th>
                                    <th>Branch Address</th>
                                    <th>Current Cash</th>
                                    <th>Table Amount</th>
                                    <th>Updated At</th>
                                    <th>Updated By</th>
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
                "url": "{{url('branch/branch_list_list')}}",
                "type": "GET",
                'data': "",
                "dataSrc": "",
            },

        // <th>Branch Name</th>
        // <th>Branch Contact</th>
        // <th>Branch Address</th>
        // <th>Current Cash</th>
        // <th>Created At</th>
        // <th>Updated At</th>
        // <th>Updated By</th>
        // <th>Active</th>
        // <th>Action</th>
            "columns": [{
                "data": "branch_name"
            },
                {
                    "data": "branch_contact"
                },
                {
                    "data": "branch_address"
                },
                {
                    "data": "current_cash"
                },
                {
                    "data": "branch_table_amount"
                },
                {
                    "data": "updated_at"
                },
                {
                    "data": "admin_name"
                },
                {
                    "data": "branch_active"
                },
                {
                    data: 'branch_contact',
                    "class": "cbcell",
                    "render": function (branch_contact) {
                        return '<button type="button" id="action" class="btn btn-primary" data-toggle="modal" data-target="#Action">Action</button>';
                    }
                },
            ],
        });
        baseTable.on("click", "td button[id=action]", function() {

            var data = baseTable.row($(this).closest("tr")).data();
            document.getElementById('edit_branch_address').value = data['branch_address'];
            document.getElementById('edit_branch_contact').value = data['branch_contact'];
            document.getElementById('edit_branch_name').value = data['branch_name'];
            document.getElementById('edit_branch_table_amount').value = data['branch_table_amount'];
            let branch_id = data['branch_id'];

            $(document).on("click","#delete", function(){
                window.location.href = "{{url('branch/branch_list_destroy').'/'}}"+branch_id;
                console.log(branch_id);
            });

            $(document).on("click","#active", function(){
                window.location.href = "{{url('branch/branch_list_active').'/'}}"+branch_id;
                console.log(branch_id);
            });
        });


    } );
</script>
</html>
