<?php

namespace App\Http\Controllers;

use App\Helpers\Push;
use App\Jobs\SendNotificationFromAdminPanel;
use App\Models\Notification;
use App\Models\NotificationStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Storage;
use File;
use Maatwebsite\Excel\Facades\Excel;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notification::orderBy('id', 'desc')->get();
        return view('admin.notification.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notification.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,bmp,png',
            'csv' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $urlImage = $this->saveImage($request);
        }
        if ($request->hasFile('csv')) {
            list($urlFile, $extension, $path) = $this->saveCsv($request);
        }
        //save notification
        if ($urlImage && $urlFile){
            $notification = Notification::create([
                'title' => $request->title,
                'message' => $request->message,
                'description' => $request->description,
                'image' => $urlImage,
                'send_to' => $urlFile,
                'created_by' => Auth::user()->id,
            ]);
        }

        if ($extension == 'csv'){
            $this->sendNotiFromCsv($request,$path, $notification);
        } else {
            $this->sendNotiFromXlsx($request, $path, $notification);
        }
        return redirect()->route('notifications.index')->with('success','Notification sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function saveImage($request){
        //get filename with extension
        $fileNameWithExtension = $request->file('image');
        //get filename without extension
        $filename = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
        //get file extension
        $extension = $request->file('image')->getClientOriginalExtension();
        //filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        // save in storage
        $saveImage = Storage::disk('public')->put('notificationImage/'.$fileNameToStore,  File::get($fileNameWithExtension));
        //get path
        $urlImage = Storage::disk('public')->url('notificationImage/'.$fileNameToStore);

        return $urlImage;
    }

    public function saveCsv($request){
        //get filename path
        $path = $request->file('csv')->getRealPath();
        //get filename with extension
        $fileNameWithExtension = $request->file('csv');
        //get filename without extension
        $filename = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
        //get file extension
        $extension = $request->file('csv')->getClientOriginalExtension();
        //filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        // save in storage
        $saveFile = Storage::disk('public')->put('notificationCsv/'.$fileNameToStore,  File::get($fileNameWithExtension));
        //get path
        $urlFile = Storage::disk('public')->url($fileNameToStore);

        return [$urlFile, $extension, $path];
    }

    public function sendNotiFromCsv($request, $path, $notification){
        $data = array_map('str_getcsv', file($path));
        if (count($data) > 0) {
            unset($data[0]);
            foreach ($data as $item){
                $notificationStatusId = NotificationStatus::create([
                    'notification_id' => $notification->id,
                    'receiver_id' => $item[0],
                    'notification_type' => "Default",
                    'read_status' => 0
                ])->id;
                //use relations to add notification object
                // $notStatus->add($notification)
                // get User
                $user = User::where('id', $item[0])->first();
                if ($user){
                    // Send Notification
//                    $title = $request->title;
//                    $message = $request->message;
//                    $job = new SendNotificationFromAdminPanel($item[0], $title, $message);
//                    $this->dispatch($job);
                    // Send direct push as IOS developer suggestion
                    $customData = array(
                        'notification_type' => 'admin_notification',
                        'notification' => $notification,
                        'notification_status_id' => $notificationStatusId,
                    );
                    $title = $request->title;
                    $body = $request->message;
                    Push::handle($title, $body, $customData, $user);
                }
            }
        }
    }

    public function sendNotiFromXlsx($request, $path, $notification){
        //$notificationId = $notification->id;
        Excel::load($path, function ($reader) use ($request, $notification) {
            $reader->each(function ($data) use ($request, $notification) {
                foreach ($data as $item){
                    $notificationStatusId = NotificationStatus::create([
                        'notification_id' => $notification->id,
                        'receiver_id' => intval($item->id),
                        'notification_type' => "Default",
                        'read_status' => 0
                    ])->id;
                    // get User
                    $user = User::where('id', $item->id)->first();
                    if ($user){
                        // Send Notification
                        $customData = array(
                            'notification_type' => 'admin_notification',
                            'notification' => $notification,
                            'notification_status_id' => $notificationStatusId,
                        );
                        $title = $request->title;
                        $body = $request->message;
                        Push::handle($title, $body, $customData, $user);
                    }
                }
            });
        });
    }
}
