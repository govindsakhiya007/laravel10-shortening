@extends('layouts.dashboard')

@section('title') Shortened URLs | Edit @endsection

@section('content')
    <div class="row mt-3">
        <div class="col-lg-12 col-md-12">
            <!-- Breadcrumb Items -->
            <div class="card custom-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="text-wrap">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-style mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('urls.index') }}">Shortened URLs / Edit</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Geckos List Layouts-->
            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{ route('urls.update', $url->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="original_url">Original URL</label>
                            <input type="text" name="original_url" class="form-control" id="original_url" value="{{ old('original_url', $url->original_url) }}" />
                            <div id="original_url_error" class="text-danger">@error('original_url'){{ $message }}@enderror</div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection
