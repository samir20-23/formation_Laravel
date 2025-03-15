@extends('layout.app')
@section('content')
<div class="mt-5">
<input type="text" id="search" placeholder="🔥🚩 Search" class="form-control mb-3">
<button id="load" class="btn btn-primary mb-3">💻❤ Load Posts</button>
<div id="posts"></div>
<form id="postForm">
<input type="hidden" name="id" id="post_id">
<input type="text" name="title" id="title" placeholder="🎉 Title" class="form-control mb-2">
<textarea name="content" id="content" placeholder="⚠ Content" class="form-control mb-2"></textarea>
<button type="submit" id="save" class="btn btn-success">⚡ Save</button>
<button type="button" id="update" class="btn btn-warning" style="display:none;">🚩 Update</button>
<button type="button" id="cancel" class="btn btn-secondary" style="display:none;">💻 Cancel</button>
</form>
<form id="importForm" enctype="multipart/form-data" class="mt-3">
<input type="file" name="file" class="form-control mb-2">
<button type="submit" class="btn btn-info">🚩 Import</button>
</form>
<a href="{{ route('posts.export') }}" class="btn btn-warning mt-2">💻 Export</a>
</div>
@endsection