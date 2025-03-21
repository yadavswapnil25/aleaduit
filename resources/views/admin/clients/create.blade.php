@extends('admin.layouts.main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add Client</li>
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
                            <h3 class="card-title">Add Client</h3>
                        </div>
                        <form role="form" id="quickForm" method="POST" action="{{ route('admin.client.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name_of_society">Name of Society</label>
                                            <input type="text" id="name_of_society" class="form-control @error('name_of_society') is-invalid @enderror" name="name_of_society" value="{{ old('name_of_society') }}">
                                            @error('name_of_society')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="chairman">Chairman</label>
                                            <input type="text" id="chairman" class="form-control @error('chairman') is-invalid @enderror" name="chairman" value="{{ old('chairman') }}">
                                            @error('chairman')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="vice_chairman">Vice Chairman</label>
                                            <input type="text" id="vice_chairman" class="form-control @error('vice_chairman') is-invalid @enderror" name="vice_chairman" value="{{ old('vice_chairman') }}">
                                            @error('vice_chairman')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="manager">Manager</label>
                                            <input type="text" id="manager" class="form-control @error('manager') is-invalid @enderror" name="manager" value="{{ old('manager') }}">
                                            @error('manager')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="registration_no">Registration No</label>
                                            <input type="text" id="registration_no" class="form-control @error('registration_no') is-invalid @enderror" name="registration_no" value="{{ old('registration_no') }}">
                                            @error('registration_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lekha_parikshan_vargwari">Lekha Parikshan Vargwari</label>
                                            <input type="text" id="lekha_parikshan_vargwari" class="form-control @error('lekha_parikshan_vargwari') is-invalid @enderror" name="lekha_parikshan_vargwari" value="{{ old('lekha_parikshan_vargwari') }}">
                                            @error('lekha_parikshan_vargwari')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="total_shakha">Total Shakha</label>
                                            <input type="number" id="total_shakha" class="form-control @error('total_shakha') is-invalid @enderror" name="total_shakha" value="{{ old('total_shakha') }}">
                                            @error('total_shakha')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="district">District</label>
                                            <input type="text" id="district" class="form-control @error('district') is-invalid @enderror" name="district" value="{{ old('district') }}">
                                            @error('district')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="taluka">Taluka</label>
                                            <input type="text" id="taluka" class="form-control @error('taluka') is-invalid @enderror" name="taluka" value="{{ old('taluka') }}">
                                            @error('taluka')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="registration_date">Registration Date</label>
                                            <input type="date" id="registration_date" class="form-control @error('registration_date') is-invalid @enderror" name="registration_date" value="{{ old('registration_date') }}">
                                            @error('registration_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="karyashetra">Karyashetra</label>
                                            <input type="text" id="karyashetra" class="form-control @error('karyashetra') is-invalid @enderror" name="karyashetra" value="{{ old('karyashetra') }}">
                                            @error('karyashetra')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="society_address">Society Address</label>
                                            <input type="text" id="society_address" class="form-control @error('society_address') is-invalid @enderror" name="society_address" value="{{ old('society_address') }}">
                                            @error('society_address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Create</button>
                                <a href="/admin/clients" class="btn btn-info">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
