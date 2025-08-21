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
                            <a href="{{ route('admin.client.duplicate', $client->id) }}" class="btn btn-success btn-sm ml-2">Duplicate Client</a>
                            <a href="#" class="btn btn-warning btn-sm ml-2" onclick="confirmDuplicateWithData()">Duplicate with All Data</a>
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
                                                <a class="btn btn-warning btn-sm edit-sheet-btn" data-year="{{ $year->audit_year }}">
                                                    <i class="fa fa-edit"></i> Edit Sheet
                                                </a>
                                                <a href="{{ route('admin.client.master',$year->client_id) }}" class="btn btn-success btn-sm">
                                                    <i class="fa fa-th"></i> Set Master
                                                </a>
                                                <a href="{{ route('admin.client.download', $year->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fa fa-download"></i> Download
                                                </a>
                                                <a href="{{ route('admin.client.duplicate', $client->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fa fa-copy"></i> Duplicate
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

<!-- Modal -->
<div class="modal fade" id="editSheetModal" tabindex="-1" role="dialog" aria-labelledby="editSheetModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSheetModalLabel">Choose Sheet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="modalYearText"></p>
                <div class="d-flex flex-wrap">
                    <button class="btn btn-outline-primary m-1 sheet-btn" data-sheet="1">Sheet 1</button>
                    <button class="btn btn-outline-primary m-1 sheet-btn" data-sheet="2">Sheet 2</button>
                    <button class="btn btn-outline-primary m-1 sheet-btn" data-sheet="3">Sheet 3</button>
                    <button class="btn btn-outline-primary m-1 sheet-btn" data-sheet="4">Sheet 4</button>
                    <button class="btn btn-outline-primary m-1 sheet-btn" data-sheet="5">Sheet 5</button>
                    <button class="btn btn-outline-primary m-1 sheet-btn" data-sheet="6">Sheet 6</button>
                    <button class="btn btn-outline-primary m-1 sheet-btn" data-sheet="7">Sheet 7</button>
                    <button class="btn btn-outline-primary m-1 sheet-btn" data-sheet="8">Sheet 8</button>
                    <button class="btn btn-outline-primary m-1 sheet-btn" data-sheet="9">Sheet 9</button>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        // Handle Edit Sheet button click
        $(document).on('click', '.edit-sheet-btn', function(e) {
            e.preventDefault();
            const year = $(this).data('year'); // Get the year from the button's data attribute
            $('#modalYearText').text(`Manage sheets for year: ${year}`); // Update modal content
            $('#editSheetModal').modal('show'); // Show the modal
        });

        // Handle Sheet button click
        $(document).on('click', '.sheet-btn', function(e) {
            e.preventDefault();
            const sheetNumber = $(this).data('sheet'); // Get the sheet number
            const clientId = "{{ $client->id }}"; // Get the client ID
            window.location.href = "{{ url('admin/client/') }}/" + clientId + "/sheet/" + sheetNumber; // Redirect with client_id and sheetNumber
        });
    });

    function confirmDuplicateWithData() {
        if (confirm('This will create a complete copy of the client with all related data (Master Data, Client Inputs, Years, etc.). Are you sure you want to proceed?')) {
            window.location.href = "{{ route('admin.client.duplicateWithData', $client->id) }}";
        }
    }
</script>
@endsection