<?php

namespace App\Http\Controllers;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Http\Requests\StoreUpdateSupport;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function __construct(
        protected SupportService $service
    ) {}

    public function index(Request $request)
    {
        $supports = $this->service->getAll($request->filter);

        return view('admin/supports/index', compact('support'));
    }

    public function show(string $id)
    {
        // $support = Support::find($id)
        // $support = Support::where('id', $id)->first();
        // $support = Support::where('id', '!=', $id)->first();

        if(!$support = $this->service->findOne($id)) {
            return redirect()->back();
        }

        return view('admin/supports/show', compact('support'));
    }

    public function create()
    {
        return view('admin/supports/create');
    }

    public function store(StoreUpdateSupport $request , Support $support)
    {
        $this->service->new(
            CreateSupportDTO::makeFromRequest($request)
        );

        return redirect()->route('supports.index');
    }

    public function edit(Support $support, string|int $id)
    {
        //if(!$support = Support::find($id)) {
        if(!$support = $this->service->findOne($id)) {
            return back();
        }

        return view('admin/supports.edit', compact('support'));
    }

    public function update(StoreUpdateSupport $request, Support $support)
    {
        $support = $this->service->update(
            UpdateSupportDTO::makeFromRequest($request)
        );
        
        if(!$support) {
            return back();
        }

        return redirect()->route('supports.index');
    }

    public function destroy(string|int $id)
    {
        $this->service->delete($id);

        return redirect()->route('supports.index');
    }
}
