<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\Image;
use App\Models\Discription;

class WorkController extends Controller
{
    public function index(){
        $works = Work::all();
        return view('works',['works' => $works]);
    }

    public function show($id){
        $work = Work::find($id);
        return view('detail',['work' => $work]);
    }

    public function upload(Request $request){
        $path = $request->file('image')->store('images');
        $file_name = basename($path);
        $new_work = new Work();
        $new_work->save();

        $new_image = new Image();
        $new_image->work_id = $new_work->id;
        $new_image->number = 0;
        $new_image->filename = $file_name;

        $new_text = new Discription();
        $new_text->work_id = $new_work->id;
        $new_text->number = 0;
        $new_text->type = 0;
        $new_text->txt = $request->text;

        $new_image->save();
        $new_text->save();

        return redirect("works");
    }
    public function add(Request $request){
        if (isset($request->image)){
            $path = $request->file('image')->store('images');
            $file_name = basename($path);

            $new_image = new Image();
            $new_image->work_id = $request->id;
            $new_image->filename = $file_name;

            $max_num = Image::where('work_id',$request->id)->max('number') + 1;
            $new_image->number = $max_num;

            $new_image->save();
        }
        if (isset($request->text)){
            $new_text = new Discription();
            $new_text->txt = $request->text;
            $new_text->work_id = $request->id;
            $new_text->type = $request->type;

            $max_num = Discription::where('work_id',$request->id)->max('number') + 1;
            $new_text->number = $max_num;

            $new_text->save();
        }
        return redirect("/works/$request->id");
    }
    public function deletepost(Request $request){
        $num = $request->number;
        switch ($request->img_or_txt){
            case "img":
                $image = Image::where('work_id',$request->id)->where('number',$num)->first();
                $image->delete();
                break;

            case "txt":
                $discription = Discription::where('work_id',$request->id)->where('number',$num)->first();
                $discription->delete();
                break;
        }


        return redirect("/works/$request->id");
    }
    public function delete(Request $request){
        $work = Work::find($request->id);
        $work->delete();
        return redirect("/works");
    }
    public function edit(Request $request){
        $num = $request->number;
        $image = Image::where('work_id',$request->id)->where('number',$num)->first();
        $discription = Discription::where('work_id',$request->id)->where('number',$num)->first();
        if(!isset($image)){
            $image = new Image();
        }
        if(!isset($discription)){
            $discription = new Discription();
            $discription->work_id = $request->id;
            $discription->number = $num;
        }

        if (isset($request->image)){
            $file_name = basename($request->file('image')->store('images'));
            $image->filename = $file_name;
            $image->save();
        }
        if (isset($request->text)){
            $discription->txt = $request->text;
            $discription->type = $request->type;

            $discription->save();
        }

        return redirect("/works/$request->id");
    }

    //used in "/works" page
    public function update(Request $request){
        $image = Image::where('work_id',$request->id)->where('number',0)->first();
        $discription = Discription::where('work_id',$request->id)->where('number',0)->first();

        if (isset($request->image)){
            $file_name = basename($request->file('image')->store('images'));
            $image->filename = $file_name;
        }
        $discription->txt = $request->text;

        $image->save();
        $discription->save();

        return redirect("/works");
    }
}
