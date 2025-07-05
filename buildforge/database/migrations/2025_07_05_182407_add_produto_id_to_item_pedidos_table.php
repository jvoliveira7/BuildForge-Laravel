<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up()
    {
        Schema::table('item_pedidos', function (Blueprint $table) {
            $table->foreignId('produto_id')->constrained('produtos');
        });
    }

    public function down()
    {
        Schema::table('item_pedidos', function (Blueprint $table) {
            $table->dropForeign(['produto_id']);
            $table->dropColumn('produto_id');
        });
    }

};
