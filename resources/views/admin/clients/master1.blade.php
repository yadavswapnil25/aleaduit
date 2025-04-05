@extends('admin.layouts.main')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Master1 - Year: {{ $year->audit_year }}</h3>
                </div>
                <div class="card-body">
                    @include('components.master-table')
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Add Row
        $('#addRow').on('click', function () {
            let newRow = `
                <tr>
                    <td>
                        <select class="form-control entity-select">
                            <option>Select Product</option>
                            <option>Enter custom product</option>
                        </select>
                    </td>
                    <td><input type="text" class="form-control last-year" placeholder="Enter last year value"></td>
                    <td><input type="text" class="form-control current-year" placeholder="Enter current year value"></td>
                    <td><input type="text" class="form-control difference" readonly></td>
                    <td><input type="text" class="form-control result" readonly></td>
                    <td>
                        <button class="btn btn-danger btn-sm remove-row"><i class="fa fa-times"></i></button>
                    </td>
                </tr>
            `;
            $('#masterTable tbody').append(newRow);
        });

        // Remove Row
        $(document).on('click', '.remove-row', function () {
            $(this).closest('tr').remove();
        });

        // Calculate Difference and Result
        $(document).on('input', '.last-year, .current-year', function () {
            let row = $(this).closest('tr');
            let lastYear = parseFloat(row.find('.last-year').val()) || 0;
            let currentYear = parseFloat(row.find('.current-year').val()) || 0;

            let difference = currentYear - lastYear;
            row.find('.difference').val(difference);

            // Example logic for result (you can customize this)
            let result = difference > 0 ? 'Profit' : 'Loss';
            row.find('.result').val(result);
        });

        // Save Data
        $('#saveData').on('click', function () {
            let tableData = [];
            $('#masterTable tbody tr').each(function () {
                let row = $(this);
                let rowData = {
                    entity: row.find('.entity-select').val(),
                    last_year: row.find('.last-year').val(),
                    current_year: row.find('.current-year').val(),
                    difference: row.find('.difference').val(),
                    result: row.find('.result').val(),
                };
                tableData.push(rowData);
            });

            // Send data to the server via AJAX
            $.ajax({
                url: '{{ route("admin.client.saveMasterData") }}', // Replace with your route
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    year_id: '{{ $year->id }}',
                    data: tableData,
                },
                success: function (response) {
                    alert('Data saved successfully!');
                },
                error: function (xhr) {
                    alert('An error occurred while saving data.');
                },
            });
        });
    });
</script>
@endsection