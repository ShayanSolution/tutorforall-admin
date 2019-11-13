@extends('admin.layout')
@section('title','classesAdd')
@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            @include('errors.common-errors')
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Edit Percentage Costs for {{$percentageCost->number_of_students}} Students</h4> </div>
            <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="#">Admin</a></li>
                    <li class="active">Edit Percentage Costs</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="white-box">
                <form method="post" class="form-material form-horizontal" action="{{route('percentage-costs.update', $percentageCost->id)}}" autocomplete="off">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Number Of Students</label>
                        <div class="col-md-12">
                            <input type="text" name="number_of_students" class="form-control" placeholder="Enter Number Of Students" value="{{old('number_of_students') ? old('number_of_students') : $percentageCost->number_of_students}}" onkeypress="return myKeyPress(event, 'int', 'Only numbers allowed')">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Percentage</label>
                        <div class="col-md-12">
                            <input type="text" name="percentage" class="form-control" placeholder="Enter percentage value for this category" value="{{old('percentage') ? old('percentage') : $percentageCost->percentage}}" onkeypress="return myKeyPress(event, 'float', 'Only numbers and decimal point allowed')">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12">Active</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="is_active" required>
                                @foreach([''=>'Select Status', '1'=>'Yes', '0'=>'No'] as $value=>$text)
                                    <option value="{{$value}}" {{$percentageCost->is_active == $value ? 'selected' : ''}}>{{$text}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">Submit</button>
                    <a href="{{route('programsList')}}" class="btn btn-inverse waves-effect waves-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('javascripts')
    @parent

    <script>

        function myKeyPress(e, type, errorMessage){
            let key_num;

            if(window.event)  // IE
                key_num = e.keyCode;
            else if(e.which) // Netscape/Firefox/Opera
                key_num = e.which;

            var regex = /^[0-9]*$/;

            if(type === 'float')
                regex = /^[0-9.]*$/;

            if(!regex.test(String.fromCharCode(key_num)))
            {
                alert(errorMessage);
                return false;
            }
        }
    </script>
@stop