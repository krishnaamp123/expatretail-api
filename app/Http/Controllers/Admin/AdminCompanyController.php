<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class AdminCompanyController extends Controller
{
    public function getCompany()
    {
        return view('admin.company.index', [
            'company' => Company::latest()->get()
        ]);
    }

    public function addCompany()
    {
        return view('admin.company.store');
    }

    public function storeCompany(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|max:100',
        ]);

        Company::create([
            'company_name' => $request->company_name,
        ]);

        return redirect()->route('getCompany')->with('message', 'Data Added Successfully');
    }

    public function editCompany($id)
    {
        $company = Company::findOrFail($id);

        return view('admin.company.update', compact('company'));
    }

    public function updateCompany(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $validated = $request->validate([
            'company_name' => 'required|max:100',
        ]);

        $company->company_name = $request->company_name;

        $company->save();

        return redirect()->route('getCompany')->with('message', 'Company Updated Successfully');
    }

    public function destroyCompany($id)
    {
        $company = Company::findOrFail($id);

        $company->delete();

        return redirect()->route('getCompany')->with('message', 'Company deleted successfully');
    }

}
