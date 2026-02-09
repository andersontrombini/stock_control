<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\ServiceOrder;
use App\Models\Technical;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TechnicalController extends Controller
{
    public function index()
    {
        // Busca o técnico vinculado ao usuário logado
        $technical = Technical::where('user_id', Auth::id())->firstOrFail();

        // Carrega as ordens de serviço vinculadas a este técnico
        $serviceOrders = $technical->serviceOrders()->where('status', '!=', 'closed')->orderBy('created_at', 'desc')->get();

        return view('technicals.index', compact('serviceOrders'));
    }

    public function edit($id)
    {
        $serviceOrder = ServiceOrder::findOrFail($id);
        $equipments = Equipment::where('quantity', '>', 0)->get(); // Apenas itens com estoque

        return view('technicals.edit', compact('serviceOrder', 'equipments'));
    }

    public function update(Request $request, $id)
    {
        $serviceOrder = ServiceOrder::findOrFail($id);

        $request->validate([
            'status' => 'required|string|in:open,in_progress,closed',
            'equipment_id' => 'nullable|array',
            'equipment_id.*' => 'exists:equipment,id',
            'quantity_used' => 'nullable|array',
            'quantity_used.*' => 'integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            // 1. Atualiza o status da OS
            $serviceOrder->update([
                'status' => $request->status
            ]);

            // 2. Processa os materiais (se foram enviados)
            if ($request->has('equipment_id')) {
                foreach ($request->equipment_id as $index => $equipmentId) {
                    $qtyUsed = $request->quantity_used[$index];

                    if (!$qtyUsed) continue;

                    $item = Equipment::lockForUpdate()->findOrFail($equipmentId);

                    if ($item->quantity < $qtyUsed) {
                        throw new \Exception("Estoque insuficiente para: {$item->name}");
                    }

                    // Registra o uso na tabela pivot
                    $serviceOrder->equipment()->attach($equipmentId, [
                        'quantity_used' => $qtyUsed
                    ]);

                    // Abate do estoque
                    $item->quantity -= $qtyUsed;
                    $item->save();
                }
            }

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }
}
