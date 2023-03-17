@extends('home')
@section('contente')


<div class="container">

    <div class="pagetitle">
        <h1>Dashboard</h1>
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
                <th scope="col">Phone</th>
                <th scope="col">Profile picture</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Brandon Jacob</td>
                <td>Designer</td>
                <td>28</td>
                <td>2016-05-25</td>
                <td> <button type="button" class="btn btn-outline-primary btn-sm">Small</button>
                </td>

            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Bridie Kessler</td>
                <td>Developer</td>
                <td>35</td>
                <td>2014-12-05</td>
                <td> <button type="button" class="btn btn-outline-primary btn-sm">Small</button>
                </td>

            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Ashleigh Langosh</td>
                <td>Finance</td>
                <td>45</td>
                <td>2011-08-12</td>
                <td> <button type="button" class="btn btn-outline-primary btn-sm">Small</button>
                </td>

            </tr>
            <tr>
                <th scope="row">4</th>
                <td>Angus Grady</td>
                <td>HR</td>
                <td>34</td>
                <td>2012-06-11</td>
                <td> <button type="button" class="btn btn-outline-primary btn-sm">Small</button>
                </td>

            </tr>
            <tr>
                <th scope="row">5</th>
                <td>Raheem Lehner</td>
                <td>Dynamic Division Officer</td>
                <td>47</td>
                <td>2011-04-19</td>
                <td> <button type="button" class="btn btn-outline-primary btn-sm">Small</button>
                </td>

            </tr>
        </tbody>
    </table>




    <section class="section dashboard">

        <button type="submit" class="btn btn-outline-warning my-4" onclick="showDiv()">Add Region</button>

        <div class="card" style="display:none;" id="add_region">
            <div class="card-body">
                <h5 class="card-title">Add User</h5>

                <!-- General Form Elements -->
                <form>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Nida</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control">
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Profile picture</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control">
                        </div>
                    </div>



                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
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
function showDiv() {
    var div = document.getElementById("add_region");
    div.style.display = "block";
}
</script>

@endsection