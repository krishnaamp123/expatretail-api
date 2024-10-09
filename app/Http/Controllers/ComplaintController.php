<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ComplaintResource;

class ComplaintController extends Controller
{
    public function index()
    {
        $customerId = auth()->id();
        $complaint = Complaint::where('id_customer', $customerId)->get();
        return ComplaintResource::collection($complaint);
    }

    public function show($id)
    {
        $complaint = Complaint::findOrFail($id);
        return new ComplaintResource($complaint);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_customer' => 'required',
            'complaint_date' => 'required',
            'production_code' => 'required',
            'description' => 'required',
        ]);

        $image = null;
        if($request->file){
            $filename = $this->generateRandomString();
            $extension = $request->file->extension();
            $image = $filename.'.'.$extension;

            Storage::putFileAs('public/image', $request->file, $image);
        }

        $request['image'] = $image;
        $complaint = Complaint::create($request->all());
        return new ComplaintResource($complaint);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_customer' => 'required',
            'complaint_date' => 'required',
            'production_code' => 'required',
            'description' => 'required',
        ]);

        $complaint = Complaint::findorFail($id);
        $complaint->update($request->all());
        return new ComplaintResource($complaint);
    }

    public function destroy($id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->delete();
        return response()->json(['message' => 'Complaint deleted successfully.'], 200);
    }

    function generateRandomString($length = 30) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
