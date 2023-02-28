<?php

namespace App\Http\Controllers;

use Domains\File\Models\FileLink;
use Domains\File\Support\FileManager;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileController extends Controller
{
    public function file(Request $request, FileManager $fileManage, FileLink $fileLink): StreamedResponse|bool|string
    {
        $file = $fileManage->downloadFile($fileLink);

        if(!$file) {
            return 'Файл уже скачен';
        }

        return $file;
    }
}
