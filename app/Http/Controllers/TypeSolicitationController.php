<?php

namespace App\Http\Controllers;

use App\Models\TypeSolicitation;
use Illuminate\Http\Request;

class TypeSolicitationController extends Controller
{
    public function index()
    {
        $type_solicitation = TypeSolicitation::orderBy('name', 'asc')->simplePaginate(25);
        return view('type_solicitation.index', ['type_solicitation' => $type_solicitation]);
    }

    public function store()
    {
        return view('type_solicitation.store');
    }

    public function update(Request $request, $id)
    {
        $type_solicitation = TypeSolicitation::find($id);
        return view('type_solicitation.update', ['type_solicitation' => $type_solicitation]);
    }

    public function save(Request $request, $id = null)
    {
        try {
            if (isset($id)) {
                $method = 'PUT';
                TypeSolicitation::createLog('type_solicitation', TypeSolicitation::find($id)->toArray(), $method, 'success');
                $type_solicitation = TypeSolicitation::where('id', $id)->update($request->except(['_token', '_method']));
            } else {
                $method = 'POST';
                $type_solicitation = TypeSolicitation::create($request->all());
                TypeSolicitation::createLog('type_solicitation', $type_solicitation->toArray(), $method, 'success');
            }
        } catch (\Exception $e) {
            TypeSolicitation::createLog('type_solicitation', $e->getMessage(), $method, 'error');
            return redirect()->back()
                ->with('header', 'Error')
                ->with('message', 'Failed ' . ($method == 'POST' ? 'created' : 'updated') . ' with message "' . $e->getMessage() . '"')
                ->with('status', 'error')
                ->withInput();
        }
        return redirect()->route('type_solicitation.index')
            ->with('header', 'Success')
            ->with('message', 'Successfully ' . ($method == 'POST' ? 'created' : 'updated'))
            ->with('status', 'success');
    }

    public function delete($id)
    {
        try {
            TypeSolicitation::createLog('type_solicitation', TypeSolicitation::find($id)->toArray(), 'DELETE', 'success');
            TypeSolicitation::where('id', $id)->delete();
        } catch (\Exception $e) {
            TypeSolicitation::createLog('type_solicitation', $e->getMessage(), 'DELETE', 'error');
            return redirect()->back()
                ->with('header', 'Error')
                ->with('message', 'Failed deleted with message "' . $e->getMessage() . '"')
                ->with('status', 'error');
        }
        return redirect()->route('type_solicitation.index')
            ->with('header', 'Success')
            ->with('message', 'Successfully deleted')
            ->with('status', 'success');
    }
}
