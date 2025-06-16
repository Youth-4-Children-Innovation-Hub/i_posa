@extends('home')
@section('contente')



<div class="container">
    <div class="pagetitle">
        <h1>Courses</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Courses</li> /
                @if($user_role->role == 'admin')
                <li>
                    <button type="submit" class="btn btn-outline-primary mx-3 py-0 my-1" data-bs-toggle="modal"
                        data-bs-target="#CreateNewCourseModal">Add New course</button>
                </li>
                @endif
                

                @if($user_role->role == 'head of center')
                <li>
                   
                    <button type="submit" class="btn btn-outline-primary mx-3 py-0 my-1" data-bs-toggle="modal"
                        data-bs-target="#CreateNewCenterCourseModal">Add Center course</button>

                </li>
                @endif
                   @cannot('is_admin')
                 @can('is_hoc')
                <li>
                <form action="{{ route('center_courses') }}" method="get" target="_blank">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary mx-3 py-0 my-1" onclick="confirmAction(event, 'Are you sure you want to generate this report?')">Generate Report</button>
                    </form> 
                </li>
                 @endcan
                @can('is_dist_cordinator')
            <li>
                <form action="{{ route('district_courses_report') }}" method="get" target="_blank">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary mx-3 py-0 my-1" onclick="confirmAction(event, 'Are you sure you want to generate this report?')">Generate Report</button>
                </form> 
            </li>
            @endcan  
                @can('is_reg_cordinator')
            <li>
                <form action="{{ route('regional_courses_report') }}" method="get" target="_blank">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary mx-3 py-0 my-1" onclick="confirmAction(event, 'Are you sure you want to generate this report?')">Generate Report</button>
                </form> 
            </li>
            @endcan  
              @endcannot
                @can('is_admin')
            <li>
                <form action="{{ route('national_courses_report') }}" method="get" target="_blank">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary mx-3 py-0 my-1" onclick="confirmAction(event, 'Are you sure you want to generate this report?')">Generate National Report</button>
                </form> 
            </li>
            @endcan  
               
               

            </ol>
        </nav>
    </div><!-- End Page Title -->

    @can('is_admin')
    

    <div class="">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">

                  <table class="table table-borderless datatable">
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
                                data-bs-target="#editCourse" onclick="populateEditModal('{{ $course->id }}', '{{ $course->name }}')">Edit</button>
                            <button type="button" value="{{ $course->id }}"
                                class="btn btn-outline-danger btn-sm delBtnAdmin">Delete</button>
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
    <div class="row-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">

                  <table class="table table-borderless datatable">
                    <thead>
                   
                      <tr>
                        <th>#</th>
                        <th scope="col">Course</th>
                        <th scope="col">Centers</th>
                        <th scope="col">Action</th>
                      </tr>
                    
                    </thead>
                    <tbody>
              
                    @foreach($regionCourses as $key => $course)  
                      <tr>
                      <th scope="row"><a href="#">{{ $key + 1 }}</a></th>
                        <td scope="col">{{ $course->course }}</td>
                        <td scope="col">{{ $course->centers }}</td>
                        <td>
                            <button type="button" class="btn btn-outline-info btn-sm viewCourseBtn" 
                                data-bs-toggle="modal" 
                                data-bs-target="#viewCourseModal"
                                data-course="{{ $course->course }}">
                                View Details
                            </button>
                        </td>
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
    <div class="row-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">

                  <table class="table table-borderless datatable">
                    <thead>
                   
                      <tr>
                        <th>#</th>
                        <th scope="col">Course</th>
                        <th scope="col">Teacher</th>
                        <th scope="col">Center</th>
                        <th scope="col">Action</th>
                      </tr>
                    
                    </thead>
                    <tbody>
              
                    @foreach($districtCourses as $key => $course)  
                      <tr>
                      <th scope="row"><a href="#">{{ $key + 1 }}</a></th>
                        <td scope="col">{{ $course->course }}</td>
                        <td scope="col">{{ $course->teacher }}</td>
                        <td scope="col">{{ $course->center }}</td>
                        <td>
                          <button type="button" class="btn btn-outline-info btn-sm viewDistrictCourseBtn" 
                              data-bs-toggle="modal" 
                              data-bs-target="#viewCourseModal"
                              data-course="{{ $course->course }}">
                              View Details
                          </button>
                        </td>
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
                                data-bs-target="#EditNewCenterCourseModal">Edit</button>
                            <button type="button" value="{{ $centercourses1->id }}"
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
                        <button type="submit" class="btn btn-primary">Create</button>

                    </div>
                </form><!-- End General Form Elements -->

            </div>
        </div>
    </div><!-- End of model add new  course-->

    <!-- Add new course model -->


 @cannot('is_admin')
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
                                            @can('is_hoc')
                                            @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                            @endforeach
                                            @endcan
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
@endcannot
 <!--admin edit course -->
 <div class="modal fade" id="editCourse" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('update_course') }}">
                    @csrf

                    <div class="modal-body">
                        <div class="" id="add_region">
                            <div class="card-body">
                                <!-- General Form Elements -->
                                <input type="hidden" id="course_id" name="courseId">
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Course Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="edit-name" class="form-control" name="course" required>
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
    </div><!-- End admin edit course-->
