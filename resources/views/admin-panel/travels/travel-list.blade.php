@extends('admin-panel.includes.master')
@section('content')
<section class="content">
    <div class="">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-8 col-md-6 col-sm-12">
                    <h2>Travel List</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}"><i class="zmdi zmdi-home"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active">Travel List</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <!-- <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button> -->
                    <a href="{{route('adminTravelAdd')}}"><button class="btn btn-primary float-right">Add Travel</button></a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="card project_list">
                    <div class="table-responsive">
                        <table id="users-table" class="table table-hover c_table">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Type</th>
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
                url: '{{ route('adminTravelList') }}',
                type: 'GET',
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'type', name: 'type' },
                { data: 'status', name: 'status' },
                { data: 'photo', name: 'photo', orderable: false, searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
        $('form').on('submit', function(e) {
            e.preventDefault();
            table.draw();
        });
        $('#users-table').on('click', '.travel-status', function() {
            var button = $(this);
            var travelId = button.data('id');
            var currentStatus = button.data('status');
            var newStatus = currentStatus == '1' ? '0' : '1';
            var confirmationMessage = currentStatus == '1'
                ? "Are you sure you want to deactivate this travel?"
                : "Are you sure you want to activate this travel?";
            if (confirm(confirmationMessage)) {
                $.ajax({
                url: '{{ route('adminTravelUpdateStatus') }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    travelId: travelId,
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