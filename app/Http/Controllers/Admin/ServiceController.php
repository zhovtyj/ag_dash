<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Session;
use Storage;
use App\Service;
use App\ServiceSubscription;
use App\Category;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.service.index')->withServices($services);
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.service.create')->withCategories($categories);
    }

    public function store(Request $request)
    {
        $service = New Service;

        $service->name = $request->name;
        $service->category_id = $request->category_id;
        $service->price = $request->price;
        $service->old_price = $request->old_price;
        $service->short_description = $request->short_description;
        $service->description = $request->description;
        if ($request->active == 'checked'){
            $service->active = 1;
        }
        else{
            $service->active = 0;
        }

        if ($request->hasfile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('upload_images/services/'.$filename);
            $img = Image::make($image);
            $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($location);

            $service->image = $filename;
        }

        $service->save();

        //Subscription
        if(isset($service->serviceSubscription)){
            if($request->subscription == 1){
                $service->serviceSubscription()->save();
            }
            else{
                $service->serviceSubscription()->delete();
            }
        }
        elseif($request->subscription == 1){
            $serviceSubscription = new ServiceSubscription;
            $serviceSubscription->service()->associate($service);
            $serviceSubscription->save();
        }

        Session::flash('success', 'Service created successfully');

        return redirect()->route('service.show', $service->id);
    }

    public function show($id)
    {
        $service = Service::find($id);
        return view('admin.service.show')->withService($service);
    }

    public function edit($id)
    {
        $service = Service::find($id);
        $categories = Category::all();
        return view('admin.service.edit')->withService($service)->withCategories($categories);
    }

    public function update(Request $request, $id)
    {
        $service = Service::find($id);

        $service->name = $request->name;
        $service->category_id = $request->category_id;
        $service->price = $request->price;
        if(!$request->old_price){
            $service->old_price = $request->price;
        }
        else{
            $service->old_price = $request->old_price;
        }
        $service->short_description = $request->short_description;
        $service->description = $request->description;
        if ($request->active == 'checked'){
            $service->active = 1;
        }
        else{
            $service->active = 0;
        }

        if ($request->hasfile('image')){
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('upload_images/services/'.$filename);
            $img = Image::make($image);
            $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($location);

            $service->image = $filename;
        }

        $service->save();

        //Subscription
        if(isset($service->serviceSubscription)){
            if($request->subscription == 1){
                $service->serviceSubscription->save();
            }
            else{
                $service->serviceSubscription->delete();
            }
        }
        elseif($request->subscription == 1){
            $serviceSubscription = new ServiceSubscription;
            $serviceSubscription->service()->associate($service);
            $serviceSubscription->save();
        }

        Session::flash('success', 'Service updated successfully');

        return redirect()->route('service.show', $service->id);
    }

    public function destroy($id)
    {
        $service = Service::find($id);

        $location = public_path('upload_images\services\\'.$service->image);

        Storage::delete($location);

        $service->delete();

        Session::flash('success', 'Service was deleted!');

        return redirect()->route('service.index');
    }
}
