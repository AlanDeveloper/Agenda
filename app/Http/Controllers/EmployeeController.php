<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employee = Employee::orderBy('name', 'asc')->simplePaginate(25);
        return view('employee.index', ['employee' => $employee]);
    }

    public function store()
    {
        $company = Company::orderBy('name', 'asc')->get();
        return view('employee.store', ['company' => $company]);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        $company = Company::orderBy('name', 'asc')->get();
        return view('employee.update', ['employee' => $employee, 'company' => $company]);
    }

    public function save(Request $request, $id = null)
    {
        try {
            if (isset($id)) {
                $method = 'PUT';
                Employee::createLog('employee', Employee::find($id)->toArray(), $method, 'success');
                $employee = Employee::where('id', $id)->update($request->except(['_token', '_method']));
            } else {
                $method = 'POST';
                $employee = Employee::create($request->all());
                Employee::createLog('employee', $employee->toArray(), $method, 'success');
            }
        } catch (\Exception $e) {
            Employee::createLog('employee', $e->getMessage(), $method, 'error');
            return redirect()->back()->with('error', 'Failed updated with message "' . $e->getMessage() . '"')->withInput();
        }
        return redirect()->route('employee.index')->with('status', 'Successfully updated');
    }

    public function delete($id)
    {
        try {
            Employee::createLog('employee', Employee::find($id)->toArray(), 'DELETE', 'success');
            Employee::where('id', $id)->delete();
        } catch (\Exception $e) {
            Employee::createLog('employee', $e->getMessage(), 'DELETE', 'error');
            return redirect()->back()->with('error', 'Failed deleted with message "' . $e->getMessage() . '"');
        }
        return redirect()->route('employee.index')->with('status', 'Successfully deleted');
    }
}
