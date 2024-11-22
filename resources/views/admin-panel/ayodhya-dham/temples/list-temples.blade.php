@extends('admin-panel.includes.master')
@section('content')

<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-8 col-md-6 col-sm-12">
                    <h2>Ayodhya Dham Temple List</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active">Ayodhya Dham Temple List</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <!-- <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button> -->
                    <a href="{{route('adminAyodhyaDhamAddTemple')}}"><button class="btn btn-primary float-right">Add Ayodhya Dham Temple</button></a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <form class="d-lg-flex align-items-end justify-content-between mt-2 mb-2 col-md-8 col-sm-12"  method="get">
                    <div class="w-100 mr-2">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name"/>
                    </div>
                    <div class="w-100 mr-2">
                        <label>Status</label>
                        <select name="status"  class="form-control" id="status">
                            <option value="">-- Select Status--</option>
                            <option value="1">Active</option>
                            <option value="0">In-Active</option>
                        </select>
                    </div>
                    <div >
                       <button class="btn btn-primary mb-0 mt-0" style="padding:10.5px ">Search</button>
                    </div>
                </form>
                <div class="card project_list">
                    <div class="table-responsive">
                        <table id="users-table" class="table table-hover c_table">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Temple Name</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Photo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        var table = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('adminAyodhyaDhamTempleList') }}',
                type: 'GET',
                data: function(d) {
                    d.name = $('input[name="name"]').val();
                    d.status = $('select[name="status"]').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'address', name: 'address' },
                { data: 'status', name: 'status' },
                { data: 'photo', name: 'photo', orderable: false, searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
        $('form').on('submit', function(e) {
            e.preventDefault();
            table.draw();
        });
        $('#users-table').on('click', '.ayodhya-dham-temples-status', function() {
            var button = $(this);
            var ayodhyaDhamTempleId = button.data('id');
            var currentStatus = button.data('status');
            var newStatus = currentStatus == '1' ? '0' : '1';
            var confirmationMessage = currentStatus == '1'
                ? "Are you sure you want to deactivate this ayodhya dham temples?"
                : "Are you sure you want to activate this ayodhya dham temples?";
            if (confirm(confirmationMessage)) {
                $.ajax({
                url: '{{ route('adminAyodhyaDhamTempleUpdateStatus') }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    ayodhyaDhamTempleId: ayodhyaDhamTempleId,
                    newStatus: newStatus,
                },
                success: function(res) {
                    button.toggleClass('btn-success btn-danger');
                    button.text(newStatus == '1' ? 'Active' : 'In-Active');
                    button.data('status', newStatus);
                    toastr.success(res.message);
                },
                error: function(xhr) {
                    console.error('Error: ' + xhr.error);
                }
            });
            }
        });
    });
</script>
@stop