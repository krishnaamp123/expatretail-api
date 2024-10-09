<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Packaging;
use Illuminate\Support\Facades\Storage;

class AdminPackagingController extends Controller
{
    public function getPackaging()
    {
        return view('admin.packaging.index', [
            'packaging' => Packaging::latest()->get()
        ]);
    }

    public function addPackaging()
    {
        return view('admin.packaging.store');
    }

    public function storePackaging(Request $request)
    {
        $validated = $request->validate([
            'packaging_name' => 'required|max:100',
            'weight' => 'required',
        ]);

        Packaging::create([
            'packaging_name' => $request->packaging_name,
            'weight' => $request->weight,
        ]);

        return redirect()->route('getPackaging')->with('message', 'Data Added Successfully');
    }

    public function editPackaging($id)
    {
        $packaging = Packaging::findOrFail($id);

        return view('admin.packaging.update', compact('packaging'));
    }

    public function updatePackaging(Request $request, $id)
    {
        $packaging = Packaging::findOrFail($id);

        $validated = $request->validate([
            'packaging_name' => 'required|max:100',
            'weight' => 'required',
        ]);

        $packaging->packaging_name = $request->packaging_name;
        $packaging->weight = $request->weight;

        $packaging->save();

        return redirect()->route('getPackaging')->with('message', 'Packaging Updated Successfully');
    }

    public function destroyPackaging($id)
    {
        $packaging = Packaging::findOrFail($id);

        $packaging->delete();

        return redirect()->route('getPackaging')->with('message', 'Packaging deleted successfully');
    }

}
