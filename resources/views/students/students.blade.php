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
                <form method="POST" action="{{ route('create_student') }}" enctype="multipart/form-data" id="studentForm">
                    @csrf

                    <div class="modal-body">

                        <div class="" id="add_region">
                            <div class="card-body ">

                                <!-- General Form Elements -->
                                <center><div class="row">
                                    <b> <p>Student information</p></b>
                                </div></center>
                                
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" required>
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
                                    <label class="col-sm-2 col-form-label">Disability</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="disability"
                                            required>
                                            <option value="None">None</option>
                                            <option value="Deaf">Deaf</option>
                                            <option value="Blind">Blind</option>
                                            <option value="Multi impaired">Multi impaired</option>
                                            <option value="Albino">Albino</option>
                                            <option value="Visual impaired">Visual impaired</option>
                                            <option value="Physically impaired">Physically impaired</option>
                                            <option value="Hearing impaired">Hearing impaired</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Date of birth</label>
                                    <div class="col-sm-10">
                                        <input type="date" id="birth-date" class="form-control" name="dob">
                                    </div>
                                    <div id="birth-error" style="color: red;"></div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">NIDA</label>
                                    <div class="col-sm-10">
                                        <input type="number" id="nida" placeholder="optional" class="form-control" name="nida">
                                    </div>
                                    <div id="error-message" style="color: red;"></div>
                                </div>
                             
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Region</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="region" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">District</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="district" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Ward</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="ward" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Street</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="street" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Employment status</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="employment_status"
                                            required>
                                            <option selected>Open this select menu</option>
                                            <option value="Employed">Employed</option>
                                            <option value="Not employed">Not employed</option>
                                            <option value="Self employed">Self employed</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Marital status</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="marital_status"
                                            required>
                                            <option selected>Open this select menu</option>
                                            <option value="Married">Married</option>
                                            <option value="Single">Single</option>
                                            <option value="Widowed">Widowed</option>
                                            <option value="Divorced">Divorced</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Education level</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="education_level" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Education Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="education_type"
                                            required>
                                            <option selected>Open this select menu</option>
                                            <option value="Married">Formal</option>
                                            <option value="Single">Non-formal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Phone number</label>
                                    <div class="col-sm-10">
                                        <input type="tel" id="sphone" class="form-control" name="phone_number" required>
                                    </div>
                                    <div id="sphone-error" style="color: red;"></div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" id="email" placeholder="optional" class="form-control" name="student_email">
                                    </div>
                                    <div id="email-error" style="color: red;"></div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Stage</label>
                                    <div class="col-sm-10">
                                         <select class="form-select" aria-label="Default select example" name="stage"
                                            required>
                                            <option selected>Open this select menu</option>
                                            <option value="Stage one">Stage one </option>
                                            <option value="Stage two">Stage two</option>
                                         </select>
                                    </div>
                                </div>                              
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Courses</label>
                                    <div class="col-sm-10">
                                        <select class="form-control selectpicker" multiple data-live-search="true"
                                            data-mdb-container="#exampleModal" data-mdb-filter="true"
                                            name="course_id[]">
                                            @foreach ($centerCourses as $course)
                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Passport</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="passport" type="file" id="formFile" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Letter</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="letter" type="file" id="formFile" required>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Birth Certificate</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="birth_certificate" type="file" id="formFile" required>
                                    </div>
                                </div>
                                <center><div class="row">
                                    <b> <p>Parents/Guardian information</p></b>
                                </div></center>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="parent" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Phone number</label>
                                    <div class="col-sm-10">
                                        <input type="tel" id="phone" class="form-control" name="parent_phone" required>
                                    </div>
                                    <div id="phone-error" style="color: red;"></div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" placeholder="optional" class="form-control" name="parent_email">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <input type="text" placeholder="optional" class="form-control" name="parent_address">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Occupation</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="parent_occupation" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Disability</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="pdissability"
                                            required>
                                            <option selected>Open this select menu</option>
                                            <option value="None">None</option>
                                            <option value="Disabled">Disabled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Region</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="pregion" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">District</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="pdistrict" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Ward</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="pward" required>
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
                <form method="POST" action="{{ route('update_student') }}" enctype="multipart/form-data" id="editForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="student_id" id="student_id">
                        <input type="hidden" name="parent_id" id="gid">
                        <div class="" id="add_region">
                            <div class="card-body ">
                                <!-- General Form Elements -->
                                <center><div class="row">
                                    <b> <p>Student information</p></b>
                                </div></center>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" id="name" required>
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
                                    <label class="col-sm-2 col-form-label">Disability</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="edit-dissability" aria-label="Default select example" name="dissability"
                                            required>
                                            <option value="None">None</option>
                                            <option value="Deaf">Deaf</option>
                                            <option value="Blind">Blind</option>
                                            <option value="Multi impaired">Multi impaired</option>
                                            <option value="Albino">Albino</option>
                                            <option value="Visual impaired">Visual impaired</option>
                                            <option value="Physically impaired">Physically impaired</option>
                                            <option value="Hearing impaired">Hearing impaired</option>
                                        </select>
                                    </div>
                                </div>
                              
                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Date of birth</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" name="dob" id="dob">
                                    </div>
                                    <div id="dob-error" style="color: red;"></div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">NIDA</label>
                                    <div class="col-sm-10">
                                        <input type="number" id="nida-edit" placeholder="optional" class="form-control" name="nida">
                                    </div>
                                    <div id="nida-error1" style="color: red;"></div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Region</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="region-edit" class="form-control" name="region" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">District</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="district-edit" class="form-control" name="district" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Ward</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="ward-edit" class="form-control" name="ward" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Street</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="street-edit" class="form-control" name="street" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Employment status</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="employment-edit" aria-label="Default select example" name="employment_status"
                                            required>
                                            <option selected>Open this select menu</option>
                                            <option value="Employed">Employed</option>
                                            <option value="Not employed">Not employed</option>
                                            <option value="Self employed">Self employed</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Marital status</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="marital-edit" aria-label="Default select example" name="marital_status"
                                            required>
                                            <option selected>Open this select menu</option>
                                            <option value="Married">Married</option>
                                            <option value="Single">Single</option>
                                            <option value="Widowed">Widowed</option>
                                            <option value="Divorced">Divorced</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Education level</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="education-edit" class="form-control" name="education_level" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Education Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="education-type-edit" aria-label="Default select example" name="education_type"
                                            required>
                                            <option selected>Open this select menu</option>
                                            <option value="Married">Formal</option>
                                            <option value="Single">Non-formal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Phone number</label>
                                    <div class="col-sm-10">
                                        <input type="tel" id="phone-edit" class="form-control" name="phone_number" required>
                                    </div>
                                    <div id="sphone-error1" style="color: red;"></div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" id="email-edit" placeholder="optional" class="form-control" name="student_email">
                                    </div>
                                    <div id="email-error1" style="color: red;"></div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Stage</label>
                                    <div class="col-sm-10">
                                         <select class="form-select" id="stage-edit" aria-label="Default select example" name="stage"
                                            required>
                                            <option selected>Open this select menu</option>
                                            <option value="Stage one">Stage one </option>
                                            <option value="Stage two">Stage two</option>
                                         </select>
                                    </div>
                                </div>                              
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Courses</label>
                                    <div class="col-sm-10">
                                        <select class="form-control selectpicker" id="course-edit" multiple data-live-search="true"
                                            data-mdb-container="#exampleModal" data-mdb-filter="true"
                                            name="course_id[]" required>
                                            @foreach ($centerCourses as $course)
                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
