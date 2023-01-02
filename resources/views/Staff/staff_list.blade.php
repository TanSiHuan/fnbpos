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
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Staff</a></li>
                    <li class="breadcrumb-item active"><a href="{{url('/item/item_master')}}">Staff List</a></li>
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
                                        <h5 class="modal-title" id="edit">Edit Staff</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{route('itemMaster_create_update')}}" method="post" id="branch_edit" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="edit_staff_name">Staff Name</label>
                                                <input type="text" class="form-control" id="edit_staff_name" name="edit_staff_name"
                                                       required="required">
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_staff_email">Staff Email</label>
                                                <input type="text" class="form-control" id="edit_staff_email" name="edit_staff_email"
                                                       required="required">
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_staff_password">Staff Password</label>
                                                <input type="password" class="form-control" id="edit_staff_password" name="edit_staff_password"
                                                       required="required">
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_staff_contact">Staff Contact</label>
                                                <input type="number" step="0.01" class="form-control" id="edit_staff_contact" name="edit_staff_contact"
                                                       required="required">
                                            </div>
                                            <div class="form-group">
                                                <label for="staff_branch">Branch</label>
                                                <select class="form-control" name="staff_branch" id="staff_branch" required>
                                                    <option value="">Please Select a Category</option>
                                                    @foreach($branch as $branch_list)
                                                        <option value="{{$branch_list->branch_id}}">{{$branch_list->branch_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_access">Access</label>
                                                <br>
                                                <label for="access_counter">
                                                    <input type="checkbox" name="edit_access_counter" id="edit_access_counter" value="counter"> Counter

                                                </label>
                                                <br>
                                                <label for="access_admin">
                                                    <input type="checkbox" name="edit_access_admin" id="edit_access_admin" value="admin"> Admin
                                                </label>
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
                        <h4 class="card-title">Staff List</h4>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Create Staff</button>
                        <div class="modal fade" id="exampleModalCenter" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Create Staff</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url('staff/staff_detail_store')}}" method="post" enctype="multipart/form-data" id="ItemCategory-create">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="staff_name">Name</label>
                                                    <input type="text" class="form-control" id="staff_name" name="staff_name"
                                                           required="required">
                                                </div>
                                                <div class="form-group">
                                                    <label for="staff_email">Email</label>
                                                    <input type="email" class="form-control" id="staff_email" name="staff_email"
                                                           required="required">
                                                </div>
                                                <div class="form-group">
                                                    <label for="staff_password">Password</label>
                                                    <input type="password" class="form-control" id="staff_password" name="staff_password"
                                                           required="required">
                                                </div>
                                                <div class="form-group">
                                                    <label for="staff_contact">Contact Number</label>
                                                    <input type="number" class="form-control" id="staff_contact" name="staff_contact"
                                                           required="required">
                                                </div>
                                                <div class="form-group">
                                                    <label for="staff_branch">Branch</label>
                                                    <select class="form-control" name="staff_branch" id="staff_branch" required>
                                                        <option value="">Please Select a Category</option>
                                                        @foreach($branch as $branch_list)
                                                            <option value="{{$branch_list->branch_id}}">{{$branch_list->branch_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="access">Access</label>
                                                    <br>
                                                    <label for="access_counter">
                                                        <input type="checkbox" name="access_counter" id="access_counter" value="counter"> Counter

                                                    </label>
                                                    <br>
                                                    <label for="access_admin">
                                                        <input type="checkbox" name="access_admin" id="access_admin" value="admin"> Admin
                                                    </label>
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
                                    <th>Staff ID</th>
                                    <th>Staff Name</th>
                                    <th>Staff Email</th>
                                    <th>Staff Contact</th>
                                    <th>Staff Branch</th>
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
                "url": "{{url('staff/staff_detail')}}",
                "type": "GET",
                'data': "",
                "dataSrc": "",
            },
        // <th>Staff ID</th>
        // <th>Staff Name</th>
        // <th>Staff Email</th>
        // <th>Staff Contact</th>
        // <th>Staff Branch</th>
        // <th>Created At</th>
        // <th>Updated At</th>
        // <th>Active</th>
        // <th>Action</th>
            "columns": [{
                "data": "staff_id"
            },
                {
                    "data": "staff_name"
                },
                {
                    "data": "staff_email"
                },
                {
                    "data": "staff_contact"
                },
                {
                    "data": "branch_name"
                },
                {
                    "data": "created_at"
                },
                {
                    "data": "updated_at"
                },
                {
                    "data": "staff_active"
                },
                {
                    data: 'staff_id',
                    "class": "cbcell",
                    "render": function (staff_id) {
                        return '<button type="button" id="action" class="btn btn-primary" data-toggle="modal" data-target="#Action">Action</button>';
                    }
                },
            ],
        });
        baseTable.on("click", "td button[id=action]", function() {



            var data = baseTable.row($(this).closest("tr")).data();
            document.getElementById('edit_staff_name').value = data['staff_name'];
            document.getElementById('edit_staff_contact').value = data['staff_contact'];
            document.getElementById('edit_staff_email').value = data['staff_email'];
            document.getElementById('edit_staff_password').value = data['staff_password'];
            document.getElementById('edit_access_admin').value = data['admin'];
            document.getElementById('edit_access_counter').value = data['counter'];
            let checkbox_counter = document.getElementById('edit_access_counter');
            let checkbox_admin = document.getElementById('edit_access_admin');
            let counter = data['counter'];
            let admin = data['admin'];

            if (counter === 'yes'){
                checkbox_counter.checked = true;
                console.log('counter yes');
            }else if(admin === 'yes'){
                checkbox_admin.checked = true;
                console.log('admin yes');
            }else if(counter === 'yes' && admin === 'yes'){
                checkbox_counter.checked = true;
                checkbox_admin.checked = true;
                console.log('counter and admin yes');

            }

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
