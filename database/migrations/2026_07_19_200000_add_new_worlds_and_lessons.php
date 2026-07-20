<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // =============================================
        // WORLD 5: Funciones Trigonométricas
        // =============================================
        $world5Id = DB::table('worlds')->insertGetId([
            'name' => 'Funciones Trigonométricas',
            'slug' => 'funciones-trigonometricas',
            'description' => 'Domina las gráficas de seno, coseno y tangente. ¡Controla las ondas!',
            'icon' => '📊',
            'color' => '#E040FB',
            'bg_gradient' => 'linear-gradient(135deg, #E040FB, #7C4DFF)',
            'order' => 5,
            'xp_required' => 1300,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Lessons for World 5
        $lesson14Id = DB::table('lessons')->insertGetId([
            'world_id' => $world5Id,
            'title' => 'Gráfica del Seno',
            'slug' => 'grafica-seno',
            'description' => 'Aprende a trazar y leer la gráfica de la función seno.',
            'content' => json_encode([
                ['type' => 'title', 'text' => 'La Función Seno: y = sen(x)'],
                ['type' => 'text', 'text' => 'La función seno genera una onda suave que oscila entre -1 y 1. Su período es 2π (360°), lo que significa que la onda se repite cada 2π unidades.'],
                ['type' => 'card', 'title' => 'Valores Clave', 'icon' => '📌', 'text' => 'sen(0°) = 0, sen(90°) = 1, sen(180°) = 0, sen(270°) = -1, sen(360°) = 0'],
                ['type' => 'tip', 'text' => '💡 La gráfica del seno comienza en el origen (0,0) y sube primero.'],
            ]),
            'order' => 1,
            'xp_reward' => 80,
            'icon' => '📈',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $lesson15Id = DB::table('lessons')->insertGetId([
            'world_id' => $world5Id,
            'title' => 'Gráfica del Coseno',
            'slug' => 'grafica-coseno',
            'description' => 'Descubre cómo se comporta la gráfica del coseno.',
            'content' => json_encode([
                ['type' => 'title', 'text' => 'La Función Coseno: y = cos(x)'],
                ['type' => 'text', 'text' => 'La función coseno es muy parecida a la del seno, pero desplazada 90° a la izquierda. También oscila entre -1 y 1 con período 2π.'],
                ['type' => 'card', 'title' => 'Valores Clave', 'icon' => '📌', 'text' => 'cos(0°) = 1, cos(90°) = 0, cos(180°) = -1, cos(270°) = 0, cos(360°) = 1'],
                ['type' => 'tip', 'text' => '💡 La gráfica del coseno comienza en (0, 1) — ¡empieza arriba!'],
            ]),
            'order' => 2,
            'xp_reward' => 80,
            'icon' => '📉',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $lesson16Id = DB::table('lessons')->insertGetId([
            'world_id' => $world5Id,
            'title' => 'Amplitud y Periodo',
            'slug' => 'amplitud-periodo',
            'description' => 'Modifica las ondas: cambia su altura y su frecuencia.',
            'content' => json_encode([
                ['type' => 'title', 'text' => 'Transformando las Ondas'],
                ['type' => 'text', 'text' => 'En la función y = A·sen(Bx), A controla la amplitud (altura máxima) y B controla la frecuencia (cantidad de ondas).'],
                ['type' => 'card', 'title' => 'Amplitud (A)', 'icon' => '📏', 'text' => 'La amplitud es |A|. Si A = 3, la onda sube hasta 3 y baja hasta -3.'],
                ['type' => 'card', 'title' => 'Periodo', 'icon' => '🔁', 'text' => 'El periodo es 2π/B. Si B = 2, el periodo es π, y la onda se repite más rápido.'],
                ['type' => 'tip', 'text' => '💡 Amplitud grande = onda alta. Frecuencia grande = onda apretada.'],
            ]),
            'order' => 3,
            'xp_reward' => 90,
            'icon' => '🎛️',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $lesson17Id = DB::table('lessons')->insertGetId([
            'world_id' => $world5Id,
            'title' => 'Gráfica de la Tangente',
            'slug' => 'grafica-tangente',
            'description' => 'La función tangente: asíntotas y comportamiento especial.',
            'content' => json_encode([
                ['type' => 'title', 'text' => 'La Función Tangente: y = tan(x)'],
                ['type' => 'text', 'text' => 'A diferencia del seno y coseno, la tangente no tiene límites: va de -∞ a +∞. Tiene asíntotas verticales donde cos(x) = 0.'],
                ['type' => 'card', 'title' => 'Asíntotas', 'icon' => '⚠️', 'text' => 'En 90° y 270° la tangente no está definida. La gráfica se dispara hacia infinito.'],
                ['type' => 'card', 'title' => 'Periodo', 'icon' => '🔁', 'text' => 'El periodo de la tangente es π (180°), la mitad que seno y coseno.'],
                ['type' => 'tip', 'text' => '💡 tan(x) = sen(x)/cos(x). Cuando cos(x) = 0, ¡la tangente explota!'],
            ]),
            'order' => 4,
            'xp_reward' => 90,
            'icon' => '📐',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // =============================================
        // WORLD 6: Trigonometría Avanzada
        // =============================================
        $world6Id = DB::table('worlds')->insertGetId([
            'name' => 'Trigonometría Avanzada',
            'slug' => 'trigonometria-avanzada',
            'description' => 'Desafía tus límites con leyes avanzadas y aplicaciones reales.',
            'icon' => '⚡',
            'color' => '#00E5FF',
            'bg_gradient' => 'linear-gradient(135deg, #00E5FF, #651FFF)',
            'order' => 6,
            'xp_required' => 1800,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $lesson18Id = DB::table('lessons')->insertGetId([
            'world_id' => $world6Id,
            'title' => 'Ley de Senos',
            'slug' => 'ley-de-senos',
            'description' => 'Resuelve cualquier triángulo con la Ley de Senos.',
            'content' => json_encode([
                ['type' => 'title', 'text' => 'La Ley de Senos'],
                ['type' => 'text', 'text' => 'La Ley de Senos establece que en cualquier triángulo, la razón entre un lado y el seno de su ángulo opuesto es constante: a/sen(A) = b/sen(B) = c/sen(C).'],
                ['type' => 'card', 'title' => 'Cuándo usarla', 'icon' => '🎯', 'text' => 'Úsala cuando conoces dos ángulos y un lado (AAS/ASA) o dos lados y un ángulo opuesto (SSA).'],
                ['type' => 'tip', 'text' => '💡 La Ley de Senos funciona para CUALQUIER triángulo, ¡no solo rectángulos!'],
            ]),
            'order' => 1,
            'xp_reward' => 100,
            'icon' => '⚖️',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $lesson19Id = DB::table('lessons')->insertGetId([
            'world_id' => $world6Id,
            'title' => 'Ley de Cosenos',
            'slug' => 'ley-de-cosenos',
            'description' => 'El poder de la Ley de Cosenos para triángulos oblicuos.',
            'content' => json_encode([
                ['type' => 'title', 'text' => 'La Ley de Cosenos'],
                ['type' => 'text', 'text' => 'La Ley de Cosenos generaliza el Teorema de Pitágoras: c² = a² + b² - 2ab·cos(C). Funciona para todo triángulo.'],
                ['type' => 'card', 'title' => 'Cuándo usarla', 'icon' => '🎯', 'text' => 'Cuando conoces dos lados y el ángulo entre ellos (SAS), o los tres lados (SSS).'],
                ['type' => 'card', 'title' => 'Conexión con Pitágoras', 'icon' => '🔗', 'text' => 'Si C = 90°, cos(90°) = 0, y obtenemos c² = a² + b². ¡Es Pitágoras!'],
                ['type' => 'tip', 'text' => '💡 Si no sabes si usar Senos o Cosenos: ¿tienes ángulo entre dos lados? → Cosenos. ¿Tienes lado y ángulo opuesto? → Senos.'],
            ]),
            'order' => 2,
            'xp_reward' => 100,
            'icon' => '🧮',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $lesson20Id = DB::table('lessons')->insertGetId([
            'world_id' => $world6Id,
            'title' => 'Vectores y Trigonometría',
            'slug' => 'vectores-trigonometria',
            'description' => 'Aplica la trigonometría al mundo de los vectores.',
            'content' => json_encode([
                ['type' => 'title', 'text' => 'Vectores y sus Componentes'],
                ['type' => 'text', 'text' => 'Un vector tiene magnitud y dirección. Usando trigonometría, podemos descomponerlo en componentes: Vx = V·cos(θ) y Vy = V·sen(θ).'],
                ['type' => 'card', 'title' => 'Componente Horizontal', 'icon' => '➡️', 'text' => 'Vx = |V| · cos(θ). Es la proyección del vector sobre el eje X.'],
                ['type' => 'card', 'title' => 'Componente Vertical', 'icon' => '⬆️', 'text' => 'Vy = |V| · sen(θ). Es la proyección del vector sobre el eje Y.'],
                ['type' => 'tip', 'text' => '💡 Si un avión vuela a 500 km/h a 30°, su velocidad horizontal es 500·cos(30°) ≈ 433 km/h.'],
            ]),
            'order' => 3,
            'xp_reward' => 110,
            'icon' => '🧭',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $lesson21Id = DB::table('lessons')->insertGetId([
            'world_id' => $world6Id,
            'title' => 'Prueba Final',
            'slug' => 'prueba-final',
            'description' => '¡El desafío definitivo! Demuestra todo lo que has aprendido.',
            'content' => json_encode([
                ['type' => 'title', 'text' => '🏆 La Prueba Final'],
                ['type' => 'text', 'text' => 'Has llegado al final de tu aventura trigonométrica. Este quiz combina preguntas de todos los mundos. ¡Demuestra que eres un maestro de la trigonometría!'],
                ['type' => 'card', 'title' => 'Preparación', 'icon' => '📋', 'text' => 'Repasa: ángulos, SOH-CAH-TOA, identidades, gráficas, leyes de senos y cosenos.'],
                ['type' => 'tip', 'text' => '💡 Respira hondo, confía en lo que sabes, ¡y conquista el último desafío!'],
            ]),
            'order' => 4,
            'xp_reward' => 200,
            'icon' => '👑',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // =============================================
        // QUESTIONS for World 5
        // =============================================

        // Lesson 14: Gráfica del Seno
        DB::table('questions')->insert([
            [
                'lesson_id' => $lesson14Id, 'type' => 'multiple_choice',
                'question' => '¿Cuál es el valor máximo que alcanza la función y = sen(x)?',
                'options' => json_encode(['0', '1', '2', 'π']),
                'correct_answer' => '1',
                'explanation' => 'La función seno oscila entre -1 y 1. Su valor máximo es 1, alcanzado en 90° (π/2).',
                'difficulty' => 'easy', 'xp_value' => 10, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'lesson_id' => $lesson14Id, 'type' => 'multiple_choice',
                'question' => '¿Cuál es el periodo de la función y = sen(x)?',
                'options' => json_encode(['π', '2π', '3π', '4π']),
                'correct_answer' => '2π',
                'explanation' => 'El periodo del seno es 2π (360°). La onda se repite completamente cada 2π.',
                'difficulty' => 'easy', 'xp_value' => 10, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'lesson_id' => $lesson14Id, 'type' => 'multiple_choice',
                'question' => '¿En qué punto la gráfica de sen(x) cruza el eje X por segunda vez (después de 0)?',
                'options' => json_encode(['x = π/2', 'x = π', 'x = 3π/2', 'x = 2π']),
                'correct_answer' => 'x = π',
                'explanation' => 'sen(π) = sen(180°) = 0, así que la gráfica cruza el eje X en x = π.',
                'difficulty' => 'medium', 'xp_value' => 15, 'created_at' => now(), 'updated_at' => now(),
            ],
        ]);

        // Lesson 15: Gráfica del Coseno
        DB::table('questions')->insert([
            [
                'lesson_id' => $lesson15Id, 'type' => 'multiple_choice',
                'question' => '¿Cuál es el valor de cos(0°)?',
                'options' => json_encode(['0', '1', '-1', '0.5']),
                'correct_answer' => '1',
                'explanation' => 'cos(0°) = 1. La gráfica del coseno comienza en su valor máximo.',
                'difficulty' => 'easy', 'xp_value' => 10, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'lesson_id' => $lesson15Id, 'type' => 'multiple_choice',
                'question' => 'La gráfica de cos(x) es igual a la de sen(x) desplazada...',
                'options' => json_encode(['90° a la izquierda', '90° a la derecha', '180° a la izquierda', '45° a la derecha']),
                'correct_answer' => '90° a la izquierda',
                'explanation' => 'cos(x) = sen(x + 90°). El coseno adelanta al seno por 90° (π/2).',
                'difficulty' => 'medium', 'xp_value' => 15, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'lesson_id' => $lesson15Id, 'type' => 'multiple_choice',
                'question' => '¿En qué ángulo cos(x) vale -1?',
                'options' => json_encode(['0°', '90°', '180°', '270°']),
                'correct_answer' => '180°',
                'explanation' => 'cos(180°) = -1. Es el punto más bajo de la gráfica del coseno.',
                'difficulty' => 'easy', 'xp_value' => 10, 'created_at' => now(), 'updated_at' => now(),
            ],
        ]);

        // Lesson 16: Amplitud y Periodo
        DB::table('questions')->insert([
            [
                'lesson_id' => $lesson16Id, 'type' => 'multiple_choice',
                'question' => 'En la función y = 3·sen(x), ¿cuál es la amplitud?',
                'options' => json_encode(['1', '2', '3', '6']),
                'correct_answer' => '3',
                'explanation' => 'La amplitud es |A| = |3| = 3. La onda sube hasta 3 y baja hasta -3.',
                'difficulty' => 'easy', 'xp_value' => 10, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'lesson_id' => $lesson16Id, 'type' => 'multiple_choice',
                'question' => '¿Cuál es el periodo de y = sen(2x)?',
                'options' => json_encode(['π', '2π', '4π', 'π/2']),
                'correct_answer' => 'π',
                'explanation' => 'El periodo es 2π/B = 2π/2 = π. La onda se comprime y se repite cada π.',
                'difficulty' => 'medium', 'xp_value' => 15, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'lesson_id' => $lesson16Id, 'type' => 'multiple_choice',
                'question' => 'Si la amplitud de una onda seno es 5 y su periodo es π, ¿cuál es la función?',
                'options' => json_encode(['y = 5·sen(2x)', 'y = 2·sen(5x)', 'y = 5·sen(x/2)', 'y = sen(5x)']),
                'correct_answer' => 'y = 5·sen(2x)',
                'explanation' => 'Amplitud = 5, así A = 5. Periodo = π, así 2π/B = π → B = 2. Resultado: y = 5·sen(2x).',
                'difficulty' => 'hard', 'xp_value' => 20, 'created_at' => now(), 'updated_at' => now(),
            ],
        ]);

        // Lesson 17: Gráfica de la Tangente
        DB::table('questions')->insert([
            [
                'lesson_id' => $lesson17Id, 'type' => 'multiple_choice',
                'question' => '¿Por qué la tangente no está definida en 90°?',
                'options' => json_encode(['Porque sen(90°) = 0', 'Porque cos(90°) = 0', 'Porque tan(90°) = 1', 'Porque tan(90°) = -1']),
                'correct_answer' => 'Porque cos(90°) = 0',
                'explanation' => 'tan(x) = sen(x)/cos(x). En 90°, cos(90°) = 0, y la división por 0 no existe.',
                'difficulty' => 'medium', 'xp_value' => 15, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'lesson_id' => $lesson17Id, 'type' => 'multiple_choice',
                'question' => '¿Cuál es el periodo de la función tangente?',
                'options' => json_encode(['π/2', 'π', '2π', '3π']),
                'correct_answer' => 'π',
                'explanation' => 'El periodo de la tangente es π (180°), la mitad del periodo del seno y coseno.',
                'difficulty' => 'easy', 'xp_value' => 10, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'lesson_id' => $lesson17Id, 'type' => 'multiple_choice',
                'question' => '¿Cuál es el valor de tan(45°)?',
                'options' => json_encode(['0', '1', '√2', 'No definida']),
                'correct_answer' => '1',
                'explanation' => 'tan(45°) = sen(45°)/cos(45°) = 1. Es uno de los valores más importantes.',
                'difficulty' => 'easy', 'xp_value' => 10, 'created_at' => now(), 'updated_at' => now(),
            ],
        ]);

        // =============================================
        // QUESTIONS for World 6
        // =============================================

        // Lesson 18: Ley de Senos
        DB::table('questions')->insert([
            [
                'lesson_id' => $lesson18Id, 'type' => 'multiple_choice',
                'question' => 'La Ley de Senos establece que a/sen(A) =...',
                'options' => json_encode(['b/sen(B)', 'b·sen(B)', 'a·cos(A)', 'c/cos(C)']),
                'correct_answer' => 'b/sen(B)',
                'explanation' => 'La Ley de Senos dice que a/sen(A) = b/sen(B) = c/sen(C) para cualquier triángulo.',
                'difficulty' => 'easy', 'xp_value' => 10, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'lesson_id' => $lesson18Id, 'type' => 'multiple_choice',
                'question' => '¿Cuándo se usa la Ley de Senos?',
                'options' => json_encode(['Cuando conoces SAS', 'Cuando conoces AAS o ASA', 'Solo en triángulos rectángulos', 'Cuando conoces los tres lados']),
                'correct_answer' => 'Cuando conoces AAS o ASA',
                'explanation' => 'La Ley de Senos se usa cuando tienes dos ángulos y un lado (AAS/ASA) o dos lados y un ángulo opuesto.',
                'difficulty' => 'medium', 'xp_value' => 15, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'lesson_id' => $lesson18Id, 'type' => 'multiple_choice',
                'question' => 'En un triángulo, A = 30°, a = 5. Si B = 60°, ¿cuánto vale b?',
                'options' => json_encode(['5√3 ≈ 8.66', '10', '5', '2.5']),
                'correct_answer' => '5√3 ≈ 8.66',
                'explanation' => 'Por Ley de Senos: b = a·sen(B)/sen(A) = 5·sen(60°)/sen(30°) = 5·(√3/2)/(1/2) = 5√3.',
                'difficulty' => 'hard', 'xp_value' => 20, 'created_at' => now(), 'updated_at' => now(),
            ],
        ]);

        // Lesson 19: Ley de Cosenos
        DB::table('questions')->insert([
            [
                'lesson_id' => $lesson19Id, 'type' => 'multiple_choice',
                'question' => 'La Ley de Cosenos dice que c² = ...',
                'options' => json_encode(['a² + b² - 2ab·cos(C)', 'a² + b²', 'a² - b² + 2ab·cos(C)', '2ab·sen(C)']),
                'correct_answer' => 'a² + b² - 2ab·cos(C)',
                'explanation' => 'La fórmula completa es c² = a² + b² - 2ab·cos(C). Generaliza a Pitágoras.',
                'difficulty' => 'easy', 'xp_value' => 10, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'lesson_id' => $lesson19Id, 'type' => 'multiple_choice',
                'question' => 'Si C = 90°, la Ley de Cosenos se convierte en...',
                'options' => json_encode(['El Teorema de Pitágoras', 'La Ley de Senos', 'Una identidad trigonométrica', 'La fórmula de Herón']),
                'correct_answer' => 'El Teorema de Pitágoras',
                'explanation' => 'Si C = 90°, cos(90°) = 0 y la fórmula queda c² = a² + b². ¡Es Pitágoras!',
                'difficulty' => 'medium', 'xp_value' => 15, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'lesson_id' => $lesson19Id, 'type' => 'multiple_choice',
                'question' => 'Un triángulo tiene lados a=7, b=5 y ángulo C=60°. ¿Cuánto vale c²?',
                'options' => json_encode(['39', '74', '49', '24']),
                'correct_answer' => '39',
                'explanation' => 'c² = 7² + 5² - 2(7)(5)cos(60°) = 49 + 25 - 70(0.5) = 74 - 35 = 39.',
                'difficulty' => 'hard', 'xp_value' => 20, 'created_at' => now(), 'updated_at' => now(),
            ],
        ]);

        // Lesson 20: Vectores y Trigonometría
        DB::table('questions')->insert([
            [
                'lesson_id' => $lesson20Id, 'type' => 'multiple_choice',
                'question' => 'Para descomponer un vector, la componente horizontal es...',
                'options' => json_encode(['V·cos(θ)', 'V·sen(θ)', 'V·tan(θ)', 'V/cos(θ)']),
                'correct_answer' => 'V·cos(θ)',
                'explanation' => 'La componente horizontal (Vx) se calcula como Vx = |V|·cos(θ).',
                'difficulty' => 'easy', 'xp_value' => 10, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'lesson_id' => $lesson20Id, 'type' => 'multiple_choice',
                'question' => 'Un vector de magnitud 10 forma un ángulo de 30° con el eje X. ¿Cuál es su componente vertical?',
                'options' => json_encode(['5', '8.66', '10', '7.07']),
                'correct_answer' => '5',
                'explanation' => 'Vy = 10·sen(30°) = 10·0.5 = 5.',
                'difficulty' => 'medium', 'xp_value' => 15, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'lesson_id' => $lesson20Id, 'type' => 'multiple_choice',
                'question' => 'Si Vx = 3 y Vy = 4, la magnitud del vector es...',
                'options' => json_encode(['5', '7', '12', '3.5']),
                'correct_answer' => '5',
                'explanation' => '|V| = √(Vx² + Vy²) = √(9 + 16) = √25 = 5. ¡Pitágoras en acción!',
                'difficulty' => 'medium', 'xp_value' => 15, 'created_at' => now(), 'updated_at' => now(),
            ],
        ]);

        // Lesson 21: Prueba Final
        DB::table('questions')->insert([
            [
                'lesson_id' => $lesson21Id, 'type' => 'multiple_choice',
                'question' => '¿Cuánto vale sen²(x) + cos²(x)?',
                'options' => json_encode(['0', '1', '2', 'Depende de x']),
                'correct_answer' => '1',
                'explanation' => 'La identidad pitagórica fundamental: sen²(x) + cos²(x) = 1, para todo x.',
                'difficulty' => 'easy', 'xp_value' => 10, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'lesson_id' => $lesson21Id, 'type' => 'multiple_choice',
                'question' => 'En un triángulo rectángulo con hipotenusa 13 y cateto opuesto 5, ¿cuánto vale el seno del ángulo?',
                'options' => json_encode(['5/13', '12/13', '5/12', '13/5']),
                'correct_answer' => '5/13',
                'explanation' => 'SOH: Seno = Opuesto/Hipotenusa = 5/13.',
                'difficulty' => 'medium', 'xp_value' => 15, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'lesson_id' => $lesson21Id, 'type' => 'multiple_choice',
                'question' => '¿Cuál es la amplitud de y = -4·cos(3x) + 1?',
                'options' => json_encode(['4', '-4', '3', '1']),
                'correct_answer' => '4',
                'explanation' => 'La amplitud es |A| = |-4| = 4. El signo negativo refleja la gráfica, no cambia la amplitud.',
                'difficulty' => 'hard', 'xp_value' => 20, 'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'lesson_id' => $lesson21Id, 'type' => 'multiple_choice',
                'question' => 'Un triángulo tiene ángulos A=45°, B=75° y lado a=10. Usando Ley de Senos, ¿cuánto vale b aproximadamente?',
                'options' => json_encode(['13.66', '7.32', '10', '14.14']),
                'correct_answer' => '13.66',
                'explanation' => 'b = a·sen(B)/sen(A) = 10·sen(75°)/sen(45°) = 10·0.9659/0.7071 ≈ 13.66.',
                'difficulty' => 'hard', 'xp_value' => 25, 'created_at' => now(), 'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        // Delete questions for new lessons
        $lessonSlugs = [
            'grafica-seno', 'grafica-coseno', 'amplitud-periodo', 'grafica-tangente',
            'ley-de-senos', 'ley-de-cosenos', 'vectores-trigonometria', 'prueba-final',
        ];
        $lessonIds = DB::table('lessons')->whereIn('slug', $lessonSlugs)->pluck('id');
        DB::table('questions')->whereIn('lesson_id', $lessonIds)->delete();
        DB::table('lessons')->whereIn('slug', $lessonSlugs)->delete();

        DB::table('worlds')->whereIn('slug', ['funciones-trigonometricas', 'trigonometria-avanzada'])->delete();
    }
};
