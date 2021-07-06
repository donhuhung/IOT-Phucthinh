<?php namespace PhucThinh\IOT\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePhucthinhIotFactory3 extends Migration
{
    public function up()
    {
        Schema::table('phucthinh_iot_factory', function($table)
        {
            $table->string('address', 200)->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('phucthinh_iot_factory', function($table)
        {
            $table->dropColumn('address');
        });
    }
}
