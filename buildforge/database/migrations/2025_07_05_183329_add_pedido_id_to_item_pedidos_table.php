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
                $table->unsignedBigInteger('pedido_id')->after('id');

                // Se quiser, pode adicionar a foreign key também:
                $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
            });
        }

        public function down()
        {
            Schema::table('item_pedidos', function (Blueprint $table) {
                $table->dropForeign(['pedido_id']);
                $table->dropColumn('pedido_id');
            });
        }
};
