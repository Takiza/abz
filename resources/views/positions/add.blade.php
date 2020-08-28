@extends('adminlte::page')

@section('title', 'New position')

@section('content')

    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="box-title">New position</h3>
        </div>
        <div class="card-body">
            <form method="post" action="/admin/positions/store" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Press name..." value="">
                    </div>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <a href="{{ URL::previous() }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-success">Add</button>
            </form>
        </div>
    </div>

@stop
