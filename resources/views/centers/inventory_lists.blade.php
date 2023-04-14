@extends('home')
@section('contente')


<div class="container">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Inventory List</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Number</th>
                <th scope="col">Course</th>
                <th scope="col">Condition</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventory_lists as $inventory_list)
            <tr>
                <th scope="row">1</th>
                <td>{{$inventory_list->name}}</td>
                <td>{{ $inventory_list->number}}</td>
                <td>{{ $inventory_list->course_name}}</td>
                <td>{{ $inventory_list->condition}}</td>
                <td> <button type="button" class="btn btn-outline-primary btn-sm">Update</button>
                </td>

            </tr>
            @endforeach

        </tbody>
    </table>




    <section class="section dashboard">
        @can('is_hoc')
            <button type="submit" class="btn btn-outline-warning my-4" onclick="showDiv()">Add New Inventory</button>
        @endcan

        <div class="card" style="display:none;" id="add_inventory_list">
            <div class="card-body">
                <h5 class="card-title">Add New Inventory</h5>

                <!-- General Form Elements -->
                <form method="POST" action="{{route('create_inventory')}}">
                    @csrf
                    <div class=" row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input name="name" type="text" class="form-control">
                        </div>
                    </div>

                    <div class=" row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Number</label>
                        <div class="col-sm-10">
                            <input name="number" type="number" class="form-control">
                        </div>
                    </div>


                    <div class=" row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Course</label>
                        <div class="col-sm-10">
                            <input name="course" type="text" class="form-control">
                        </div>
                    </div>

                    <div class=" row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Condition</label>
                        <div class="col-sm-10">
                            <input name="condition" type="text" class="form-control">
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
    var div = document.getElementById("add_inventory_list");
    div.style.display = "block";
}
</script>

@endsection
