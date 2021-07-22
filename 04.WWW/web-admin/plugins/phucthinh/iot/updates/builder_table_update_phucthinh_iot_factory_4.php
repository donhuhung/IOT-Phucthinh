<?php namespace PhucThinh\IOT\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePhucthinhIotFactory4 extends Migration
{
    public function up()
    {
        Schema::table('phucthinh_iot_factory', function($table)
        {
            $table->integer('customer_id');
        });
    }
    
    public function down()
    {
        Schema::table('phucthinh_iot_factory', function($table)
        {
            $table->dropColumn('customer_id');
        });
    }
}
