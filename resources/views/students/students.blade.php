@extends('home')
@section('contente')


<div class="container">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Students</li>
                <li class="mx-3 py-0">
                    <div class="search mx-auto">
                        <form action="{{url('/search_district')}}" method="GET">
                            <input id="search_text" type="text" placeholder="Search" name="search_querry">
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </button>

                        </form>

                    </div>
                </li>


                <li>
                    <div class="my-1 d-flex" id="paginate">
                        <form method="GET" action="{{url('/districts')}}">
                            <select class="" name="number" id="exampleFormControlSelect1">
                                @if (isset($paginate))
                                <option value="{{$paginate}}">{{$paginate}}</option>

                                @endif
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                            </select>
                            <button type="submit">Show</button>

                        </form>

                    </div>


                </li>
                <li>
                    <button type="submit" class="btn btn-outline-primary mx-3 py-0 my-1" data-bs-toggle="modal"
                        data-bs-target="#CreateModal">Add Student</button>

                </li>

            </ol>
        </nav>
    </div><!-- End Page Title -->

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    @endif


    <table class="table table-striped bg-light">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Phone number</th>
                <th scope="col">Gender</th>
                <th scope="col">Center</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $key=>$student)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$student->name}}</td>
                <td>{{$student->phone_number}}</td>

                <td>{{$student->gender}}</td>
                <td>{{$student->center}}</td>
                <td><span
                        class="bg-success text-light px-2 py-auto border border-success rounded-5">{{$student->status}}</span>
                </td>
                <td> <button type="button" class="btn btn-outline-primary btn-sm">Small</button>
                </td>



            </tr>
            @endforeach

        </tbody>
    </table>



    <!-- model add student -->

    <div class="modal fade" id="CreateModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{route('create_student')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">

                        <div class="" id="add_region">
                            <div class="card-body ">

                                <!-- General Form Elements -->
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Phone number</label>
                                    <div class="col-sm-10">
                                        <input type="tel" class="form-control" name="phone_number" required>
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Date of birth</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="dob">
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="gender"
                                            required>
                                            <option selected>Open this select menu</option>
                                            <option value="F">Female</option>
                                            <option value="M">Male</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Center</label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker" aria-label="Default select example" name="center"
                                            required data-width=100% data-live-search="true">
                                            <option selected="selected" hidden="hidden" value="">Open this select menu
                                            </option>
                                            @foreach($centers as $center)
                                            <option value="{{$center->id}}">{{ $center->name }}</option>
                                            @endforeach


                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Courses</label>
                                    <div class="col-sm-10">
                                        <select class="form-control selectpicker" multiple data-live-search="true"
                                            data-mdb-container="#exampleModal" data-mdb-filter="true"
                                            name="course_id[]">
                                            @foreach($courses as $course)
                                            <option value="{{$course->id}}">{{ $course->name }}</option>
                                            @endforeach


                                        </select>
                                    </div>
                                </div>





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




                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save </button>

                    </div>
                </form><!-- End General Form Elements -->

            </div>
        </div>
    </div><!-- End of model add student-->





</div>
<script>
function showDiv() {
    var div = document.getElementById("add_region");
    div.style.display = "block";
}
</script>

@endsection