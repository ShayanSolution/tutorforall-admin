<?php

namespace App\Http\Controllers;

use App\Models\Disbursement;
use App\Models\Document;
use App\Models\Profile;
use App\Models\Program;
use App\Models\ProgramSubject;
use App\Models\SessionPayment;
use App\Models\Subject;
use App\Models\TutorInvoice;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

use App\Traits\TutorFilterTrait;
use App\Traits\LocationTrait;
use App\Traits\RevenueFilterTrait;
use App\Traits\DisbursementFilterTrait;
use Illuminate\Support\Facades\Input;
use function foo\func;
use Nexmo\Client\Response\ResponseInterface;
use Nexmo\Message\Shortcode\Alert;
use Yajra\DataTables\Facades\DataTables;

class TutorController extends Controller {

	use TutorFilterTrait;
	use LocationTrait;
	use RevenueFilterTrait;
	use DisbursementFilterTrait;

	private static $documentStoragePath = "/home/devtutor4allapis/public_html/storage/app/public/documents";

	public function tutorAdd() {
		$classes = Program::where('status', 1)->get();
		return view('admin.tutor.tutorAdd', compact('classes'));
	}

	public function getSubjects($class_id) {
		$subjects = Subject::where('programme_id', $class_id)->get();
		return response()->json([
			'subjects' => $subjects,
		]);
	}

	public function tutorSave(Request $request) {
		//        dd($request->all());
		request()->validate([
			'firstName'        => 'required|min:2|max:50',
			'lastName'         => 'required|min:2|max:50',
			'fatherName'       => 'required|min:2|max:50',
			'phone'            => 'required|min:10|numeric|unique:users',
			'email'            => 'required|email|unique:users',
			'password'         => 'required|min:6|max:20',
			'confirm_password' => 'required|min:6|max:20|same:password',
			'dob'              => 'required',
			'gender_id'        => 'required',
			'qualification'    => 'required',
			'cnic_no'          => 'required',
			'subject_id'       => 'required',
		],
			[
				'firstName.required'     => 'Name is required',
				'firstName.min'          => 'Name must be at least 2 characters.',
				'firstName.max'          => 'Name should not be greater than 50 characters.',
				'lastName.required'      => 'Name is required',
				'lastName.min'           => 'Name must be at least 2 characters.',
				'fatherName.required'    => 'Name is required',
				'fatherName.min'         => 'Name must be at least 2 characters.',
				'fatherName.max'         => 'Name should not be greater than 50 characters.',
				'dob.required'           => 'Date of birth is required.',
				'phone.required'         => 'Phone number is required.',
				'gender_id.required'     => 'Select gender',
				'qualification.required' => 'Qualification is required',
				'cnic_no.required'       => 'Enter CNIC number',
				'subject_id.required'    => 'Select subject',
			]);

		$input           = request()->except('password', 'confirm_password');
		$user            = new User($input);
		$user->password  = bcrypt(request()->password);
		$user->uid       = str_random(32);
		$user->is_active = 1;
		$user->role_id   = 2;
		$user->save();

		//Create profile table entry
		$profile = Profile::create(
			[
				'is_mentor'       => 0,
				'is_deserving'    => 0,
				'one_on_one'      => 0,
				'call_tutor'      => 0,
				'call_student'    => 0,
				'is_home'         => 0,
				'is_group'        => 0,
				'subject_id'      => 0,
				'programme_id'    => 0,
				'meeting_type_id' => 0,
				'user_id'         => $user->id
			]);

		$subjects = $request->subject_id;
		foreach ($subjects as $subject) {
			$sub                 = Subject::where('id', $subject)->first();
			$prosub              = new ProgramSubject();
			$prosub->user_id     = $user->id;
			$prosub->program_id  = $sub->programme_id;
			$prosub->document_id = 0;
			$prosub->subject_id  = $subject;
			$prosub->save();
		}
		return redirect()->route('tutorsList')->with('success', 'Tutor added Successfully');
	}

	public function changeTutorStatus(Request $request) {
		request()->validate([
			'tutor_id'  => 'required',
			'is_active' => 'required'
		]);
		$tutor_id  = $request->tutor_id;
		$is_active = $request->is_active;

		$tutor = User::where('id', $tutor_id)->first();
		if ($is_active == 'true') {
			$tutor->is_active = 1;
			$tutor->save();
		} else {
			$tutor->is_active = 0;
			$tutor->save();
		}
	}

