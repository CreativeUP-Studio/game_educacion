#!/usr/bin/env node

/**
 * Script para generar iconos PWA automáticamente
 * Requiere: npm install sharp
 * Uso: node generate-pwa-icons.js
 */

const fs = require('fs');
const path = require('path');

// Verificar si sharp está instalado
let sharp;
try {
    sharp = require('sharp');
} catch (error) {
    console.error('❌ Error: El paquete "sharp" no está instalado.');
    console.log('📦 Por favor ejecuta: npm install sharp --save-dev');
    process.exit(1);
}

// Tamaños de iconos necesarios
const ICON_SIZES = [16, 32, 72, 96, 128, 144, 152, 192, 384, 512];

// Directorio de salida
const OUTPUT_DIR = path.join(__dirname, 'public', 'images');

// Crear SVG base (icono de triángulo)
function createBaseSVG(size) {
    return `
<svg width="${size}" height="${size}" xmlns="http://www.w3.org/2000/svg">
  <defs>
    <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" style="stop-color:#4F46E5;stop-opacity:1" />
      <stop offset="100%" style="stop-color:#7C3AED;stop-opacity:1" />
    </linearGradient>
  </defs>
  
  <!-- Background -->
  <rect width="${size}" height="${size}" fill="url(#grad)" rx="${size * 0.15}"/>
  
  <!-- Triangle -->
  <path d="M ${size * 0.5} ${size * 0.25} 
           L ${size * 0.25} ${size * 0.75} 
           L ${size * 0.75} ${size * 0.75} Z" 
        fill="white" 
        stroke="none"/>
  
  <!-- Angle arc -->
  <path d="M ${size * 0.25} ${size * 0.75} 
           Q ${size * 0.25} ${size * 0.65}, ${size * 0.35} ${size * 0.65}"
        fill="none" 
        stroke="rgba(255,255,255,0.8)" 
        stroke-width="${size * 0.025}"
        stroke-linecap="round"/>
  
  <!-- Dot for angle -->
  <circle cx="${size * 0.25}" cy="${size * 0.75}" r="${size * 0.015}" fill="white"/>
</svg>
    `.trim();
}

// Generar todos los iconos
async function generateIcons() {
    console.log('🎨 Generando iconos PWA para TrignoQuest...\n');

    // Crear directorio si no existe
    if (!fs.existsSync(OUTPUT_DIR)) {
        fs.mkdirSync(OUTPUT_DIR, { recursive: true });
        console.log(`📁 Directorio creado: ${OUTPUT_DIR}`);
    }

    let successCount = 0;
    let errorCount = 0;

    for (const size of ICON_SIZES) {
        try {
            const svg = createBaseSVG(size);
            const outputPath = path.join(OUTPUT_DIR, `icon-${size}x${size}.png`);

            await sharp(Buffer.from(svg))
                .png({
                    quality: 100,
                    compressionLevel: 9
                })
                .toFile(outputPath);

            console.log(`✅ Generado: icon-${size}x${size}.png`);
            successCount++;
        } catch (error) {
            console.error(`❌ Error al generar icon-${size}x${size}.png:`, error.message);
            errorCount++;
        }
    }

    // Generar favicon.ico (usando el icono de 32x32)
    try {
        const svg = createBaseSVG(32);
        const faviconPath = path.join(__dirname, 'public', 'favicon.ico');

        await sharp(Buffer.from(svg))
            .resize(32, 32)
            .toFile(faviconPath.replace('.ico', '.png'));

        // Renombrar a .ico
        if (fs.existsSync(faviconPath.replace('.ico', '.png'))) {
            fs.renameSync(faviconPath.replace('.ico', '.png'), faviconPath);
            console.log(`✅ Generado: favicon.ico`);
            successCount++;
        }
    } catch (error) {
        console.error('❌ Error al generar favicon.ico:', error.message);
        errorCount++;
    }

    // Resumen
    console.log('\n' + '='.repeat(50));
    console.log(`✨ Proceso completado:`);
    console.log(`   ✅ Exitosos: ${successCount}`);
    if (errorCount > 0) {
        console.log(`   ❌ Errores: ${errorCount}`);
    }
    console.log('='.repeat(50));

    if (successCount > 0) {
        console.log('\n📱 Los iconos están listos en: public/images/');
        console.log('\n🚀 Próximos pasos:');
        console.log('   1. Ejecuta: npm run build');
        console.log('   2. Abre tu app en el navegador');
        console.log('   3. Verifica en DevTools > Application > Manifest');
        console.log('   4. ¡Prueba instalar la app!');
    }
}

// Ejecutar
generateIcons().catch(error => {
    console.error('💥 Error fatal:', error);
    process.exit(1);
});
