<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Initial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('price');
            $table->text('information');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->integer('color_id');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
            $table->integer('product_category_id');
            $table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('cascade');
        });
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('path');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->integer('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
        Schema::create('product_inventory', function (Blueprint $table) {
            $table->id();
            $table->string('size');
            $table->integer('quantity');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->integer('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->integer('pc_product_id');
            $table->string('pc_size');
            $table->integer('product_inventory_id');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign(['product_inventory_id'])->references('id')->on('product_inventory')->onDelete('cascade');
        });

        DB::unprepared(file_get_contents('public/database_inserts.sql'));

        $admin = new User;
        $admin->email = 'admin@merchsort.sk';
        $admin->password = \Illuminate\Support\Facades\Hash::make('12345678');
        $admin->name = '';
        $admin->last_name = '';
        $admin->phone_number = '';
        $admin->city = '';
        $admin->street = '';
        $admin->additional_info = '';
        $admin->zip_code = '';
        $admin->admin = 't';
        $admin->save();
}

/**
 * Reverse the migrations.
 *
 * @return void
 */
public
function down()
{
    Schema::dropIfExists('cart_items');
    Schema::dropIfExists('photos');
    Schema::dropIfExists('product_inventory');
    Schema::dropIfExists('products');
    Schema::dropIfExists('product_categories');
    Schema::dropIfExists('colors');

}
}
