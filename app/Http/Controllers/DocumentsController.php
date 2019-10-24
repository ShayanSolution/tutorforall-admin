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

        Storage::download($doc->path, 'file.jpg');

        return redirect()->back();
    }
}
