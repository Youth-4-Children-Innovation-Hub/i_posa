@extends('home')
@section('contente')


<div class="container mx-auto p-0">

    <div class="pagetitle">
        <h1>Users</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Users</li>
                <li class="mx-3 py-0">
                    <div class="search mx-auto">
                        <form action="{{url('/search_user')}}" method="GET">
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
                    <div class="my-1 d-flex">
                        <label for="exampleFormControlSelect1 mx-1">Show</label>
                        <form method="GET" action="{{url('/users')}}">
                            <select class="" name="number" id="exampleFormControlSelect1">
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
                            </select>

                        </form>
                        <label for="exampleFormControlSelect1 mx-1">Entries</label>

                    </div>


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


<table class="table table-striped mx-auto ">
    <thead>
        <tr>
            <th scope="col">#</th>
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
                <button type="button" class="btn btn-outline-primary btn-sm py-0" data-bs-toggle="modal"
                    data-bs-target="#UpdateModal">Update</button>
            </td>

        </tr>


        @endforeach

    </tbody>
</table>

{{$users->onEachSide(1)->links()}}

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
                                        <option selected="selected" hidden="hidden">Open this select menu</option>
                                        @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{ $role->role }}</option>
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
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" required value="">
                        </div>
                    </div>

                    <div class=" row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" required value="">
                        </div>
                    </div>
                    <input type="text" class="form-control" style="display:none;" name="id" value="">

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="role" required>
                                <option value="" selected="selected" hidden="hidden">

                                </option>
                                @foreach($roles as $role)
                                <option value="">{{ $role->role }}</option>
                                @endforeach


                            </select>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Submit Button</label>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Submit Form</button>

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
<script>
// function showDiv(id) {
//     var div = document.getElementById(id);
//     div.style.display = "block";
// }

// function showUpdate() {
//     var div = document.getElementById("update_user");
//     div.style.display = "block";

// }
</script>

@endsection