	public function changeTutorApprovedStatus(Request $request) {
		request()->validate([
			'tutor_id'    => 'required',
			'is_approved' => 'required'
		]);
		$tutor_id    = $request->tutor_id;
		$is_approved = $request->is_approved;

		$tutor = User::where('id', $tutor_id)->first();
		if ($is_approved == 'true') {
			$tutor->is_approved = 1;
			$tutor->save();
		} else {
			$tutor->is_approved = 0;
			$tutor->save();
		}
	}

	public function tutorsList(Request $request) {
		$mentorOrCommercial = 'Commercial';
		if ($request->ajax()) {
			if ($request->input('filterDataArray') != '' && $request->has('filterDataArray')) {
				$tutors = $this->tutorFilter($request, $mentorOrCommercial)->where('is_approved',
					1)->where('final_phone_verification', 1);
			} else {
				$tutors = User::select('id',
					'firstName',
					'lastName',
					'email',
					'phone',
					'is_active',
					'is_approved',
					'created_at',
					'last_login')->whereHas('profile',
					function ($q) {
						$q->where('is_mentor', 0);
					})->with('rating')->where('role_id', 2)->where('is_approved', 1)->where('final_phone_verification',
					1);
			}
			return datatables()->eloquent($tutors)
							   ->addColumn('rating',
								   function ($tutor) {
									   return round($tutor->rating->avg('rating'), 1);
								   })
							   ->addColumn('created_at',
								   function ($tutor) {
									   return dateTimeConverter($tutor->created_at);
								   })
							   ->addColumn('last_login',
								   function ($tutor) {
									   return $tutor->last_login == null ? 'N-A' : dateTimeConverter($tutor->last_login);
								   })
							   ->addColumn('is_active',
								   function ($tutor) {
									   $is_checked = $tutor->is_active == 1 ? 'checked' : '';
									   $is_active  = '<input type="checkbox" data-tutor-id="' . $tutor->id . '" data-url="' . url('/') . '" class="js-switch" data-color="#99d683"' . $is_checked . '>';
									   return $is_active;
								   })
				//                ->addColumn('is_approve', function($tutor){
				//                    $is_checked = $tutor->is_approved == 1 ? 'checked' : '';
				//                    $is_approve = '<input type="checkbox" data-tutor-id="'.$tutor->id.'" data-url="'.url('/').'" class="is_approved_by_admin" data-color="#99d683"'.$is_checked.'>';
				//                    return $is_approve;
				//                })
				//                ->addColumn('edit', function($tutor){
				//                    $btn = '<a type="button" class="fcbtn btn btn-warning btn-outline btn-1d" href="'.route('tutorProfile',$tutor->id).'" alt="default">View</a>';
				//                    return $btn;
				//                })
							   ->addColumn('delete',
					function ($tutor) {
						$delete_btn = '<div style="text-align: center"><a type="button" class="fcbtn btn btn-warning btn-outline btn-1d" style="padding-left: 25px; padding-right: 25px;" href="' . route('tutorProfile',
								$tutor->id) . '" alt="default">View</a><br><a type="button" class="fcbtn btn btn-danger btn-outline btn-1d delete" style="margin-top: 5px" data-id="' . $tutor->id . '">Delete</a></div>';
						return $delete_btn;
					})
							   ->rawColumns(['rating', 'created_at', 'last_login', 'is_active', 'delete'])
							   ->orderColumn('created_at', 'created_at $1')
							   ->orderColumn('last_login', 'last_login $1')
							   ->orderColumn('is_active', 'is_active $1')
							   ->make(true);
		}
		$countries          = User::select('country')->whereNotNull('country')->where('role_id',
			'2')->groupBy('country')->get();
		$programs           = Program::with('subjects')->where('status', '!=', '2')->orderBy("id", 'Desc')->get();
		$mentorOrCommercial = 'Commercial';
		return view('admin.tutor.tutorsList', compact('mentorOrCommercial', 'countries', 'programs'));
	}

