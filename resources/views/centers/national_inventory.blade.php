@extends('home')
@section('contente')
<div class="container">
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <div class="pagetitle">
        <h1>Inventory</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Inventory List</li>
                
            </ol>
           
        </nav>
    </div><!-- End Page Title -->

   
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