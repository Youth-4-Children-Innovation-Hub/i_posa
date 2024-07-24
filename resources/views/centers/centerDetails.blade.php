@extends('home')
@section('contente')
<div class="pagetitle">
        <h1>Center Details</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <!-- <li class="breadcrumb-item active">Regions</li> -->
            </ol>
        </nav>
    </div>
        <!-- Default Card -->
             <div class="card">
                <div class="card-body">
                    <div class="row">
                     
                        <div class="col-6 col-md-4 mb-3">
                            <a href="{{ url('national_center_students/' . $id) }}" >Students</a>
                        </div>
                        <div class="col-6 col-md-4 mb-3">
                            <a href="{{ url('national_center_courses/' . $id) }}" >Courses</a>
                        </div>
                        <div class="col-6 col-md-4 mb-3">
                            <a href="{{ url('national_center_teachers/' . $id) }}" >Teachers</a>
                        </div>
                        <div class="col-6 col-md-4 mb-3">
                            <a href="{{ url('national_center_clubs/' . $id) }}" >Clubs</a>
                        </div>
                        <div class="col-6 col-md-4 mb-3">
                            <a href="{{ url('national_inventory/' . $id) }}" >Inventory</a>
                        </div>
                       
                    </div>          
                </div>
            </div>
        <!-- End Default Card -->
              
@endsection