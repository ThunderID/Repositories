<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('appointment', function (Blueprint $table) {
			$table->string('id', 255);
			$table->string('atas_nama', 255);
			$table->datetime('waktu_pertemuan');
			$table->text('tempat_bertemu');
			$table->text('agenda');
			$table->timestamps();
			$table->softDeletes();

            $table->primary('id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('appointment');
	}
}
