<!-- filepath: resources/views/components/master-table.blade.php -->
<div class="table-responsive">
    <table class="table table-bordered" id="masterTable">
        <thead>
            <tr>
                <th>ENTITY</th>
                <th>LAST YEAR</th>
                <th>CURRENT YEAR</th>
                <th>DIFFERENCE</th>
                <th>RESULT</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
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
        </tbody>
    </table>
    <button class="btn btn-primary btn-sm" id="addRow"><i class="fa fa-plus"></i> Add Row</button>
    <button class="btn btn-success btn-sm" id="saveData"><i class="fa fa-save"></i> Save Data</button>
</div>