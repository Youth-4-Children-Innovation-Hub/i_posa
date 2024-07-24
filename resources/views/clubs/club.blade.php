@extends('home')
@section('contente')
<div class="container">
    <div class="pagetitle">
        <h1>Clubs</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Clubs</li>

                @cannot('is_admin')
                @cannot('is_reg_cordinator')
                @cannot('is_dist_cordinator')
                <li>
                    <button type="submit" class="btn btn-outline-primary mx-3 py-0 my-1" data-bs-toggle="modal"
                        data-bs-target="#CreateModal">Add Club</button>
                </li>
                @endcannot
                @endcannot
                @endcannot
                

            </ol>
        </nav>
    </div><!-- End Page Title -->

       <!-- Default Card -->
       @can('is_hoc')
       @cannot('is_admin')
       <div class="">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">

                  <table class="table table-borderless datatable">
                    <thead>
                    <tr>
                       
                        <th scope="col">Name</th>
                        <th scope="col">Chairperson</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody> 
                    @foreach($clubs as $key => $clubs)    
                    <tr>
                        <td>{{ $clubs->Name }}</td>
                        <td>{{ $clubs->Chairperson }}</td>
                        <td>{{ $clubs->Contact }}</td>
                        <td>
                            <a href="{{ url('club_details', ['id' => $clubs->id]) }}" type="button" class="btn btn-outline-success btn-sm editBtn" value="">View</a>
                            
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
       @can('is_admin')
       <div class="">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Clubs</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Location</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($adminClubs as $key => $clubs)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $clubs->Name }}</td>
                        <td>{{ $clubs->rName }}, {{ $clubs->dName }}, {{ $clubs->cName }}</td>
                        <td>
                            <a href="{{ url('club_details', ['id' => $clubs->id]) }}" type="button" class="btn btn-outline-success btn-sm editBtn" value="">View</a>
                        </td>    
                    </tr>
                    @endforeach
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
       @endcan
       @can('is_dist_cordinator')
       <div class="row align-items-top">
            @foreach($distclubs as $clubs)
            
                <div class="col-lg-3">
                  
                        <a href="{{ url('club_details', ['id' => $clubs->id]) }}" style="text-decoration: none;">
                        <div class="card">
                        <div class="card-body">
                        <h5 class="card-title" style="text-align: center;">{{ $clubs->Name }}</h5>
                        </div>
                        </div>
                        </a>
                    
               
                </div>
           @endforeach
            
       </div>
       @endcan
       @can('is_reg_cordinator')
       <div class="row align-items-top">
            @foreach($regclubs as $clubs)
            
                <div class="col-lg-3">
                  
                        <a href="{{ url('club_details', ['id' => $clubs->id]) }}" style="text-decoration: none;">
                        <div class="card">
                        <div class="card-body">
                        <h5 class="card-title" style="text-align: center;">{{ $clubs->Name }}</h5>
                        </div>
                        </div>
                        </a>
                    
               
                </div>
           @endforeach
            
       </div>
       @endcan
       <!-- End Default Card -->

    <!-- add new club-->
    <div class="modal fade" id="CreateModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                   
                    <h5 class="modal-title">Add Club</h5>
                    
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('create_club') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="" id="add_region">
                            <div class="card-body">
                                <!-- General Form Elements -->
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Club Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Chairperson Name</label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker" aria-label="Default select example"
                                            name="chairId" id="chair_name" required data-width=100%
                                            data-live-search="true">
                                            <option selected="selected" hidden="hidden" value="">Open this
                                                select menu
                                            </option>
                                            @foreach ($students as $student)
                                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Registration Status</label>
                                    <div class="col-sm-10">
                                         <select class="selectpicker" aria-label="Default select example"
                                            name="registration" id="chair_name" required data-width=100%
                                            data-live-search="true">
                                            <option value="Registered">Registered</option>
                                            <option value="Not registered">Not registered</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Assets</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="assets" id="name" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Funding sources</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="funding" id="name">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Capital</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="capital" id="name" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Contact with QA</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="QA"
                                            required>
                                            <option selected>Open this select menu</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
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

    <!-- end club model -->
     
   

</div>
@endsection


@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function addInputField() {
        var inputGroup = $('<div class="input-group mt-2"><input type="text" name="multiInput[]" class="form-control" id="name"><div class="input-group-append"><button class="btn btn-outline-danger" type="button" onclick="removeInputField(this)">Remove</button></div></div>');
        $('#input-container').append(inputGroup);
    }

    function removeInputField(button) {
        $(button).closest('.input-group').remove();
    }
</script>

<script>
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


</script>
@endsection
