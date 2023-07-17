<?php

namespace App\Http\Controllers\Admin\Banner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    public function index(){
        return view('admin.banner.editbanner');
    }

    public function edit(Request $request){
//        dd($request);
        if ($request->get('url') != null){
            $request->validate([
                'url' => 'required',
            ]);
        }
        if ($request->get('banner') != null){
            $request->validate([
                'banner' => 'required|numeric',
            ]);
        }
        if ($request->get('content') != null){
            $request->validate([
                'content' => 'required',
            ]);
        }
        if ($request->get('url') != null){
            $affected = Banner::where('id', $request->get('banner'))
                ->update(['url' => $request->get('url')]);
        }
        if ($request->get('content') != null){
            $affected = Banner::where('id', $request->get('banner'))
                ->update(['content' => $request->get('content')]);
        }

        if ($request->image != null){
            $affected = Banner::where('id', $request->get('banner'))
                ->update(['image' => $request->image->getClientOriginalName()]);
            $file = $request->image->move('images', $request->image->getClientOriginalName());
        }

        return redirect()->back();
    }
}
