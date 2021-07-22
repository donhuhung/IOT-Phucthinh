<?php namespace PhucThinh\IOT\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreatePhucthinhIotCustomer extends Migration
{
    public function up()
    {
        Schema::create('phucthinh_iot_customer', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('phucthinh_iot_customer');
    }
}
