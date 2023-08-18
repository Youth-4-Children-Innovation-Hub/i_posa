@extends('home')

@section('contente')
<div class="pagetitle">
        <h1>Reports</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">Notifications</li>
            </ol>
        </nav>
    </div>
    @foreach(auth()->user()->notifications as $notifications)
    @if(!$notifications->read_at)
    <div class="alert alert-info  alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">Info Heading</h4>
                <p>Et suscipit deserunt earum itaque dignissimos recusandae dolorem qui. Molestiae rerum perferendis laborum. Occaecati illo at laboriosam rem molestiae sint.</p>
                <hr>
                <p class="mb-0">Temporibus quis et qui aspernatur laboriosam sit eveniet qui sunt.</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @endforeach
@endsection