	public function tutorsDisbursementList(Request $request) {
		$mentorOrCommercial = 'Commercial';
		if ($request->ajax()) {
			if ($request->input('filterDataArray') != '' && $request->has('filterDataArray')) {
				$invoices = $this->disbursementFilter($request, $mentorOrCommercial);
			} else {
				$invoices = TutorInvoice::with('tutor');
				//            $invoices = TutorInvoice::get();
				//                $tutors = User::select('id', 'firstName', 'lastName', 'email', 'phone', 'is_active', 'is_approved', 'created_at', 'last_login')->whereHas('profile', function ($q) {
				//                    $q->where('is_mentor', 0);
				//                })->with('rating')->where('role_id', 2)->where('is_approved', 1)->where('final_phone_verification',1);
			}
			return datatables()->eloquent($invoices)
							   ->addColumn('tutor',
								   function (TutorInvoice $invoice) {
									   return $invoice['tutor']['firstName'] . ' ' . $invoice['tutor']['lastName'];
								   })
                                ->addColumn('amount',
                                    function ($invoice) {
                                        return $invoice->amount > 0 ? $invoice->amount.' PKR' : "0.00 PKR";
                                    })
                                ->addColumn('commission',
                                    function ($invoice) {
                                        return $invoice->commission > 0 ? $invoice->commission.' PKR' : "0.00 PKR";
                                    })
								->addColumn('payable',
									function ($invoice) {
										return $invoice->payable > 0 ? $invoice->payable.' PKR' : "0.00 PKR";
									})
								->addColumn('receiveable',
									function ($invoice) {
										return $invoice->receiveable > 0 ? $invoice->receiveable.' PKR' : "0.00 PKR";
									})
							   ->addColumn('transaction_type',
								   function ($invoice) {
									   return $invoice->transaction_type ? $invoice->transaction_type : "not Paid yet";
								   })
							   ->addColumn('transaction_platform',
								   function ($invoice) {
									   return $invoice->transaction_platform ? $invoice->transaction_platform : "not Paid yet";
								   })
							   ->addColumn('transaction_status',
								   function ($invoice) {
									   return $invoice->transaction_status ? $invoice->transaction_status : "not Paid yet";
								   })
							   ->addColumn('commission_percentage',
								   function ($invoice) {
									   return $invoice->commission_percentage ? $invoice->commission_percentage. ' %' : "not Paid yet";
								   })
							   ->addColumn('created_at',
								   function ($invoice) {
									   return dateTimeConverter($invoice->created_at);
								   })
							   ->rawColumns(['tutor_name', 'amount', 'commission', 'payable', 'receiveable', 'due_date', 'status', 'transaction_type', 'transaction_platform', 'transaction_status', 'commission_percentage', 'created_at'])
							   ->orderColumn('tutor_name', 'tutorname $1')
							   ->orderColumn('amount', 'amount $1')
							   ->orderColumn('commission', 'commission $1')
							   ->orderColumn('payable', 'payable $1')
							   ->orderColumn('receiveable', 'receiveable $1')
							   ->orderColumn('due_date', 'due_date $1')
							   ->orderColumn('status', 'status $1')
							   ->orderColumn('transaction_type', 'transaction_type $1')
							   ->orderColumn('transaction_platform', 'transaction_platform $1')
							   ->orderColumn('transaction_status', 'transaction_status $1')
							   ->orderColumn('commission_percentage', 'commission_percentage $1')
							   ->orderColumn('created_at', 'created_at $1')
							   ->make(true);
		}
		$countries          = User::select('country')->whereNotNull('country')->where('role_id',
			'2')->groupBy('country')->get();
		$programs           = Program::with('subjects')->where('status', '!=', '2')->orderBy("id", 'Desc')->get();
		$mentorOrCommercial = 'Commercial';
		return view('admin.tutor.tutorsDisbursementList', compact('mentorOrCommercial', 'countries', 'programs'));
	}

	public function tutorsRevenueReports(Request $request) {
		$mentorOrCommercial = 'Commercial';
		if ($request->ajax()) {
			if ($request->input('filterDataArray') != '' && $request->has('filterDataArray')) {
				$invoices = $this->revenueFilter($request, $mentorOrCommercial)->get();
				$invoices = $invoices->groupBy('tutor_id');
				//->where('is_approved',1)->where('final_phone_verification', 1)
			} else {
				$invoices = TutorInvoice::all();
				$invoices = $invoices->groupBy('tutor_id');
				//            $invoices = TutorInvoice::get();
				//                $tutors = User::select('id', 'firstName', 'lastName', 'email', 'phone', 'is_active', 'is_approved', 'created_at', 'last_login')->whereHas('profile', function ($q) {
				//                    $q->where('is_mentor', 0);
				//                })->with('rating')->where('role_id', 2)->where('is_approved', 1)->where('final_phone_verification',1);
			}
			return DataTables::collection($invoices)
							 ->addColumn('id',
								 function ($invoice) {
									 return $invoice[0]->id;
								 })
							 ->addColumn('tutor',
								 function ($invoice) {
									 return $invoice[0]->tutor->firstName . ' ' . $invoice[0]->tutor->lastName;
								 })
							 ->addColumn('tutor_email',
								 function ($invoice) {
									 return $invoice[0]->tutor->email;
								 })
							 ->addColumn('tutor_phone',
								 function ($invoice) {
									 return $invoice[0]->tutor->phone;
								 })
							 ->addColumn('amount',
								 function ($invoice) {
									 return $invoice->sum('amount').' PKR';
								 })
							 ->addColumn('commission',
								 function ($invoice) {
									 return $invoice->sum('commission').' PKR';
								 })
							 ->addColumn('payable',
								 function ($invoice) {
									 return $invoice->sum('payable') > 0 ? $invoice->sum('payable').' PKR' : '0.00 PKR';
								 })
							 ->addColumn('receiveable',
								 function ($invoice) {
									 return $invoice->sum('receiveable') > 0 ? $invoice->sum('receiveable').' PKR' : '0.00 PKR';
								 })
							 ->rawColumns(['tutor_name', 'amount', 'commission', 'payable', 'receiveable'])
				//							 ->orderColumn('tutor_name', 'tutorname $1')
				//							 ->orderColumn('amount', 'amount $1')
				//							 ->orderColumn('commission', 'commission $1')
				//							 ->orderColumn('payable', 'payable $1')
				//							 ->orderColumn('receiveable', 'receiveable $1')
							 ->make(true);
		}
		$countries          = User::select('country')->whereNotNull('country')->where('role_id',
			'2')->groupBy('country')->get();
		$programs           = Program::with('subjects')->where('status', '!=', '2')->orderBy("id", 'Desc')->get();
		$mentorOrCommercial = 'Commercial';
		return view('admin.tutor.tutorsRevenueList', compact('mentorOrCommercial', 'countries', 'programs'));
	}

