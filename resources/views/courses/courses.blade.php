@extends('home')
@section('contente')
<div class="container">
    <div class="pagetitle">
        <h1>Courses</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Courses</li>
                <li class="mx-3 py-0">
                    <div class="search mx-auto">
                        <form action="{{ url('/search_district') }}" method="GET">
                        @csrf
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
                        <form method="GET" action="{{ url('/courses') }}">
                        @csrf
                            <select class="" name="number" id="exampleFormControlSelect1">
                                @if (isset($paginate))
                                <option value="{{ $paginate }}">{{ $paginate }}</option>
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
                        data-bs-target="#CreateNewCenterCourseModal">Add Center course</button>

                </li>
                @can('is_reg_cordinator')
                <li>
                    <button type="submit" class="btn btn-outline-primary mx-3 py-0 my-1" data-bs-toggle="modal"
                        data-bs-target="#CreateNewCourseModal">Add New course</button>
                </li>
                @endcan

            </ol>
        </nav>
    </div><!-- End Page Title -->

    @can('is_admin')
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Course</th>
              
                @can('is_hoc')

                <th scope="col">Action</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $key => $course)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $course->name }}</td>
                
                @can('is_hoc')
                <td> <button type="button" class="btn btn-outline-primary btn-sm editBtn"
                        value="{{ $course->id }}" data-bs-toggle="modal"
                        data-bs-target="#EditNewCenterCourseModal">Update</button>
                    <button type="button" value="{{ $course->id }}"
                        class="btn btn-outline-danger btn-sm delBtnAdmin">Delete</button>
                </td>
                @endcan
            </tr>
            @endforeach

        </tbody>
    </table>
    @endcan
    
    @can('is_hoc')
    @cannot('is_admin')
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Course</th>
                <th scope="col">Teacher</th>
               
                @can('is_hoc')

                <th scope="col">Action</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($centercourses1 as $key => $centercourses1)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $centercourses1->course1 }}</td>
                <td>{{ $centercourses1->teacher1 }}</td>
               
                @can('is_hoc')
                <td> <button type="button" class="btn btn-outline-primary btn-sm editBtn"
                        value="{{ $centercourses1->id }}" data-bs-toggle="modal"
                        data-bs-target="#EditNewCenterCourseModal">Update</button>
                    <button type="button" value="{{ $centercourses1->id }}"
                        class="btn btn-outline-danger btn-sm delBtn">Delete</button>
                </td>
                @endcan
            </tr>
            @endforeach

        </tbody>
    </table>
    @endcannot
    @endcan

   
    <!-- add new course -->
    <div class="modal fade" id="CreateNewCourseModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('create_new_course') }}">
                    @csrf

                    <div class="modal-body">

                        <div class="" id="add_region">
                            <div class="card-body">

                                <!-- General Form Elements -->
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Course Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" required>
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
    </div><!-- End of model add new  course-->

    <!-- Add new course model -->



    <!-- add center course -->
    <div class="modal fade" id="CreateNewCenterCourseModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Center Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('create_course') }}">
                    @csrf

                    <div class="modal-body">

                        <div class="" id="add_region">
                            <div class="card-body">

                                <!-- General Form Elements -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Course</label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker" aria-label="Default select example"
                                            name="course_id" required data-width=100% data-live-search="true">
                                            <option selected="selected" hidden="hidden" value="">Open this
                                                select menu
                                            </option>
                                            @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                                            @endforeach


                                        </select>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Teacher</label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker" aria-label="Default select example"
                                            name="teacher_id" required data-width=100% data-live-search="true">
                                            <option selected="selected" hidden="hidden" value="">Open this
                                                select menu
                                            </option>
                                            @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                            @endforeach


                                        </select>
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
    </div><!-- End of model add new  course-->

    <!-- Add new center course model -->

    <!-- add center course -->
    <div class="modal fade" id="EditNewCenterCourseModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Center Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('update_course') }}">
                    @csrf

                    <div class="modal-body">
                        <div class="" id="add_region">
                            <div class="card-body">
                                <!-- General Form Elements -->
                                <input type="hidden" id="course_center_id" name="course_center_id">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Course</label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker" aria-label="Default select example"
                                            name="course_id" id="course_id" required data-width=100%
                                            data-live-search="true">
                                            <option selected="selected" hidden="hidden" value="">Open this
                                                select menu
                                            </option>
                                            @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Teacher</label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker" aria-label="Default select example"
                                            name="teacher_id" id="teacher_id" required data-width=100%
                                            data-live-search="true">
                                            <option selected="selected" hidden="hidden" value="">Open this
                                                select menu
                                            </option>
                                            @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Center</label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker" aria-label="Default select example"
                                            name="center_id" id="center_id" required data-width=100%
                                            data-live-search="true">
                                            <option selected="selected" hidden="hidden" value="">Open this
                                                select menu
                                            </option>
                                            @foreach ($centers as $center)
                                            <option value="{{ $center->id }}">{{ $center->name }}</option>
                                            @endforeach
                                        </select>
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
    </div><!-- End of model add new  course-->


</div>
@endsection

@section('scripts')
<script>
$(document).on('click', '.editBtn', function() {
    var id = $(this).val();
    console.log(id);
    $.ajax({
        type: "GET",
        url: "/edit_course/" + id,
        success: function(response) {
            console.log(response);
            $('#course_id').val(response.course_centers.course_id);
            $('#course_id').selectpicker('refresh');
            $('#course_center_id').val(id);
            $('#teacher_id').val(response.course_centers.teacher_id);
            $('#teacher_id').selectpicker('refresh');
            $('#center_id').val(response.course_centers.center_id);
            $('#center_id').selectpicker('refresh');
        },
        error: function(xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
        }

    });
});

$('.delBtn').on('click', function() {
    var confirmation = confirm('Are you sure you want to delete this course?');
    if (confirmation) {
        // delete it
        var course = $(this).val();
        console.log(course);

        $.ajax({
            type: 'POST',
            url: '/delete_course_center',
            data: {
                id: course
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

$('.delBtnAdmin').on('click', function() {
    var confirmation = confirm('Are you sure you want to delete this course?');
    if (confirmation) {
        // delete it
        var course = $(this).val();
        console.log(course);

        $.ajax({
            type: 'POST',
            url: '/delete_course_admin',
            data: {
                id: course
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