<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vh_employees', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null')
                  ->comment('ID користувача системи')
                  ->index('fk_vhemp_uid'); // Явно задане ім'я для зовнішнього ключа

            $table->string('surname', 128)->nullable()->comment('Прізвище');
            $table->string('name', 128)->nullable()->comment('Ім\'я');
            $table->string('patronymic', 128)->nullable()->comment('По батькові');
            $table->foreignId('education_id')
                  ->nullable()
                  ->constrained('educations')
                  ->onDelete('set null')
                  ->comment('Освіта')
                  ->index('fk_vhemp_eid'); // Явно задане ім'я для зовнішнього ключа

            $table->text('birth_place')->nullable()->comment('Місце народження');
            $table->date('birth_date')->nullable()->comment('Дата народження');
            $table->text('residence_place')->nullable()->comment('Місце проживання');
            $table->text('registration_place')->nullable()->comment('Місце реєстрації');

            // Унікальні індекси вже мають явно задані імена:
            $table->string('rnokpp', 10)->nullable()->unique('uq_vhemp_rnokpp')->comment('РНОКПП');
            $table->text('passport_number')->nullable()->comment('Серія, номер паспорта');
            $table->text('passport_issued')->nullable()->comment('Ким виданий паспорт');
            $table->date('passport_date_issue')->nullable()->comment('Дата видачі паспорта');
            $table->string('unzr', 14)->nullable()->unique('uq_vhemp_unzr')->comment('УНЗР (якщо ID карта)');

            $table->foreignId('marital_status_id')
                  ->nullable()
                  ->constrained('marital_statuses')
                  ->onDelete('set null')
                  ->comment('Сімейний стан')
                  ->index('fk_vhemp_msid'); // Явно задане ім'я для зовнішнього ключа

            $table->timestamps();
            $table->softDeletes()->index('idx_vhemp_deleted');

            // Композитний унікальний індекс вже має явно задане ім'я:
            $table->unique(['surname', 'name', 'patronymic', 'birth_date'], 'uq_vhemp_snpbd');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vh_employees');
    }
};
