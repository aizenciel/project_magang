<?php

namespace App\Http\Controllers;

use App\Models\CheckoutRequest;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutRequestController extends Controller
{
    public function index()
    {
        $checkoutRequests = CheckoutRequest::with(['user', 'item'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.checkout-requests.index', compact('checkoutRequests'));
    }

    public function create()
    {
        $items = Item::where('max_stock_level', '>', 0)->get();
        $users = User::all();
        
        return view('admin.checkout-requests.create', compact('items', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
            'status' => 'nullable|in:pending,approved,rejected'
        ]);

        $item = Item::findOrFail($validated['item_id']);

        // Check if requested quantity is available
        if ($item->max_stock_level < $validated['quantity']) {
            return back()->with('error', 'Requested quantity exceeds available stock.');
        }

        $userId = $validated['user_id'] ?? Auth::id();
        $status = $validated['status'] ?? 'pending';

        $checkoutRequest = CheckoutRequest::create([
            'user_id' => $userId,
            'item_id' => $validated['item_id'],
            'quantity' => $validated['quantity'],
            'notes' => $validated['notes'] ?? null,
            'status' => $status
        ]);

        // If status is approved, update item stock
        if ($status === 'approved') {
            $item->max_stock_level -= $validated['quantity'];
            $item->save();
        }

        // Check if request is coming from admin or user
        $referer = request()->headers->get('referer');
        if (stripos($referer, 'admin') !== false) {
            return redirect()->route('admin.checkout.index')->with('success', 'Checkout request created successfully.');
        } else {
            return redirect()->route('landing.index')->with('success', 'Your checkout request has been submitted successfully. We will notify you when it is processed.');
        }
    }

    public function approve(CheckoutRequest $checkoutRequest)
    {
        if ($checkoutRequest->status !== 'pending') {
            return back()->with('error', 'This request has already been processed.');
        }

        $item = $checkoutRequest->item;
        
        // Update item stock
        $item->max_stock_level -= $checkoutRequest->quantity;
        $item->save();

        // Update request status
        $checkoutRequest->status = 'approved';
        $checkoutRequest->save();

        return back()->with('success', 'Checkout request approved successfully.');
    }

    public function reject(CheckoutRequest $checkoutRequest)
    {
        if ($checkoutRequest->status !== 'pending') {
            return back()->with('error', 'This request has already been processed.');
        }

        $checkoutRequest->status = 'rejected';
        $checkoutRequest->save();

        return back()->with('success', 'Checkout request rejected successfully.');
    }
} 