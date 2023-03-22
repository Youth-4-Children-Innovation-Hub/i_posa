@extends('home')
@section('contente')


<div class="container">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Users</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Photo</th>
                <th scope="col">Name</th>
                <th scope="col">Gender</th>
                <th scope="col">Center</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
            <tr>
                <th scope="row">1</th>
                <td> <img src="{{asset($student->profile_picture)}}" alt="Profile" width="30" height="30"
                        class="rounded-circle"> </td>
                <td>{{$student->name}}</td>
                <td>{{$student->gender}}</td>
                <td>{{$student->center}}</td>
                <td> <button type="button" class="btn btn-outline-primary btn-sm">Small</button>
                </td>



            </tr>
            @endforeach

        </tbody>
    </table>




    <section class="section dashboard">

        <button type="submit" class="btn btn-outline-warning my-4" onclick="showDiv()">Add User</button>

        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

        @endif






        <div class="card" style="display:none;" id="add_region">
            <div class="card-body">
                <h5 class="card-title">Add User</h5>

                <!-- General Form Elements -->
                <form method="POST" action="{{route('create_student')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">age</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="age" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">NIDA</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nida" required>
                        </div>
                    </div>


                    <!-- <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control">
                  </div>
                </div> -->





                    <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Passport</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="passport" type="file" id="formFile">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Letter</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="letter" type="file" id="formFile">
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Birth Certificate</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="birth_certificate" type="file" id="formFile">
                        </div>
                    </div>



                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="gender" required>
                                <option selected>Open this select menu</option>
                                <option value="F">Female</option>
                                <option value="M">Male</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Center</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="center" required>
                                <option selected>Open this select menu</option>
                                @foreach($centers as $center)
                                <option value="{{$center->id}}">{{$center->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Region</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="region" required>
                                <option selected>Open this select menu</option>
                                @foreach ($regions as $region )
                                <option value="{{$region->id}}">{{$region->name}}</option>

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