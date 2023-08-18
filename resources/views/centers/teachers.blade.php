@extends('home')
@section('contente')
<div class="container">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Teachers</li>

                <li class="mx-3 py-0">
                    <div class="search mx-auto">
                        <form action="{{ url('/search_district') }}" method="GET">
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
                    <div class="my-1 d-flex" id="paginate">
                        <form method="GET" action="{{ url('/teachers') }}">
                            <select class="" name="number" id="exampleFormControlSelect1">
                                @if (isset($paginate))
                                <option value="{{ $paginate }}">{{ $paginate }}</option>
                                @endif
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="8">8</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                            </select>
                            <button type="submit">Show</button>

                        </form>
                    </div>
                </li>

                @can('is_reg_cordinator')
                <li>
                    <button type="submit" class="btn btn-outline-primary mx-3 py-0 my-1" data-bs-toggle="modal"
                        data-bs-target="#CreateModal">Add Teacher</button>
                </li>
                @endcan

            </ol>
        </nav>
    </div><!-- End Page Title -->

    @can('is_admin')
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone number</th>
                @can('is_hoc')

                <th scope="col">Action</th>
                @endcan
            </tr>
        <tbody>
            @foreach ($teachers as $key => $teacher)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $teacher->name }}</td>
                <td>{{ $teacher->email }}</td>
                <td>{{ $teacher->phone_number }}</td>
                @can('is_hoc')

                <td> <button type="button" data-bs-toggle="modal" data-bs-target="#EditModal" value="{{ $teacher->id }}"
                        class="btn btn-outline-primary btn-sm editBtn">Update</button>
                    <button type="button" value="{{ $teacher->id }}"
                        class="btn btn-outline-danger btn-sm delBtn">Delete</button>
                </td>

                @endcan
            </tr>
            @endforeach

        </tbody>
        </thead>

    </table>
    @endcan
   
    @can('is_hoc')
    @cannot('is_admin')
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Course</th>
                <th scope="col">Email</th
                <th scope="col">Phone number</th>
                @can('is_hoc')

                <th scope="col">Action</th>
                @endcan
            </tr>
        <tbody>
            @foreach ($teachers1 as $key => $teachers1)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $teachers1->name1 }}</td>
                <td>{{ $teachers1->course1 }}</td>
                <td>{{ $teachers1->email1 }}</td>
                <td>{{ $teachers1->phone_number1 }}</td>
                @can('is_hoc')

                <td> <button type="button" data-bs-toggle="modal" data-bs-target="#EditModal" value="{{ $teachers1->id }}"
                        class="btn btn-outline-primary btn-sm editBtn">Update</button>
                    <button type="button" value="{{ $teachers1->id }}"
                        class="btn btn-outline-danger btn-sm delBtn">Delete</button>
                </td>

                @endcan
            </tr>
            @endforeach

        </tbody>
        </thead>

    </table>
    @endcannot
    @endcan


    <!-- add new teacher -->
    <div class="modal fade" id="CreateModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Teacher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('create_teacher') }}">
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
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Phone number</label>
                                    <div class="col-sm-10">
                                        <input type="tel" class="form-control" name="phone_number" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">update </button>
                    </div>
                </form><!-- End General Form Elements -->
            </div>
        </div>
    </div><!-- End of model add new  course-->

    <!-- Add new teacher model -->

    <!-- add new teacher -->
    <div class="modal fade" id="EditModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Teacher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('update_teacher') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="" id="add_region">
                            <input type="hidden" name="teacher_id" id="teacher_id">
                            <div class="card-body">
                                <!-- General Form Elements -->
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" id="name" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email" id="email" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Phone number</label>
                                    <div class="col-sm-10">
                                        <input type="tel" class="form-control" name="phone_number" id="phone_number"
                                            required>
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
    </div><!-- End of model add new  course-->

    <!-- Add new teacher model -->


</div>
@endsection


@section('scripts')
<script>
$(document).on('click', '.editBtn', function() {
    var id = $(this).val();
    console.log(id);
    $.ajax({
        type: "GET",
        url: "/edit_teacher/" + id,
        success: function(response) {
            console.log(response);
            $('#teacher_id').val(id);
            $('#name').val(response.teacher.name);
            $('#phone_number').val(response.teacher.phone_number);
            $('#email').val(response.teacher.email);

        },

    });
});

$('.delBtn').on('click', function() {
    var confirmation = confirm('Are you sure you want to delete this Teacher?');
    if (confirmation) {
        // delete it
        var teacher = $(this).val();
        console.log(teacher);

        $.ajax({
            type: 'POST',
            url: '/delete_teacher',
            data: {
                id: teacher
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