@if ($errors->any())
    <div class="alert alert-danger col-md-12">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger col-md-12">
        <p> {{session('error')}} </p>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success col-md-12">
        <p> {{session('success')}}</p>
    </div>
@endif