<!-- 
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Passport</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="passport-edit" name="passport" type="file" id="formFile" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Letter</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" id="letter-edit" name="letter" type="file" id="formFile" required>
                                    </div>
                                </div>  -->
                                <!-- <div class="row mb-3">
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
                                </div> -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="edit-status" aria-label="Default select example" name="status"
                                            id="gender" required>
                                            <option selected>Open this select menu</option>
                                            <option value="continous">Continuous</option>
                                            <option value="Graduate">Graduate</option>
                                            <option value="Dropout">dropout</option>
                                        </select>
                                    </div>
                                </div>
                                <center><div class="row">
                                    <b> <p>Parents/Guardian information</p></b>
                                </div></center>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="gname-edit" class="form-control" name="parent" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Phone number</label>
                                    <div class="col-sm-10">
                                        <input type="tel" id="gphone-edit" class="form-control" name="parent_phone" required>
                                    </div>
                                    <div id="phone-error2" style="color: red;"></div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" id="gemail-edit" placeholder="optional" class="form-control" name="parent_email">
                                    </div>
                                    <div id="email-error2" style="color: red;"></div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="gaddress-edit" placeholder="optional" class="form-control" name="parent_address">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Occupation</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="occupation-edit" class="form-control" name="parent_occupation" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Dissability</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="gdissability-edit" aria-label="Default select example" name="pdissability"
                                            required>
                                            <option selected>Open this select menu</option>
                                            <option value="None">None</option>
                                            <option value="Disabled">Disabled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Region</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="gregion-edit" class="form-control" name="pregion" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">District</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="gdistrict-edit" class="form-control" name="pdistrict" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Ward</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="gward-edit" class="form-control" name="pward" required>
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
    document.getElementById('editForm').addEventListener('submit', function(event) {
        var emailInput = document.getElementById('gemail_edit');
        var errorMessage = document.getElementById('email-error2');

        // Remove any existing error message
        if (errorMessage) {
            errorMessage.remove();
        }

        if (!validateEmail(emailInput.value)) {
            errorMessage = document.createElement('div');
            errorMessage.id = 'email-error2';
            errorMessage.innerText = 'Invalid email address';
            errorMessage.style.color = 'red';
            emailInput.parentNode.insertBefore(errorMessage, emailInput.nextSibling);
            emailInput.focus(); // Focus back on the email input field
            event.preventDefault(); // Prevent form submission
        }
    });

    function validateEmail(email) {
        // Regular expression for validating email addresses
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }
</script>

