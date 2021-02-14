<?php

namespace App\Http\Controllers\imageshare;

use App\Http\Controllers\Controller;
use App\Models\photoModles\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\File;
use  Intervention\Image\Exception\NotReadableException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;

use function PHPUnit\Framework\fileExists;

class ImageContoller extends Controller
{
    //
    public function getIndex()
    {
        $allimages=DB::table('photos')->paginate(1);
    
        return view('imageshare.index',['allimages'=>$allimages]);
    
    }
    public function addimage(){
        return view('imageshare.imageadd');
    }
    
    public function postIndex(Request $request){
        //return all messages from geterrorMSG func
        $messages = $this->geterrorMSG();
        
        $validation = validator::make($request->all(),Photo::$upload_rules,$messages);
        
        //$validation =  validator::make($request->all());
        if ($validation -> fails()){
           // $image= $request->file('image');
            
            //return $validation->errors();
            return redirect()->back()->withErrors($validation)->withInput();
        }
        else{
            $image= $request->file('image');
            //$thumbnail= Image::make($image);
            
            /*Here I used save image without using Intervention libaray
            $filename=$image->getClientOriginalName();
            $filename= pathinfo($filename,PATHINFO_FILENAME);
            //$fullname= time().'_'.$filename.'.'.$image->getClientOriginalExtension();
            $fullname=Str::slug(Str::random(8).$filename).'.'.$image->getClientOriginalExtension();
            $upload = $image->move('imageupload',$fullname);
            */
            
            // for save thumnail image
            $filename=$image->getClientOriginalName();
            $filename= pathinfo($filename,PATHINFO_FILENAME);
            $fullname=Str::slug(Str::random(8).$filename).'.'.$image->getClientOriginalExtension();
            $imagePath=public_path('imageupload')."/".$fullname;
            $thumbnailPath = public_path('thumbnail')."/".$fullname;
            $imageupload= Image::make($image->getRealPath())->save($imagePath);
            $thumbnailupload= Image::make($image->getRealPath())->resize(250,125)->save($thumbnailPath);
            

            if ( $imageupload && $thumbnailupload){
                $insetID=Photo::insertGetID([
                    'title' => $request->title,
                    'image' => $fullname
                ]);

                return redirect('imageshare/index')->with(['success'=>'Your Image and Thumbnail are uploaded ']);
            }
            else {
                return redirect('imageshare/index')->with(['error'=>'Your Image and Thumbnail are not uploaded ']);
            }

            
        }
        
    }

    //this method to return image with some info about it 
    public function getView($id){
        $imageinfo=Photo::find($id);
        if($imageinfo){
            return view('imageshare/imageshow',['imageinfo'=>$imageinfo]);
        }
        else{
            return redirect('imageshare/index')->with(['error'=>'The image not found']);
        }

    }
    public function deleteimage($id){
        $imagedel=photo::find($id);
        if($imagedel){
            $imagepath=public_path('imageupload')."/".$imagedel->image;
            $thumbnailPath=public_path('thumbnail')."/".$imagedel->image;
            unlink($imagepath);
            unlink($thumbnailPath);
            
            if( !file_exists($imagepath) && !file_exists($thumbnailPath))
            {
                $imagedel->delete();
                return redirect('imageshare/index')->with(['warning'=>"The image is deleted"]);
            }
         }

    }

    protected function geterrorMSG(){
        return $messages =[
        'title.required'=>'This fileld is required',
        'title.min'=>'You must insert 3 letters at least',
        'image.required'=>'This fileld is required',
        'image.image'=>'You can only upload image files',
        ]; 
    }
}
