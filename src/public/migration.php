<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assetfields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('entryid')->nullable();
            $table->string('filename', 255)->nullable();
            $table->string('kind', 50)->nullable();
            $table->string('width', 10)->nullable();
            $table->string('height', 10)->nullable();
            $table->integer('size')->nullable();
            $table->dateTime('datecreated')->nullable();
            $table->string('url', 200)->nullable();
            $table->string('thumb', 300)->nullable();
            $table->string('fieldname', 200)->nullable();
            $table->timestamps();
        });

        Schema::create('routes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('route', 200);
            $table->string('controller', 200);
            $table->timestamps();
        });

        Schema::create('plugins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->dateTime('install');
            $table->integer('status');
            $table->timestamps();
        });

        Schema::create('cat_links', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prod_id');
            $table->integer('cat_id');
            $table->timestamps();
        });

         Schema::create('cats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cat_name', 100);
            $table->timestamps();
        });

        Schema::create('content', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('entryid');
            $table->string('entrytitle', 200);
            $table->timestamps();
        });

         Schema::create('entry', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sectionid');
            $table->string('type', 200);
            $table->date('datecreated');
            $table->integer('sort_order');
            $table->timestamps();
        });

         Schema::create('fields', function (Blueprint $table) {
            $table->string('name', 200);
            $table->string('type', 50);
            $table->text('opts')->nullable();
            $table->string('instructions', 200)->nullable();
            $table->string('maxchars', 50)->nullable();
            $table->integer('limitamount')->nullable();
            $table->text('formvalidation')->nullable();
            $table->text('settings')->nullable();
            $table->increments('id');
            $table->timestamps();
        });

        Schema::create('permission_groups', function (Blueprint $table) {
            $table->increments('groupID');
            $table->string('groupName', 200)->nullable();
            $table->timestamps();
        });

        Schema::create('permission_map', function (Blueprint $table) {
            $table->integer('groupID')->default('0');
            $table->integer('permissionID')->default('0');
            $table->primary(['groupID', 'permissionID']);
        });


        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('permissionID');
            $table->string('permission', 200);
            $table->integer('order_position');
            $table->timestamps();
        });


        Schema::create('section', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('sectiontype', 200);
            $table->timestamps();
        });

        Schema::create('section_layout', function (Blueprint $table) {
            $table->increments('s_id');
            $table->integer('sectionid');
            $table->integer('fieldid');
            $table->integer('sortorder');
            $table->integer('required');
            $table->timestamps();
        });

        Schema::create('blocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fieldid');
            $table->integer('typeid');
            $table->integer('sortorder');
            $table->dateTime('datecreated');
            $table->timestamps();
        });

         Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('password', 500);
            $table->date('joindate');
            $table->integer('logins');
            $table->integer('is_logged_in');
            $table->string('email', 50);
            $table->integer('activ_status');
            $table->string('activ_key', 1000);
            $table->integer('permissiongroup');
            $table->string('fullname', 200);
            $table->timestamps();
        });

        Schema::create('paypal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sandbox');
            $table->string('paypal_email', 100);
            $table->string('notify_url', 512);
            $table->string('thanks_url', 512);
            $table->string('currency_code', 10);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->timestamps();
        });

        Schema::create('ipn', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_name', 512);
            $table->string('item_number', 512);
            $table->string('payment_status', 512);
            $table->string('payment_amount', 512);
            $table->string('payment_currency', 512);
            $table->string('txn_id', 512);
            $table->string('receiver_email', 512);
            $table->string('payer_email', 512);
            $table->string('txn_type', 512);
            $table->string('pending_reason', 512);
            $table->string('payment_type', 512);
            $table->string('custom', 512);
            $table->string('invoice', 512);
            $table->string('first_name', 512);
            $table->string('last_name', 512);
            $table->string('address_name', 512);
            $table->string('address_country', 512);
            $table->string('address_country_code', 512);
            $table->string('address_zip', 512);
            $table->string('address_state', 512);
            $table->string('address_city', 512);
            $table->string('address_street', 512);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};


