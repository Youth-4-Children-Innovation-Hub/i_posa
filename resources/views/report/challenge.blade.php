@extends('home')
@section('contente')
<div class="card">
            <div class="card-body">
              <h5 class="card-title">Introduction</h5>

              <!-- Floating Labels Form -->
              <form action="{{ url('post_challenges') }}" method="post" class="row g-3">
                @csrf
                   
                <div class="col-12">
                  <div class="form-floating">
                    <textarea class="form-control" name="introduction" id="floatingTextarea" style="height: 100px;" required></textarea>
                  </div>
                </div>

                <h5 class="card-title">Challenges</h5>
                <div class="col-12">
                  <div class="form-floating">
                    <textarea class="form-control" name="challenge" id="floatingTextarea" style="height: 100px;" required></textarea>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form><!-- End floating Labels Form -->

            </div>
</div>

@endsection