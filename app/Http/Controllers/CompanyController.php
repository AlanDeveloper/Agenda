<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $company = Company::orderBy('name', 'asc')->simplePaginate(25);
        return view('company.index', ['company' => $company]);
    }

    public function store()
    {
        return view('company.store');
    }

    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        return view('company.update', ['company' => $company]);
    }

    public function save(Request $request, $id = null)
    {
        try {
            if (isset($id)) {
                $method = 'PUT';
                Company::createLog('company', Company::find($id)->toArray(), $method, 'success');
                $company = Company::where('id', $id)->update($request->except(['_token', '_method']));
            } else {
                $method = 'POST';
                $company = Company::create($request->all());
                Company::createLog('company', $company->toArray(), $method, 'success');
            }
        } catch (\Exception $e) {
            Company::createLog('company', $e->getMessage(), $method, 'error');
            return redirect()->back()
                ->with('header', 'Error')
                ->with('message', 'Failed ' . ($method == 'POST' ? 'created' : 'updated') . ' with message "' . $e->getMessage() . '"')
                ->with('status', 'error')
                ->withInput();
        }
        return redirect()->route('company.index')
            ->with('header', 'Success')
            ->with('message', 'Successfully ' . ($method == 'POST' ? 'created' : 'updated'))
            ->with('status', 'success');
    }

    public function delete($id)
    {
        try {
            Company::createLog('company', Company::find($id)->toArray(), 'DELETE', 'success');
            Company::where('id', $id)->delete();
        } catch (\Exception $e) {
            Company::createLog('company', $e->getMessage(), 'DELETE', 'error');
            return redirect()->back()
                ->with('header', 'Error')
                ->with('message', 'Failed deleted with message "' . $e->getMessage() . '"')
                ->with('status', 'error');
        }
        return redirect()->route('company.index')
            ->with('header', 'Success')
            ->with('message', 'Successfully deleted')
            ->with('status', 'success');
    }
}
