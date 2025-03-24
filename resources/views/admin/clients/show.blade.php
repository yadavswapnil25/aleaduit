@extends('admin.layouts.main')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <strong>Client Name: {{$client->name_of_society}}</strong>
                    <div class="card-tools">
                        <div class="d-flex flex-row justify-content-center">
                            <a href="{{ url('admin/client/addYear',$client->id) }}" class="btn btn-primary btn-sm ml-2">Add Year</a>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="user-tab" data-toggle="tab" href="#user" role="tab"
                            aria-controls="user" aria-selected="true">All Year Wise Data
                        </a>
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
                                            <th>YEAR</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($years as $index => $year)
                                        <tr>
                                            <td>{{$index + 1}}</td>
                                            <td>{{$year->audit_year}}</td>
                                            <td>
                                                <!-- <a href="#" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-edit"></i> Edit Sheet
                                                </a>
                                                <a href="#" class="btn btn-success btn-sm">
                                                    <i class="fa fa-th"></i> Set Master
                                                </a>
                                               
                                                -->
                                                <a href="{{ route('admin.client.download', $year->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-download"></i> Download
                                                </a>
                                                <form action="{{ route('admin.client.destroy', $year->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No Data Found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
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