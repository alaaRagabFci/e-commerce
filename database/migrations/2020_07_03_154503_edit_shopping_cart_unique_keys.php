<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EditShoppingCartUniqueKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shoppingCart', function (Blueprint $table) {
            DB::statement("ALTER TABLE `shoppingcart` ADD UNIQUE( `identifier`, `instance`);");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shoppingCart', function (Blueprint $table) {
            DB::statement("ALTER TABLE `shoppingcart` DROP UNIQUE( `identifier`, `instance`);");
        });
    }
}
