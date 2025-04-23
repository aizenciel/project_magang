<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $items = Item::latest()->paginate(12);
        return view('landing.index', compact('items'));
    }

    public function show(Item $item)
    {
        return view('landing.show', compact('item'));
    }

    public function checkout(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to checkout.');
        }

        $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $item = Item::findOrFail($request->item_id);
        $total = $item->unit_price * $request->quantity;

        return view('landing.checkout', compact('item', 'total'));
    }
} 