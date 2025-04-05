@extends('admin.layouts.main')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Master 1</h5>
                    <p>Year: {{ $year->audit_year }}</p>
                   <a href="{{ route('admin.client.master1',$year->client_id) }}"> <button class="btn btn-warning" >Open</button> </a>               </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Master 2</h5>
                    <p>Year: {{ $year->audit_year }}</p>
                    <a href="{{ route('admin.client.master2',$year->client_id) }}"> <button class="btn btn-warning" >Open</button> </a>               </div>
                    </div>
            </div>
        </div>
    </div>
</section>
@endsection
