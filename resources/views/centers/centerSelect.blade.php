@extends('home')
@section('contente')
<div class="pagetitle">
        <h1>Regions</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Regions</li>
            </ol>
        </nav>
    </div>
        <!-- Default Card -->
             <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Select A Center</h5>
                    <div class="row">
                        @foreach($centers as $center)
                        <div class="col-6 col-md-4 mb-3">
                            <a href="{{ url('center_details/' . $center->id) }}" >{{ $center->name }}</a>
                        </div>
                        @endforeach
                    </div>          
                </div>
            </div>
        <!-- End Default Card -->
              
@endsection