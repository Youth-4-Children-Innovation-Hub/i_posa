@extends('home')
@section('contente')


<div class="container">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Courses</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Course</th>
                <th scope="col">Center</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course )
            <tr>
                <th scope="row">1</th>
                <td>{{$course->name}}</td>
                <td>{{$course->center}}</td>
                <td> <button type="button" class="btn btn-outline-primary btn-sm">Small</button>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>




    <section class="section dashboard">
        @can('is_hoc')
        <button type="submit" class="btn btn-outline-warning my-4" onclick="showDiv()">Add Region</button>

        @endcan

        <div class="card" style="display:none;" id="add_region">
            <div class="card-body">
                <h5 class="card-title">Add Region</h5>

                <!-- General Form Elements -->
                <form method="POST" action="{{route('create_course')}}">
                    @csrf
                    <div class=" row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input name="name" type="text" class="form-control">
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Cordinator</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="center">
                                <option selected>Open this select menu</option>
                                @foreach ($centers as $center )
                                <option value="{{$center->id}}">{{$center->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Submit Button</label>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Submit Form</button>

                        </div>
                    </div>

                </form><!-- End General Form Elements -->

            </div>
        </div>


    </section>
</div>
<script>
function showDiv() {
    var div = document.getElementById("add_region");
    div.style.display = "block";
}
</script>

@endsection