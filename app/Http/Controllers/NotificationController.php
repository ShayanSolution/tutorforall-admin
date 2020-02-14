<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('admin.notification.index');
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
            'csv' => 'required|mimes:csv,xlsx',
        ]);

        if ($request->hasFile('image')) {
            $notiImage = $request->file('image');
            $extension = $notiImage->getClientOriginalExtension();
            $store = Storage::disk('public')->put('notificationImage/'.$notiImage->getFilename().'.'.$extension,  File::get($notiImage));
            $notiImagePath = Storage::url($notiImage).".".$extension;
        }
        if ($request->hasFile('csv')) {
            $notiPhones = $request->file('csv');
            $extension = $notiPhones->getClientOriginalExtension();
            $store = Storage::disk('public')->put('notificationCsv/'.$notiPhones->getFilename().'.'.$extension,  File::get($notiPhones));
            $notiCsvPath = Storage::url($notiPhones).".".$extension;
        }


        dd($notiImagePath, $notiCsvPath);
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
