<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Department;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            //$table->timestamps();
        });

        Department::create([
            'id'=>1,
            'name'=>'Sales and Marketing',
        ]);

        Department::create([
            'id'=>2,
            'name'=>'Application Developement',
        ]);

        Department::create([
            'id'=>3,
            'name'=>'Web Developement',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
};
