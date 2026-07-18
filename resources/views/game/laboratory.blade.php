@extends('layouts.game')
@section('title', 'Laboratorio GeoGebra - TrignoQuest')

@section('content')
<div class="lab-layout">
    <!-- Sidebar / Presets Panel -->
    <div class="lab-sidebar">
        <div class="lab-title-section">
            <h1>🧪 Laboratorio GeoGebra</h1>
            <p>Experimenta, grafica y descubre los conceptos de la trigonometría en tiempo real.</p>
        </div>

        <div class="presets-container">
            <h3 style="font-size: 0.95rem; text-transform: uppercase; color: var(--accent-purple); font-weight: 800; margin-bottom: 8px;">Herramientas</h3>
            
            <div class="preset-card active" data-preset="graphing">
                <span class="preset-icon">📈</span>
                <div class="preset-info">
                    <span class="preset-name">Calculadora Gráfica</span>
                    <span class="preset-desc">Lienzo libre para funciones</span>
                </div>
            </div>

            <div class="preset-card" data-preset="geometry">
                <span class="preset-icon">📐</span>
                <div class="preset-info">
                    <span class="preset-name">Geometría Libre</span>
                    <span class="preset-desc">Construye figuras y mide ángulos</span>
                </div>
            </div>

            <div class="preset-card" data-preset="unit_circle">
                <span class="preset-icon">🟣</span>
                <div class="preset-info">
                    <span class="preset-name">Círculo Unitario</span>
                    <span class="preset-desc">Explora Seno, Coseno y Tangente</span>
                </div>
            </div>

            <div class="preset-card" data-preset="waves">
                <span class="preset-icon">🌊</span>
                <div class="preset-info">
                    <span class="preset-name">Ondas Interactivas</span>
                    <span class="preset-desc">Modifica amplitud y frecuencia</span>
                </div>
            </div>
        </div>

        <!-- Theory & Instructions Card -->
        <div class="theory-card">
            <h3 id="theoryTitle">📈 Funciones y Gráficas</h3>
            <div class="theory-content" id="theoryContent">
                Escribe ecuaciones en la barra de álgebra para graficar funciones trigonométricas. Ejemplos:<br>
                <ul>
                    <li><code>f(x) = sen(x)</code></li>
                    <li><code>g(x) = cos(2x)</code></li>
                    <li><code>h(x) = sen(x) + cos(x)</code></li>
                </ul>
                <br>
                Prueba a cambiar los coeficientes para ver cómo cambia el período y la amplitud de las ondas.
            </div>
        </div>
    </div>

    <!-- Active Viewport Panel -->
    <div class="lab-viewport-container">
        <div class="lab-header">
            <div class="lab-header-title" id="activePresetTitle">Calculadora Gráfica</div>
            <button class="btn btn-outline btn-sm" onclick="reloadApplet()" style="padding: 6px 12px; font-size: 0.8rem;">🔄 Reiniciar Lienzo</button>
        </div>
        <div class="lab-viewport" id="ggb-lab-container"></div>
    </div>
</div>


@push('scripts')
<script>
    const presets = {
        graphing: {
            title: "Calculadora Gráfica",
            iframeUrl: "https://www.geogebra.org/graphing?embed&rc=true&ai=true&smb=true&stb=true&sri=true&sfsb=true",
            theory: {
                title: "📈 Funciones y Gráficas",
                html: "Escribe ecuaciones en la barra de álgebra para graficar funciones trigonométricas. Ejemplos:<br><ul><li><code>f(x) = sen(x)</code></li><li><code>g(x) = cos(2x)</code></li><li><code>h(x) = sen(x) + cos(x)</code></li></ul><br>Prueba a cambiar los coeficientes para ver cómo cambia el período y la amplitud de las ondas."
            }
        },
        geometry: {
            title: "Geometría Interactiva",
            iframeUrl: "https://www.geogebra.org/geometry?embed&rc=true&ai=false&smb=true&stb=true&sri=true&sfsb=true",
            theory: {
                title: "📐 Construcciones Geométricas",
                html: "Utiliza las herramientas superiores para trazar puntos, segmentos y rectas. Construye triángulos y utiliza la herramienta de medición para:<br><ul><li>Medir distancias y longitudes de lados.</li><li>Medir ángulos internos y verificar que sumen 180°.</li><li>Trazar perpendiculares y paralelas.</li></ul>"
            }
        },
        unit_circle: {
            title: "Círculo Unitario Interactivo",
            iframeUrl: "https://www.geogebra.org/material/iframe/id/mxgqt3jk/width/800/height/600/border/888888/sfsb/true/smb/false/stb/false/stbh/false/ai/false/asb/false/sri/true/rc/false/ld/false/sdz/true/ctl/false",
            theory: {
                title: "🟣 El Círculo Trigonométrico",
                html: "El círculo unitario tiene radio = 1. Arrastra el punto en la circunferencia y observa:<br><ul><li>La coordenada X del punto representa el <strong>Coseno</strong>.</li><li>La coordenada Y del punto representa el <strong>Seno</strong>.</li><li>La recta tangente representa la <strong>Tangente</strong>.</li><li>Cómo cambian los signos de las razones en los 4 cuadrantes.</li></ul>"
            }
        },
        waves: {
            title: "Generador de Ondas",
            iframeUrl: "https://www.geogebra.org/material/iframe/id/j5z7sdbw/width/800/height/600/border/888888/sfsb/true/smb/false/stb/false/stbh/false/ai/false/asb/false/sri/true/rc/false/ld/false/sdz/true/ctl/false",
            theory: {
                title: "🌊 Ondas Trigonométricas",
                html: "Una función trigonométrica generalizada se escribe como: <code>y = A sen(B x + C) + D</code>.<br>Interactúa con los deslizadores para entender:<br><ul><li><strong>Amplitud (A)</strong>: Modifica la altura máxima de la onda.</li><li><strong>Frecuencia (B)</strong>: Altera cuántas ondas se forman en un tramo.</li><li><strong>Fase (C)</strong>: Desplaza la gráfica a la izquierda o derecha.</li><li><strong>Desplazamiento (D)</strong>: Mueve la onda verticalmente.</li></ul>"
            }
        }
    };

    let activePresetKey = 'graphing';

    function loadPreset(key) {
        activePresetKey = key;
        const preset = presets[key];

        // Update active classes
        document.querySelectorAll('.preset-card').forEach(card => {
            if (card.dataset.preset === key) card.classList.add('active');
            else card.classList.remove('active');
        });

        // Update metadata and theory
        document.getElementById('activePresetTitle').textContent = preset.title;
        document.getElementById('theoryTitle').innerHTML = preset.theory.title;
        document.getElementById('theoryContent').innerHTML = preset.theory.html;

        // Clear container and load applet using iframe
        const container = document.getElementById('ggb-lab-container');
        container.innerHTML = `
            <iframe src="${preset.iframeUrl}" 
                    style="width: 100%; height: 100%; border: 0; border-radius: 16px;" 
                    allow="geolocation; microphone; camera; clipboard-read; clipboard-write; amap" 
                    allowfullscreen>
            </iframe>`;
    }

    function reloadApplet() {
        loadPreset(activePresetKey);
    }

    // Initialize first preset on load
    window.addEventListener('load', () => {
        loadPreset('graphing');

        // Bind clicks
        document.querySelectorAll('.preset-card').forEach(card => {
            card.addEventListener('click', () => {
                loadPreset(card.dataset.preset);
            });
        });
    });
</script>
@endpush
@endsection
