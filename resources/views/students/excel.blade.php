@extends('home')
@section('contente')
<div class="card">
            <div class="card-body">
                <center><h5 class="card-title">EXCEL</h5></center>
                <center> <ol class="breadcrumb">
                <li>
                <a href="{{ url('download-template') }}" class="btn btn-outline-success mx-3 py-0 my-1">Download template</a>                </li>
                <li>
                    <button type="submit" class="btn btn-outline-success mx-3 py-0 my-1" data-bs-toggle="modal"
                        data-bs-target="#excelModal">Import</button>
                </li>
            </ol></center>
                        

            </div>
</div>
<!-- excel modal -->
<div class="modal fade" id="excelModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('import_student') }}" enctype="multipart/form-data" id="studentForm">
                    @csrf
                    <div class="modal-body">
                    <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Import file</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="excel_file" type="file" id="excel" required>
                                    </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import </button>

                    </div>
                </form><!-- End General Form Elements -->

            </div>
        </div>
    </div>
    <!-- end excel -->
@endsection