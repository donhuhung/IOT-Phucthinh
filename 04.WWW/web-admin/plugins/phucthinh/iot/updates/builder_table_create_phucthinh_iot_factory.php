<?php namespace PhucThinh\IOT\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePhucthinhIotFactory extends Migration
{
    public function up()
    {
        Schema::create('phucthinh_iot_factory', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('ip');
            $table->string('langtitude');
            $table->string('longtitude');
            $table->integer('status');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('phucthinh_iot_factory');
    }
}
