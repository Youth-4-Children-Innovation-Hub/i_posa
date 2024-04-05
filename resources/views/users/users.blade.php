@extends('home')
@section('contente')


<div class="container mx-auto p-0">

    <div class="pagetitle">
        <h1>Users</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Users</li>
                  <li>

                </li>
                <li>
                    <button type="submit" class="btn btn-outline-primary mx-3 py-0 my-1" data-bs-toggle="modal"
                        data-bs-target="#CreateModal">Add
                        User</button>

                </li>
    </div>
    </ol>
    </nav>
</div><!-- End Page Title -->
 <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Recent Reports</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col"></th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key=>$user)
                        <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td> {{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone_number}}</td>
                        <td>{{$user->role}}</td>

                        <!-- updateform/{{$user->id}} -->
                        <td>
                            <button type="button" class="btn btn-outline-primary btn-sm py-0 editBtn" value="{{ $user->id }}" data-bs-toggle="modal"
                                data-bs-target="#UpdateModal">Update</button>
                                <button type="button" class="btn btn-outline-danger btn-sm py-0 delBtn" value="{{ $user->id }}">Delete</button>
                        </td>
                      </tr>  
                    @endforeach  
                    </tbody>
                  </table>

                </div>

              </div>
            </div>



<!-- model add user -->

<div class="modal fade" id="CreateModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{route('create_user')}}">
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
                                <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="email" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <select class="selectpicker" aria-label="Default select example" name="role"
                                        required data-width=100% data-live-search="true">
                                        <option selected="selected" hidden="hidden">
                                            Open this select menu</option>
                                        @foreach($roles as $role)
                                        <option value="{{$role->id}}">
                                            {{ $role->role }}</option>
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
</div><!-- End of model add user-->



<!-- model update user -->

<div class="modal fade" id="UpdateModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{route('update_user')}}">

                @csrf
                <div class="modal-body">

                    <input type="hidden" name="user_id" id="user_id">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" required value="">
                        </div>
                    </div>

                    <div class=" row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" id="email" required value="">
                        </div>
                    </div>
                    <input type="text" class="form-control" style="display:none;" name="id" value="">

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="role" id="role" required>
                                <option value="" selected="selected" hidden="hidden">

                                </option>
                                @foreach($roles as $role)
                                <option value="{{$role->id }}">{{ $role->role }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Update</label>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Update
                                </button>

                        </div>
                    </div>


                </div>
            </form>
        </div>
    </div>
    <!-- end of model update user -->

    <section class=" section dashboard">


    </section>


    <!-- update user -->


</div>


@endsection

@section('scripts')
    <script>
        $(document).on('click', '.editBtn', function() {
            var id = $(this).val();
            console.log(id);
            $.ajax({
                type: "GET",
                url: "/edit_user/" + id,
                success: function(response) {
                    console.log(response);
                    $('#user_id').val(id);
                    $('#name').val(response.user.name);
                    $('#email').val(response.user.email);
                    $('#role').val(response.user.role_id);
                    $('#role').selectpicker('refresh');

                    },

            });
        });

        $('.delBtn').on('click', function() {
            var confirmation = confirm('Are you sure you want to delete this user?');
            if (confirmation) {
                // delete it
                var user = $(this).val();
                console.log(user);

                $.ajax({
                    type: 'POST',
                    url: '/delete_user',
                    data: {
                        id: user
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
