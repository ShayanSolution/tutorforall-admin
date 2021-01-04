<?php

namespace App\Http\Controllers;

use App\Helpers\Push;
use App\Models\Banner;
use App\Models\BannerStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
use File;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::orderBy('id', 'desc')->get();
        return view('admin.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
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
            'image' => 'required',
            'csv' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $urlImage = $this->saveImage($request);
        }
        if ($request->hasFile('csv')) {
            list($urlFile, $extension, $path) = $this->saveCsv($request);
        }
        //save Banner
        if ($urlImage && $urlFile){
            $storagePath = explode('.com', $urlImage);
            $banner = Banner::create([
                'text' => 'LINK',
                'hyperlink' => $request->url,
                'path' => $urlImage,
                'storage_path' => $storagePath[1],
                'send_to_csv' => $urlFile,
                'created_by' => Auth::user()->id,
            ]);
        }

        if ($extension == 'csv'){
            $this->sendBannerFromCsv($request,$path, $banner);
        }
        return redirect()->route('banners.index')->with('success','Banner sent');
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
        $saveImage = Storage::disk('public')->put('bannerImage/'.$fileNameToStore,  File::get($fileNameWithExtension));
        //get path
        $urlImage = Storage::disk('public')->url('bannerImage/'.$fileNameToStore);

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
        $saveFile = Storage::disk('public')->put('bannerCsv/'.$fileNameToStore,  File::get($fileNameWithExtension));
        //get path
        $urlFile = Storage::disk('public')->url($fileNameToStore);

        return [$urlFile, $extension, $path];
    }

    public function sendBannerFromCsv($request, $path, $banner){
        $data = array_map('str_getcsv', file($path));
        if (count($data) > 0) {
            unset($data[0]);
            foreach ($data as $item){
                $bannerStatusId = BannerStatus::create([
                    'banner_id' => $banner->id,
                    'receiver_id' => $item[0],
                    'read_status' => 0
                ])->id;
            }
        }
    }
}
