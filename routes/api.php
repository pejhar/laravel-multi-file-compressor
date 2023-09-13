<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Models\CompressedFileEnums;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('folder/compress', function (Request $request) {
    $folderName = strtoupper(md5(time().uniqid(rand(1111,9999),true)));
    $path = public_path($folderName.'/');
    if(!File::isDirectory($path)){
        File::makeDirectory($path, 0777, true, true);
    }
    return response($folderName, 201);

});

Route::post('file/upload', function (Request $request) {
    if($request->has('folder_name'))
    {
        if($request->hasFile('file'))
        {
            if ($request->file('file')->isValid())
            {
                $file              = $request->file('file');
                $orginal_file_name = $file->getClientOriginalName();
                $extension         = $file->getClientOriginalExtension();
                $fileName          = $orginal_file_name;
                $path = public_path($request->input('folder_name').'/');

                $uploadSuccess = $file->move($path,$fileName,$extension);
                if(!$uploadSuccess)
                    return abort(422, 'File was not uploaded');

                return response('file uploaded.', 200);
            }return abort(422, 'File is not valid');
        }return abort(422, 'File does not exist');
    }return abort(422, 'Folder Name does not exist');
});

Route::get('file/compress', function (Request $request) {
    if ($request->has('file_name') && $request->has('file_type')) {
        $zip = new ZipArchive;
        $fileName = $request->input('file_name').$request->input('file_type');
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
        {
            $files = File::files(public_path($request->input('file_name').'/'));
            if($files == []){
                return abort(422, 'Compressed file is empty!');
            }
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }
            $zip->close();
        }
        return response()->download(public_path($fileName));
    } return abort(422, 'File name or File type is empty');
});
