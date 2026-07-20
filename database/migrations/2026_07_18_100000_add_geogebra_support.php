<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Modificar la columna 'type' para permitir string, quitando la restricción de enum
        Schema::table('questions', function (Blueprint $table) {
            $table->string('type')->change();
        });

        // 2. Insertar preguntas de GeoGebra
        // Obtener IDs de las lecciones
        $lesson1 = DB::table('lessons')->where('slug', 'tipos-de-angulos')->first();
        $lesson2 = DB::table('lessons')->where('slug', 'soh-cah-toa')->first();

        if ($lesson1) {
            DB::table('questions')->insert([
                'lesson_id' => $lesson1->id,
                'type' => 'geogebra',
                'question' => 'Interactúa con la gráfica de GeoGebra para arrastrar el punto y formar un ángulo obtuso. ¿Cuál de los siguientes valores es un ángulo obtuso?',
                'options' => json_encode([
                    'material_id' => 'bGst5fJz',
                    'choices' => ['45°', '90°', '135°', '180°']
                ]),
                'correct_answer' => '135°',
                'explanation' => 'Un ángulo obtuso es aquel que mide más de 90° y menos de 180°. En este caso, 135°.',
                'difficulty' => 'medium',
                'xp_value' => 15,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        if ($lesson2) {
            DB::table('questions')->insert([
                'lesson_id' => $lesson2->id,
                'type' => 'geogebra',
                'question' => 'Usa el triángulo interactivo de GeoGebra para observar cómo cambian las razones. Si ajustas el ángulo a 45°, ¿cómo son el cateto opuesto y el cateto adyacente?',
                'options' => json_encode([
                    'material_id' => 'bGst5fJz',
                    'choices' => ['El opuesto es mayor', 'El adyacente es mayor', 'Son iguales', 'La hipotenusa es igual al opuesto']
                ]),
                'correct_answer' => 'Son iguales',
                'explanation' => 'A 45°, el triángulo rectángulo es isósceles, por lo que el cateto opuesto y el adyacente miden exactamente lo mismo.',
                'difficulty' => 'medium',
                'xp_value' => 20,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar las preguntas insertadas
        DB::table('questions')->where('type', 'geogebra')->delete();

        // Revertir a enum
        Schema::table('questions', function (Blueprint $table) {
            $table->enum('type', ['multiple_choice', 'true_false', 'fill_blank'])->change();
        });
    }
};
