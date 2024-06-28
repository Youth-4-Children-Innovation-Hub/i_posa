@extends('home')
@section('contente')
<div class="container">

    <div class="pagetitle">
        <h1>Inventory Type</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Inventory Type</li>
                <li>
                @can('is_hoc')
                    <button type="submit" class="btn btn-outline-primary mx-3 py-0 my-1" data-bs-toggle="modal"
                        data-bs-target="#addInventory">Add Inventory type</button>
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
                  <h5 class="card-title">Inventory Type</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @foreach ($inventory_types as $inventory)
                    <tr>
                        <th scope="row">{{ $i }}</th>
                        <td>{{ $inventory->name }}</td>
                        @can('is_hoc')
                        <td> <button type="button" class="btn btn-outline-primary btn-sm editBtn" data-bs-toggle="modal"
                                data-bs-target="#EditModal" onclick="populateEditModal('{{ $inventory->id }}', '{{ $inventory->name }}')">Edit</button>
                            <!-- <button type="button" value="{{ $inventory->id }}"
                                class="btn btn-outline-danger btn-sm delBtn">Delete</button> -->
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
    

   
    <div class="modal fade" id="addInventory" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Inventory type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- General Form Elements -->
                <form method="POST" action="{{ route('add_inv_type') }}">
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
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Add</button>
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
                <h5 class="modal-title">Edit Inventory type</h5>
            </div>
            <form method="POST" action="{{ route('update_inv_type') }}">
                @csrf
                <div class="modal-body">

                <div class="" id="add_region">
                    <div class="card-body">
                    <input type="hidden" name="id" id="editId">
                            <div class=" row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input name="name" type="text" class="form-control" id="editName">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                    </div>
                </div>
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
    function populateEditModal(id, name) {
        document.getElementById('editId').value = id;
        document.getElementById('editName').value = name;
        $('#editModal').modal('show');
    }
</script>
<script>
// $(document).on('click', '.editBtn', function() {
//     var id = $(this).val();
//     console.log(id);
//     $.ajax({
//         type: "GET",
//         url: "/edit_inventory/" + id,
//         success: function(response) {
//             console.log(response);
//             $('#course').val(response.inventory.course_id);
//             $('#course').selectpicker('refresh');
//             $('#inv_id').val(id);
//             $('#name').val(response.inventory.name);
//             $('#number').val(response.inventory.number);
//             $('#existing').val(response.inventory.number);
//             $('#inuse').val(response.inventory.inuse);
//         },
//         error: function(xhr, status, error) {
//             console.log(xhr);
//             console.log(status);
//             console.log(error);
//         }

//     });
// });

$('.delBtn').on('click', function() {
    var confirmation = confirm('Are you sure you want to delete this course?');
    if (confirmation) {
        // delete it
        var inventory = $(this).val();
        console.log(inventory);

        $.ajax({
            type: 'POST',
            url: '/delete_inventory_type',
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