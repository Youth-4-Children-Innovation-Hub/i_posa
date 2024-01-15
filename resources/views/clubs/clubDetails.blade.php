@extends('home')
@section('contente')
<div class="container">
    <div class="pagetitle">
        <h1>Clubs</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Clubs</li>
               
                <li class="breadcrumb-item active">{{ $club_details->Name }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card">
            <div class="card-body">
              <h5 class="card-title" style="text-align: center;">{{ $club_details->Name }} CLUB</h5>
             
              <!-- Active Table -->
              <table class="table table-borderless">
                <thead>
                  <tr>
                
                    <th scope="col">Chairperson Name</th>
                    <td scope="col">{{ $club_details->Chairperson }}</td>
                    
                  </tr>
                </thead>
                <tbody>
                  <tr>
             
                    <td> <b>Contact</b></td>
                    <td>{{ $club_details->Contact }}</td>
                  
                  </tr>
                  <tr>
                  
                  <td> <b>Email</b></td>
                    <td>{{ $club_details->Email }}</td>
                  
                  </tr>
                  <tr>
                  <tr>
             
                    <td> <b>Funding Sources</b></td>
                    <td>{{ $club_details->Funding_sources }}</td>
                  
                  </tr>  
            
                  <td> <b>Assets</b></td>
                    <td>{{ $club_details->Asset }}</td>
                
                  </tr>
                  <tr>
                 
                  <td> <b>Capital</b></td>
                    <td>{{ $club_details->Capital }}</td>
                   
                  </tr>
                  <tr>
                  
                  <td> <b>Quality Assurance Contact</b></td>
                    <td>{{ $club_details->QA_Contact }}</td>
                  
                  </tr>
                </tbody>
              </table>
              <!-- End Tables without borders -->
              <button type="submit" class="btn btn-outline-primary py-0 my-1" data-bs-toggle="modal" value="{{ $club_details->id }}" data-bs-target="#EditModal">Edit Club</button>
              <button type="submit" class="btn btn-outline-danger py-0 my-1" data-bs-toggle="modal" value="{{ $club_details->id }}" data-bs-target="#EditModal">Delete Club</button>
            </div>
          </div>

    <!-- update teacher -->
    <div class="modal fade" id="EditModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Club</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="" id="add_region">
                            <input type="hidden" name="teacher_id" id="teacher_id">
                            <div class="card-body">
                                <!-- General Form Elements -->
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Club Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" value="{{ $club_details->Name }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Chairperson Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="chairName" value="{{ $club_details->Chairperson }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Chairperson Phone Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="contact" value="{{ $club_details->Contact }}" required>
                                    </div>
                                </div>
                               
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Chairperson Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" id="name" value="{{ $club_details->Email }}"  placeholder="optional">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Registration Status</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="registration" id="name" value="{{ $club_details->Registration_status }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Assets</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="assets" id="name" value="{{ $club_details->Asset }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Funding sources</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="funding" value="{{ $club_details->Funding_sources}}" id="name">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Capital</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="capital" value="{{ $club_details->Capital }}" id="name" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Contact with QA</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="QA"
                                            required>
                                            <option selected>{{ $club_details->QA_Contact }}</option>
                                            @if($club_details->QA_Contact == "No")
                                            <option value="Yes">Yes</option>
                                            @else
                                            <option value="No">No</option>
                                            @endif
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

    <!-- update teacher model -->

        

</div>
@endsection


@section('scripts')


<script>
$(document).on('click', '.editBtn', function() {
    var id = $(this).val();
    console.log(id);
    $.ajax({
        type: "GET",
        url: "/edit_club/" + id,
        success: function(response) {
            console.log(response);
            // $('#teacher_id').val(id);
            // $('#name').val(response.teacher.name);
            // $('#phone_number').val(response.teacher.phone_number);
            // $('#email').val(response.teacher.email);

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
