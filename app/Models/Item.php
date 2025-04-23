<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_code',
        'inc',
        'item_type',
        'item_group',
        'uom',
        'denotation',
        'key_word',
        'description',
        'old_code',
        'cross_references_1',
        'cross_references_2',
        'cross_references_3',
        'functional_location',
        'coa',
        'gl',
        'unit_price',
        'main_supplier',
        'storage_location',
        'max_stock_level',
        'reorder_point',
        'image_path'
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'max_stock_level' => 'decimal:2',
        'reorder_point' => 'decimal:2'
    ];
} 