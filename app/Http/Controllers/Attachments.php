<?php

namespace App\Http\Controllers;

use App\Attachments;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{

    public function upload(Request $request)
    {
       
        $path = 'attachments';
        $file = $request->file('file');
        $request->file->store($path);
     
    }

}