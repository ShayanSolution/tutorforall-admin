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

        $newPath = public_path('temp/new.png');

        Storage::disk('public')->move($fileContents, $newPath);

        Storage::download($newPath, 'file.jpg');

        return redirect()->back();
    }
}
