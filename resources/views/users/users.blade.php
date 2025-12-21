@extends('home')
@section('contente')


<div class="container mx-auto p-0">

    <div class="pagetitle">
        <h1>Users</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Users</li>
                  <li>

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
 <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Recent Reports</h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">S/N</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key=>$user)
                        <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td> {{$user->name}}</td>
                        <td>{{$user->phone_number}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role}}</td>
                        

                        <!-- updateform/{{$user->id}} -->
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <!-- Edit Icon Button -->
                                <button type="button" class="btn btn-outline-primary btn-sm py-0 editBtn" value="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#UpdateModal" title="Edit User">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <!-- Activate/Deactivate Icon Button -->
                                <form action="{{route('userStatus',['id' => $user->id ])}}" method="post" class="m-0 p-0 status-form" data-user-name="{{ $user->name }}" data-action="{{ (int)$user->status === 1 ? 'deactivate' : 'activate' }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline btn-sm py-0 {{ $user->status == 1 ? 'btn-danger' : 'btn-success' }}" title="{{ (int)$user->status === 1 ? 'Deactivate' : 'Activate' }} User">
                                        <i class="bi {{ (int)$user->status === 1 ? 'bi-lock' : 'bi-unlock' }}"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                      </tr>  
                    @endforeach  
                    </tbody>
                  </table>

                </div>

              </div>
            </div>



<!-- model add user -->

