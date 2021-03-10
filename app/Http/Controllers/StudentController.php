<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Program;
use App\Models\ProgramSubject;
use App\Models\SessionPayment;
use App\Models\User;
use App\Traits\StudentFilterTrait;
use App\Traits\WalletTrait;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    use StudentFilterTrait;
    use WalletTrait;

    public function studentsList(Request $request){
        $listType = 'studentsList';
        if($request->ajax())
        {
            $students = User::where('role_id',3)->with('profile');
            if( $request->input('filterDataArray') != '' && $request->has('filterDataArray')) {
                $students = $this->studentFilter($request)->where('role_id',3)->select('users.*', 'profile.is_deserving as isdeserving')
                    ->leftJoin('profiles as profile', 'users.id','=','profile.user_id');
            }
            else{
//                $students = User::where('role_id',3)->with('profile');
                $students = User::where('role_id',3)->select('users.*', 'profile.is_deserving as isdeserving')
                    ->leftJoin('profiles as profile', 'users.id','=','profile.user_id');
            }
            return datatables()->eloquent($students)
                ->addColumn('firstName', function($student){
                    return $student->firstName ? $student->firstName : 'N-A';
                })
                ->addColumn('lastName', function($student){
                    return $student->lastName ? $student->lastName : 'N-A';
                })
                ->addColumn('created_at', function($student){
                    return dateTimeConverter($student->created_at);
                })
                ->addColumn('is_active', function($student){
                    $is_checked = $student->is_active == 1 ? 'checked' : '';
                    $is_active = '<input type="checkbox" data-student-id="'.$student->id.'" class="js-switch-is_active" data-color="#99d683"'. $is_checked .'>';
                    return $is_active;
                })
                ->addColumn('is_deserving', function($student){
                    $is_checked = $student->profile->is_deserving ? 'checked' : '';
                    $is_active = '<input type="checkbox" data-student-id="'.$student->id.'" class="js-switch" data-color="#99d683"'. $is_checked .'>';
                    return $is_active;
                })
                ->addColumn('delete', function($student){
                    $delete_btn = '<div style="text-align: center"><a type="button" class="fcbtn btn btn-warning btn-outline btn-1d" style="padding-left: 25px; padding-right: 25px;" href="' . route('studentProfile',
                            $student->id) . '" alt="default">View</a><br><a type="button" class="fcbtn btn btn-danger btn-outline btn-1d delete" data-id="'.$student->id.'">Delete</a>';
                    return $delete_btn;
                })
                ->rawColumns(['firstName','lastName','created_at','is_active','is_deserving','delete'])
                ->orderColumn('created_at', 'created_at $1')
                ->orderColumn('firstName', 'firstName $1')
                ->orderColumn('lastName', 'lastName $1')
                ->orderColumn('is_active', 'is_active $1')
                ->orderColumn('is_deserving', 'isdeserving $1')
                ->make(true);
        }
        $countries = User::select('country')->whereNotNull('country')->groupBy('country')->get();
        $programs = Program::with('subjects')->where('status', '!=', '2')->orderBy("id", 'Desc')->get();
        return view('admin.student.studentsList',compact('countries', 'programs','listType'));
    }

    public function deservingStudentsList(Request $request){
        $listType = 'deservingStudentsList';
        if($request->ajax())
        {
            if( $request->input('filterDataArray') != '' && $request->has('filterDataArray')) {
                $students = $this->studentFilter($request)->where('role_id',3)->whereHas('profile', function ($query) {
                    $query->where('is_deserving', 1);
                })->where('role_id',3)->select('users.*', 'profile.is_deserving as isdeserving')
                    ->leftJoin('profiles as profile', 'users.id','=','profile.user_id');
            }
            else{
                $students = User::whereHas('profile', function ($query) {
                    $query->where('is_deserving', 1);
                })->where('role_id',3)->select('users.*', 'profile.is_deserving as isdeserving')
                    ->leftJoin('profiles as profile', 'users.id','=','profile.user_id');
            }
            return datatables()->eloquent($students)
                ->addColumn('firstName', function($student){
                    return $student->firstName ? $student->firstName : 'N-A';
                })
                ->addColumn('lastName', function($student){
                    return $student->lastName ? $student->lastName : 'N-A';
                })
                ->addColumn('created_at', function($student){
                    return dateTimeConverter($student->created_at);
                })
                ->addColumn('is_active', function($student){
                    $is_checked = $student->is_active == 1 ? 'checked' : '';
                    $is_active = '<input type="checkbox" data-student-id="'.$student->id.'" class="js-switch-is_active" data-color="#99d683"'. $is_checked .'>';
                    return $is_active;
                })
                ->addColumn('is_deserving', function($student){
                    $is_checked = $student->profile->is_deserving ? 'checked' : '';
                    $is_active = '<input type="checkbox" data-student-id="'.$student->id.'" class="js-switch" data-color="#99d683"'. $is_checked .'>';
                    return $is_active;
                })
                ->addColumn('delete', function($student){
                    $delete_btn = '<div style="text-align: center"><a type="button" class="fcbtn btn btn-warning btn-outline btn-1d" style="padding-left: 25px; padding-right: 25px;" href="' . route('studentProfile',
                            $student->id) . '" alt="default">View</a><br><a type="button" class="fcbtn btn btn-danger btn-outline btn-1d delete" data-id="'.$student->id.'">Delete</a>';
                    return $delete_btn;
                })
                ->rawColumns(['firstName','lastName','created_at','is_active','is_deserving','delete'])
                ->orderColumn('created_at', 'created_at $1')
                ->orderColumn('firstName', 'firstName $1')
                ->orderColumn('lastName', 'lastName $1')
                ->orderColumn('is_active', 'is_active $1')
                ->orderColumn('is_deserving', 'isdeserving $1')
                ->make(true);
        }
        $countries = User::select('country')->whereNotNull('country')->groupBy('country')->get();
        $programs = Program::with('subjects')->where('status', '!=', '2')->orderBy("id", 'Desc')->get();
        return view('admin.student.studentsList',compact('countries','programs','listType'));
    }

    public function changeStudentDeserving(Request $request){
        $student_id = $request->student_id;
        $is_deserving = $request->is_deserving;
        $profile = Profile::where('user_id', $student_id)->first();
        if ($is_deserving == 'true'){
            $profile->is_deserving = 1;
            $profile->save();
        }else{
            $profile->is_deserving = 0;
            $profile->save();
        }
    }

    public function changeStudentStatus(Request $request){
        $student_id = $request->student_id;
        $is_active = $request->is_active;
        $user = User::where('id', $student_id)->first();
        if ($is_active == 'true'){
            $user->is_active = 1;
            $user->save();
        }else{
            $user->is_active = 0;
            $user->save();
        }
    }

    public function studentDelete($student){
        $student = User::find($student);

        $deleted = false;

        if($student)
            $deleted = $student->forceDelete();

        if(!$deleted)
            return redirect()->route('studentsList')->with('error','Oops! Something went wrong.');

        return redirect()->route('studentsList')->with('success','Student Deleted successfully');

    }

    public function studentProfile(User $user) {
        $studentWallets = User::find($user->id)->studentWalletTransactions;
        $walletAmount = $this->wallet($user->id, 'student');
        return view('admin.student.studentProfile',compact('user', 'studentWallets', 'walletAmount'));
    }
}
