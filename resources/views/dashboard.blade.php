@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Welcome, {{ Auth::user()->name }}!</h5>
      <p class="card-text">You are logged in as a {{ Auth::user()->role }}.</p>
    </div>
  </div>
</div>
<div class="row mt-5">
  <div class="col-md-6 mx-auto">
    @foreach($announcements as $announcement)
    <div class="card mb-3">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">{{ $announcement->title }}</h5>
      </div>
      <div class="card-body">
        <p class="text-muted">Posted by: {{ $announcement->author }}</p>
        <p class="card-text">{{ $announcement->content }}</p>
        <p class="text-muted">Date: {{ $announcement->created_at }}</p>
      </div>
    </div>
    @endforeach
  </div>
</div>

@endsection