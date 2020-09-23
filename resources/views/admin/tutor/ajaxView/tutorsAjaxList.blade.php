<table id="myTable" class="table table-striped">
    <thead>
    <tr>
        <th hidden>Id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Rating</th>
        <th>Created</th>
        <th>Last Login</th>
        <th>Active</th>
{{--        <th>Approved</th>--}}
        <th>Detail</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tutors as $tutor)
        <tr>
            <td hidden>{{$tutor->id}}</td>
            <td>{{$tutor->firstName ? $tutor->firstName : 'N-A'}}</td>
            <td>{{$tutor->lastName ? $tutor->lastName : 'N-A'}}</td>
            <td>{{$tutor->email}}</td>
            <td>{{$tutor->phone}}</td>
            <td>{{round($tutor->rating->avg('rating'),1)}}</td>
            <td>{{dateTimeConverter($tutor->created_at)}}</td>
            <td>{{$tutor->last_login == null ? 'N-A' : dateTimeConverter($tutor->last_login)}}</td>
            {{--<td>@if($tutor->is_active == 1) Yes @else No @endif</td>--}}
            <td><input type="checkbox" data-tutor-id="{{ $tutor->id }}" data-url="{{url('/')}}" class="js-switch" data-color="#99d683" @if($tutor->is_active == 1) checked @endif></td>
{{--            <td><input type="checkbox" data-tutor-id="{{ $tutor->id }}" data-url="{{url('/')}}" class="is_approved_by_admin" data-color="#99d683" @if($tutor->is_approved == 1) checked @endif></td>--}}
            <td><a type="button" class="fcbtn btn btn-warning btn-outline btn-1d" href="{{route('tutorProfile',$tutor->id)}}" alt="default">View</a></td>
            <td><a type="button" class="fcbtn btn btn-danger btn-outline btn-1d"  data-toggle="modal" data-target="#deleteModaltutor{{$tutor->id}}">Delete</a></td>
        </tr>

        <!-- delete modal content -->
        <div id="deleteModaltutor{{$tutor->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Do you really want to delete this tutor?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                        <a type="button" class="fcbtn btn btn-danger btn-1d" href="{{route('tutorDelete',$tutor->id)}}" style="color: white">Delete</a>
                    </div>
                </div>
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    @endforeach
    </tbody>
</table>
