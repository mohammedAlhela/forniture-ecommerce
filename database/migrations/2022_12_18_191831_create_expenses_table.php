<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->mediumText('notes')->default(0);
            $table->string('total')->default(0);
            $table->string('employment_offer')->default(0);
            $table->string('transfer_work_permit_application')->default(0);
            $table->string('pre_approval_typing')->default(0);
            $table->string('work_permit_pre_approval_fee')->default(0);
            $table->string('work_permit_information_update')->default(0);
            $table->string('employment_visa')->default(0);
            $table->string('change_work_status')->default(0);
            $table->string('status_delay_fine')->default(0);
            $table->string('employment_contract')->default(0);
            $table->string('employment_renewal')->default(0);
            $table->string('labour_card_renewal')->default(0);
            $table->string('work_permit_application')->default(0);
            $table->string('id_registration')->default(0);
            $table->string('pre_visa_medical')->default(0);
            $table->string('daman_document_preparation')->default(0);
            $table->string('daman_insurance_delay')->default(0);
            $table->string('insurance_delay_fee')->default(0);
            $table->string('passport_charge')->default(0);
            $table->string('residency')->default(0);
            $table->string('residency_delay_fine')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}