<script>
    document.getElementById('editForm').addEventListener('submit', function(event) {
        var emailInput = document.getElementById('email-edit');
        var errorMessage = document.getElementById('email-error1');

        // Remove any existing error message
        if (errorMessage) {
            errorMessage.remove();
        }

        if (!validateEmail(emailInput.value)) {
            errorMessage = document.createElement('div');
            errorMessage.id = 'email-error1';
            errorMessage.innerText = 'Invalid email address';
            errorMessage.style.color = 'red';
            emailInput.parentNode.insertBefore(errorMessage, emailInput.nextSibling);
            emailInput.focus(); // Focus back on the email input field
            event.preventDefault(); // Prevent form submission
        }
    });

    function validateEmail(email) {
        // Regular expression for validating email addresses
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }
</script>


<script>
    document.getElementById('studentForm').addEventListener('submit', function(event) {
        var emailInput = document.getElementById('email');
        var errorMessage = document.getElementById('email-error');

        // Remove any existing error message
        if (errorMessage) {
            errorMessage.remove();
        }

        if (!validateEmail(emailInput.value)) {
            errorMessage = document.createElement('div');
            errorMessage.id = 'email-error';
            errorMessage.innerText = 'Invalid email address';
            errorMessage.style.color = 'red';
            emailInput.parentNode.insertBefore(errorMessage, emailInput.nextSibling);
            emailInput.focus(); // Focus back on the email input field
            event.preventDefault(); // Prevent form submission
        }
    });

    function validateEmail(email) {
        // Regular expression for validating email addresses
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }
</script>

