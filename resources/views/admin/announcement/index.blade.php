@extends('layouts.app')
@section('content')

<div class="row col-md-3 mx-auto">
  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary"
  data-bs-toggle="modal" data-bs-target="#addAnnouncementModal">
    Add Announcement
  </button>
</div>

<div class="row mt-5">
  <div class="col-md-6 mx-auto">
    @foreach($announcements as $announcement)
    <div class="card mb-3">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">{{ $announcement->title }}</h5>
        <div>
          <a href="{{ route('announcement.edit', $announcement->id) }}"
          class="btn btn-sm btn-outline-primary"><i class="fas fa-pencil-alt"></i></a>
          <form action="{{ route('announcement.destroy', $announcement->id) }}"
          method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-danger">
              <i class="fas fa-trash-alt"></i>
            </button>
          </form>
        </div>
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

<!-- The Modal -->
<div class="modal" id="addAnnouncementModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Announcement</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <!-- Modal Body -->
      <div class="modal-body">
        <form action="{{ route('announcement.store') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
          </div>
          <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>