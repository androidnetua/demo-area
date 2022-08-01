<?php

namespace App\Http\Controllers\Area;

use App\Http\Requests\SpecsGpuRequest;
use App\Http\Resources\SpecsGpuResource;
use App\Models\SpecsGpu;
use Illuminate\Support\Facades\Lang;

class SpecsGpuController extends SpecsController
{
    public function params()
    {
        return ['data' => Lang::get('specs.gpu')];
    }

    public function index()
    {
        return SpecsGpuResource::collection(SpecsGpu::with('vendor')->get());
    }

    public function store(SpecsGpuRequest $request)
    {
        $gpu = SpecsGpu::create([
            'vendor_id' => $request->vendor_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'data' => $request->data,
            'author_id' => auth()->id(),
        ]);

        return (new SpecsGpuResource($gpu))->additional([
            'message' => __('specs.gpu_created', ['gpu' => $gpu->name])
        ]);
    }

    public function show(SpecsGpu $device)
    {
        return new SpecsGpuResource($device);
    }

    public function update(SpecsGpuRequest $request, SpecsGpu $device)
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
            'message' => __('specs.gpu_updated', ['gpu' => $request->name])
        ]);
    }

    public function destroy(SpecsGpu $device)
    {
        $device->delete();

        return response()->json([
            'message' => __('specs.gpu_deleted', ['gpu' => $device->name])
        ]);
    }
}