<script>
    document.getElementById('studentForm').addEventListener('submit', function(event) {
        var numberInput = document.getElementById('nida');
        var errorMessage = document.getElementById('error-message');
        
        if (errorMessage) {
            errorMessage.remove();
        }

        if (numberInput.value.length !== 20) {
            errorMessage = document.createElement('div');
            errorMessage.id = 'error-message';
            errorMessage.innerText = 'NIDA number must be exactly 20 characters long';
            errorMessage.style.color = 'red';
            numberInput.parentNode.insertBefore(errorMessage, numberInput.nextSibling);
            numberInput.focus();
            event.preventDefault(); 
        }
    });
</script>
<script>
    document.getElementById('editForm').addEventListener('submit', function(event) {
        var numberInput = document.getElementById('nida-edit');
        var errorMessage = document.getElementById('nida-error1');
        
        if (errorMessage) {
            errorMessage.remove();
        }

        if (numberInput.value.length !== 20) {
            errorMessage = document.createElement('div');
            errorMessage.id = 'nida-error1';
            errorMessage.innerText = 'NIDA number must be exactly 20 characters long';
            errorMessage.style.color = 'red';
            numberInput.parentNode.insertBefore(errorMessage, numberInput.nextSibling);
            numberInput.focus(); // Focus back on the input field
            event.preventDefault(); // Prevent form submission
        }
    });
</script>
<script>
    document.getElementById('studentForm').addEventListener('submit', function(event) {
        var birthDateInput = document.getElementById('birth-date');
        var errorMessage = document.getElementById('birth-error');

        // Remove any existing error message
        if (errorMessage) {
            errorMessage.remove();
        }

        if (!validateBirthDate(birthDateInput.value)) {
            errorMessage = document.createElement('div');
            errorMessage.id = 'birth-error';
            errorMessage.innerText = 'Enter a valid birth date.';
            errorMessage.style.color = 'red';
            birthDateInput.parentNode.insertBefore(errorMessage, birthDateInput.nextSibling);
            birthDateInput.focus(); // Focus back on the birth date input field
            event.preventDefault(); // Prevent form submission
        } else if (isFutureDate(birthDateInput.value)) {
            errorMessage = document.createElement('div');
            errorMessage.id = 'birth-error';
            errorMessage.innerText = 'Enter a valid birth date.';
            errorMessage.style.color = 'red';
            birthDateInput.parentNode.insertBefore(errorMessage, birthDateInput.nextSibling);
            birthDateInput.focus(); // Focus back on the birth date input field
            event.preventDefault(); // Prevent form submission
        } else if (!validateAge(birthDateInput.value)) {
            errorMessage = document.createElement('div');
            errorMessage.id = 'birth-error';
            errorMessage.innerText = 'You are too young for the program. Age must be greater than 13.';
            errorMessage.style.color = 'red';
            birthDateInput.parentNode.insertBefore(errorMessage, birthDateInput.nextSibling);
            birthDateInput.focus(); // Focus back on the birth date input field
            event.preventDefault(); // Prevent form submission
        }
    });

    function validateBirthDate(birthDateStr) {
        var birthDate = new Date(birthDateStr);
        return !isNaN(birthDate.getTime());
    }

    function isFutureDate(birthDateStr) {
        var birthDate = new Date(birthDateStr);
        var today = new Date();
        return birthDate.getTime() > today.getTime();
    }

    function validateAge(birthDateStr) {
        var birthDate = new Date(birthDateStr);
        var today = new Date();
        var ageDiffMs = today.getTime() - birthDate.getTime();
        var ageDate = new Date(ageDiffMs); // miliseconds from epoch
        var age = Math.abs(ageDate.getUTCFullYear() - 1970);
        return age >= 13;
    }
