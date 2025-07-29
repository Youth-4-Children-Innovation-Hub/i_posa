@extends('home')
@section('contente')
<div class="container">
    <div class="pagetitle">
        <h1>Student Details</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Students</li>
               
                <li class="breadcrumb-item active">{{ $student->registration_number }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card">
    <div class="card-body">
        <h5 class="card-title text-center text-primary mb-4">{{ $student->name }}</h5>
        <p class="text-center text-muted mb-4">Registration: {{ $student->registration_number }}</p>
        
        <!-- Student Photo -->
        @if($student->profile_picture)
        <div class="text-center mb-4">
            <img src="{{ asset( $student->profile_picture) }}" alt="Student Photo" 
                 class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
        </div>
        @endif
        
        <!-- Student Details Tables -->
        <div class="row">
            <!-- Personal Information -->
            <div class="col-lg-6">
                <h6 class="text-primary mb-3"><i class="bi bi-person-circle me-2"></i>Personal Information</h6>
                <table class="table table-striped table-sm">
                    <tbody>
                        <tr>
                            <td class="fw-bold text-primary" style="width: 45%;">Date of Birth</td>
                            <td>{{ $student->date_of_birth }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-primary">Gender</td>
                            <td>{{ $student->gender }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-primary">Phone</td>
                            <td>{{ $student->phone_number }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-primary">Email</td>
                            <td>{{ $student->email }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-primary">NIDA</td>
                            <td>{{ $student->nida }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-primary">Employment Status</td>
                            <td>{{ $student->employment_status }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-primary">Marital Status</td>
                            <td>{{ $student->marital_status }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-primary">Education Level</td>
                            <td>{{ $student->education_level }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-primary">Education Type</td>
                            <td>{{ $student->education_type }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-primary">Disability</td>
                            <td>{{ $student->disability ?: 'None' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Academic & Location Information -->
            <div class="col-lg-6">
                <h6 class="text-primary mb-3"><i class="bi bi-geo-alt me-2"></i>Academic & Location</h6>
                <table class="table table-striped table-sm">
                    <tbody>
                        <tr>
                            <td class="fw-bold text-primary" style="width: 45%;">Center</td>
                            <td>{{ $student->center_name }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-primary">Stage</td>
                            <td>{{ $student->stage }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-primary">Status</td>
                            <td>
                                @php
                                    $statusColors = [
                                        'continous' => 'success',
                                        'dropout' => 'danger', 
                                        'Graduate' => 'primary'
                                    ];
                                    $badgeColor = $statusColors[$student->status] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $badgeColor }}">
                                    {{ ucfirst($student->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-primary">Region</td>
                            <td>{{ $student->region }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-primary">District</td>
                            <td>{{ $student->district }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-primary">Ward</td>
                            <td>{{ $student->ward }}</td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-primary">Street</td>
                            <td>{{ $student->street }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Guardian Information -->
        @if($guardian)
        <div class="row mt-4">
            <div class="col-12">
                <h6 class="text-primary mb-3"><i class="bi bi-person-heart me-2"></i>Guardian Information</h6>
                <div class="row">
                    <div class="col-lg-6">
                        <table class="table table-striped table-sm">
                            <tbody>
                                <tr>
                                    <td class="fw-bold text-primary" style="width: 45%;">Name</td>
                                    <td>{{ $guardian->name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-primary">Phone</td>
                                    <td>{{ $guardian->phone }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-primary">Email</td>
                                    <td>{{ $guardian->email ?: 'Not provided' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-primary">Occupation</td>
                                    <td>{{ $guardian->occupation }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-primary">Disability</td>
                                    <td>{{ $guardian->disability ?: 'None' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <table class="table table-striped table-sm">
                            <tbody>
                                <tr>
                                    <td class="fw-bold text-primary" style="width: 45%;">Address</td>
                                    <td>{{ $guardian->address }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-primary">Region</td>
                                    <td>{{ $guardian->region }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-primary">District</td>
                                    <td>{{ $guardian->district }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-primary">Ward</td>
                                    <td>{{ $guardian->ward }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        <!-- Documents Section -->
        <div class="row mt-4">
            <div class="col-12">
                <h6 class="text-primary mb-3"><i class="bi bi-file-earmark-text me-2"></i>Documents</h6>
                <div class="row">
                    @if($student->birth_certificate)
                    <div class="col-md-6 mb-2">
                        <a href="{{ Storage::url(str_replace(storage_path('app/public/'), '', $student->birth_certificate)) }}" 
                           class="btn btn-outline-info btn-sm" download>
                            <i class="bi bi-download me-1"></i>Download Birth Certificate
                        </a>
                    </div>
                    @endif
                    
                    @if($student->letter)
                    <div class="col-md-6 mb-2">
                        <a href="{{ Storage::url(str_replace(storage_path('app/public/'), '', $student->letter)) }}" 
                           class="btn btn-outline-info btn-sm" download>
                            <i class="bi bi-download me-1"></i>Download Letter
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
        @if(auth()->user()->role == 'head of center')
        <div class="text-center mt-4">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#EditModal">
                <i class="bi bi-pencil me-1"></i>Edit Student
            </button>
        </div>
        @endif
    </div>
</div>    

</div>
@endsection


@section('scripts')


<script>
$(document).on('click', '.editBtn', function() {
    var id = $(this).val();
    console.log(id);
    $.ajax({
        type: "GET",
        url: "/edit_club/" + id,
        success: function(response) {
            console.log(response);
            // $('#teacher_id').val(id);
            // $('#name').val(response.teacher.name);
            // $('#phone_number').val(response.teacher.phone_number);
            // $('#email').val(response.teacher.email);

        },

    });
});


</script>
@endsection
