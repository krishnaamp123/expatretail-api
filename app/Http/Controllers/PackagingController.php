<?php

namespace App\Http\Controllers;

use App\Models\Packaging;
use Illuminate\Http\Request;
use App\Http\Resources\PackagingResource;

class PackagingController extends Controller
{
    public function index()
    {
        $packaging = Packaging::all();
        // return response()->json(['data' => $packaging]);
        return PackagingResource::collection($packaging);
    }

    public function show($id)
    {
        $packaging = Packaging::findOrFail($id);
        return new PackagingResource($packaging);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'packaging_name' => 'required|max:100',
            'weight' => 'required',
        ]);

        $packaging = Packaging::create($request->all());
        return new PackagingResource($packaging);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'packaging_name' => 'required|max:100',
            'weight' => 'required',
        ]);

        $packaging = Packaging::findorFail($id);
        $packaging->update($request->all());
        return new PackagingResource($packaging);
    }

    public function destroy($id)
    {
        $packaging = Packaging::findOrFail($id);
        $packaging->delete();
        return response()->json(['message' => 'Packaging deleted successfully.'], 200);
    }
}
