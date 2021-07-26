<?php namespace PhucThinh\IOT\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdatePhucthinhIotCustomer2 extends Migration
{
    public function up()
    {
        Schema::table('phucthinh_iot_customer', function($table)
        {
            $table->string('address')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('phucthinh_iot_customer', function($table)
        {
            $table->dropColumn('address');
        });
    }
}
