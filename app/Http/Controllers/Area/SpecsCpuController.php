<?php

namespace App\Http\Controllers\Area;

use App\Http\Requests\SpecsCpuRequest;
use App\Http\Resources\SpecsCpuResource;
use App\Models\SpecsCpu;
use Illuminate\Support\Facades\Lang;

class SpecsCpuController extends SpecsController
{
    public function params()
    {
        return ['data' => Lang::get('specs.cpu')];
    }

    public function index()
    {
        return SpecsCpuResource::collection(SpecsCpu::with('vendor')->get());
    }

    public function store(SpecsCpuRequest $request)
    {
        $cpu = SpecsCpu::create([
            'vendor_id' => $request->vendor_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'data' => $request->data,
            'author_id' => auth()->id(),
        ]);

        return (new SpecsCpuResource($cpu))->additional([
            'message' => __('specs.cpu_created', ['cpu' => $cpu->name])
        ]);
    }

    public function show(SpecsCpu $device)
    {
        return new SpecsCpuResource($device);
    }

    public function update(SpecsCpuRequest $request, SpecsCpu $device)
    {
        $data = [
            'vendor_id' => $request->vendor_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'data' => $request->data,
            'author_id' => auth()->id(),
        ];

        $device->update($data);

        return response()->json([
            'message' => __('specs.cpu_updated', ['cpu' => $request->name])
        ]);
    }

    public function destroy(SpecsCpu $device)
    {
        $device->delete();

        return response()->json([
            'message' => __('specs.cpu_deleted', ['cpu' => $device->name])
        ]);
    }
}
