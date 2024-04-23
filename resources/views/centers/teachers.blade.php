@extends('home')
@section('contente')
<div class="container">
    <div class="pagetitle">
        <h1>Teachers</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Teachers</li>
                <li>
                    <button type="submit" class="btn btn-outline-primary mx-3 py-0 my-1" data-bs-toggle="modal"
                        data-bs-target="#CreateModal">Add Teacher</button>
                </li>
                

            </ol>
        </nav>
    </div><!-- End Page Title -->

    @can('is_admin')
    <div class="">
              <div class="card recent-sales overflow-auto">


                  <table class="table table-borderless datatable">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone number</th>
                        @can('is_hoc')

                        <th scope="col">Action</th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>
                 
                    @foreach ($teachers as $key => $teacher)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>{{ $teacher->phone_number }}</td>
                        @can('is_hoc')

                        <td> <button type="button" data-bs-toggle="modal" data-bs-target="#EditModal" value="{{ $teacher->id }}"
                                class="btn btn-outline-primary btn-sm editBtn">Update</button>
                            <button type="button" value="{{ $teacher->id }}"
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
    <div class="row-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <!-- <h5 class="card-title">Recent Reports</h5> -->

                  <table class="table table-borderless datatable">
                    <thead>
                   
                      <tr>
                        <th>#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Center</th>
                        <th scope="col">District</th>
                      </tr>
                    
                    </thead>
                    <tbody>
              
                    @foreach($regionTeachers as $key => $regionTeachers)  
                      <tr>
                      <th scope="row"><a href="#">{{ $key + 1 }}</a></th>
                        <td scope="col">{{ $regionTeachers->name }}</td>
                        <td scope="col">{{ $regionTeachers->centerName }}</td>
                        <td scope="col">{{ $regionTeachers->distName }}</td>
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
                  <!-- <h5 class="card-title">Recent Reports</h5> -->

                  <table class="table table-borderless datatable">
                    <thead>
                   
                      <tr>
                        <th>#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Center</th>
                      </tr>
                    
                    </thead>
                    <tbody>
              
                    @foreach($districtTeachers as $key => $districtTeachers)  
                      <tr>
                      <th scope="row"><a href="#">{{ $key + 1 }}</a></th>
                        <td scope="col">{{ $districtTeachers->name }}</td>
                        <td scope="col">{{ $districtTeachers->centerName }}</td>
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
                        <th scope="col">Email</th>
                        <th scope="col">Phone number</th>
                        <th scope="col">Action</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($teachers1 as $key => $teachers1)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $teachers1->name }}</td>
                        <td>{{ $teachers1->email }}</td>
                        <td>{{ $teachers1->phone_number }}</td>
                        @can('is_hoc')

                        <td> <button type="button" data-bs-toggle="modal" data-bs-target="#EditModal" value="{{ $teachers1->id }}"
                                class="btn btn-outline-primary btn-sm editBtn">Update</button>
                            <button type="button" value="{{ $teachers1->id }}"
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


    <!-- add new teacher -->
    <div class="modal fade" id="CreateModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Teacher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('create_teacher') }}" id="teacherForm">
                    @csrf
                    <div class="modal-body">
                        <div class="" id="add_region">
                            <div class="card-body">
                                <!-- General Form Elements -->
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Gender</label>
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
                                    <label for="inputText" class="col-sm-2 col-form-label">Qualification</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="qualification" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Attended ANFE training</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="anfe"
                                            required>
                                            <option selected>Open this select menu</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" id="email1" class="form-control" name="email" required>
                                    </div>
                                    <div id="email-error" style="color: red;"></div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Phone number</label>
                                    <div class="col-sm-10">
                                        <input type="tel" class="form-control" id="phone" name="phone_number" required>
                                    </div>
                                    <div id="phone-error" style="color: red;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add </button>
                    </div>
                </form><!-- End General Form Elements -->
            </div>
        </div>
    </div>

    <!-- Add new teacher model -->

    <!-- update teacher -->
    <div class="modal fade" id="EditModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Teacher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('update_teacher') }}" id="teacherEditForm">
                    @csrf
                    <div class="modal-body">
                        <div class="" id="add_region">
                            <input type="hidden" name="teacher_id" id="teacher_id">
                            <div class="card-body">
                                <!-- General Form Elements -->
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" id="name" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="gender" aria-label="Default select example" name="gender"
                                            required>
                                            <option selected>Open this select menu</option>
                                            <option value="F">Female</option>
                                            <option value="M">Male</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Qualification</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="qualification" class="form-control" name="qualification" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Attended ANFE training</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="anfe" aria-label="Default select example" name="anfe"
                                            required>
                                            <option selected>Open this select menu</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" id="email" required>
                                    </div>
                                    <div id="email-edit-error" style="color: red;"></div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Phone number</label>
                                    <div class="col-sm-10">
                                        <input type="tel" class="form-control" name="phone_number" id="phone_number"
                                            required>
                                    </div>
                                    <div id="phone2-edit-error" style="color: red;"></div>
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

    <!-- update teacher model -->


</div>
@endsection


@section('scripts')
<script>
    document.getElementById('teacherForm').addEventListener('submit', function(event) {
        var emailInput = document.getElementById('email1');
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
    document.getElementById('teacherEditForm').addEventListener('submit', function(event) {
        var emailInput = document.getElementById('email');
        var errorMessage = document.getElementById('email-edit-error');

        // Remove any existing error message
        if (errorMessage) {
            errorMessage.remove();
        }

        if (!validateEmail(emailInput.value)) {
            errorMessage = document.createElement('div');
            errorMessage.id = 'email-edit-error';
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
    document.getElementById('teacherForm').addEventListener('submit', function(event) {
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
    document.getElementById('teacherEditForm').addEventListener('submit', function(event) {
        var phoneNumberInput = document.getElementById('phone_number');
        var errorMessage = document.getElementById('phone2-edit-error');

        // Remove any existing error message
        if (errorMessage) {
            errorMessage.remove();
        }

        if (!validatePhoneNumber(phoneNumberInput.value)) {
            errorMessage = document.createElement('div');
            errorMessage.id = 'phone2-edit-error';
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
        url: "/edit_teacher/" + id,
        success: function(response) {
            console.log(response);
            $('#teacher_id').val(id);
            $('#name').val(response.teacher.name);
            $('#phone_number').val(response.teacher.phone_number);
            $('#email').val(response.teacher.email);
            $('#anfe').val(response.teacher.ANFE_training);
            $('#qualification').val(response.teacher.qualification);
            $('#gender').val(response.teacher.gender);

        },

    });
});

$('.delBtn').on('click', function() {
    var confirmation = confirm('Are you sure you want to delete this Teacher?');
    if (confirmation) {
        // delete it
        var teacher = $(this).val();
        console.log(teacher);

        $.ajax({
            type: 'POST',
            url: '/delete_teacher',
            data: {
                id: teacher
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