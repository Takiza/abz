@extends('adminlte::page')

@section('title', 'New employee')

@section('content')

    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="box-title">New employee</h3>
        </div>
        <div class="card-body">
            <form method="post" action="/admin/employees/store" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="file" class="@error('photo') is-invalid @enderror" name="photo" id="photo" required>
                        @error('photo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Name" required value="{{ old('name') }}">
                        <span class="d-block text-right" id="textFeedback">255 characters left</span>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone number</label>
                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="Phone number" required value="{{ old('phone') }}">
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" required value="{{ old('email') }}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="wage">Salary</label>
                        <input type="text" class="form-control @error('wage') is-invalid @enderror" name="wage" id="wage" placeholder="Salary" required value="{{ old('wage') }}">
                        @error('wage')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="position">Position</label>
                        <select class="form-control @error('position') is-invalid @enderror" name="position" id="position" required>
                            @foreach($positions as $position)
                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                                @endforeach
                        </select>
                        @error('position')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="head">Head</label>
                        <input type="text" class="form-control @error('head') is-invalid @enderror" name="head" id="head" placeholder="Head" required value="{{ old('head') }}">
                        @error('head')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="emp_date">Date of employment</label>
                        <input type="text" class="form-control pull-right" name="emp_date" id="datepicker" required value="{{ old('emp_date') }}">
                    </div>

                </div>
                <a href="{{ URL::previous() }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-success">Add</button>
            </form>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
@stop

@section('js')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js"></script>
    <script>
        $(function () {
            $('#datepicker').datepicker({
                format: 'yyyy-mm-dd'
            });
        });

        $("#phone").inputmask({ mask: "+380 (99) 999 99 99", greedy: true});

        var $area = $("#name"), $feed = $("#textFeedback"),
            maxLength = 255;

        $('#name').on("input", function(){
            var val = this.value, selStart = this.selectionStart;

            val.length > maxLength && $area
                .val( val.substr(0, maxLength) )
                .prop({
                    selectionStart : selStart,
                    selectionEnd : selStart
                })
            ;

            var remaning = Math.max(maxLength - val.length, 0);
            $feed.html(remaning + ' characters left')
        });
    </script>
@stop
