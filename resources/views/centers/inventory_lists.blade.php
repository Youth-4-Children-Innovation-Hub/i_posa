@extends('home')
@section('contente')
<div class="container">

    <div class="pagetitle">
        <h1>Inventory</h1>
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
    @cannot('is_admin')
    <div class="">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Inventory</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Code</th>
                        <th scope="col">Course</th>
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
                        <td>{{ $inventory_list->code }}</td>
                        <td>{{ $inventory_list->course_name }}</td>
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

                </div>

              </div>
            </div>
            @endcannot
    @endcan
    @can('is_admin')
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
                        <th scope="col">Location</th>
                    </tr>
                    </thead>
                    <tbody>
                 
                    @php
                    $i = 1;
                    @endphp
                    @foreach ($admin_inventory as $admin_inventory)
                    <tr>
                        <th scope="row">{{ $i }}</th>
                        <td>{{ $admin_inventory->name }}</td>
                        <td>{{ $admin_inventory->course_name }}</td>
                        <td>{{ $admin_inventory->cName }}, {{ $admin_inventory->distName }}, {{ $admin_inventory->rName }}</td>
                      
                    </tr>
                    
                    @php
                    $i++;
                    @endphp
                    @endforeach
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
    @endcan

    @can('is_dist_cordinator')
    @cannot('is_admin')
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
                        <th scope="col">Center</th>
                    
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
                        <td>{{ $dist_inventory->course_name }}</td>
                        <td>{{ $dist_inventory->cName }}</td>
                    </tr>
                    
                    @php
                    $i++;
                    @endphp
                    @endforeach
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
            @endcannot
    @endcan

    @can('is_reg_cordinator')
    @cannot('is_admin')
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
                        <th scope="col">Center</th>
                        <th scope="col">District</th>
                    
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
                        <td>{{ $reg_inventory->course_name }}</td>
                        <td>{{ $reg_inventory->cName }}</td>
                        <td>{{ $reg_inventory->distName }}</td>
                    </tr>
                    @php
                    $i++;
                    @endphp
                    @endforeach
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
            @endcannot
    @endcan

    <div class="modal fade" id="addInventory" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Inventories</h5>
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
                                    <select class="form-control selectpicker" data-mdb-container="#exampleModal"
                                            data-mdb-filter="true" name="name">
                                            @foreach ($inv_type as $inv)
                                            <option value="{{ $inv->id }}">{{ $inv->name }}</option>
                                            @endforeach

                                    </select>                                    </div>
                                </div>
                                <div class=" row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Code</label>
                                    <div class="col-sm-10">
                                        <input name="code" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class=" row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Use status</label>
                                    <div class="col-sm-10">
                                        <select class="form-control selectpicker" data-mdb-container="#exampleModal"
                                            data-mdb-filter="true" name="course">
                                            <option value="use">Use</option>
                                            <option value="store">Store</option>
                                        </select>
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
                <h5 class="modal-title">Edit Inventory</h5>
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
                                    <select class="form-control selectpicker" data-mdb-container="#exampleModal"
                                            data-mdb-filter="true" name="name">
                                            @foreach ($inv_type as $inv)
                                            <option value="{{ $inv->id }}">{{ $inv->name }}</option>
                                            @endforeach

                                    </select> 
                                    </div>
                                </div>
                                <div class=" row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Code</label>
                                    <div class="col-sm-10">
                                        <input name="code" id="name" type="text" class="form-control">
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
            $('#name').val(response.inventory.name);
            $('#number').val(response.inventory.number);
            $('#existing').val(response.inventory.number);
            $('#inuse').val(response.inventory.inuse);
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