	public function tutorsArchiveList() {
		$tutors             = User::select('id',
			'firstName',
			'lastName',
			'email',
			'phone',
			'is_active',
			'is_approved',
			'created_at',
			'last_login')->whereHas('profile',
			function ($q) {
				$q->where('is_mentor', 0);
			})->with('rating')->onlyTrashed()->orderBy('id', 'DESC')->get();
		$mentorOrCommercial = 'Commercial';


		return view('admin.tutor.tutorsArchiveList', compact('tutors', 'mentorOrCommercial'));
	}

	public function mentorsList(Request $request) {
		$mentorOrCommercial = 'Mentor';

		if ($request->ajax()) {
			if ($request->input('filterDataArray') != '' && $request->has('filterDataArray')) {
				$tutors = $this->tutorFilter($request, $mentorOrCommercial)->where('is_approved',
					1)->where('final_phone_verification', 1);
			} else {
				$tutors = User::select('id',
					'firstName',
					'lastName',
					'email',
					'phone',
					'is_active',
					'is_approved',
					'created_at',
					'last_login')->whereHas('profile',
					function ($q) {
						$q->where('is_mentor', 1);
					})->with('rating')->where('role_id', 2)->where('is_approved', 1)->where('final_phone_verification',
					1);
			}
			return datatables()->eloquent($tutors)
							   ->orderColumn('firstName',
								   function ($query, $order) {
									   $query->orderBy('status', $order);
								   })
							   ->addColumn('rating',
								   function ($tutor) {
									   return round($tutor->rating->avg('rating'), 1);
								   })
							   ->addColumn('created_at',
								   function ($tutor) {
									   return dateTimeConverter($tutor->created_at);
								   })
							   ->addColumn('last_login',
								   function ($tutor) {
									   return $tutor->last_login == null ? 'N-A' : dateTimeConverter($tutor->last_login);
								   })
							   ->addColumn('is_active',
								   function ($tutor) {
									   $is_checked = $tutor->is_active == 1 ? 'checked' : '';
									   $is_active  = '<input type="checkbox" data-tutor-id="' . $tutor->id . '" data-url="' . url('/') . '" class="js-switch" data-color="#99d683"' . $is_checked . '>';
									   return $is_active;
								   })
				//                ->addColumn('is_approve', function($tutor){
				//                    $is_checked = $tutor->is_approved == 1 ? 'checked' : '';
				//                    $is_approve = '<input type="checkbox" data-tutor-id="'.$tutor->id.'" data-url="'.url('/').'" class="is_approved_by_admin" data-color="#99d683"'.$is_checked.'>';
				//                    return $is_approve;
				//                })
				//                ->addColumn('edit', function($tutor){
				//                    $btn = '<a type="button" class="fcbtn btn btn-warning btn-outline btn-1d" href="'.route('tutorProfile',$tutor->id).'" alt="default">View</a>';
				//                    return $btn;
				//                })
							   ->addColumn('delete',
					function ($tutor) {
						$delete_btn = '<div style="text-align: center"><a type="button" class="fcbtn btn btn-warning btn-outline btn-1d" style="padding-left: 25px; padding-right: 25px;" href="' . route('tutorProfile',
								$tutor->id) . '" alt="default">View</a><br><a type="button" class="fcbtn btn btn-danger btn-outline btn-1d delete" style="margin-top: 5px" data-id="' . $tutor->id . '">Delete</a></div>';
						return $delete_btn;
					})
							   ->rawColumns(['rating', 'created_at', 'last_login', 'is_active', 'delete'])
							   ->orderColumn('created_at', 'created_at $1')
							   ->orderColumn('last_login', 'last_login $1')
							   ->orderColumn('is_active', 'is_active $1')
							   ->make(true);
		}
		$countries = User::select('country')->where('role_id', '2')->whereNotNull('country')->groupBy('country')->get();
		$programs  = Program::with('subjects')->where('status', '!=', '2')->orderBy("id", 'Desc')->get();

		return view('admin.tutor.tutorsList', compact('mentorOrCommercial', 'countries', 'programs'));
		//        $tutors = User::whereHas('profile', function ($q){
		//            $q->where('is_mentor', 1);
		//        })->where('role_id',2)->orderBy('id', 'DESC')->get();
		//        $mentorOrCommercial = 'Mentor';
		//        return view('admin.tutor.tutorsList',compact('tutors', 'mentorOrCommercial'));
	}

