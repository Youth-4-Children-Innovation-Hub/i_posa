@extends('home')
@section('contente')
    <div style="display:flex; justify-content:center; align-items:center;">
    <iframe src="/assets/{{$data->name}}" height="900" width="800" frameborder="0"></iframe>
    </div>
    
@endsection