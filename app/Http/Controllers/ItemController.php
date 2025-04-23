<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('admin.items.index', compact('items'));
    }

    public function create()
    {
        try {
            return view('admin.items.create');
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'item_code' => 'required|unique:items',
            'inc' => 'required',
            'item_type' => 'required',
            'item_group' => 'required',
            'uom' => 'required',
            'denotation' => 'required',
            'key_word' => 'required',
            'description' => 'required',
            'old_code' => 'required',
            'unit_price' => 'required|numeric',
            'main_supplier' => 'required',
            'storage_location' => 'nullable',
            'max_stock_level' => 'nullable|numeric',
            'reorder_point' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                // Make sure the directory exists
                Storage::makeDirectory('public/items');
                
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                
                // Log debugging information
                \Log::info('Uploading image: ' . $imageName);
                \Log::info('Image exists: ' . $image->isValid());
                \Log::info('Image size: ' . $image->getSize() . ' bytes');
                \Log::info('Target directory exists: ' . Storage::exists('public/items'));
                
                // Save the file using put instead of storeAs
                $path = Storage::disk('public')->put('items/' . $imageName, file_get_contents($image));
                
                \Log::info('Storage path result: ' . ($path ? 'success' : 'failed'));
                
                if ($path) {
                    $validatedData['image_path'] = 'items/' . $imageName;
                    \Log::info('Image path saved: ' . $validatedData['image_path']);
                } else {
                    \Log::error('Failed to store image');
                    return back()->with('error', 'Failed to upload image. Please try again.');
                }
            }

            $item = Item::create($validatedData);
            \Log::info('Item created with ID: ' . $item->id);

            return redirect()->route('admin.items.index')
                ->with('success', 'Item created successfully.');
        } catch (\Exception $e) {
            \Log::error('Error creating item: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            return back()->with('error', 'Failed to create item: ' . $e->getMessage());
        }
    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        return view('admin.items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $validatedData = $request->validate([
            'item_code' => 'required|unique:items,item_code,' . $item->id,
            'inc' => 'required',
            'item_type' => 'required',
            'item_group' => 'required',
            'uom' => 'required',
            'denotation' => 'required',
            'key_word' => 'required',
            'description' => 'required',
            'old_code' => 'required',
            'unit_price' => 'required|numeric',
            'main_supplier' => 'required',
            'storage_location' => 'nullable',
            'max_stock_level' => 'nullable|numeric',
            'reorder_point' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                // Delete old image if exists
                if ($item->image_path) {
                    \Log::info('Deleting old image: ' . $item->image_path);
                    $deleted = Storage::disk('public')->delete($item->image_path);
                    \Log::info('Old image deleted: ' . ($deleted ? 'yes' : 'no'));
                }
                
                // Make sure the directory exists
                Storage::makeDirectory('public/items');
                
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                
                // Log debugging information
                \Log::info('Uploading image: ' . $imageName);
                \Log::info('Image exists: ' . $image->isValid());
                \Log::info('Image size: ' . $image->getSize() . ' bytes');
                \Log::info('Target directory exists: ' . Storage::exists('public/items'));
                
                // Save the file using put instead of storeAs
                $path = Storage::disk('public')->put('items/' . $imageName, file_get_contents($image));
                
                \Log::info('Storage path result: ' . ($path ? 'success' : 'failed'));
                
                if ($path) {
                    $validatedData['image_path'] = 'items/' . $imageName;
                    \Log::info('Image path saved: ' . $validatedData['image_path']);
                } else {
                    \Log::error('Failed to store image');
                    return back()->with('error', 'Failed to upload image. Please try again.');
                }
            }

            $item->update($validatedData);
            \Log::info('Item updated with ID: ' . $item->id);

            return redirect()->route('admin.items.index')
                ->with('success', 'Item updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Error updating item: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            return back()->with('error', 'Failed to update item: ' . $e->getMessage());
        }
    }

    public function destroy(Item $item)
    {
        if ($item->image_path) {
            Storage::delete('public/' . $item->image_path);
        }
        
        $item->delete();

        return redirect()->route('admin.items.index')
            ->with('success', 'Item deleted successfully.');
    }
} 