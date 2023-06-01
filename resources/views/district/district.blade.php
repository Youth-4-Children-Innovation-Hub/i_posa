@extends('home')
@section('contente')


<div class="container">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Districts</li>
                <li class="mx-3 py-0">
                    <div class="search mx-auto">
                        <form action="{{url('/search_district')}}" method="GET">
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
                        <form method="GET" action="{{url('/districts')}}">
                            <select class="" name="number" id="exampleFormControlSelect1">
                                @if (isset($paginate))
                                <option value="{{$paginate}}">{{$paginate}}</option>

                                @endif
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
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
                <li>
                    <button type="submit" class="btn btn-outline-primary mx-3 py-0 my-1" data-bs-toggle="modal"
                        data-bs-target="#CreateModal">Add District</button>

                </li>

            </ol>
        </nav>
    </div><!-- End Page Title -->


    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">District</th>
                <th scope="col">Cordinator</th>
                <th scope="col">Region</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($districts as $key=>$district)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$district->name}}</td>
                <td>{{ $district->cordinator}}</td>
                <td>{{ $district->region}}</td>
                <td> <button type="button" class="btn btn-outline-primary btn-sm">Update</button>
                </td>

            </tr>

            @endforeach



        </tbody>
    </table>



    <!-- model add district -->

    <div class="modal fade" id="CreateModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add District</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{route('create_district')}}">
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
                                    <label class="col-sm-2 col-form-label">Region</label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker" aria-label="Default select example"
                                            name="region_id" required data-width=100% data-live-search="true">
                                            <option selected="selected" hidden="hidden" value="">Open this select menu
                                            </option>
                                            @foreach($regions as $region)
                                            <option value="{{$region->id}}">{{ $region->name }}</option>
                                            @endforeach


                                        </select>
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Cordinator</label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker" aria-label="Default select example"
                                            name="cordinator_id" required data-width=100% data-live-search="true">
                                            <option selected="selected" hidden="hidden" value="">Open this select menu
                                            </option>
                                            @foreach($cordinators as $cordinator)
                                            <option value="{{$cordinator->id}}">{{ $cordinator->name }}</option>
                                            @endforeach


                                        </select>
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
    </div><!-- End of model add district-->



</div>

@endsection