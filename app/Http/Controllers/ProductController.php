<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;

class PdfController extends Controller
{
    public function generatePdf()
    {
        // Retrieve cart data from session, defaulting to an empty array if null
        $cartData = Session::get('cart_data', []);

        // Handle case when cart is empty
        if (empty($cartData)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        // Fetch products in the cart
        $products = Product::whereIn('id', $cartData)->get();
        
        // Calculate total price
        $total = $products->sum(function($product) {
            return $product->getPrice();
        });

        // Prepare data for PDF
        $data = [
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'date' => now()->format('Y-m-d H:i:s'),
            'products' => $products,
            'total' => number_format($total, 2),
            'company' => [
                'name' => config('app.name'),
                'address' => '123 Main Street, City',
                'phone' => '+1 555-123-4567',
                'email' => 'sales@example.com'
            ]
        ];

        // Generate PDF
        $pdf = Pdf::loadView('pdf.receipt', $data)
            ->setPaper('a5', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true
            ]);

        // Download PDF
        return $pdf->download('payment-receipt-' . $data['order_number'] . '.pdf');
    }
}