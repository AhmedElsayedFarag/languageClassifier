<?php

namespace App\Traits;
use Illuminate\Support\Facades\File;
use LanguageDetection\Language;

trait fileProcessesTrait
{
    public function detectFileLanguage($file){
        //check file language
        $text = File::get($file->getRealPath());
        $language = new Language;
        $result = $language->detect($text)->close();
        $file_language = array_key_first($result);
        return $file_language;
    }
    public function saveFile($file, $file_language)
    {

        // Get filename with the extension
        $filenameWithExt = $file->getClientOriginalName();
        //Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $file->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
        // Upload file
        $path = $file->storeAs('language_files/' . $file_language, $fileNameToStore,'public');

        return [
            'name'=>$fileNameToStore,
            'path'=>'storage/'.$path, //to add full path to database
        ];
    }
}
