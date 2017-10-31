<?php

namespace App\Http\Controllers;

use App\Presaleupload;
use Illuminate\Http\Response as Responses;
use Response;
/*use Illuminate\Http\Request;*/

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request as Requestes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    // -----------------------------view------------------------------//
	public function index(){
        $imageupload = Presaleupload::all();
        return Response::json([
                'data' => $this->transformCollection($imageupload)
        ], 200);
	}

     private function transform($image){
         return [
            'mime' => $image['mime'],
            'original_filename' => $image['original_filename'],
            'filename' => $image['filename'],
            'presale_no' => $image['presale_no'],

        ];
    }
    private function transformCollection($image){
        return array_map([$this, 'transform'], $image->toArray());
    }
 
	  public function show($id)
    {
        $entry = Presaleupload::where('filename', '=', $id)->firstOrFail();
        $file = Storage::disk('local')->get($entry->filename);
 
        return (new Responses($file, 200))
              ->header('Content-Type', $entry->mime);
    }

     public function add(Request $request) {
 
        // $file = Request::file('filefield');
        // // return $file->getClientOriginalName();
        // // $extension = $file->getClientOriginalExtension();
        // Storage::disk('local')->put($file->getClientOriginalName(),  File::get($file));
        // $entry = new Presaleupload();
        // $entry->mime = $file->getClientMimeType();
        // $entry->presale_no = $request->presale_no;
        // $entry->original_filename = $file->getClientOriginalName();
        // $entry->filename = $file->getClientOriginalName();
        
 
        // $entry->save();

        $file = Input::file('image');

        $input = array('image' => $file);
        $mime = array('image' => 'jpeg, png, jpg, gif, pdf, application/vnd.ms-excel' );
        $rules = array( 'image' => 'image');
        $validator = Validator::make($input, $rules, $mime);


        $image = new Presaleupload();
        $image->mime = $file->getClientMimeType();
        $image->original_filename = $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();

        $originalNameWithoutExt = $image->original_filename;
        
        $image->filename = $this->sanitize($originalNameWithoutExt);
        
        $allowedName = $this->createUniqueFilename($image->filename,$ext);
        $filenameExt = $allowedName;
        
        $image->presale_no = $request->input('presale_no');
        $image->save();
        $uploadSuccess = Storage::disk('local')->put('/'.$filenameExt, File::get($file));
       
        return Response::json([
                'message' => 'Joke Created Succesfully',
                'filename'=> $filenameExt
        ]);
 
        // return redirect('fileentry');
        
    }

    public function createUniqueFilename($filename)
    {
        if (Storage::exists('public'.$filename.'.jpg'))
        {
            $imageToken = substr(sha1(mt_rand()), 0, 5);
            return $filename . '-' . $imageToken;
        }
        return $filename;
    }
    public function sanitize($string, $force_lowercase = true, $anal = false)
    {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ">", "/", "?");
        //, "."
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }





    // public function get($filename){
      
    //     $entry = Presaleupload::where('filename', '=', $filename)->firstOrFail();
    //     $file = Storage::disk('local')->get($entry->filename);
 
    //     return (new Response($file, 200))
    //           ->header('Content-Type', $entry->mime);
    // }

}
