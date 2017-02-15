<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Service;
use App\ServiceOptional;
use App\ServiceOptionalDescription;

class ServiceOptionalController extends Controller
{

    public function index()
    {
        $serviceOptionals = ServiceOptional::all();
        return view('admin.serviceOptional.index')->withServiceoptionals($serviceOptionals);
    }

    public function create()
    {
        $services = Service::all();
        return view('admin.serviceOptional.create')->withServices($services);
    }

    public function store(Request $request)
    {
        $serviceOptional = new ServiceOptional;

        $serviceOptional->name = $request->name;
        $serviceOptional->service_id = $request->service_id;
        $serviceOptional->save();


        for($i=0; $i < count($request->description); $i++){
            $serviceOptionalDescription = new ServiceOptionalDescription;

            $serviceOptionalDescription->serviceOptional()->associate($serviceOptional);
            $serviceOptionalDescription->description = $request->description[$i];
            $serviceOptionalDescription->price = $request->price[$i];
            $serviceOptionalDescription->save();
        }

        Session::flash('success', 'Optional Service created successfully!');

        return redirect()->route('service-optional.index');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $services = Service::all();
        $serviceOptional = ServiceOptional::find($id);
        return view('admin.serviceOptional.edit')->withServiceoptional($serviceOptional)->withServices($services);
    }

    public function update(Request $request, $id)
    {
        $serviceOptional = ServiceOptional::find($id);

        $serviceOptional->name = $request->name;
        $serviceOptional->service_id = $request->service_id;
        $serviceOptional->save();
        $serviceOptional->serviceOptionalDescriptions()->delete();


        for($i=0; $i < count($request->description); $i++){
            $serviceOptionalDescription = new ServiceOptionalDescription;

            $serviceOptionalDescription->serviceOptional()->associate($serviceOptional);
            $serviceOptionalDescription->description = $request->description[$i];
            $serviceOptionalDescription->price = $request->price[$i];
            $serviceOptionalDescription->save();
        }

        Session::flash('success', 'Optional Service created successfully!');

        return redirect()->route('service-optional.index');
    }

    public function destroy($id)
    {
        $serviceOptional = ServiceOptional::find($id);
        $serviceOptional->serviceOptionalDescriptions()->delete();
        $serviceOptional->delete();

        Session::flash('success', 'Optional Service was deleted!');

        return redirect()->route('service-optional.index');
    }
}
