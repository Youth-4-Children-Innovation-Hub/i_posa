@extends('home')
@section('contente')


<div class="container">

    <div class="pagetitle">
        <h1>Students</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Students</li>
               
                @can('is_hoc')
                <li>
                    <button type="submit" class="btn btn-outline-primary mx-3 py-0 my-1" data-bs-toggle="modal"
                        data-bs-target="#CreateModal">Add Student</button>
                </li>
                @endcan

            </ol>
        </nav>
    </div><!-- End Page Title -->

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    @can('is_admin')
    
    <div class="">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Recent Reports</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone number</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Disability</th>
                        <th scope="col">Center</th>
                        <th scope="col">Status</th>
                        @can('is_hoc')
                        <th scope="col">Action</th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>
                 
                    @foreach ($students as $key => $student)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->phone_number }}</td>
                        <td>{{ $student->gender }}</td>
                        <td>{{ $student->disability }}</td>
                        <td>{{ $student->center }}</td>
                        @if( $student->status == 'continous' )
                        <td><span
                                class="bg-success text-light px-2 py-auto border border-success rounded-5">{{ $student->status }}</span>
                        </td>
                        @elseif( $student->status == 'Graduate' )
                        <td><span
                                class="bg-primary text-light px-2 py-auto border border-primary rounded-5">{{ $student->status }}</span>
                        </td>
                        @else
                        <td><span
                        class="bg-danger text-light px-2 py-auto border border-danger rounded-5">{{ $student->status }}</span>
                        </td>
                        @endif

                        @can('is_hoc')

                        <td> <button type="button" class="btn btn-outline-primary btn-sm editBtn" value="{{ $student->id }}"
                                data-bs-toggle="modal" data-bs-target="#EditStudent">Update</button>
                            <button type="button" value="{{ $student->id }}"
                                class="btn btn-outline-danger btn-sm delBtn">Delete</button>
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                   
                    </tbody>
                  </table>

                </div>

              </div>
            </div>


    @endcan

    @can('is_reg_cordinator')
    @cannot('is_admin')
    <div class="">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <!-- <h5 class="card-title">Recent Reports</h5> -->

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Course</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Status</th>
                        <th scope="col">Center</th>
                        <th scope="col">District</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($regionStudents as $key => $regionStudents)
                      <tr>
                        <th scope="row"><a href="#">{{ $key + 1 }}</a></th>
                        <td>{{ $regionStudents->name }}</td>
                        <td>{{ $regionStudents->course2 }}</td>
                        <td>{{ $regionStudents->phone_number }}</td>
                        <td>{{ $regionStudents->gender }}</td>
                        @if( $regionStudents->status == 'continous' )
                        <td><span
                                class="bg-success text-light px-2 py-auto border border-success rounded-5">{{ $regionStudents->status }}</span>
                        </td>
                        @elseif( $regionStudents->status == 'Graduate' )
                        <td><span
                                class="bg-primary text-light px-2 py-auto border border-primary rounded-5">{{ $regionStudents->status }}</span>
                        </td>
                        @else
                        <td><span
                        class="bg-danger text-light px-2 py-auto border border-danger rounded-5">{{ $regionStudents->status }}</span>
                        </td>
                        @endif
                        <td>{{ $regionStudents->centerName2 }}</td>
                        <td>{{ $regionStudents->distName }}</td>
                        <td>jkfhd</td>
                      </tr> 
                      @endforeach 
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
     @endcannot       
    @endcan

    @can('is_dist_cordinator')
    @cannot('is_admin')
    


        <div class="">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <!-- <h5 class="card-title">Recent Reports</h5> -->

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Course</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Status</th>
                        <th scope="col">Center</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($districtStudents as $key => $districtStudents)
                      <tr>
                        <th scope="row"><a href="#">{{ $key + 1 }}</a></th>
                        <td>{{ $districtStudents->name }}</td>
                        <td>{{ $districtStudents->course2 }}</td>
                        <td>{{ $districtStudents->phone_number }}</td>
                        <td>{{ $districtStudents->gender }}</td>
                        @if( $districtStudents->status == 'continous' )
                        <td><span
                                class="bg-success text-light px-2 py-auto border border-success rounded-5">{{ $districtStudents->status }}</span>
                        </td>
                        @elseif( $districtStudents->status == 'Graduate' )
                        <td><span
                                class="bg-primary text-light px-2 py-auto border border-primary rounded-5">{{ $districtStudents->status }}</span>
                        </td>
                        @else
                        <td><span
                        class="bg-danger text-light px-2 py-auto border border-danger rounded-5">{{ $districtStudents->status }}</span>
                        </td>
                        @endif
                        <td>{{ $districtStudents->centerName2 }}</td>
                        <td>jkfhd</td>
                      </tr> 
                      @endforeach 
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
    @endcannot          
    @endcan
    
    @can('is_hoc')
    @cannot('is_admin')
    <div class="">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Recent Reports</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Course</th>
                        <th scope="col">Phone number</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Disability</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                 
                    @foreach ($students1 as $key => $students1)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $students1->name1 }}</td>
                        <td>{{ $students1->course1 }}</td>
                        <td>{{ $students1->phone_number1 }}</td>
                        <td>{{ $students1->gender1 }}</td>
                        @if( $students1->disability1 == NULL)
                        <td>None</td>
                        @else
                        <td>{{ $students1->disability1}}</td>
                        @endif

                        @if( $students1->status1 == 'continous' )
                        <td><span
                                class="bg-success text-light px-2 py-auto border border-success rounded-5">{{ $students1->status1 }}</span>
                        </td>
                        @elseif( $students1->status1 == 'Graduate' )
                        <td><span
                                class="bg-primary text-light px-2 py-auto border border-primary rounded-5">{{ $students1->status1 }}</span>
                        </td>
                        @else
                        <td><span
                        class="bg-danger text-light px-2 py-auto border border-danger rounded-5">{{ $students1->status1 }}</span>
                        </td>
                        @endif
                        @can('is_hoc')

                        <td> <button type="button" class="btn btn-outline-primary btn-sm editBtn" value="{{ $students1->id }}"
                                data-bs-toggle="modal" data-bs-target="#EditStudent">Update</button>
                            <button type="button" value="{{ $students1->id }}"
                                class="btn btn-outline-danger btn-sm delBtn">Delete</button>
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
    @endcannot
    @endcan
    


    <!-- model add student -->
    <div class="modal fade" id="CreateModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('create_student') }}" enctype="multipart/form-data">
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
                                    <label for="inputText" class="col-sm-2 col-form-label">Parent/Guardian's Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="parent" required>
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
                                    <label for="inputDate" class="col-sm-2 col-form-label">Term</label>
                                    <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="term"
                                            required>
                                            <option selected>Open this select menu</option>
                                            <option value="Short term">short term</option>
                                            <option value="Long term">Long term</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Stage</label>
                                    <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="stage"
                                            required>
                                            <option selected>Open this select menu</option>
                                            <option value="Stage 1">Stage 1 </option>
                                            <option value="Stage 2">Stage 2</option>
                                            <option value="Stage 3">Stage 3</option>
                                            <option value="Stage 4">Stage 4</option>
                                        </select>
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
                                    <label for="inputText" class="col-sm-2 col-form-label">Disability</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="disability">
                                    </div>
                                </div>

                                <!-- <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Center</label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker" aria-label="Default select example" name="center"
                                            required data-width=100% data-live-search="true">
                                            <option selected="selected" hidden="hidden" value="">Open this
                                                select menu
                                            </option>
                                            @can('is_admin')
                                            @foreach ($centers as $center)
                                            <option value="{{ $center->id }}">{{ $center->name }}</option>
                                            @endforeach
                                            @endcan
                                            @can('is_hoc')
                                            @cannot('is_admin')
                                            @foreach ($center1 as $center1)
                                            <option value="{{ $center1->id }}">{{ $center1->centerName1 }}</option>
                                            @endforeach
                                            @endcannot
                                            @endcan

                                        </select>
                                    </div>
                                </div> -->

                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Courses</label>
                                    <div class="col-sm-10">
                                        <select class="form-control selectpicker" multiple data-live-search="true"
                                            data-mdb-container="#exampleModal" data-mdb-filter="true"
                                            name="course_id[]">
                                            @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
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

    <!-- model edit student -->
    <div class="modal fade" id="EditStudent" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('update_student') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="student_id" id="student_id">
                        <div class="" id="add_region">
                            <div class="card-body ">
                                <!-- General Form Elements -->
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" id="name" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Phone number</label>
                                    <div class="col-sm-10">
                                        <input type="tel" class="form-control" name="phone_number" id="phone_number"
                                            required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Date of birth</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="dob" id="dob">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="gender"
                                            id="gender" required>
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
                                            id="center" required data-width=100% data-live-search="true">
                                            <option selected="selected" hidden="hidden" value="">Open this
                                                select menu
                                            </option>
                                            @foreach ($centers as $center)
                                            <option value="{{ $center->id }}">{{ $center->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Courses</label>
                                    <div class="col-sm-10">
                                        <select class="form-control selectpicker" multiple data-live-search="true"
                                            data-mdb-container="#exampleModal" data-mdb-filter="true" name="course_id[]"
                                            id="course_id[]">
                                            @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="status"
                                            id="gender" required>
                                            <option selected>Open this select menu</option>
                                            <option value="Graduate">Graduate</option>
                                            <option value="Dropout">dropout</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Passport</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="passport" id="passport" type="file"
                                            id="formFile">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Letter</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="letter" id="letter" type="file" id="formFile">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Birth Certificate</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="birth_certificate" id="birth_certificate"
                                            type="file" id="formFile">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update </button>

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



@section('scripts')
<script>
$(document).on('click', '.editBtn', function() {
    var id = $(this).val();
    console.log(id);
    $.ajax({
        type: "GET",
        url: "/edit_student/" + id,
        success: function(response) {
            console.log(response);
            $('#student_id').val(id);
            $('#name').val(response.student.name);
            $('#phone_number').val(response.student.phone_number);
            $('#dob').val(response.student.date_of_birth);
            $('#gender').val(response.student.gender);
            $('#gender').selectpicker('refresh');
            $('#center').val(response.student.center_id);
            $('#center').selectpicker('refresh');
            $('#course_id').val(response.student.course_id);
            $('#course_id').selectpicker('refresh');
        },

    });
});

$('.delBtn').on('click', function() {
    var confirmation = confirm('Are you sure you want to delete this student?');
    if (confirmation) {
        // delete it
        var student = $(this).val();
        console.log(student);

        $.ajax({
            type: 'POST',
            url: '/delete_student',
            data: {
                id: student
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
            }
        });
    } else {
        //canceled
    }
});
</script>
@endsection