@cannot('is_admin')
    <!-- edit center course -->
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
                                            @foreach ($centerCourses as $course)
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
                                             @can('is_hoc')
                                            @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                            @endforeach
                                             @endcan
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

@endcannot
</div>

<!-- View Course Details Modal -->
<div class="modal fade" id="viewCourseModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalCourseName"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info"><i class="bi bi-book"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Course Details</span>
                                        <span class="info-box-number" id="modalCourseName2"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Center</th>
                                        <th>District</th>
                                        <th>Region</th>
                                        <th>Teacher</th>
                                    </tr>
                                </thead>
                                <tbody id="courseDetailsBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function populateEditModal(id, name) {
        document.getElementById('course_id').value = id;
        document.getElementById('edit-name').value = name;
        $('#editCourse').modal('show');
    }
</script>
<script>
// Initialize DataTables and attach event handlers
document.addEventListener("DOMContentLoaded", function() {
    const datatables = document.querySelectorAll('.datatable');
    datatables.forEach(datatable => {
        const dataTable = new simpleDatatables.DataTable(datatable, {
            perPage: 10,
            perPageSelect: [10, 25, 50, 100],
            columns: [
                { select: 0, sort: "asc" }
            ]
        });

        // Add event listener for page changes
        datatable.addEventListener('datatable.page', function() {
            // Reattach event handlers after page change
            attachEventHandlers();
        });
    });

    // Initial attachment of event handlers
    attachEventHandlers();
});

function attachEventHandlers() {
    // Delete button event handlers using event delegation
    $(document).on('click', '.delBtn', function() {
        var course = $(this).val();
        
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
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
                        if(response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: response.message,
                                confirmButtonColor: '#28a745'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message,
                                confirmButtonColor: '#dc3545'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something went wrong. Please try again.',
                            confirmButtonColor: '#dc3545'
                        });
                    }
                });
            }
        });
    });

    $(document).on('click', '.delBtnAdmin', function() {
        var course = $(this).val();
        
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
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
                        if(response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: response.message,
                                confirmButtonColor: '#28a745'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message,
                                confirmButtonColor: '#dc3545'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something went wrong. Please try again.',
                            confirmButtonColor: '#dc3545'
                        });
                    }
                });
            }
        });
    });

    // Handle both regional and district course view buttons
    $(document).on('click', '.viewCourseBtn, .viewDistrictCourseBtn', function() {
        const courseName = $(this).data('course');
        
        // Update modal title and info box
        $('#modalCourseName').text(courseName);
        $('#modalCourseName2').text(courseName);
        
        // Make AJAX call to get course details
        $.ajax({
            url: '/get-course-details',
            method: 'GET',
            data: {
                course_name: courseName
            },
            success: function(response) {
                let html = '';
                response.details.forEach(function(detail) {
                    html += `
                        <tr>
                            <td>${detail.center}</td>
                            <td>${detail.district}</td>
                            <td>${detail.region}</td>
                            <td>${detail.teacher}</td>
                        </tr>
                    `;
                });
                $('#courseDetailsBody').html(html);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching course details:', error);
                $('#courseDetailsBody').html('<tr><td colspan="4" class="text-center text-danger">Error loading course details</td></tr>');
            }
        });
    });
}
</script>

<style>
.info-box {
    display: flex;
    min-height: 90px;
    background: #fff;
    width: 100%;
    box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
    border-radius: 0.25rem;
    margin-bottom: 1rem;
}

.info-box-icon {
    border-radius: 0.25rem 0 0 0.25rem;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 70px;
    color: #fff;
    font-size: 1.875rem;
}

.info-box-content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    line-height: 1.8;
    flex: 1;
    padding: 0 15px;
}

.info-box-text {
    display: block;
    font-size: 0.875rem;
    color: #6c757d;
}

.info-box-number {
    display: block;
    font-weight: 700;
    font-size: 1.25rem;
}

.table-hover tbody tr:hover {
    background-color: rgba(0,0,0,.075);
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0,0,0,.02);
}
</style>
@endsection