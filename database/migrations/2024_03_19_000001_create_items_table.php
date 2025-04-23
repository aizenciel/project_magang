<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('item_code')->unique();
            $table->string('inc')->nullable();
            $table->string('item_type');
            $table->string('item_group');
            $table->string('uom');
            $table->string('denotation');
            $table->string('key_word');
            $table->text('description');
            $table->string('old_code')->nullable();
            $table->string('cross_references_1')->nullable();
            $table->string('cross_references_2')->nullable();
            $table->string('cross_references_3')->nullable();
            $table->string('functional_location')->nullable();
            $table->string('coa')->nullable();
            $table->string('gl')->nullable();
            $table->decimal('unit_price', 15, 2);
            $table->string('main_supplier');
            $table->string('storage_location');
            $table->decimal('max_stock_level', 15, 2)->default(0);
            $table->decimal('reorder_point', 15, 2)->default(0);
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('items');
    }
}; 