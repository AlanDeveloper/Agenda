<?php

namespace App\Http\Controllers;

use App\Models\Solicitation;
use App\Models\TypeSolicitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SolicitationController extends Controller
{
    public function index()
    {
        $type_solicitation_name = DB::raw('(SELECT name FROM type_solicitation WHERE type_solicitation.id = solicitation.type_id) AS type_solicitation_name');
        $solicitation = Solicitation::select('solicitation.*', $type_solicitation_name)->orderBy('title', 'asc')->simplePaginate(25);
        return view('solicitation.index', ['solicitation' => $solicitation]);
    }

    public function store()
    {
        $type_solicitation = TypeSolicitation::orderBy('name', 'asc')->get();
        return view('solicitation.store', ['type_solicitation' => $type_solicitation]);
    }

    public function update(Request $request, $id)
    {
        $solicitation = Solicitation::find($id);
        $type_solicitation = TypeSolicitation::orderBy('name', 'asc')->get();
        return view('solicitation.update', ['solicitation' => $solicitation, 'type_solicitation' => $type_solicitation]);
    }

    public function save(Request $request, $id = null)
    {
        try {
            if (isset($id)) {
                $method = 'PUT';
                Solicitation::createLog('solicitation', Solicitation::find($id)->toArray(), $method, 'success');
                $solicitation = Solicitation::where('id', $id)->update($request->except(['_token', '_method']));
            } else {
                $method = 'POST';
                $solicitation = Solicitation::create($request->all());
                Solicitation::createLog('solicitation', $solicitation->toArray(), $method, 'success');
            }
        } catch (\Exception $e) {
            Solicitation::createLog('solicitation', $e->getMessage(), $method, 'error');
            return redirect()->back()
                ->with('header', 'Error')
                ->with('message', 'Failed ' . ($method == 'POST' ? 'created' : 'updated') . ' with message "' . $e->getMessage() . '"')
                ->with('status', 'error')
                ->withInput();
        }
        return redirect()->route('solicitation.index')
            ->with('header', 'Success')
            ->with('message', 'Successfully ' . ($method == 'POST' ? 'created' : 'updated'))
            ->with('status', 'success');
    }

    public function delete($id)
    {
        try {
            Solicitation::createLog('solicitation', Solicitation::find($id)->toArray(), 'DELETE', 'success');
            Solicitation::where('id', $id)->delete();
        } catch (\Exception $e) {
            Solicitation::createLog('solicitation', $e->getMessage(), 'DELETE', 'error');
            return redirect()->back()
                ->with('header', 'Error')
                ->with('message', 'Failed deleted with message "' . $e->getMessage() . '"')
                ->with('status', 'error');
        }
        return redirect()->route('solicitation.index')
            ->with('header', 'Success')
            ->with('message', 'Successfully deleted')
            ->with('status', 'success');
    }
}
