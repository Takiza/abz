@extends('adminlte::page')

@section('title', 'Edit position')

@section('content')

    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="box-title">Edit position: {{ $position->name }}</h3>
        </div>
        <div class="card-body">
            <form method="post" action="/admin/positions/{{ $position->id }}/update" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Press name..." value="{{ $position->name }}">
                    </div>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <a href="{{ URL::previous() }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-success">Edit</button>
            </form>
        </div>
    </div>

@stop
