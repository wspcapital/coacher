<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('booker_user_id');
            $table->integer('rm_user_id')->nullable();
            $table->enum('type', [
                'Workshop', 'Bookout', 'Bulk', 'Rouser', 'Tradeshow', 'Webinar', 'ELS', 'ELS + Workshop'
            ])->default('Workshop');
            $table->string('title', 250)->default('')->nullable();
            $table->string('company', 250)->default('')->nullable();
            $table->string('company_website', 250)->nullable();
            $table->string('company_contact', 250)->nullable();
            $table->string('client_phone', 250)->nullable();
            $table->string('client_email', 250)->nullable();
            $table->text('details')->nullable();
            $table->string('location_name', 256)->nullable();
            $table->string('location_city', 250)->nullable();
            $table->string('location_state', 250)->nullable();
            $table->string('location_address', 250)->nullable();
            $table->string('location_zip', 250)->nullable();
            $table->string('location_country', 250)->nullable();
            $table->enum('preport', ['0', '1'])->default('0');
            $table->enum('cap_required', ['0', '1'])->default('0');
            $table->enum('gna', ['0', '1'])->default('0');
            $table->enum('evaluation', ['0', '1'])->default('0');
            $table->enum('customwb', ['0', '1'])->default('0');
            $table->enum('pdp', ['0', '1'])->default('0');
            $table->string('workbook', 256)->default('0');
            $table->integer('part')->default('0');
            $table->integer('vcoaches')->default(0);
            $table->integer('sessions')->default(0);
            $table->text('pdpship')->nullable();
            $table->text('noteship')->nullable();
            $table->string('pdptrack', 256)->nullable();
            $table->text('generalnote')->nullable();
            $table->enum('readybook', ['0', '1'])->default('0');
            $table->text('event_hotels')->nullable();
            $table->text('travelnotes')->nullable();
            $table->text('accommodations')->nullable();
            $table->text('corporate_rate')->nullable();
            $table->text('transfer')->nullable();
            $table->enum('expenses', ['0', '1'])->default('0');
            $table->enum('expenses_complete', ['0', '1'])->default('0');
            $table->enum('materials', ['0', '1'])->default('0');
            $table->enum('ina_type', ['-1', '3', '5', '4', '6', '7', '8', '9'])->default('3');
            $table->string('share_hash', 256)->nullable();
            $table->longText('data')->nullable();

            $table->string('site_contact_fname', 256)->nullable();
            $table->string('site_contact_lname', 256)->nullable();
            $table->string('site_contact_phone', 256)->nullable();
            $table->string('site_contact_email', 256)->nullable();

            $table->text('shipping')->nullable();
            $table->text('restaurants')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
