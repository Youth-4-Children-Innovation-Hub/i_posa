@extends('home')
@section('contente')


<div class="container">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Regions</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Region</th>
                <th scope="col">Cordinator</th>
                <th scope="col">Centers</th>
                <th scope="col">Start Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach($regions as $key=>$region)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$region->region}}</td>
                <td>{{ $region->name}}</td>
                <td>28</td>
                <td>{{ $region->start_date}}</td>
                <td> <button type="button" class="btn btn-outline-primary btn-sm">Update</button>
                </td>

            </tr>

            @endforeach


        </tbody>
    </table>
    {{$regions->onEachSide(1)->links()}}





    <section class="section dashboard">
        @can('is_reg_cordinator')
        <button type="submit" class="btn btn-outline-warning my-4" onclick="showDiv()">Add Region</button>

        @endcan

        <div class="card" style="display:none;" id="add_region">
            <div class="card-body">
                <h5 class="card-title">Add Region</h5>

                <!-- General Form Elements -->
                <form method="POST" action="{{route('create_region')}}">
                    @csrf
                    <div class=" row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input name="name" type="text" class="form-control">
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Cordinator</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="cordinator">
                                <option selected>Open this select menu</option>
                                @foreach ($cordinators as $cordinator)
                                <option value="{{$cordinator->id}}">{{$cordinator->name}}</option>
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
function showDiv() {
    var div = document.getElementById("add_region");
    div.style.display = "block";
}
</script>

@endsection