<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentsController extends Controller
{
    public function downloadDoc($id){
        $doc = Document::find($id);

        if(!$doc)
            return redirect()->back()->with('error', 'No document found!');

        $fileContents = file_get_contents($doc->path);


        /* Source File URL */
        $remote_file_url = $doc->path;

        /* New file name and path for this file */
        $local_file = '/new.png';

        /* Copy the file from source url to server */
        $copy = copy( $remote_file_url, $local_file );

        /* Add notice for success/failure */
        if( !$copy ) {
            return "Doh! failed to copy $remote_file_url...\n";
        }
        else{
            return "WOOT! success to copy $remote_file_url...\n";
        }




//        $newPath = public_path('/temp/new.png');
//
//        Storage::disk('public')->move($fileContents, $newPath);
//
//        Storage::download($newPath, 'file.jpg');

        return redirect()->back();
    }
}
