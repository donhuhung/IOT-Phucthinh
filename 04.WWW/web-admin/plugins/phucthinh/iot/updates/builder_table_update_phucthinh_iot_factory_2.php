<?php namespace PhucThinh\IOT\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePhucthinhIotFactory2 extends Migration
{
    public function up()
    {
        Schema::table('phucthinh_iot_factory', function($table)
        {
            $table->integer('factory_id');
            $table->dropColumn('thumbnail');
            $table->dropColumn('overview');
        });
    }
    
    public function down()
    {
        Schema::table('phucthinh_iot_factory', function($table)
        {
            $table->dropColumn('factory_id');
            $table->string('thumbnail', 191)->nullable();
            $table->string('overview', 191)->nullable();
        });
    }
}