	public function tutorProfile(User $user) {
		$programs_subjects = ProgramSubject::where('user_id', $user->id)->with('program', 'subject')->get();
		$programs          = Program::where('status', 1)->get();
		$profile           = $user->documents()->where('document_type',
			'profile_photo')->exists() ? $user->documents()->where('document_type', 'profile_photo')->orderBy('id',
			'desc')->pluck('path')[0] : '0';
		$cnicfront         = $user->documents()->where('document_type',
			'cnic_front')->exists() ? $user->documents()->where('document_type', 'cnic_front')->orderBy('id',
			'desc')->pluck('path')[0] : '0';
		$cnicback          = $user->documents()->where('document_type',
			'cnic_back')->exists() ? $user->documents()->where('document_type', 'cnic_back')->orderBy('id',
			'desc')->pluck('path')[0] : '0';
		$payment_invoices  = SessionPayment::with('session')->whereIn('id',
			$user->disbursement->pluck('paymentable_id'));

		//                        dd($payment_invoices->first()!=null);
		return view('admin.tutor.tutorProfile',
			compact('user', 'programs_subjects', 'programs', 'profile', 'cnicfront', 'cnicback', 'payment_invoices'));
	}

	public function tutorSubjectsUpdate(Request $request) {
		$user_id = $request->user_id;
		ProgramSubject::where('user_id', $user_id)->delete();
		$subjects = $request->subject_id;
		if ($subjects != null) {
			foreach ($subjects as $subject) {
				$prosub             = new ProgramSubject();
				$sub                = Subject::where('id', $subject)->first();
				$prosub->program_id = $sub->programme_id;
				$prosub->subject_id = $subject;
				$prosub->user_id    = $user_id;
				$prosub->save();
			}
		}
		return redirect()->route('tutorProfile', $user_id)->with('success', 'Tutor subjects updated Successfully');
	}

	public function tutorsEdit(User $user) {
		//
		//        $profilePhotoprogrameId=Program::where('name','ProfilePhoto')->pluck('id')[0];
		//        $cnicprogrameId=Program::where('name','Cnic')->pluck('id')[0];
		//        $profilePhotoSubId=Subject::where('programme_id',$profilePhotoprogrameId)->pluck('id')[0];
		//        $cnicFrontSubId=Subject::where('programme_id',$cnicprogrameId)->where('name','cnic_front')->pluck('id')[0];
		//        $cnicBackSubId=Subject::where('programme_id',$cnicprogrameId)->where('name','cnic_back')->pluck('id')[0];

		//$user->program_subject()-->where('program_id',$profilePhotoprogrameId)->where('subject_id',$profilePhotoSubId);
		$profile   = $user->documents()->where('document_type',
			'profile_photo')->exists() ? $user->documents()->where('document_type', 'profile_photo')->orderBy('id',
			'desc')->pluck('path')[0] : '0';
		$cnicfront = $user->documents()->where('document_type',
			'cnic_front')->exists() ? $user->documents()->where('document_type', 'cnic_front')->orderBy('id',
			'desc')->pluck('path')[0] : '0';
		$cnicback  = $user->documents()->where('document_type',
			'cnic_back')->exists() ? $user->documents()->where('document_type', 'cnic_back')->orderBy('id',
			'desc')->pluck('path')[0] : '0';
		//dd($profile);
		return view('admin.tutor.profileEdit', compact('user', 'profile', 'cnicfront', 'cnicback'));
	}

	public function tutorUpdate(Request $request, User $user) {
		$profilePhotoprogrameId = Program::where('name', 'ProfilePhoto')->pluck('id')[0];
		$cnicprogrameId         = Program::where('name', 'Cnic')->pluck('id')[0];
		$profilePhotoSubId      = Subject::where('programme_id', $profilePhotoprogrameId)->pluck('id')[0];
		$cnicFrontSubId         = Subject::where('programme_id', $cnicprogrameId)->where('name',
			'cnic_front')->pluck('id')[0];
		$cnicBackSubId          = Subject::where('programme_id', $cnicprogrameId)->where('name',
			'cnic_back')->pluck('id')[0];
		$request->validate([
			'firstName'        => 'required|min:2|max:50',
			'lastName'         => 'required|min:2|max:50',
			'fatherName'       => 'required|min:2|max:50',
			//            'email' =>  [
			//                'required',
			//                'min:2',
			//                'regex:',
			//                Rule::unique('users')->ignore($user->id),
			//            ],
			//            'phone' =>  [
			//                'required',
			//                Rule::unique('users')->ignore($user->id),
			//            ],
			'password'         => 'min:6|max:20|nullable',
			'confirm_password' => 'min:6|max:20|same:password|nullable',
			'dob'              => 'required',
			'gender_id'        => 'required',
			'experience'       => 'required',
			'qualification'    => 'required',
			'cnic_no'          => 'required',
			'profile_picture'  => [
				'name'  => 'max:300',
				'image' => 'mimes:jpeg,png',
				'nullable'
			], 'cnic_front'    => [
				'name'  => 'max:300',
				'image' => 'mimes:jpeg,png',
				'nullable'
			], 'cnic_back'     => [
				'name'  => 'max:300',
				'image' => 'mimes:jpeg,png',
				'nullable'
			],
		],
			[
				'firstName.required'     => 'Name is required',
				'firstName.min'          => 'Name must be at least 2 characters.',
				'firstName.max'          => 'Name should not be greater than 50 characters.',
				'lastName.required'      => 'Name is required',
				'lastName.min'           => 'Name must be at least 2 characters.',
				'fatherName.required'    => 'Name is required',
				'fatherName.min'         => 'Name must be at least 2 characters.',
				'fatherName.max'         => 'Name should not be greater than 50 characters.',
				'dob.required'           => 'Date of birth is required.',
				//            'phone.required' => 'Phone number is required.',
				'gender_id.required'     => 'Select gender',
				'experience.required'    => 'Select experience',
				'qualification.required' => 'Qualification is required',
				'cnic_no.required'       => 'Enter CNIC number',
				'profile_picture.max'    => 'Profile photo name Must be within 300 characters',
				'profile_picture.mimes'  => 'Profile Image must be of type JPEG or PNG',
				'cnic_front.max'         => 'CNIC front photo name Must be within 300 characters',
				'cnic_front.mimes'       => 'CNIC front Image must be of type JPEG or PNG',
				'cnic_back.max'          => 'CNIC back photo name Must be within 300 characters',
				'cnic_back.mimes'        => 'CNIC back Image must be of type JPEG or PNG',

			]);
		//        dd(Document::get()->last()->id);
		//        dd($user->id);
		$user->firstName     = $request->firstName;
		$user->lastName      = $request->lastName;
		$user->fatherName    = $request->fatherName;
		$user->dob           = $request->dob;
		$user->phone         = $request->phone;
		$user->gender_id     = $request->gender_id;
		$user->experience    = $request->experience;
		$user->qualification = $request->qualification;
		$user->cnic_no       = $request->cnic_no;
		$user->email         = $request->email;
		$client              = new Client();
		//dd($request);

		if ($request->hasFile('profile_picture')) {
			$imageName = time() . '1.' . $request->profile_picture->getClientOriginalExtension();
			$request->profile_picture->storeAs('/public/documents', $imageName);
			//            $storagePath = self::$documentStoragePath . '/' . $imageName;
			$fullyQualifiedPath = base_path() . '/storage/app/public/documents/' . $imageName;
			if (!$user->program_subject()->where('program_id', $profilePhotoprogrameId)->where('subject_id',
				$profilePhotoSubId)->exists()
			) {
				//                dd('profile'.$user->program_subject()->where('program_id', $profilePhotoprogrameId)->where('subject_id', $profilePhotoSubId)->exists());

				$promise = $client->request('POST',
					config('app.api_url', 'www.test.com') . '/admin-upload-documents',
					[
						'multipart' => [
							[
								'name'     => 'title',
								'contents' => 'Profile Photo'
							],
							[
								'name'     => 'document_type',
								'contents' => 'profile_photo'
							],
							[
								'name'     => 'device',
								'contents' => 'android'
							],
							[
								'name'     => 'id',
								'contents' => $user->id
							],
							[
								'name'     => 'document',
								'contents' => fopen($fullyQualifiedPath, 'r')
							]
						]
					]);
				//                dd($promise);

			} else {
				$documentId = $user->program_subject()->where('program_id',
					$profilePhotoprogrameId)->where('subject_id', $profilePhotoSubId)->pluck('document_id')[0];
				$promise    = $client->request('POST',
					config('app.api_url', 'www.test.com') . '/admin-update-tutors-document',
					[
						'multipart' => [
							[
								'name'     => 'title',
								'contents' => 'Profile Photo'
							],
							[
								'name'     => 'document_type',
								'contents' => 'profile_photo'
							],
							[
								'name'     => 'device',
								'contents' => 'android'
							],
							[
								'name'     => 'id',
								'contents' => $user->id
							],
							[
								'name'     => 'document_id',
								'contents' => $documentId
							],
							[
								'name'     => 'document',
								'contents' => fopen($fullyQualifiedPath, 'r')
							]
						]
					]);

				//                dd($promise);
			}
		}
		//        dd(config('app.api_url', 'www.test.com/').'admin-upload-documents');
		if ($request->hasFile('cnic_back')) {
			$imageName = time() . '2.' . $request->cnic_back->getClientOriginalExtension();
			$request->cnic_back->storeAs('/public/documents', $imageName);
			$storagePath        = self::$documentStoragePath . '/' . $imageName;
			$fullyQualifiedPath = base_path() . '/storage/app/public/documents/' . $imageName;
			//            dd('cnicback'.$user->program_subject()->where('program_id', $cnicprogrameId)->where('subject_id', $cnicBackSubId)->exists());

			if (!$user->program_subject()->where('program_id', $cnicprogrameId)->where('subject_id',
				$cnicBackSubId)->exists()
			) {

				$promise = $client->request('POST',
					config('app.api_url', 'www.test.com') . '/admin-upload-documents',
					[
						'multipart' => [
							[
								'name'     => 'title',
								'contents' => 'CNIC Back'
							],
							[
								'name'     => 'document_type',
								'contents' => 'cnic_back'
							],
							[
								'name'     => 'device',
								'contents' => 'android'
							],
							[
								'name'     => 'id',
								'contents' => $user->id
							],
							[
								'name'     => 'document',
								'contents' => fopen($fullyQualifiedPath, 'r')
							]
						]
					]);

			} else {
				$documentId = $user->program_subject()->where('program_id', $cnicprogrameId)->where('subject_id',
					$cnicBackSubId)->pluck('document_id')[0];
				$promise    = $client->request('POST',
					config('app.api_url', 'www.test.com') . '/admin-update-tutors-document',
					[
						'multipart' => [
							[
								'name'     => 'title',
								'contents' => 'CNIC Back'
							],
							[
								'name'     => 'document_type',
								'contents' => 'cnic_back'
							],
							[
								'name'     => 'device',
								'contents' => 'android'
							],
							[
								'name'     => 'id',
								'contents' => $user->id
							],
							[
								'name'     => 'document_id',
								'contents' => $documentId
							],
							[
								'name'     => 'document',
								'contents' => fopen($fullyQualifiedPath, 'r')
							]
						]
					]);

				//                dd($promise);
			}


		}
		if ($request->hasFile('cnic_front')) {
			$imageName = time() . '3.' . $request->cnic_front->getClientOriginalExtension();
			$request->cnic_front->storeAs('/public/documents', $imageName);
			$storagePath        = self::$documentStoragePath . '/' . $imageName;
			$fullyQualifiedPath = base_path() . '/storage/app/public/documents/' . $imageName;
			//            dd('cnicfrotn',$user->program_subject()->where('program_id', $cnicprogrameId)->where('subject_id', $cnicFrontSubId)->exists());

			if (!$user->program_subject()->where('program_id', $cnicprogrameId)->where('subject_id',
				$cnicFrontSubId)->exists()
			) {
				$promise = $client->request('POST',
					config('app.api_url', 'www.test.com') . '/admin-upload-documents',
					[
						'multipart' => [
							[
								'name'     => 'title',
								'contents' => 'CNIC Front'
							],
							[
								'name'     => 'document_type',
								'contents' => 'cnic_front'
							],
							[
								'name'     => 'device',
								'contents' => 'android'
							],
							[
								'name'     => 'id',
								'contents' => $user->id
							],
							[
								'name'     => 'document',
								'contents' => fopen($fullyQualifiedPath, 'r')
							]
						]
					]);
			} else {
				$documentId = $user->program_subject()->where('program_id', $cnicprogrameId)->where('subject_id',
					$cnicFrontSubId)->pluck('document_id')[0];

				//                dd($user->program_subject()->where('program_id', $cnicprogrameId)->where('subject_id', $cnicFrontSubId)->pluck('document_id')[0]);
				$promise = $client->request('POST',
					config('app.api_url', 'www.test.com') . '/admin-update-tutors-document',
					[
						'multipart' => [
							[
								'name'     => 'title',
								'contents' => 'CNIC Front'
							],
							[
								'name'     => 'document_type',
								'contents' => 'cnic_front'
							],
							[
								'name'     => 'device',
								'contents' => 'android'
							],
							[
								'name'     => 'id',
								'contents' => $user->id
							],
							[
								'name'     => 'document_id',
								'contents' => $documentId
							],
							[
								'name'     => 'document',
								'contents' => fopen($fullyQualifiedPath, 'r')
							]
						]
					]);

				//                dd($promise);
			}
		}


		if ($request->password) {
			$user->password = bcrypt($request->password);
			$user->save();
		} else {
			$user->password = $user->password;
			$user->save();
		}
		//        $user->save();
		//        dd('saved');
		return redirect()->route('tutorsList')->with('success', 'Tutor updated Successfully');
	}

	public function tutorDelete($tutor) {
		User::where('id', $tutor)->delete();
		return redirect()->route('tutorsList')->with('success', 'Tutor Deleted successfully');
	}

	public function tutorRestore($tutor) {
		/*dd($tutor);*/
		User::withTrashed()->find($tutor)->restore();
		return redirect()->route('tutorsArchiveList')->with('success', 'Tutor Restored successfully');
	}

	public function profileUpdate(Request $request) {

		$userProfile = Profile::where('user_id', $request->user_id)->first();

		if ($request->group_tutor_or_one_on_one == 'group_tutor') {
			$userProfile->is_group   = 1;
			$userProfile->one_on_one = 0;
		}

		if ($request->group_tutor_or_one_on_one == 'one_on_one') {
			$userProfile->is_group   = 0;
			$userProfile->one_on_one = 1;
		}

		if ($request->group_tutor_or_one_on_one == 'no_pref') {
			$userProfile->is_group   = 1;
			$userProfile->one_on_one = 1;
		}


		if ($request->call_student_or_go_home == 'call_student') {
			$userProfile->call_student = 1;
			$userProfile->is_home      = 0;
		}

		if ($request->call_student_or_go_home == 'go_home') {
			$userProfile->call_student = 0;
			$userProfile->is_home      = 1;
		}

		if ($request->call_student_or_go_home == 'no_pref') {
			$userProfile->call_student = 1;
			$userProfile->is_home      = 1;
		}

		if ($request->who_would_you_like_to_teach == 'male') {
			$userProfile->teach_to = 1;
		}
		if ($request->who_would_you_like_to_teach == 'female') {
			$userProfile->teach_to = 2;
		}
		if ($request->who_would_you_like_to_teach == 'no_preference') {
			$userProfile->teach_to = 0;
		}


		if ($request->commercial_or_mentor == 'commercial') {
			$userProfile->is_mentor = 0;
		}
		if ($request->commercial_or_mentor == 'mentor') {
			$userProfile->is_mentor = 1;
		}

		$userProfile->save();


		return redirect()->back()->with('success', 'Updated Successfully!');
	}


	public function getCoordinatesOfTutors() {
		$tutors = User::select('latitude as lat', 'longitude as lng', 'firstName', 'lastName', 'phone')
					  ->where('role_id', 2)
					  ->where('is_online', 1)
					  ->where('latitude', '!=', null)
					  ->where('longitude', '!=', null)
					  ->get();
		return view('admin.tutor.map', compact('tutors'));
	}

	public function fetchProvince(Request $request) {
		$provicesHtml = $this->getProviceByCountry($request);
		return $provicesHtml;
	}

	public function fetchCity(Request $request) {
		$citesHtml = $this->getCityByProvince($request);
		return $citesHtml;
	}

	public function fetchArea(Request $request) {
		$areaHtml = $this->getAreaByCity($request);
		return $areaHtml;
	}

	public function fetchSubjects(Request $request) {
		$where_array = explode(',', $request->input('class'));
		//        $html = '<option value="all">Select Subjects</option>';
		$html     = '';
		$subjects = Subject::where('status', '!=', '2')->whereIn('programme_id', $where_array)->get();
		foreach ($subjects as $subject) {
			$html .= '<option value="' . $subject->id . '">' . $subject->name . '</option>';
		}
		return $html;
	}

}
