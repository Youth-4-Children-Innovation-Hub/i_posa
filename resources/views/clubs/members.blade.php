@extends('home')
@section('contente')
<div class="container">
<div class="pagetitle">
        <h1>Clubs</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Clubs</li>
                <li class="breadcrumb-item active">{{ $club->Name }}</li>
                <li class="breadcrumb-item active">Members</li>
                <li>
                    <button type="submit" class="btn btn-outline-primary mx-3 py-0 my-1" data-bs-toggle="modal"
                        data-bs-target="#CreateModal">Add Members</button>
                </li>
            </ol>
        </nav>
</div>
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
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"></th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>   
                        </tr>               
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
</div>
   <!-- model add student -->
   <div class="modal fade" id="CreateModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Members</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="" enctype="multipart/form-data" id="membersForm">
                    @csrf

                    <div class="modal-body">

                        <div class="" id="add_region">
                            <div class="card-body ">

                                <!-- General Form Elements -->
                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Student</label>
                                    <div class="col-sm-10">
                                        <select class="form-control selectpicker" multiple data-live-search="true"
                                            data-mdb-container="#exampleModal" data-mdb-filter="true"
                                            name="">
                                            @foreach($students as $student)
                                            <option value="">{{ $student->name }}</option>
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
    </div><!-- End of model add student-->

@endsection