<div class="modal fade" id="CreateModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('create_user') }}" id="createUserForm">
                @csrf
                <div class="modal-body" id="createUserModalBody">
                    <div class="" id="add_region">
                        <div class="card-body">

                            <!-- General Form Elements -->
                            <div class="row mb-3">
                                <label for="create_name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="create_name" name="name" required>
                                    <div class="invalid-feedback" id="error-name"></div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="create_phone" class="col-sm-2 col-form-label">Phone number</label>
                                <div class="col-sm-10">
                                    <input type="text" placeholder="Start with 07 or 06" class="form-control" id="create_phone" name="phone" required>
                                    <div class="invalid-feedback" id="error-phone"></div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="create_email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="create_email" name="email" required>
                                    <div class="invalid-feedback" id="error-email"></div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="create_role" class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <select class="selectpicker" id="create_role" aria-label="Default select example" name="role"
                                        required data-width=100% data-live-search="true">
                                        <option value="" disabled selected>Open this select menu</option>
                                        @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{ $role->role }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback" id="error-role"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveUserBtn">Save</button>
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

                    <input type="hidden" name="user_id" id="user_id">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name" required value="">
                        </div>
                    </div>

                    <div class=" row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Phone number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="phone" id="phone" required value="">
                        </div>
                    </div>

                    <div class=" row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" id="email" required value="">
                        </div>
                    </div>
                    <input type="text" class="form-control" style="display:none;" name="id" value="">

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example" name="role" id="role" required>
                                <option value="" selected="selected" hidden="hidden">

                                </option>
                                @foreach($roles as $role)
                                <option value="{{$role->id }}">{{ $role->role }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Update</label>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Update
                                </button>

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


@endsection

@section('scripts')
<script>
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'X-Requested-With': 'XMLHttpRequest'
        }
    });

    function clearFormErrors() {
        $('#createUserForm .invalid-feedback').text('').css('display', 'none');
        $('#createUserForm .form-control, #createUserForm .selectpicker').removeClass('is-invalid');
    }

    function clearFieldError(fieldName) {
        $('#error-' + fieldName).text('').css('display', 'none');
        $('#createUserForm [name="' + fieldName + '"]').removeClass('is-invalid');
    }

    function displayFormErrors(errors) {
        let firstErrorField = null;

        $.each(errors, function (field, messages) {
            const message = Array.isArray(messages) ? messages[0] : messages;
            const errorDiv = $('#error-' + field);
            const inputField = $('#createUserForm [name="' + field + '"]');

            if (firstErrorField === null && inputField.length) {
                firstErrorField = inputField;
            }

            errorDiv.text(message).css('display', 'block');
            inputField.addClass('is-invalid');

            // bootstrap-select: highlight button too
            if (inputField.hasClass('selectpicker')) {
                inputField.selectpicker('setStyle', 'is-invalid', 'add');
            }
        });

        if (firstErrorField && firstErrorField[0]) {
            firstErrorField[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }

    // Reset create modal state
    $('#CreateModal').on('show.bs.modal', function () {
        clearFormErrors();
        const formEl = $('#createUserForm')[0];
        if (formEl) formEl.reset();
        $('.selectpicker').selectpicker('refresh');
        $('#saveUserBtn').prop('disabled', false).text('Save');
    });

    // Clear individual field error on change
    $(document).on('input change', '#createUserForm input, #createUserForm select', function () {
        const fieldName = $(this).attr('name');
        if (fieldName) clearFieldError(fieldName);
    });

    // Create user (AJAX)
    $(document).on('submit', '#createUserForm', function (e) {
        e.preventDefault();

        const form = $(this);
        const url = form.attr('action');
        const formData = form.serialize();
        const submitBtn = $('#saveUserBtn');

        clearFormErrors();

        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Saving...');

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response && response.success) {
                    $('#CreateModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message || 'User created successfully!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => location.reload());
                } else {
                    submitBtn.prop('disabled', false).text('Save');
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Unexpected response.' });
                }
            },
            error: function (xhr) {
                submitBtn.prop('disabled', false).text('Save');

                if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    displayFormErrors(xhr.responseJSON.errors);
                    return;
                }

                const msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Please try again later.';
                Swal.fire({ icon: 'error', title: 'Error', text: msg });
            }
        });
    });

    // Edit user (existing)
    $(document).on('click', '.editBtn', function () {
        var id = $(this).val();
        $.ajax({
            type: 'GET',
            url: '/edit_user/' + id,
            success: function (response) {
                $('#user_id').val(id);
                $('#name').val(response.user.name);
                $('#phone').val(response.user.phone_number);
                $('#email').val(response.user.email);
                $('#role').val(response.user.role_id);
                $('#role').selectpicker('refresh');
            }
        });
    });

    // Delete user (existing)
    $(document).on('click', '.delBtn', function () {
        var confirmation = confirm('Are you sure you want to delete this user?');
        if (!confirmation) return;

        var user = $(this).val();
        $.ajax({
            type: 'POST',
            url: '/delete_user',
            data: { id: user },
            success: function () {
                location.reload();
            },
            error: function () {
                Swal.fire({ icon: 'error', title: 'Error', text: 'Failed to delete user.' });
            }
        });
    });

    // Activate/Deactivate user confirmation
    $(document).on('submit', '.status-form', function (e) {
        e.preventDefault();
        const form = this;
        const $form = $(form);
        const userName = ($form.data('user-name') || '').toString();
        const action = ($form.data('action') || '').toString().toLowerCase();
        const isDeactivate = action === 'deactivate';

        // Fallback if SweetAlert is unavailable
        if (typeof Swal === 'undefined') {
            const ok = window.confirm('Are you sure you want to ' + (isDeactivate ? 'deactivate' : 'activate') + (userName ? ' "' + userName + '"' : ' this user') + '?');
            if (ok) form.submit();
            return;
        }

        Swal.fire({
            icon: 'warning',
            title: (isDeactivate ? 'Deactivate' : 'Activate') + ' User?',
            text: 'Are you sure you want to ' + (isDeactivate ? 'deactivate' : 'activate') + (userName ? ' "' + userName + '"' : ' this user') + '?',
            showCancelButton: true,
            confirmButtonColor: isDeactivate ? '#d33' : '#198754',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, ' + (isDeactivate ? 'deactivate' : 'activate'),
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>

<style>
    .table .btn i { pointer-events: none; }
    .gap-2 > * + * { margin-left: 0.5rem !important; }
    .invalid-feedback { color: #dc3545; font-size: 0.875em; margin-top: 0.25rem; font-weight: 500; }
</style>
@endsection
