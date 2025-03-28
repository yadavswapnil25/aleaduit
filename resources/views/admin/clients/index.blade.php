@extends('admin.layouts.main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active">Clients</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Clients
                        <a href=''>
                    </h3>
                    <div class="card-tools">
                        <div class="d-flex flex-row justify-content-center">
                            <a href="{{ route('admin.client.create') }}" class="btn btn-primary btn-sm ml-2">Add</a>
                            <a href="{{ route('admin.user.export') }}" class="btn btn-primary btn-sm ml-2">Export</a>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="user-tab" data-toggle="tab" href="#user" role="tab"
                            aria-controls="user" aria-selected="true">Client</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="user-tab">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="load_area table-responsive">
                                <table id="example1" class="table table-striped" style="width:100% !important;">
                                    <thead>
                                        <tr>
                                            <th>SR.NO</th>
                                            <th>CLIENT ID</th>
                                            <th>NAME OF SOCIETY</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="deleteduser" role="tabpanel" aria-labelledby="deleteduser-tab">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="load_area table-responsive">
                                <table id="example2" class="table table-striped" style="width:100%  !important;">
                                    <thead>
                                        <tr>
                                            <th>SR.NO</th>
                                            <th>CLIENT ID</th>
                                            <th>NAME OF SOCIETY</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('pagejs')
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.min.js"></script>

<script>
    $(function() {


        var table = $('#example1').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.clients.index', ['deleted' => 'false']) }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'client_id',
                    name: 'client_id'
                },
                {
                    data: 'name_of_society',
                    name: 'name_of_society'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        $('.filter-input').keypress(function() {
            table.column($(this).data('column'))
                .search($(this).val())
                .draw();
        });
        $('.filter-select').change(function() {
            table.column($(this).data('column'))
                .search($(this).val())
                .draw();
        });
    });
</script>
@endsection