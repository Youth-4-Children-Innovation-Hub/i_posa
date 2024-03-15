@extends('home')
@section('contente')
<div class="container">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Inventory List</li>
                <li>
                @can('is_hoc')
                    <button type="submit" class="btn btn-outline-primary mx-3 py-0 my-1" data-bs-toggle="modal"
                        data-bs-target="#addInventory">Add Inventory</button>
                @endcan       
             </li>
            </ol>
           
        </nav>
    </div><!-- End Page Title -->

    @can('is_hoc')
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
            @php
            $i = 1;
            @endphp
            @foreach ($inventory_lists as $inventory_list)
            <tr>
                <th scope="row">{{ $i }}</th>
                <td>{{ $inventory_list->name }}</td>
                <td>{{ $inventory_list->number }}</td>
                <td>{{ $inventory_list->course_name }}</td>
                <td>{{ $inventory_list->condition }}</td>
                @can('is_hoc')
                <td> <button type="button" class="btn btn-outline-primary btn-sm editBtn" data-bs-toggle="modal"
                        data-bs-target="#EditModal" value="{{ $inventory_list->id }}">Update</button>
                    <button type="button" value="{{ $inventory_list->id }}"
                        class="btn btn-outline-danger btn-sm delBtn">Delete</button>
                </td>
                @endcan


            </tr>
            @php
            $i++;
            @endphp
            @endforeach

        </tbody>
    </table>
    @endcan

    @can('is_dist_cordinator')
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Number</th>
                <th scope="col">Course</th>
                <th scope="col">Center</th>
                <th scope="col">Condition</th>
               
            </tr>
        </thead>
        <tbody>
            @php
            $i = 1;
            @endphp
            @foreach ($dist_inventory as $dist_inventory)
            <tr>
                <th scope="row">{{ $i }}</th>
                <td>{{ $dist_inventory->name }}</td>
                <td>{{ $dist_inventory->number }}</td>
                <td>{{ $dist_inventory->course_name }}</td>
                <td>{{ $dist_inventory->cName }}</td>
                <td>{{ $dist_inventory->condition }}</td>
            </tr>
               
            @php
            $i++;
            @endphp
            @endforeach

        </tbody>
    </table>
    @endcan

    @can('is_reg_cordinator')
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Number</th>
                <th scope="col">Course</th>
                <th scope="col">Center</th>
                <th scope="col">District</th>
                <th scope="col">Condition</th>
               
            </tr>
        </thead>
        <tbody>
            @php
            $i = 1;
            @endphp
            @foreach ($reg_inventory as $reg_inventory)
            <tr>
                <th scope="row">{{ $i }}</th>
                <td>{{ $reg_inventory->name }}</td>
                <td>{{ $reg_inventory->number }}</td>
                <td>{{ $reg_inventory->course_name }}</td>
                <td>{{ $reg_inventory->cName }}</td>
                <td>{{ $reg_inventory->distName }}</td>
                <td>{{ $reg_inventory->condition }}</td>
            </tr>
               
            @php
            $i++;
            @endphp
            @endforeach

        </tbody>
    </table>
    @endcan

    <div class="modal fade" id="addInventory" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Center Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- General Form Elements -->
                <form method="POST" action="{{ route('create_inventory') }}">
                    @csrf
                    <div class="modal-body">

                    <div class="" id="add_region">
                        <div class="card-body">
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
                                        <select class="form-control selectpicker" data-mdb-container="#exampleModal"
                                            data-mdb-filter="true" name="course">
                                            @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                                            @endforeach

                                        </select>
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
                         </div>
                       </div>
                    </div>

                </form><!-- End General Form Elements -->

            </div>
        </div>
    </div><!-- End of model add new  course-->

  
</div>

<div class="modal fade" id="EditModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Center Course</h5>
            </div>
            <form method="POST" action="{{ route('update_inventory') }}">
                @csrf

                <div class="modal-body">
                    <div class="" id="add_region">
                        <div class="card-body">
                            <!-- General Form Elements -->
                            <form method="POST" action="{{ route('update_inventory') }}">
                                @csrf

                                <input type="hidden" name="inv_id" id="inv_id">
                                <div class=" row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input name="name" id="name" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class=" row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Number</label>
                                    <div class="col-sm-10">
                                        <input name="number" type="number" id="number" class="form-control">
                                    </div>
                                </div>
                                <div class=" row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Course</label>
                                    <div class="col-sm-10">
                                        <select class="form-control selectpicker" id="course"
                                            data-mdb-container="#exampleModal" data-mdb-filter="true" name="course">
                                            @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class=" row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Condition</label>
                                    <div class="col-sm-10">
                                        <input name="condition" type="text" id="condition" class="form-control">
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update </button>

                </div>

            </form><!-- End General Form Elements -->

        </div>
    </div>
</div><!-- End of model add new  course-->
<script>
function showDiv() {
    var div = document.getElementById("add_inventory_list");
    div.style.display = "block";
}
</script>
@endsection


@section('scripts')
<script>
$(document).on('click', '.editBtn', function() {
    var id = $(this).val();
    console.log(id);
    $.ajax({
        type: "GET",
        url: "/edit_inventory/" + id,
        success: function(response) {
            console.log(response);
            $('#course').val(response.inventory.course_id);
            $('#course').selectpicker('refresh');
            $('#inv_id').val(id);
            $('#condition').val(response.inventory.condition);
            $('#name').val(response.inventory.name);
            $('#number').val(response.inventory.number);
        },
        error: function(xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
        }

    });
});

$('.delBtn').on('click', function() {
    var confirmation = confirm('Are you sure you want to delete this course?');
    if (confirmation) {
        // delete it
        var inventory = $(this).val();
        console.log(inventory);

        $.ajax({
            type: 'POST',
            url: '/delete_inventory',
            data: {
                id: inventory
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