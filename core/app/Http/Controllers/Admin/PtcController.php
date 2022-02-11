<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ptc;

class PtcController extends Controller
{

    public function index()
    {
        $page_title = 'PTC Ads';
        $empty_message = 'No Ads Created Yet.';
        $ptcs = Ptc::latest()->paginate(getPaginate());
        return view('admin.ptc.index', compact('page_title', 'empty_message', 'ptcs'));
    }

    public function create()
    {
        $page_title = 'Create New PTC Ad';
        return view('admin.ptc.create', compact('page_title'));
    }


    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'ads_type' => 'required|numeric',
            'amount' => 'required|numeric|min:0',
            'duration' => 'required|numeric|min:1',
            'max_show' => 'required|numeric|min:1',
            'website_link' => 'nullable|url|required_without_all:banner_image,script',
            'banner_image' => 'nullable|mimes:jpeg,jpg,png,gif|required_without_all:website_link,script',
            'script' => 'nullable|required_without_all:website_link,banner_image',
        ]);

        $ptc = new Ptc();
        $ptc->title = $request->title;
        $ptc->amount = $request->amount;
        $ptc->duration = $request->duration;
        $ptc->max_show = $request->max_show;
        $ptc->remain = $request->max_show;
        $ptc->ads_type = $request->ads_type;
        $ptc->status = isset($request->status) ? 1:0;

            if($request->ads_type == 1){
                $ptc->ads_body = $request->website_link;
            }elseif($request->ads_type == 2){

                if ($request->hasFile('banner_image')) {
                    try {
                        $directory = date("Y")."/".date("m")."/".date("d");
                        $path = 'assets/images/ptcimages/'.$directory;
                        $filename = $directory.'/'.uploadImage($request->banner_image,$path);
                    } catch (\Exception $exp) {
                        $notify[] = ['error', 'Image Could not be uploaded.'];
                        return back()->withNotify($notify);
                    }
                $ptc->ads_body = $filename;
                }
            }else{
                $ptc->ads_body = $request->script;
            }

        $ptc->save();

        $notify[] = ['success', 'New PTC ad has been added successfully.'];
        return back()->withNotify($notify);
    }

    public function edit($id)
    {
        $page_title = 'Edit PTC Ad';
        $ptc = Ptc::findOrFail($id);
        return view('admin.ptc.edit', compact('page_title','ptc','id'));
    }


    public function update(Request $request, $id) {


        $request->validate([
            'title' => 'required',
            'ads_type' => 'required|numeric',
            'amount' => 'required|numeric|min:0',
            'duration' => 'required|numeric|min:1',
            'max_show' => 'required|numeric|min:1',
        ]);

        $ptc = Ptc::findOrFail($id);
        $ptc->title = $request->title;
        $ptc->amount = $request->amount;
        $ptc->duration = $request->duration;
        $ptc->max_show = $request->max_show;
        $ptc->remain = $request->max_show - $ptc->showed;
        $ptc->ads_type = $request->ads_type;
        $ptc->status = isset($request->status) ? 1:0;

            if($request->ads_type == 1){
                $ptc->ads_body = $request->website_link;
            }elseif($request->ads_type == 2){
                $filename = $ptc->ads_body;
                if ($request->hasFile('banner_image')) {
                    try {
                        $old = $ptc->ads_body;
                        $directory = date("Y")."/".date("m")."/".date("d");
                        $path = 'assets/images/ptcimages/'.$directory;
                        removeFile('assets/images/ptcimages/'.$old);
                        $filename = $directory.'/'.uploadImage($request->banner_image,$path);
                    } catch (\Exception $exp) {
                        $notify[] = ['error', 'Image Could not be uploaded.'];
                        return back()->withNotify($notify);
                    }
                }
                $ptc->ads_body = $filename;
            }else{
                $ptc->ads_body = $request->script;
            }



        $ptc->save();

        $notify[] = ['success', 'PTC ad has been updated successfully.'];
        return back()->withNotify($notify);
    }


}
