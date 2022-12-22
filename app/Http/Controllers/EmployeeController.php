<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index()
    {
        $company_name = DB::raw('(SELECT name FROM company WHERE company.id = employee.company_id) AS company_name');
        $employee = Employee::select('employee.*', $company_name)->orderBy('name', 'asc')->simplePaginate(25);
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
            return redirect()->back()
                ->with('header', 'Error')
                ->with('message', 'Failed ' . ($method == 'POST' ? 'created' : 'updated') . ' with message "' . $e->getMessage() . '"')
                ->with('status', 'error')
                ->withInput();
        }
        return redirect()->route('employee.index')
            ->with('header', 'Success')
            ->with('message', 'Successfully ' . ($method == 'POST' ? 'created' : 'updated'))
            ->with('status', 'success');
    }

    public function delete($id)
    {
        try {
            Employee::createLog('employee', Employee::find($id)->toArray(), 'DELETE', 'success');
            Employee::where('id', $id)->delete();
        } catch (\Exception $e) {
            Employee::createLog('employee', $e->getMessage(), 'DELETE', 'error');
            return redirect()->back()
                ->with('header', 'Error')
                ->with('message', 'Failed deleted with message "' . $e->getMessage() . '"')
                ->with('status', 'error');
        }
        return redirect()->route('employee.index')
            ->with('header', 'Success')
            ->with('message', 'Successfully deleted')
            ->with('status', 'success');
    }
}
