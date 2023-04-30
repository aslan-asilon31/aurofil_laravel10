<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TravelPackage;

use Illuminate\Support\Facades\Storage;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class TravelPackageController extends Controller
{
    
    public function index()
    {
        $travelpackages = TravelPackage::latest()->paginate(10);
        return view('pages.admin.travel-package.index', compact('travelpackages'));
    }

    public function create()
    {
        return view('pages.admin.travel-package.create');
    }

    public function show()
    {

    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'image'      => 'required|image|mimes:png,jpg,jpeg',
            'title'     => 'required',
            'slug'     => 'required',
            'location'     => 'required',
            'about'     => 'required',
            'featured_event'     => 'required',
            'language'     => 'required',
            'foods'     => 'required',
            'departure_date'     => 'required',
            'duration'     => 'required',
            'type'     => 'required',
            'price'     => 'required',
        ]);

            //upload image
            $image = $request->file('image');
            $image->storeAs('public/travelpackages', $image->hashName());

        $travelpackage = TravelPackage::create([
            'image'                  => $image->hashName(),
            'title'          => $request->title,
            'slug'          => $request->slug,
            'location'        => $request->location,
            'about'          => $request->about,
            'featured_event'     => $request->featured_event,
            'language'         => $request->language,
            'foods'              => $request->foods,
            'departure_date'     => $request->departure_date,
            'duration'            => $request->duration,
            'type'            => $request->type,
            'price'            => $request->price,
        ]);

        if($travelpackage){
            //redirect dengan pesan sukses
            return redirect()->route('travelpackage.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('travelpackage.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

        public function edit(TravelPackage $travelpackage)
    {
        return view('pages.admin.travel-package.edit', compact('travelpackage'));
    }



    public function update(Request $request, TravelPackage $travelpackage)
    {
        $this->validate($request, [
            'title'     => 'required',
            'slug'     => 'required',
            'location'     => 'required',
            'about'     => 'required',
            'featured_event'     => 'required',
            'language'     => 'required',
            'foods'     => 'required',
            'departure_date'     => 'required',
            'duration'     => 'required',
            'type'     => 'required',
            'price'     => 'required',
        ]);

        //get data travelpackage by ID
        $travelpackage = TravelPackage::findOrFail($travelpackage->id);

        if($request->file('image') == "") {


            $travelpackage->update([
                'title'     => $request->title,
                'slug'     => $request->slug,
                'location'     => $request->location,
                'about'     => $request->about,
                'featured_event'     => $request->featured_event,
                'language'     => $request->language,
                'foods'     => $request->foods,
                'departure_date'     => $request->departure_date,
                'duration'     => $request->duration,
                'type'     => $request->type,
                'price'     => $request->price,
            ]);

        } else {

            //hapus old image
            Storage::disk('local')->delete('public/travelpackages/'.$travelpackage->image);

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/travelpackages/', $image->hashName());

            $travelpackage->update([

                'image'     => $request->image,
                'title'     => $request->title,
                'slug'     => $request->slug,
                'location'     => $request->location,
                'about'     => $request->about,
                'featured_event'     => $request->featured_event,
                'language'     => $request->language,
                'foods'     => $request->foods,
                'departure_date'     => $request->departure_date,
                'duration'     => $request->duration,
                'type'     => $request->type,
                'price'     => $request->price,
            ]);

        }

        if($travelpackage){
            //redirect dengan pesan sukses
            return redirect()->route('travelpackage.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('travelpackage.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

        public function destroy($id)
    {
        $travelpackage = TravelPackage::findOrFail($id);
        $travelpackage->delete();

            if($travelpackage){
                //redirect dengan pesan sukses
                return redirect()->route('travelpackage.index')->with(['success' => 'Data Berhasil Dihapus!']);
            }else{
                //redirect dengan pesan error
                return redirect()->route('travelpackage.index')->with(['error' => 'Data Gagal Dihapus!']);
            }
    }
}
