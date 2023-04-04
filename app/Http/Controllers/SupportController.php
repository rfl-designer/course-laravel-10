<?php

namespace App\Http\Controllers;

use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index(Support $support)
    {
        $supports = $support->all();

        return view('admin/supports/index', [
            'supports' => $supports
        ]);
    }

    /**
     * @param $id = string | int
     */
    public function show($id)
    {
        // $support = Support::find($id)
        // $support = Support::where('id', $id)->first();
        // $support = Support::where('id', '!=', $id)->first();

        if(!$support = Support::find($id)) {
            return redirect()->back();
        }

        return view('admin/supports/show', compact('support'));
    }

    public function create()
    {
        return view('admin/supports/create');
    }

    public function store(Request $request, Support $support)
    {
        $data = $request->all();
        $data['status'] = 'a';
        
        $support->create($data);

        return redirect()->route('supports.index');
    }
}