</script>
<script>
    document.getElementById('editForm').addEventListener('submit', function(event) {
        var birthDateInput = document.getElementById('dob');
        var errorMessage = document.getElementById('dob-error');

        // Remove any existing error message
        if (errorMessage) {
            errorMessage.remove();
        }

        if (!validateBirthDate(birthDateInput.value)) {
            errorMessage = document.createElement('div');
            errorMessage.id = 'dob-error';
            errorMessage.innerText = 'Enter a valid birth date.';
            errorMessage.style.color = 'red';
            birthDateInput.parentNode.insertBefore(errorMessage, birthDateInput.nextSibling);
            birthDateInput.focus(); // Focus back on the birth date input field
            event.preventDefault(); // Prevent form submission
        } else if (isFutureDate(birthDateInput.value)) {
            errorMessage = document.createElement('div');
            errorMessage.id = 'birth-error';
            errorMessage.innerText = 'Enter a valid birth date.';
            errorMessage.style.color = 'red';
            birthDateInput.parentNode.insertBefore(errorMessage, birthDateInput.nextSibling);
            birthDateInput.focus(); // Focus back on the birth date input field
            event.preventDefault(); // Prevent form submission
        } else if (!validateAge(birthDateInput.value)) {
            errorMessage = document.createElement('div');
            errorMessage.id = 'birth-error';
            errorMessage.innerText = 'You are too young for the program. Age must be greater than 13.';
            errorMessage.style.color = 'red';
            birthDateInput.parentNode.insertBefore(errorMessage, birthDateInput.nextSibling);
            birthDateInput.focus(); // Focus back on the birth date input field
            event.preventDefault(); // Prevent form submission
        }
    });

    function validateBirthDate(birthDateStr) {
        var birthDate = new Date(birthDateStr);
        return !isNaN(birthDate.getTime());
    }

    function isFutureDate(birthDateStr) {
        var birthDate = new Date(birthDateStr);
        var today = new Date();
        return birthDate.getTime() > today.getTime();
    }

    function validateAge(birthDateStr) {
        var birthDate = new Date(birthDateStr);
        var today = new Date();
        var ageDiffMs = today.getTime() - birthDate.getTime();
        var ageDate = new Date(ageDiffMs); // miliseconds from epoch
        var age = Math.abs(ageDate.getUTCFullYear() - 1970);
        return age >= 13;
    }
</script>




<script>
    document.getElementById('studentForm').addEventListener('submit', function(event) {
        var phoneNumberInput = document.getElementById('sphone');
        var errorMessage = document.getElementById('sphone-error');

        // Remove any existing error message
        if (errorMessage) {
            errorMessage.remove();
        }

        if (!validatePhoneNumber(phoneNumberInput.value)) {
            errorMessage = document.createElement('div');
            errorMessage.id = 'sphone-error';
            errorMessage.innerText = 'Invalid phone number. Must start with 07 or 06 and be 10 digits long';
            errorMessage.style.color = 'red';
            phoneNumberInput.parentNode.insertBefore(errorMessage, phoneNumberInput.nextSibling);
            phoneNumberInput.focus(); // Focus back on the phone number input field
            event.preventDefault(); // Prevent form submission
        }
    });

    function validatePhoneNumber(phoneNumber) {
        // Regular expression for validating phone numbers
        var re = /^(07|06)\d{8}$/;
        return re.test(phoneNumber);
    }
</script>

<script>
    document.getElementById('editForm').addEventListener('submit', function(event) {
        var phoneNumberInput = document.getElementById('phone-edit');
        var errorMessage = document.getElementById('sphone-error1');

        // Remove any existing error message
        if (errorMessage) {
            errorMessage.remove();
        }

        if (!validatePhoneNumber(phoneNumberInput.value)) {
            errorMessage = document.createElement('div');
            errorMessage.id = 'sphone-error1';
            errorMessage.innerText = 'Invalid phone number. Must start with 07 or 06 and be 10 digits long';
            errorMessage.style.color = 'red';
            phoneNumberInput.parentNode.insertBefore(errorMessage, phoneNumberInput.nextSibling);
            phoneNumberInput.focus(); // Focus back on the phone number input field
            event.preventDefault(); // Prevent form submission
        }
    });

    function validatePhoneNumber(phoneNumber) {
        // Regular expression for validating phone numbers
        var re = /^(07|06)\d{8}$/;
        return re.test(phoneNumber);
    }
