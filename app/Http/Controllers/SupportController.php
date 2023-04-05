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

    public function edit(Support $support, string|int $id)
    {
        if(!$support = Support::find($id)) {
            return back();
        }

        return view('admin/supports.edit', compact('support'));
    }

    public function update(Request $request, Support $support, string $id)
    {
        if(!$support = Support::find($id)) {
            return back();
        }

        $support->update($request->only([
            'subject', 'body'
        ]));

        return redirect()->route('supports.index');
    }

    public function destroy(string|int $id)
    {
        if(!$support = Support::find($id)) {
            return back();
        }

        $support->delete();

        return redirect()->route('supports.index');
    }
}
