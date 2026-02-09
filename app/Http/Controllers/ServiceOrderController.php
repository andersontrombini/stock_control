<?php

namespace App\Http\Controllers;

use App\Models\ServiceOrder;
use App\Models\Technical;
use Illuminate\Http\Request;
use App\Exports\ServiceOrdersExport;
use Maatwebsite\Excel\Facades\Excel;

class ServiceOrderController extends Controller
{
    public function index()
    {
        $serviceOrders = ServiceOrder::orderBy('created_at', 'desc')->get();

        return view('service_orders.index', [
            'serviceOrders' => $serviceOrders,
        ]);
    }

    public function create()
    {
        $technicials = Technical::all();
        return view('service_orders.create', compact('technicials'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_address' => 'required|string|max:500',
            'client_plan' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'description' => 'nullable|string',
            'status' => 'required|string|in:open,in_progress,closed',
            'technicial_id' => 'required|exists:technical,id',
        ]);

        ServiceOrder::create($validated);

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        $technicials = Technical::all();
        $serviceOrder = ServiceOrder::findOrFail($id);

        return view('service_orders.edit', compact('serviceOrder', 'technicials'));
    }

    public function update(Request $request, $id)
    {
        $serviceOrder = ServiceOrder::findOrFail($id);

        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_address' => 'required|string|max:500',
            'client_plan' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'description' => 'nullable|string',
            'status' => 'required|string|in:open,in_progress,closed',
            'technicial_id' => 'required|exists:technical,id',
        ]);

        $serviceOrder->update($validated);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $serviceOrder = ServiceOrder::findOrFail($id);

        $serviceOrder->delete();

        return response()->json(['success' => true]);
    }

    public function equipments(ServiceOrder $serviceOrder)
    {
        // ajuste o relacionamento conforme seu model
        $equipments = $serviceOrder->equipment;

        return view('service_orders._partials.equipments', compact(
            'serviceOrder',
            'equipments'
        ));
    }

    public function export()
    {
        return Excel::download(
            new ServiceOrdersExport,
            'ordens_de_servico.xlsx'
        );
    }
}
