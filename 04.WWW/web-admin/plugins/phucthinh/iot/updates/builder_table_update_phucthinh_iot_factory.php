<?php namespace PhucThinh\IOT\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePhucthinhIotFactory extends Migration
{
    public function up()
    {
        Schema::table('phucthinh_iot_factory', function($table)
        {
            $table->string('thumbnail')->nullable();
            $table->string('overview')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('phucthinh_iot_factory', function($table)
        {
            $table->dropColumn('thumbnail');
            $table->dropColumn('overview');
        });
    }
}
