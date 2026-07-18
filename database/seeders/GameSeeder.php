<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\World;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\Achievement;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        // ========== WORLDS ==========
        $world1 = World::create([
            'name' => 'Ángulos y Triángulos',
            'slug' => 'angulos-triangulos',
            'description' => 'Domina los fundamentos: tipos de ángulos, clasificación de triángulos y sus propiedades.',
            'icon' => '🏔️',
            'color' => '#6C63FF',
            'bg_gradient' => 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
            'order' => 1,
            'xp_required' => 0,
        ]);

        $world2 = World::create([
            'name' => 'Razones Trigonométricas',
            'slug' => 'razones-trigonometricas',
            'description' => 'Descubre el poder del Seno, Coseno y Tangente. ¡SOH-CAH-TOA será tu hechizo!',
            'icon' => '🌊',
            'color' => '#00C9FF',
            'bg_gradient' => 'linear-gradient(135deg, #00c6fb 0%, #005bea 100%)',
            'order' => 2,
            'xp_required' => 200,
        ]);

        $world3 = World::create([
            'name' => 'Triángulo Rectángulo',
            'slug' => 'triangulo-rectangulo',
            'description' => 'Aplica tus conocimientos para resolver triángulos rectángulos y problemas reales.',
            'icon' => '🌋',
            'color' => '#FF6B6B',
            'bg_gradient' => 'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)',
            'order' => 3,
            'xp_required' => 500,
        ]);

        $world4 = World::create([
            'name' => 'Identidades y Aplicaciones',
            'slug' => 'identidades-aplicaciones',
            'description' => 'Domina las identidades trigonométricas y resuelve problemas del mundo real.',
            'icon' => '🏰',
            'color' => '#FFD93D',
            'bg_gradient' => 'linear-gradient(135deg, #f6d365 0%, #fda085 100%)',
            'order' => 4,
            'xp_required' => 900,
        ]);

        // ========== WORLD 1 LESSONS ==========
        $l1_1 = Lesson::create([
            'world_id' => $world1->id,
            'title' => 'Tipos de Ángulos',
            'slug' => 'tipos-de-angulos',
            'description' => 'Aprende a clasificar ángulos: agudo, recto, obtuso y llano.',
            'icon' => '📐',
            'order' => 1,
            'xp_reward' => 50,
            'content' => [
                ['type' => 'title', 'text' => '¿Qué es un ángulo?'],
                ['type' => 'text', 'text' => 'Un ángulo es la abertura formada por dos rayos que parten de un mismo punto llamado vértice. Se mide en grados (°).'],
                ['type' => 'interactive', 'widget' => 'angle-explorer'],
                ['type' => 'title', 'text' => 'Clasificación de Ángulos'],
                ['type' => 'card', 'icon' => '🔹', 'title' => 'Ángulo Agudo', 'text' => 'Mide entre 0° y 90°. Es más pequeño que una esquina de un cuadrado.', 'example' => '45°'],
                ['type' => 'card', 'icon' => '🔷', 'title' => 'Ángulo Recto', 'text' => 'Mide exactamente 90°. Es como la esquina de un cuadrado o una hoja de papel.', 'example' => '90°'],
                ['type' => 'card', 'icon' => '🔶', 'title' => 'Ángulo Obtuso', 'text' => 'Mide entre 90° y 180°. Es más abierto que un ángulo recto.', 'example' => '120°'],
                ['type' => 'card', 'icon' => '⬛', 'title' => 'Ángulo Llano', 'text' => 'Mide exactamente 180°. Forma una línea recta.', 'example' => '180°'],
                ['type' => 'tip', 'text' => '💡 Truco: Piensa en un reloj. A las 3:00 las manecillas forman un ángulo recto (90°).'],
            ],
        ]);

        $l1_2 = Lesson::create([
            'world_id' => $world1->id,
            'title' => 'Triángulos y su Clasificación',
            'slug' => 'triangulos-clasificacion',
            'description' => 'Conoce los tipos de triángulos según sus lados y ángulos.',
            'icon' => '🔺',
            'order' => 2,
            'xp_reward' => 60,
            'content' => [
                ['type' => 'title', 'text' => 'El Triángulo'],
                ['type' => 'text', 'text' => 'Un triángulo es un polígono de tres lados, tres vértices y tres ángulos. La suma de sus ángulos internos siempre es 180°.'],
                ['type' => 'title', 'text' => 'Por sus Lados'],
                ['type' => 'card', 'icon' => '🔺', 'title' => 'Equilátero', 'text' => 'Tres lados iguales y tres ángulos de 60°.', 'example' => '3 lados = 5cm'],
                ['type' => 'card', 'icon' => '📐', 'title' => 'Isósceles', 'text' => 'Dos lados iguales y un lado diferente. Dos ángulos iguales.', 'example' => '2 lados = 5cm, 1 lado = 3cm'],
                ['type' => 'card', 'icon' => '📏', 'title' => 'Escaleno', 'text' => 'Todos sus lados tienen diferente medida. Todos sus ángulos son diferentes.', 'example' => 'Lados: 3, 4, 5 cm'],
                ['type' => 'title', 'text' => 'Por sus Ángulos'],
                ['type' => 'card', 'icon' => '🔹', 'title' => 'Acutángulo', 'text' => 'Todos sus ángulos son agudos (menores de 90°).', 'example' => '60°, 70°, 50°'],
                ['type' => 'card', 'icon' => '🔷', 'title' => 'Rectángulo', 'text' => 'Tiene un ángulo recto (90°). ¡Este es clave para la trigonometría!', 'example' => '90°, 45°, 45°'],
                ['type' => 'card', 'icon' => '🔶', 'title' => 'Obtusángulo', 'text' => 'Tiene un ángulo obtuso (mayor de 90°).', 'example' => '120°, 30°, 30°'],
                ['type' => 'tip', 'text' => '💡 Los ángulos internos de TODO triángulo siempre suman 180°. ¡Es una ley universal!'],
            ],
        ]);

        $l1_3 = Lesson::create([
            'world_id' => $world1->id,
            'title' => 'Ángulos Complementarios y Suplementarios',
            'slug' => 'angulos-complementarios-suplementarios',
            'description' => 'Descubre las relaciones entre ángulos.',
            'icon' => '🔄',
            'order' => 3,
            'xp_reward' => 60,
            'content' => [
                ['type' => 'title', 'text' => 'Relaciones entre Ángulos'],
                ['type' => 'card', 'icon' => '🤝', 'title' => 'Complementarios', 'text' => 'Dos ángulos son complementarios cuando suman 90°.', 'example' => '30° + 60° = 90°'],
                ['type' => 'card', 'icon' => '🔗', 'title' => 'Suplementarios', 'text' => 'Dos ángulos son suplementarios cuando suman 180°.', 'example' => '120° + 60° = 180°'],
                ['type' => 'text', 'text' => 'Para encontrar el complemento: 90° - ángulo. Para encontrar el suplemento: 180° - ángulo.'],
                ['type' => 'tip', 'text' => '💡 Complementario empieza con C como Corner (90°). Suplementario empieza con S como Straight (180°).'],
            ],
        ]);

        // ========== WORLD 2 LESSONS ==========
        $l2_1 = Lesson::create([
            'world_id' => $world2->id,
            'title' => 'Introducción al SOH-CAH-TOA',
            'slug' => 'soh-cah-toa',
            'description' => 'El hechizo más poderoso: Seno, Coseno y Tangente.',
            'icon' => '✨',
            'order' => 1,
            'xp_reward' => 80,
            'content' => [
                ['type' => 'title', 'text' => 'Las Partes del Triángulo Rectángulo'],
                ['type' => 'text', 'text' => 'En un triángulo rectángulo, respecto a un ángulo agudo, tenemos tres lados:'],
                ['type' => 'card', 'icon' => '📏', 'title' => 'Hipotenusa (H)', 'text' => 'El lado más largo, opuesto al ángulo recto.', 'example' => 'Siempre es el mayor'],
                ['type' => 'card', 'icon' => '📐', 'title' => 'Cateto Opuesto (O)', 'text' => 'El lado que está frente al ángulo que analizamos.', 'example' => 'Opuesto al ángulo θ'],
                ['type' => 'card', 'icon' => '📏', 'title' => 'Cateto Adyacente (A)', 'text' => 'El lado que está junto al ángulo que analizamos (no es la hipotenusa).', 'example' => 'Al lado del ángulo θ'],
                ['type' => 'title', 'text' => '¡SOH-CAH-TOA!'],
                ['type' => 'card', 'icon' => '🟣', 'title' => 'SOH → Sen θ = O/H', 'text' => 'Seno = Cateto Opuesto ÷ Hipotenusa', 'example' => 'Sen 30° = 1/2 = 0.5'],
                ['type' => 'card', 'icon' => '🔵', 'title' => 'CAH → Cos θ = A/H', 'text' => 'Coseno = Cateto Adyacente ÷ Hipotenusa', 'example' => 'Cos 60° = 1/2 = 0.5'],
                ['type' => 'card', 'icon' => '🟢', 'title' => 'TOA → Tan θ = O/A', 'text' => 'Tangente = Cateto Opuesto ÷ Cateto Adyacente', 'example' => 'Tan 45° = 1'],
                ['type' => 'interactive', 'widget' => 'sohcahtoa-explorer'],
                ['type' => 'tip', 'text' => '💡 Memoriza: "SOH-CAH-TOA" como un hechizo mágico. ¡Seno-Opuesto-Hipotenusa, Coseno-Adyacente-Hipotenusa, Tangente-Opuesto-Adyacente!'],
            ],
        ]);

        $l2_2 = Lesson::create([
            'world_id' => $world2->id,
            'title' => 'El Seno',
            'slug' => 'el-seno',
            'description' => 'Domina la razón seno y sus valores especiales.',
            'icon' => '🟣',
            'order' => 2,
            'xp_reward' => 70,
            'content' => [
                ['type' => 'title', 'text' => 'Seno de un Ángulo'],
                ['type' => 'text', 'text' => 'El seno de un ángulo es la razón entre el cateto opuesto y la hipotenusa: Sen θ = Opuesto / Hipotenusa'],
                ['type' => 'title', 'text' => 'Valores Notables del Seno'],
                ['type' => 'card', 'icon' => '📊', 'title' => 'Sen 0° = 0', 'text' => 'El seno de 0 grados es cero.', 'example' => '0/H = 0'],
                ['type' => 'card', 'icon' => '📊', 'title' => 'Sen 30° = 1/2', 'text' => 'El seno de 30 grados es un medio.', 'example' => '0.5'],
                ['type' => 'card', 'icon' => '📊', 'title' => 'Sen 45° = √2/2', 'text' => 'El seno de 45 grados es raíz de 2 sobre 2.', 'example' => '≈ 0.707'],
                ['type' => 'card', 'icon' => '📊', 'title' => 'Sen 60° = √3/2', 'text' => 'El seno de 60 grados es raíz de 3 sobre 2.', 'example' => '≈ 0.866'],
                ['type' => 'card', 'icon' => '📊', 'title' => 'Sen 90° = 1', 'text' => 'El seno de 90 grados es uno.', 'example' => 'H/H = 1'],
                ['type' => 'tip', 'text' => '💡 El seno siempre tiene valores entre 0 y 1 para ángulos entre 0° y 90°.'],
            ],
        ]);

        $l2_3 = Lesson::create([
            'world_id' => $world2->id,
            'title' => 'El Coseno',
            'slug' => 'el-coseno',
            'description' => 'Domina la razón coseno y descubre su relación con el seno.',
            'icon' => '🔵',
            'order' => 3,
            'xp_reward' => 70,
            'content' => [
                ['type' => 'title', 'text' => 'Coseno de un Ángulo'],
                ['type' => 'text', 'text' => 'El coseno de un ángulo es la razón entre el cateto adyacente y la hipotenusa: Cos θ = Adyacente / Hipotenusa'],
                ['type' => 'title', 'text' => 'Valores Notables del Coseno'],
                ['type' => 'card', 'icon' => '📊', 'title' => 'Cos 0° = 1', 'text' => 'El coseno de 0 grados es uno.', 'example' => 'H/H = 1'],
                ['type' => 'card', 'icon' => '📊', 'title' => 'Cos 30° = √3/2', 'text' => 'El coseno de 30 grados es raíz de 3 sobre 2.', 'example' => '≈ 0.866'],
                ['type' => 'card', 'icon' => '📊', 'title' => 'Cos 45° = √2/2', 'text' => 'El coseno de 45 grados es raíz de 2 sobre 2.', 'example' => '≈ 0.707'],
                ['type' => 'card', 'icon' => '📊', 'title' => 'Cos 60° = 1/2', 'text' => 'El coseno de 60 grados es un medio.', 'example' => '0.5'],
                ['type' => 'card', 'icon' => '📊', 'title' => 'Cos 90° = 0', 'text' => 'El coseno de 90 grados es cero.', 'example' => '0/H = 0'],
                ['type' => 'tip', 'text' => '💡 ¿Notas algo? ¡Sen 30° = Cos 60° y Sen 60° = Cos 30°! Los ángulos complementarios intercambian seno y coseno.'],
            ],
        ]);

        $l2_4 = Lesson::create([
            'world_id' => $world2->id,
            'title' => 'La Tangente',
            'slug' => 'la-tangente',
            'description' => 'Aprende la tangente y cómo se relaciona con seno y coseno.',
            'icon' => '🟢',
            'order' => 4,
            'xp_reward' => 70,
            'content' => [
                ['type' => 'title', 'text' => 'Tangente de un Ángulo'],
                ['type' => 'text', 'text' => 'La tangente de un ángulo es la razón entre el cateto opuesto y el cateto adyacente: Tan θ = Opuesto / Adyacente. También: Tan θ = Sen θ / Cos θ'],
                ['type' => 'title', 'text' => 'Valores Notables de la Tangente'],
                ['type' => 'card', 'icon' => '📊', 'title' => 'Tan 0° = 0', 'text' => 'La tangente de 0 grados es cero.', 'example' => '0'],
                ['type' => 'card', 'icon' => '📊', 'title' => 'Tan 30° = √3/3', 'text' => 'La tangente de 30 grados.', 'example' => '≈ 0.577'],
                ['type' => 'card', 'icon' => '📊', 'title' => 'Tan 45° = 1', 'text' => 'La tangente de 45 grados es uno. ¡Los catetos son iguales!', 'example' => '1'],
                ['type' => 'card', 'icon' => '📊', 'title' => 'Tan 60° = √3', 'text' => 'La tangente de 60 grados.', 'example' => '≈ 1.732'],
                ['type' => 'tip', 'text' => '💡 Tan 90° no existe porque el coseno de 90° es 0 y no podemos dividir entre cero.'],
            ],
        ]);

        // ========== WORLD 3 LESSONS ==========
        $l3_1 = Lesson::create([
            'world_id' => $world3->id,
            'title' => 'Teorema de Pitágoras',
            'slug' => 'teorema-pitagoras',
            'description' => 'El arma legendaria: a² + b² = c²',
            'icon' => '⚔️',
            'order' => 1,
            'xp_reward' => 80,
            'content' => [
                ['type' => 'title', 'text' => 'El Teorema de Pitágoras'],
                ['type' => 'text', 'text' => 'En todo triángulo rectángulo, el cuadrado de la hipotenusa es igual a la suma de los cuadrados de los catetos.'],
                ['type' => 'card', 'icon' => '⚡', 'title' => 'La Fórmula', 'text' => 'a² + b² = c², donde c es la hipotenusa y a, b son los catetos.', 'example' => '3² + 4² = 5²  →  9 + 16 = 25 ✓'],
                ['type' => 'text', 'text' => 'Usa esta fórmula para encontrar cualquier lado de un triángulo rectángulo si conoces los otros dos.'],
                ['type' => 'card', 'icon' => '🔍', 'title' => 'Encontrar la Hipotenusa', 'text' => 'c = √(a² + b²)', 'example' => 'Si a=6, b=8 → c = √(36+64) = √100 = 10'],
                ['type' => 'card', 'icon' => '🔍', 'title' => 'Encontrar un Cateto', 'text' => 'a = √(c² - b²)', 'example' => 'Si c=13, b=5 → a = √(169-25) = √144 = 12'],
                ['type' => 'interactive', 'widget' => 'pythagoras-explorer'],
                ['type' => 'tip', 'text' => '💡 Las ternas pitagóricas más famosas: (3,4,5), (5,12,13), (8,15,17), (7,24,25)'],
            ],
        ]);

        $l3_2 = Lesson::create([
            'world_id' => $world3->id,
            'title' => 'Resolver Triángulos Rectángulos',
            'slug' => 'resolver-triangulos',
            'description' => 'Combina Pitágoras y razones trigonométricas para resolver triángulos.',
            'icon' => '🧩',
            'order' => 2,
            'xp_reward' => 90,
            'content' => [
                ['type' => 'title', 'text' => 'Resolver un Triángulo Rectángulo'],
                ['type' => 'text', 'text' => 'Resolver un triángulo significa encontrar todos sus lados y ángulos. Necesitas al menos: un lado y un ángulo agudo, o dos lados.'],
                ['type' => 'title', 'text' => 'Estrategia'],
                ['type' => 'card', 'icon' => '1️⃣', 'title' => 'Paso 1: Identifica lo conocido', 'text' => '¿Qué datos tienes? ¿Lados? ¿Ángulos?', 'example' => 'Hipotenusa=10, ángulo=30°'],
                ['type' => 'card', 'icon' => '2️⃣', 'title' => 'Paso 2: Elige la razón correcta', 'text' => 'Según los datos, usa Sen, Cos o Tan.', 'example' => 'Si tienes H y buscas O → usa Seno'],
                ['type' => 'card', 'icon' => '3️⃣', 'title' => 'Paso 3: Resuelve la ecuación', 'text' => 'Despeja la incógnita y calcula.', 'example' => 'Sen 30° = O/10 → O = 10 × 0.5 = 5'],
                ['type' => 'card', 'icon' => '4️⃣', 'title' => 'Paso 4: Encuentra lo que falta', 'text' => 'Usa Pitágoras para el tercer lado y suma de ángulos (180°) para el tercer ángulo.', 'example' => 'Tercer ángulo = 180° - 90° - 30° = 60°'],
                ['type' => 'tip', 'text' => '💡 Si conoces dos lados, puedes usar funciones trigonométricas inversas para encontrar ángulos.'],
            ],
        ]);

        $l3_3 = Lesson::create([
            'world_id' => $world3->id,
            'title' => 'Problemas de Aplicación',
            'slug' => 'problemas-aplicacion',
            'description' => 'Ángulos de elevación, depresión y problemas cotidianos.',
            'icon' => '🌍',
            'order' => 3,
            'xp_reward' => 100,
            'content' => [
                ['type' => 'title', 'text' => 'Trigonometría en la Vida Real'],
                ['type' => 'card', 'icon' => '🏗️', 'title' => 'Ángulo de Elevación', 'text' => 'Es el ángulo formado al mirar HACIA ARRIBA desde la horizontal.', 'example' => 'Mirar la cima de un edificio desde la calle'],
                ['type' => 'card', 'icon' => '🏖️', 'title' => 'Ángulo de Depresión', 'text' => 'Es el ángulo formado al mirar HACIA ABAJO desde la horizontal.', 'example' => 'Mirar un barco desde un faro'],
                ['type' => 'text', 'text' => 'Ejemplo: Desde un punto a 50m de un edificio, el ángulo de elevación a su cima es 60°. ¿Cuál es la altura? Tan 60° = h/50 → h = 50 × tan 60° = 50 × 1.732 = 86.6m'],
                ['type' => 'tip', 'text' => '💡 Dibuja siempre el triángulo rectángulo. Identifica qué datos tienes y qué necesitas encontrar.'],
            ],
        ]);

        // ========== WORLD 4 LESSONS ==========
        $l4_1 = Lesson::create([
            'world_id' => $world4->id,
            'title' => 'Identidad Pitagórica',
            'slug' => 'identidad-pitagorica',
            'description' => 'La identidad fundamental: sen²θ + cos²θ = 1',
            'icon' => '🔮',
            'order' => 1,
            'xp_reward' => 90,
            'content' => [
                ['type' => 'title', 'text' => 'La Identidad Pitagórica'],
                ['type' => 'text', 'text' => 'La identidad trigonométrica más importante dice que para cualquier ángulo θ: sen²θ + cos²θ = 1'],
                ['type' => 'card', 'icon' => '🔮', 'title' => '¿Por qué funciona?', 'text' => 'Viene del Teorema de Pitágoras. Si dividimos a² + b² = c² entre c²: (a/c)² + (b/c)² = 1, es decir: sen²θ + cos²θ = 1', 'example' => 'Sen²30° + Cos²30° = 0.25 + 0.75 = 1 ✓'],
                ['type' => 'text', 'text' => 'De esta identidad podemos despejar: sen²θ = 1 - cos²θ y cos²θ = 1 - sen²θ'],
                ['type' => 'tip', 'text' => '💡 Esta identidad te permite encontrar el seno si conoces el coseno, y viceversa.'],
            ],
        ]);

        $l4_2 = Lesson::create([
            'world_id' => $world4->id,
            'title' => 'Más Identidades',
            'slug' => 'mas-identidades',
            'description' => 'Identidades recíprocas y cocientes.',
            'icon' => '📜',
            'order' => 2,
            'xp_reward' => 90,
            'content' => [
                ['type' => 'title', 'text' => 'Identidades de Cociente'],
                ['type' => 'card', 'icon' => '📊', 'title' => 'Tan θ = Sen θ / Cos θ', 'text' => 'La tangente es el cociente del seno entre el coseno.', 'example' => 'Tan 45° = Sen 45° / Cos 45° = 1'],
                ['type' => 'title', 'text' => 'Razones Recíprocas'],
                ['type' => 'card', 'icon' => '🔄', 'title' => 'Cosecante (Csc)', 'text' => 'Csc θ = 1 / Sen θ = H / O', 'example' => 'Csc 30° = 1/0.5 = 2'],
                ['type' => 'card', 'icon' => '🔄', 'title' => 'Secante (Sec)', 'text' => 'Sec θ = 1 / Cos θ = H / A', 'example' => 'Sec 60° = 1/0.5 = 2'],
                ['type' => 'card', 'icon' => '🔄', 'title' => 'Cotangente (Cot)', 'text' => 'Cot θ = 1 / Tan θ = A / O', 'example' => 'Cot 45° = 1/1 = 1'],
                ['type' => 'tip', 'text' => '💡 Cosecante es recíproca del Seno, Secante del Coseno, Cotangente de la Tangente.'],
            ],
        ]);

        $l4_3 = Lesson::create([
            'world_id' => $world4->id,
            'title' => 'Desafío Final',
            'slug' => 'desafio-final',
            'description' => 'Pon a prueba todo lo que has aprendido.',
            'icon' => '🏆',
            'order' => 3,
            'xp_reward' => 150,
            'content' => [
                ['type' => 'title', 'text' => '🏆 El Gran Desafío'],
                ['type' => 'text', 'text' => '¡Has llegado al desafío final! Demuestra todo lo que has aprendido sobre trigonometría respondiendo las preguntas más difíciles.'],
                ['type' => 'text', 'text' => 'Este quiz cubre TODOS los temas: ángulos, triángulos, razones trigonométricas, Pitágoras, identidades y aplicaciones.'],
                ['type' => 'tip', 'text' => '💡 Necesitas al menos 80% para obtener las 3 estrellas y el logro de Maestro Trigonométrico.'],
            ],
        ]);

        // ========== QUESTIONS ==========
        // World 1 - Lesson 1: Tipos de Ángulos
        $this->createQuestions($l1_1, [
            ['type' => 'multiple_choice', 'question' => '¿Cuánto mide un ángulo recto?', 'options' => ['45°', '90°', '180°', '360°'], 'correct_answer' => '90°', 'explanation' => 'Un ángulo recto mide exactamente 90°, como la esquina de un cuadrado.', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'multiple_choice', 'question' => 'Un ángulo que mide 45° es un ángulo:', 'options' => ['Agudo', 'Recto', 'Obtuso', 'Llano'], 'correct_answer' => 'Agudo', 'explanation' => 'Un ángulo agudo mide entre 0° y 90°. Como 45° está en ese rango, es agudo.', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'multiple_choice', 'question' => '¿Cuánto mide un ángulo llano?', 'options' => ['90°', '120°', '180°', '270°'], 'correct_answer' => '180°', 'explanation' => 'Un ángulo llano mide exactamente 180° y forma una línea recta.', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'true_false', 'question' => 'Un ángulo de 135° es un ángulo obtuso.', 'options' => ['Verdadero', 'Falso'], 'correct_answer' => 'Verdadero', 'explanation' => 'Un ángulo obtuso mide entre 90° y 180°. 135° está en ese rango.', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'multiple_choice', 'question' => '¿Qué tipo de ángulo se forma entre las manecillas de un reloj a las 3:00?', 'options' => ['Agudo', 'Recto', 'Obtuso', 'Llano'], 'correct_answer' => 'Recto', 'explanation' => 'A las 3:00, las manecillas forman exactamente un ángulo de 90° (recto).', 'difficulty' => 'medium', 'xp_value' => 15],
        ]);

        // World 1 - Lesson 2: Triángulos
        $this->createQuestions($l1_2, [
            ['type' => 'multiple_choice', 'question' => '¿Cuánto suman los ángulos internos de un triángulo?', 'options' => ['90°', '180°', '270°', '360°'], 'correct_answer' => '180°', 'explanation' => 'La suma de los ángulos internos de cualquier triángulo es siempre 180°.', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'multiple_choice', 'question' => 'Un triángulo con todos sus lados iguales se llama:', 'options' => ['Escaleno', 'Isósceles', 'Equilátero', 'Rectángulo'], 'correct_answer' => 'Equilátero', 'explanation' => 'Un triángulo equilátero tiene sus tres lados y tres ángulos iguales (60° cada uno).', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'multiple_choice', 'question' => 'Un triángulo con un ángulo de 90° se llama:', 'options' => ['Acutángulo', 'Obtusángulo', 'Rectángulo', 'Equilátero'], 'correct_answer' => 'Rectángulo', 'explanation' => 'Un triángulo rectángulo tiene exactamente un ángulo recto (90°).', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'true_false', 'question' => 'Un triángulo puede tener dos ángulos rectos.', 'options' => ['Verdadero', 'Falso'], 'correct_answer' => 'Falso', 'explanation' => 'Si tuviera dos ángulos de 90°, la suma ya sería 180° y no quedaría espacio para el tercer ángulo.', 'difficulty' => 'medium', 'xp_value' => 15],
            ['type' => 'multiple_choice', 'question' => 'Si un triángulo tiene ángulos de 50° y 60°, ¿cuánto mide el tercer ángulo?', 'options' => ['60°', '70°', '80°', '90°'], 'correct_answer' => '70°', 'explanation' => '180° - 50° - 60° = 70°. Recuerda que los tres ángulos suman 180°.', 'difficulty' => 'medium', 'xp_value' => 15],
        ]);

        // World 1 - Lesson 3: Complementarios y Suplementarios
        $this->createQuestions($l1_3, [
            ['type' => 'multiple_choice', 'question' => '¿Cuál es el complemento de un ángulo de 35°?', 'options' => ['45°', '55°', '65°', '145°'], 'correct_answer' => '55°', 'explanation' => 'Complemento = 90° - 35° = 55°. Los ángulos complementarios suman 90°.', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'multiple_choice', 'question' => '¿Cuál es el suplemento de un ángulo de 120°?', 'options' => ['30°', '60°', '90°', '240°'], 'correct_answer' => '60°', 'explanation' => 'Suplemento = 180° - 120° = 60°. Los ángulos suplementarios suman 180°.', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'true_false', 'question' => 'Dos ángulos de 45° son complementarios.', 'options' => ['Verdadero', 'Falso'], 'correct_answer' => 'Verdadero', 'explanation' => '45° + 45° = 90°. Como suman 90°, son complementarios.', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'multiple_choice', 'question' => 'Si dos ángulos son suplementarios y uno mide 75°, ¿cuánto mide el otro?', 'options' => ['15°', '75°', '105°', '115°'], 'correct_answer' => '105°', 'explanation' => '180° - 75° = 105°', 'difficulty' => 'medium', 'xp_value' => 15],
            ['type' => 'true_false', 'question' => 'Un ángulo obtuso puede tener complemento.', 'options' => ['Verdadero', 'Falso'], 'correct_answer' => 'Falso', 'explanation' => 'Un ángulo obtuso es mayor que 90°, así que no puede tener complemento (el complemento sería negativo).', 'difficulty' => 'hard', 'xp_value' => 20],
        ]);

        // World 2 - Lesson 1: SOH-CAH-TOA
        $this->createQuestions($l2_1, [
            ['type' => 'multiple_choice', 'question' => 'En SOH-CAH-TOA, ¿qué representa la "S" en SOH?', 'options' => ['Secante', 'Seno', 'Suplemento', 'Segmento'], 'correct_answer' => 'Seno', 'explanation' => 'SOH = Seno = Opuesto / Hipotenusa', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'multiple_choice', 'question' => '¿Cuál es la fórmula del Coseno?', 'options' => ['Opuesto/Hipotenusa', 'Adyacente/Hipotenusa', 'Opuesto/Adyacente', 'Hipotenusa/Opuesto'], 'correct_answer' => 'Adyacente/Hipotenusa', 'explanation' => 'CAH: Coseno = Adyacente / Hipotenusa', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'multiple_choice', 'question' => 'La Tangente de un ángulo es:', 'options' => ['Opuesto/Hipotenusa', 'Adyacente/Hipotenusa', 'Opuesto/Adyacente', 'Adyacente/Opuesto'], 'correct_answer' => 'Opuesto/Adyacente', 'explanation' => 'TOA: Tangente = Opuesto / Adyacente', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'multiple_choice', 'question' => 'En un triángulo rectángulo, ¿cuál es el lado más largo?', 'options' => ['Cateto opuesto', 'Cateto adyacente', 'Hipotenusa', 'Depende del triángulo'], 'correct_answer' => 'Hipotenusa', 'explanation' => 'La hipotenusa siempre es el lado más largo, opuesto al ángulo recto.', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'true_false', 'question' => 'El cateto adyacente es el lado que está frente al ángulo de referencia.', 'options' => ['Verdadero', 'Falso'], 'correct_answer' => 'Falso', 'explanation' => 'El cateto OPUESTO es el que está frente al ángulo. El adyacente es el que está junto al ángulo.', 'difficulty' => 'medium', 'xp_value' => 15],
        ]);

        // World 2 - Lesson 2: El Seno
        $this->createQuestions($l2_2, [
            ['type' => 'multiple_choice', 'question' => '¿Cuánto vale Sen 30°?', 'options' => ['0', '1/2', '√2/2', '√3/2'], 'correct_answer' => '1/2', 'explanation' => 'Sen 30° = 1/2 = 0.5. Es uno de los valores notables que debes memorizar.', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'multiple_choice', 'question' => '¿Cuánto vale Sen 90°?', 'options' => ['0', '1/2', '√2/2', '1'], 'correct_answer' => '1', 'explanation' => 'Sen 90° = 1. Es el valor máximo del seno.', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'multiple_choice', 'question' => 'Si Sen θ = 0.5, ¿cuánto vale θ?', 'options' => ['30°', '45°', '60°', '90°'], 'correct_answer' => '30°', 'explanation' => 'Sen 30° = 0.5, por lo tanto θ = 30°.', 'difficulty' => 'medium', 'xp_value' => 15],
            ['type' => 'multiple_choice', 'question' => 'En un triángulo rectángulo con hipotenusa=10 y ángulo=30°, ¿cuánto mide el cateto opuesto?', 'options' => ['3', '5', '7', '8.66'], 'correct_answer' => '5', 'explanation' => 'Sen 30° = O/H → 0.5 = O/10 → O = 5', 'difficulty' => 'medium', 'xp_value' => 15],
            ['type' => 'true_false', 'question' => 'El seno de un ángulo puede ser mayor que 1.', 'options' => ['Verdadero', 'Falso'], 'correct_answer' => 'Falso', 'explanation' => 'El seno siempre tiene valores entre -1 y 1. Para ángulos agudos, entre 0 y 1.', 'difficulty' => 'medium', 'xp_value' => 15],
        ]);

        // World 2 - Lesson 3: El Coseno
        $this->createQuestions($l2_3, [
            ['type' => 'multiple_choice', 'question' => '¿Cuánto vale Cos 60°?', 'options' => ['0', '1/2', '√2/2', '√3/2'], 'correct_answer' => '1/2', 'explanation' => 'Cos 60° = 1/2 = 0.5', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'multiple_choice', 'question' => '¿Cuánto vale Cos 0°?', 'options' => ['0', '1/2', '√2/2', '1'], 'correct_answer' => '1', 'explanation' => 'Cos 0° = 1', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'true_false', 'question' => 'Sen 30° = Cos 60°', 'options' => ['Verdadero', 'Falso'], 'correct_answer' => 'Verdadero', 'explanation' => 'Ambos valen 1/2. Los ángulos complementarios (30°+60°=90°) intercambian seno y coseno.', 'difficulty' => 'medium', 'xp_value' => 15],
            ['type' => 'multiple_choice', 'question' => 'En un triángulo rectángulo con hipotenusa=8 y ángulo=60°, ¿cuánto mide el cateto adyacente?', 'options' => ['2', '4', '6', '6.93'], 'correct_answer' => '4', 'explanation' => 'Cos 60° = A/H → 0.5 = A/8 → A = 4', 'difficulty' => 'medium', 'xp_value' => 15],
            ['type' => 'multiple_choice', 'question' => '¿Cuánto vale Cos 45°?', 'options' => ['0', '1/2', '√2/2', '1'], 'correct_answer' => '√2/2', 'explanation' => 'Cos 45° = √2/2 ≈ 0.707', 'difficulty' => 'easy', 'xp_value' => 10],
        ]);

        // World 2 - Lesson 4: La Tangente
        $this->createQuestions($l2_4, [
            ['type' => 'multiple_choice', 'question' => '¿Cuánto vale Tan 45°?', 'options' => ['0', '1/2', '1', '√3'], 'correct_answer' => '1', 'explanation' => 'Tan 45° = 1 porque el cateto opuesto y el adyacente son iguales.', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'multiple_choice', 'question' => '¿Cuánto vale Tan 0°?', 'options' => ['0', '1', 'Infinito', 'No existe'], 'correct_answer' => '0', 'explanation' => 'Tan 0° = Sen 0° / Cos 0° = 0/1 = 0', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'true_false', 'question' => 'Tan 90° existe y vale infinito.', 'options' => ['Verdadero', 'Falso'], 'correct_answer' => 'Falso', 'explanation' => 'Tan 90° no existe porque Cos 90° = 0 y no se puede dividir entre cero.', 'difficulty' => 'medium', 'xp_value' => 15],
            ['type' => 'multiple_choice', 'question' => 'Tan θ es equivalente a:', 'options' => ['Sen θ × Cos θ', 'Sen θ / Cos θ', 'Cos θ / Sen θ', '1 / Sen θ'], 'correct_answer' => 'Sen θ / Cos θ', 'explanation' => 'La tangente es el cociente del seno entre el coseno.', 'difficulty' => 'medium', 'xp_value' => 15],
            ['type' => 'multiple_choice', 'question' => 'Si desde un punto el ángulo de elevación a un árbol es 45° y estás a 20m, ¿cuál es la altura del árbol?', 'options' => ['10m', '20m', '30m', '40m'], 'correct_answer' => '20m', 'explanation' => 'Tan 45° = h/20 → 1 = h/20 → h = 20m', 'difficulty' => 'hard', 'xp_value' => 20],
        ]);

        // World 3 - Lesson 1: Pitágoras
        $this->createQuestions($l3_1, [
            ['type' => 'multiple_choice', 'question' => 'Si los catetos miden 3 y 4, ¿cuánto mide la hipotenusa?', 'options' => ['5', '6', '7', '12'], 'correct_answer' => '5', 'explanation' => '3² + 4² = 9 + 16 = 25. √25 = 5', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'multiple_choice', 'question' => 'Si la hipotenusa mide 13 y un cateto mide 5, ¿cuánto mide el otro cateto?', 'options' => ['8', '10', '12', '14'], 'correct_answer' => '12', 'explanation' => '13² - 5² = 169 - 25 = 144. √144 = 12', 'difficulty' => 'medium', 'xp_value' => 15],
            ['type' => 'true_false', 'question' => 'El Teorema de Pitágoras se aplica a todos los triángulos.', 'options' => ['Verdadero', 'Falso'], 'correct_answer' => 'Falso', 'explanation' => 'Solo se aplica a triángulos rectángulos (con un ángulo de 90°).', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'multiple_choice', 'question' => 'Si ambos catetos miden 1, ¿cuánto mide la hipotenusa?', 'options' => ['1', '√2', '2', '√3'], 'correct_answer' => '√2', 'explanation' => '1² + 1² = 2. √2 ≈ 1.414', 'difficulty' => 'medium', 'xp_value' => 15],
            ['type' => 'multiple_choice', 'question' => '¿Cuál de estas NO es una terna pitagórica?', 'options' => ['3, 4, 5', '5, 12, 13', '6, 8, 11', '8, 15, 17'], 'correct_answer' => '6, 8, 11', 'explanation' => '6² + 8² = 36 + 64 = 100. √100 = 10, no 11.', 'difficulty' => 'hard', 'xp_value' => 20],
        ]);

        // World 3 - Lesson 2: Resolver Triángulos
        $this->createQuestions($l3_2, [
            ['type' => 'multiple_choice', 'question' => 'En un triángulo rectángulo con hipotenusa=10 y ángulo=30°, el cateto opuesto mide:', 'options' => ['5', '7.07', '8.66', '10'], 'correct_answer' => '5', 'explanation' => 'Sen 30° = O/10 → O = 10 × 0.5 = 5', 'difficulty' => 'medium', 'xp_value' => 15],
            ['type' => 'multiple_choice', 'question' => 'En un triángulo rectángulo con cateto opuesto=6 y cateto adyacente=6, ¿cuánto vale el ángulo?', 'options' => ['30°', '45°', '60°', '90°'], 'correct_answer' => '45°', 'explanation' => 'Tan θ = 6/6 = 1, y Tan 45° = 1, por lo tanto θ = 45°.', 'difficulty' => 'medium', 'xp_value' => 15],
            ['type' => 'multiple_choice', 'question' => 'Si en un triángulo rectángulo los ángulos agudos son 30° y 60°, y la hipotenusa es 20, ¿cuánto mide el cateto opuesto al ángulo de 60°?', 'options' => ['10', '14.14', '17.32', '20'], 'correct_answer' => '17.32', 'explanation' => 'Sen 60° = O/20 → O = 20 × 0.866 = 17.32', 'difficulty' => 'hard', 'xp_value' => 20],
            ['type' => 'true_false', 'question' => 'Para resolver un triángulo rectángulo necesitas conocer al menos un lado y un ángulo agudo.', 'options' => ['Verdadero', 'Falso'], 'correct_answer' => 'Verdadero', 'explanation' => 'Con un lado y un ángulo agudo puedes encontrar todos los demás elementos del triángulo.', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'multiple_choice', 'question' => 'El tercer ángulo de un triángulo rectángulo con un ángulo de 35° mide:', 'options' => ['45°', '55°', '65°', '145°'], 'correct_answer' => '55°', 'explanation' => '180° - 90° - 35° = 55°', 'difficulty' => 'easy', 'xp_value' => 10],
        ]);

        // World 3 - Lesson 3: Problemas de Aplicación
        $this->createQuestions($l3_3, [
            ['type' => 'multiple_choice', 'question' => 'El ángulo de elevación se forma al mirar:', 'options' => ['Hacia abajo', 'Hacia arriba', 'Hacia los lados', 'Hacia atrás'], 'correct_answer' => 'Hacia arriba', 'explanation' => 'El ángulo de elevación se forma al mirar hacia arriba desde la horizontal.', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'multiple_choice', 'question' => 'Desde 30m de un poste, el ángulo de elevación es 45°. ¿Cuál es la altura?', 'options' => ['15m', '30m', '45m', '60m'], 'correct_answer' => '30m', 'explanation' => 'Tan 45° = h/30 → 1 = h/30 → h = 30m', 'difficulty' => 'medium', 'xp_value' => 15],
            ['type' => 'multiple_choice', 'question' => 'Una escalera de 10m está apoyada en una pared formando 60° con el suelo. ¿A qué altura llega?', 'options' => ['5m', '7.07m', '8.66m', '10m'], 'correct_answer' => '8.66m', 'explanation' => 'Sen 60° = h/10 → h = 10 × 0.866 = 8.66m', 'difficulty' => 'hard', 'xp_value' => 20],
            ['type' => 'true_false', 'question' => 'El ángulo de depresión y el ángulo de elevación correspondiente son iguales.', 'options' => ['Verdadero', 'Falso'], 'correct_answer' => 'Verdadero', 'explanation' => 'Son ángulos alternos internos entre paralelas, por lo tanto son iguales.', 'difficulty' => 'medium', 'xp_value' => 15],
            ['type' => 'multiple_choice', 'question' => 'Un avión vuela a 1000m de altura. El ángulo de depresión al aeropuerto es 30°. ¿A qué distancia horizontal está?', 'options' => ['577m', '1000m', '1732m', '2000m'], 'correct_answer' => '1732m', 'explanation' => 'Tan 30° = 1000/d → d = 1000/Tan 30° = 1000/0.577 ≈ 1732m', 'difficulty' => 'hard', 'xp_value' => 20],
        ]);

        // World 4 - Lesson 1: Identidad Pitagórica
        $this->createQuestions($l4_1, [
            ['type' => 'multiple_choice', 'question' => 'La identidad pitagórica dice que:', 'options' => ['sen θ + cos θ = 1', 'sen²θ + cos²θ = 1', 'sen²θ - cos²θ = 1', 'tan²θ + 1 = sec²θ'], 'correct_answer' => 'sen²θ + cos²θ = 1', 'explanation' => 'La identidad pitagórica fundamental es sen²θ + cos²θ = 1.', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'multiple_choice', 'question' => 'Si Cos θ = 0.6, ¿cuánto vale Sen θ? (θ agudo)', 'options' => ['0.4', '0.6', '0.8', '1'], 'correct_answer' => '0.8', 'explanation' => 'Sen²θ = 1 - Cos²θ = 1 - 0.36 = 0.64. Sen θ = √0.64 = 0.8', 'difficulty' => 'medium', 'xp_value' => 15],
            ['type' => 'true_false', 'question' => 'Sen²45° + Cos²45° = 1', 'options' => ['Verdadero', 'Falso'], 'correct_answer' => 'Verdadero', 'explanation' => '(√2/2)² + (√2/2)² = 1/2 + 1/2 = 1 ✓', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'multiple_choice', 'question' => 'Si Sen θ = 3/5, ¿cuánto vale Cos θ? (θ agudo)', 'options' => ['2/5', '3/5', '4/5', '5/3'], 'correct_answer' => '4/5', 'explanation' => 'Cos²θ = 1 - (3/5)² = 1 - 9/25 = 16/25. Cos θ = 4/5', 'difficulty' => 'hard', 'xp_value' => 20],
            ['type' => 'multiple_choice', 'question' => 'De sen²θ + cos²θ = 1, podemos despejar:', 'options' => ['sen²θ = 1 + cos²θ', 'sen²θ = 1 - cos²θ', 'sen²θ = cos²θ - 1', 'sen²θ = 1 / cos²θ'], 'correct_answer' => 'sen²θ = 1 - cos²θ', 'explanation' => 'Restando cos²θ de ambos lados: sen²θ = 1 - cos²θ', 'difficulty' => 'easy', 'xp_value' => 10],
        ]);

        // World 4 - Lesson 2: Más Identidades
        $this->createQuestions($l4_2, [
            ['type' => 'multiple_choice', 'question' => 'La cosecante (Csc) es la recíproca de:', 'options' => ['Coseno', 'Tangente', 'Seno', 'Cotangente'], 'correct_answer' => 'Seno', 'explanation' => 'Csc θ = 1/Sen θ', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'multiple_choice', 'question' => '¿Cuánto vale Csc 30°?', 'options' => ['1/2', '1', '2', '√3'], 'correct_answer' => '2', 'explanation' => 'Csc 30° = 1/Sen 30° = 1/(1/2) = 2', 'difficulty' => 'medium', 'xp_value' => 15],
            ['type' => 'multiple_choice', 'question' => 'Sec θ es igual a:', 'options' => ['1/Sen θ', '1/Cos θ', '1/Tan θ', 'Sen θ/Cos θ'], 'correct_answer' => '1/Cos θ', 'explanation' => 'Secante es la recíproca del coseno.', 'difficulty' => 'easy', 'xp_value' => 10],
            ['type' => 'true_false', 'question' => 'Cot θ = Cos θ / Sen θ', 'options' => ['Verdadero', 'Falso'], 'correct_answer' => 'Verdadero', 'explanation' => 'Cot θ = 1/Tan θ = 1/(Sen θ/Cos θ) = Cos θ/Sen θ', 'difficulty' => 'medium', 'xp_value' => 15],
            ['type' => 'multiple_choice', 'question' => 'Si Tan θ = 3/4 y θ es agudo, ¿cuánto vale Sen θ?', 'options' => ['3/4', '3/5', '4/5', '5/3'], 'correct_answer' => '3/5', 'explanation' => 'Si O=3, A=4, por Pitágoras H=5. Sen θ = O/H = 3/5', 'difficulty' => 'hard', 'xp_value' => 20],
        ]);

        // World 4 - Lesson 3: Desafío Final
        $this->createQuestions($l4_3, [
            ['type' => 'multiple_choice', 'question' => 'Si Sen θ = 5/13, ¿cuánto vale Cos θ? (θ agudo)', 'options' => ['5/13', '8/13', '12/13', '13/5'], 'correct_answer' => '12/13', 'explanation' => 'Cos²θ = 1 - 25/169 = 144/169. Cos θ = 12/13', 'difficulty' => 'hard', 'xp_value' => 20],
            ['type' => 'multiple_choice', 'question' => 'Un faro de 100m de alto. El ángulo de depresión a un barco es 30°. ¿A qué distancia está el barco?', 'options' => ['57.7m', '100m', '173.2m', '200m'], 'correct_answer' => '173.2m', 'explanation' => 'Tan 30° = 100/d → d = 100/0.577 ≈ 173.2m', 'difficulty' => 'hard', 'xp_value' => 20],
            ['type' => 'multiple_choice', 'question' => '¿Cuánto vale Sen²60° + Cos²60°?', 'options' => ['0', '1/2', '1', '2'], 'correct_answer' => '1', 'explanation' => 'Por la identidad pitagórica, Sen²θ + Cos²θ = 1 para cualquier ángulo.', 'difficulty' => 'medium', 'xp_value' => 15],
            ['type' => 'multiple_choice', 'question' => 'En un triángulo rectángulo, los catetos miden 5 y 12. El Sen del ángulo opuesto al cateto de 5 es:', 'options' => ['5/12', '5/13', '12/13', '13/5'], 'correct_answer' => '5/13', 'explanation' => 'H = √(25+144) = √169 = 13. Sen θ = O/H = 5/13', 'difficulty' => 'hard', 'xp_value' => 20],
            ['type' => 'multiple_choice', 'question' => 'Tan 60° × Cos 60° es igual a:', 'options' => ['Sen 60°', 'Cos 60°', 'Tan 60°', '1'], 'correct_answer' => 'Sen 60°', 'explanation' => 'Tan θ × Cos θ = (Sen θ/Cos θ) × Cos θ = Sen θ', 'difficulty' => 'hard', 'xp_value' => 20],
            ['type' => 'multiple_choice', 'question' => 'Si la sombra de un edificio mide 50m cuando el ángulo de elevación del sol es 60°, ¿cuál es la altura del edificio?', 'options' => ['25m', '50m', '86.6m', '100m'], 'correct_answer' => '86.6m', 'explanation' => 'Tan 60° = h/50 → h = 50 × 1.732 = 86.6m', 'difficulty' => 'hard', 'xp_value' => 20],
        ]);

        // ========== ACHIEVEMENTS ==========
        Achievement::create(['name' => 'Primer Paso', 'description' => 'Completa tu primera lección', 'icon' => '👣', 'condition_type' => 'lessons_completed', 'condition_value' => 1, 'xp_reward' => 25]);
        Achievement::create(['name' => 'Curioso', 'description' => 'Completa 3 lecciones', 'icon' => '🔍', 'condition_type' => 'lessons_completed', 'condition_value' => 3, 'xp_reward' => 50]);
        Achievement::create(['name' => 'Explorador', 'description' => 'Completa 5 lecciones', 'icon' => '🧭', 'condition_type' => 'lessons_completed', 'condition_value' => 5, 'xp_reward' => 75]);
        Achievement::create(['name' => 'Estudioso', 'description' => 'Completa 10 lecciones', 'icon' => '📚', 'condition_type' => 'lessons_completed', 'condition_value' => 10, 'xp_reward' => 150]);
        Achievement::create(['name' => 'Perfeccionista', 'description' => 'Obtén 3 estrellas en una lección', 'icon' => '⭐', 'condition_type' => 'perfect_score', 'condition_value' => 1, 'xp_reward' => 50]);
        Achievement::create(['name' => 'Racha de Fuego', 'description' => 'Logra una racha de 5 respuestas correctas', 'icon' => '🔥', 'condition_type' => 'streak', 'condition_value' => 5, 'xp_reward' => 30]);
        Achievement::create(['name' => 'Imparable', 'description' => 'Logra una racha de 10 respuestas correctas', 'icon' => '⚡', 'condition_type' => 'streak', 'condition_value' => 10, 'xp_reward' => 75]);
        Achievement::create(['name' => 'Maestro Trigonométrico', 'description' => 'Completa todos los mundos', 'icon' => '🏆', 'condition_type' => 'worlds_completed', 'condition_value' => 4, 'xp_reward' => 500]);
        Achievement::create(['name' => 'Velocista', 'description' => 'Completa un quiz en menos de 60 segundos', 'icon' => '⏱️', 'condition_type' => 'speed_complete', 'condition_value' => 60, 'xp_reward' => 50]);
        Achievement::create(['name' => 'Nivel 5', 'description' => 'Alcanza el nivel 5', 'icon' => '🌟', 'condition_type' => 'level_reached', 'condition_value' => 5, 'xp_reward' => 100]);
    }

    private function createQuestions(Lesson $lesson, array $questions): void
    {
        foreach ($questions as $q) {
            Question::create(array_merge($q, ['lesson_id' => $lesson->id]));
        }
    }
}
