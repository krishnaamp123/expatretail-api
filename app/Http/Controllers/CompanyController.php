<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Resources\CompanyResource;

class CompanyController extends Controller
{
    public function index()
    {
        $company = Company::all();
        // return response()->json(['data' => $company]);
        return CompanyResource::collection($company);
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);
        return new CompanyResource($company);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|max:100',
        ]);

        $company = Company::create($request->all());
        return new CompanyResource($company);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'company_name' => 'required|max:100',
        ]);

        $company = Company::findorFail($id);
        $company->update($request->all());
        return new CompanyResource($company);
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return response()->json(['message' => 'Company deleted successfully.'], 200);
    }
}
