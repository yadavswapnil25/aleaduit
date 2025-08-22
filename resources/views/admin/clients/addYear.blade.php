@extends('admin.layouts.main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Add Year Form</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active">Add Year Form</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Add Year Form</h3>
                    </div>
                    <form role="form" method="POST" action="{{ route('admin.client.addYear') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="client_id" value="{{ $client->id }}" hidden>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="audit_year">Select Audit Year:</label>
                                <select id="audit_year" class="form-control @error('audit_year') is-invalid @enderror" name="audit_year">
                                    <option value="">Select Year</option>
                                    @for ($year = 2023; $year <= 2023 + 10; $year++)
                                        <option value="{{ $year }}-{{ $year + 1 }}" {{ old('audit_year') == "$year-$year + 1" ? 'selected' : '' }}>{{ $year }}-{{ $year + 1 }}</option>
                                    @endfor
                                </select>
                                @error('audit_year')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="auditor">Select Auditor:</label>
                                <select id="auditor" class="form-control @error('auditor_id') is-invalid @enderror" name="auditor_id">
                                    <option value="">Select Auditor</option>
                                    @foreach ($auditors as $auditor)
                                    <option value="{{ $auditor->id }}" {{ old('auditor_id') == $auditor->id ? 'selected' : '' }}>{{ $auditor->name }}</option>
                                    @endforeach
                                </select>
                                @error('auditor_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="client_data">Select Data from Client:</label>
                                <select id="client_data" class="form-control @error('client_data') is-invalid @enderror" name="client_data">
                                    <option value="0">None</option>
                                    @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" {{ old('client_data') == $client->id ? 'selected' : '' }}>{{ $client->name_of_society }}</option>
                                    @endforeach
                                </select>
                                @error('client_data')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Add Year</button>
                            <a href="{{ route('admin.client.show', $client->id) }}" class="btn btn-secondary">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection