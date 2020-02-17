<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;
use File;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notification::all();
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
            $urlImage = Storage::disk('public')->url($fileNameToStore);
        }
        if ($request->hasFile('csv')) {
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
//            dd($saveImage,$urlImage, $saveFile, $urlFile);
        }

        if ($urlImage && $urlFile){
            Notification::create([
                'title' => $request->title,
                'message' => $request->message,
                'description' => $request->description,
                'image' => $urlImage,
                'send_to' => $urlFile,
                'created_by' => Auth::user()->id,
            ]);



            return "saved";
        }

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
}
