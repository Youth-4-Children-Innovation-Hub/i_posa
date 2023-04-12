@extends('home')
@section('contente')


<div class="container m-0 p-0">

    <div class="pagetitle">
        <h1>Users</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Users</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">NID</th>
                <th scope="col">Role</th>
                <th scope="col">Profile picture</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $key=>$user)

            <tr>
                <th scope="row">{{$key+1}}</th>
                <td> {{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->national_id}}</td>
                <td>{{$user->role}}</td>
                <td></td>
            </tr>

            @endforeach

        </tbody>
    </table>

    {{$users->onEachSide(1)->links()}}





    <!-- update user -->
    <section class="section dashboard">


        <div class="card" style="display:block;" id="update_user">
            <div class="card-body">
                <h5 class="card-title">Update user</h5>

                <!-- General Form Elements -->
                <form method="POST" action="{{route('update_user')}}">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" required value="{{$update_user->name}}">
                        </div>
                    </div>

                    <div class=" row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" required
                                value="{{$update_user->email}}">
                        </div>
                    </div>
                    <input type="text" class="form-control" style="display:none;" name="id"
                        value="{{$update_user->id}}">


                    <!-- <div class="row mb-3">
          <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
          <div class="col-sm-10">
            <input type="password" class="form-control">
          </div>
        </div> -->

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Nida</label>
                        <div class="col-sm-10">
                            <input type="text" name="nida" class="form-control" value="{{$update_user->national_id}}">
                        </div>
                    </div>




                    <!-- <div class=" row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Profile
                            picture</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="profile" type="file" id="formFile">
                        </div>
                    </div> -->



                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="role" required>
                                <option value="{{$update_user->role_id}}" selected="selected" hidden="hidden">
                                    {{$update_user->role}}
                                </option>
                                @foreach($roles as $role)
                                <option value="{{$role->id}}">{{ $role->role }}</option>
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

                </form><!-- End General Form Elements -->

            </div>
        </div>


    </section>
</div>
<script>
function showDiv(id) {
    var div = document.getElementById(id);
    div.style.display = "block";
}

// function showUpdate() {
//     var div = document.getElementById("update_user");
//     div.style.display = "block";

// }
</script>

@endsection