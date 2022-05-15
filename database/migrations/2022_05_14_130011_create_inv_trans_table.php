<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_trans', function (Blueprint $table) {
            $table->id();
            $table->integer('mst_id');
            $table->integer('item_id');
            $table->integer('parent_mst_id')->nullable(); // tracking receive is requisition or not and requisition is issued or not
            $table->integer('parent_dtls_id')->nullable(); // tracking receive is requisition or not and requisition is issued or not
            $table->integer('req')->nullable()->default(0); // 0 => receive not requisition yet , 1 => requisition completed 
            $table->integer('qty');
            $table->float('price');
            $table->integer('type'); // 1=> receive , 2=> requistion , 3 => issue
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inv_trans');
    }
}
