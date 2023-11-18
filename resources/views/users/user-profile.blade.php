@extends('home')
@section('contente')
     
    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
 <!-- jau ni path ndani ya src i think. kwa le tuishie hapa. -->
              <img src="{{ asset($userData->profile_photo)}}" alt="Profile" class="rounded-circle" style="width: 100px; height: 100px;">
              <h2>{{$userData['name']}}</h2>
              <h3>{{$userRole->role}}</h3>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item"> 
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

                <li class="nav-item"> 
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#change-profile-picture">Change profile picture</button>
                </li>

              </ul>
              @if (session('message'))
                               <h5 class="alert alert-success mb-2">{{ session('message')}}</h5>
                  @endif
              @if (session('error'))
                               <h5 class="alert alert-danger mb-2">{{ session('error')}}</h5>
                  @endif    
                  @if (session('error2'))
                               <h5 class="alert alert-danger mb-2">{{ session('error2')}}</h5>
                  @endif    
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  
                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8">{{$userData['name']}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8">A108 Adam Street, New York, NY 535022</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8">(436) 486-3538 x29071</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{$userData['email']}}</div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POST" action="{{url('/edit_profile')}}">
                  @csrf
                    
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="fullName" value="{{$userData['name']}}">
                      </div>
                    </div>

          
                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="Address" value="A108 Adam Street, New York, NY 535022">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="Phone" value="(436) 486-3538 x29071">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="{{$userData['email']}}">
                      </div>
                    </div>

                 

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

               
                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form method="POST" action="{{url('/change_password')}}">
                  @csrf
                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword" required="">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword" required="">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Confirm Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword" required="">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>
                
                <div class="tab-pane fade pt-3" id="change-profile-picture">
                  <!-- Change Password Form -->
                  
                  <form method="POST" action="{{url('/change_profile_picture')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"></label>
                      <div class="col-md-8 col-lg-9">
                        
                        <img src="{{ asset($userData->profile_photo)}}" alt="Profile" style="width: 120px; height: 120px;">
                        <div class="pt-2">
                     
                          <label for="inputNumber" class="col-sm-6 col-form-label">Picture Upload</label>
                          <div class="row mb-3">
                 
                          <div class="col-sm-7">
                            <input class="form-control" type="file" name="picture" id="formFile">
                          </div>
                          </div>
                          <div class="row mb-3">
                  
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Change Picture</button>
                         </div>
                          </div>
                        
                        </div>
                      </div>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>


@endsection