</script>
<script>
    document.getElementById('editForm').addEventListener('submit', function(event) {
        var phoneNumberInput = document.getElementById('gphone-edit');
        var errorMessage = document.getElementById('phone-error2');

        // Remove any existing error message
        if (errorMessage) {
            errorMessage.remove();
        }

        if (!validatePhoneNumber(phoneNumberInput.value)) {
            errorMessage = document.createElement('div');
            errorMessage.id = 'phone-error2';
            errorMessage.innerText = 'Invalid phone number. Must start with 07 or 06 and be 10 digits long';
            errorMessage.style.color = 'red';
            phoneNumberInput.parentNode.insertBefore(errorMessage, phoneNumberInput.nextSibling);
            phoneNumberInput.focus(); // Focus back on the phone number input field
            event.preventDefault(); // Prevent form submission
        }
    });

    function validatePhoneNumber(phoneNumber) {
        // Regular expression for validating phone numbers
        var re = /^(07|06)\d{8}$/;
        return re.test(phoneNumber);
    }
</script>

<script>
    document.getElementById('studentForm').addEventListener('submit', function(event) {
        var phoneNumberInput = document.getElementById('phone');
        var errorMessage = document.getElementById('phone-error');

        // Remove any existing error message
        if (errorMessage) {
            errorMessage.remove();
        }

        if (!validatePhoneNumber(phoneNumberInput.value)) {
            errorMessage = document.createElement('div');
            errorMessage.id = 'phone-error';
            errorMessage.innerText = 'Invalid phone number. Must start with 07 or 06 and be 10 digits long';
            errorMessage.style.color = 'red';
            phoneNumberInput.parentNode.insertBefore(errorMessage, phoneNumberInput.nextSibling);
            phoneNumberInput.focus(); // Focus back on the phone number input field
            event.preventDefault(); // Prevent form submission
        }
    });

    function validatePhoneNumber(phoneNumber) {
        // Regular expression for validating phone numbers
        var re = /^(07|06)\d{8}$/;
        return re.test(phoneNumber);
    }
</script>




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
            $('#phone-edit').val(response.student.phone_number);
            $('#dob').val(response.student.date_of_birth);
            $('#nida-edit').val(response.student.nida);
            $('#stage-edit').val(response.student.stage);
            $('#course-edit').val(response.student.course_id);
            $('#edit-status').val(response.student.status);
            $('#gid').val(response.student.gid);
            $('#region-edit').val(response.student.region);
            $('#district-edit').val(response.student.district);
            $('#ward-edit').val(response.student.ward);
            $('#street-edit').val(response.student.street);
            $('#edit-dissability').val(response.student.disability);
            $('#employment-edit').val(response.student.employment_status);
            $('#marital-edit').val(response.student.marital_status);
            $('#education-edit').val(response.student.education_level);
            $('#education-type-edit').val(response.student.education_type);
            $('#email-edit').val(response.student.email);
            $('#gregion-edit').val(response.student.gregion);
            $('#gdistrict-edit').val(response.student.gdistrict);
            $('#gward-edit').val(response.student.gward);
            $('#gemail-edit').val(response.student.gemail);
            $('#gaddress-edit').val(response.student.address);
            $('#gname-edit').val(response.student.gname);
            $('#gphone-edit').val(response.student.phone);
            $('#occupation-edit').val(response.student.occupation);
            $('#gdissability-edit').val(response.student.gdissability);
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