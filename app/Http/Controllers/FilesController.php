<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileClassifierSave;
use App\Models\FileClassifier;
use App\Traits\fileProcessesTrait;
use Illuminate\Support\Facades\Session;

class FilesController extends Controller
{
    use fileProcessesTrait;
    public function classifyFiles(FileClassifierSave $request)
    {
        foreach ($request->text_files as $file) {
            //detect language
            $lang = $this->detectFileLanguage($file);
            //save file to storage
            $fileData = $this->saveFile($file,$lang);
            //save file to database
            $stored_file = FileClassifier::create([
                'path'=>$fileData['path'],
                'lang'=>$lang,
                'name'=>$fileData['name'],
            ]);
            Session::flash('message','Saved successfully');
            return redirect()->back();
        }
    }

}
