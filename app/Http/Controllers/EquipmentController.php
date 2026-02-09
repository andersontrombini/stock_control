<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Exports\EquipmentsExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipments = Equipment::all();

        return view('equipments.index', [
            'equipments' => $equipments,
        ]);
    }

    public function create()
    {
        return view('equipments.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
        ]);

        Equipment::create($validated);

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $equipment = Equipment::findOrFail($id);

        return view('equipments.edit', compact('equipment'));
    }

    public function update(Request $request, $id)
    {
        $equipment = Equipment::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'status' => 'required|string|in:active,inactive',
        ]);

        $equipment->update($validated);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $equipment = Equipment::findOrFail($id);

        $equipment->delete();

        return response()->json(['success' => true]);
    }

    public function export()
{
    $mesAno = Carbon::now()->format('m-Y');

    return Excel::download(
        new EquipmentsExport,
        "estoque__{$mesAno}.xlsx"
    );
}
}
