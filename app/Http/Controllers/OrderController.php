<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['orders'] = Order::with(['items.product'])
            ->where('user_id', auth()->id())
            ->get();
            
        return view('order.index')->with('viewData', $viewData);
    }

    public function show(string $id): View
    {
        $viewData = [];
        $viewData['order'] = Order::with(['items.product'])->findOrFail($id);
        return view('order.show')->with('viewData', $viewData);
    }

    public function invoice(string $id): \Illuminate\Http\Response
    {
        $order = Order::with(['items.product'])->findOrFail($id);
        $pdf = Pdf::loadView('order.invoice', compact('order'));
        return $pdf->download("invoice-{$order->getId()}.pdf");
    }

}