<?php namespace PhucThinh\IOT\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateFactoriesTable extends Migration
{
    public function up()
    {
        Schema::create('phucthinh_iot_factories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('phucthinh_iot_factories');
    }
}
