# 🚀 Guía de Deploy en IONOS para PWA

## ✅ Compatibilidad IONOS

**¡Sí, tu PWA funcionará perfectamente en IONOS!**

IONOS es compatible con PWAs siempre que cumplas estos requisitos:

---

## 🔒 Requisito #1: HTTPS (CRÍTICO)

### Verificar HTTPS en IONOS

1. Accede a tu panel de IONOS
2. Ve a **"Dominios y SSL"** o **"SSL/TLS"**
3. Verifica que tu certificado SSL esté **activo**

### Activar SSL en IONOS (si no lo tienes)

**IONOS incluye SSL gratis con Let's Encrypt:**

1. Panel IONOS → **SSL**
2. Click en **"Activar SSL gratuito"**
3. Selecciona tu dominio
4. Click **"Activar"**
5. Espera 5-15 minutos para propagación

### Forzar HTTPS

El archivo `.htaccess` que creé ya incluye esto, pero verifica:

```apache
# Forzar HTTPS
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{HTTPS} off
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
</IfModule>
```

---

## 📦 Archivos a Subir a IONOS

### Paso 1: Compilar Localmente

```bash
# En tu computadora:
npm install
npm run generate:icons
npm run build
```

### Paso 2: Archivos PWA Obligatorios

Sube estos archivos vía FTP/SFTP a tu hosting IONOS:

```
✅ RAÍZ DEL DOMINIO (public_html/):
├── manifest.json          ← IMPORTANTE
├── sw.js                  ← IMPORTANTE
├── offline.html           ← IMPORTANTE
├── browserconfig.xml
├── robots.txt
├── .htaccess             ← IMPORTANTE
├── favicon.ico
│
├── build/                ← Todo el contenido
│   └── assets/
│       ├── app-*.js
│       ├── app-*.css
│       └── pwa-*.js
│
└── images/               ← Todos los iconos
    ├── icon-16x16.png
    ├── icon-32x32.png
    ├── icon-72x72.png
    ├── icon-96x96.png
    ├── icon-128x128.png
    ├── icon-144x144.png
    ├── icon-152x152.png
    ├── icon-192x192.png
    ├── icon-384x384.png
    └── icon-512x512.png
```

### Paso 3: Estructura Completa de Laravel en IONOS

```
public_html/              ← Carpeta raíz en IONOS
├── .htaccess            ← Laravel + PWA
├── index.php            ← Laravel entry point
├── manifest.json        ← PWA
├── sw.js               ← PWA
├── offline.html        ← PWA
├── browserconfig.xml   ← PWA
├── favicon.ico
├── robots.txt
├── build/              ← Assets compilados
├── images/             ← Iconos PWA
├── css/
└── js/

../app/                  ← Fuera de public_html
../bootstrap/
../config/
../database/
../resources/
../routes/
../storage/
../vendor/
../.env                  ← IMPORTANTE: Fuera de public
```

---

## 🔧 Configuración Específica de IONOS

### 1. PHP Version

IONOS requiere PHP 8.1+ para Laravel:

1. Panel IONOS → **PHP**
2. Selecciona **PHP 8.1** o superior
3. Guarda cambios

### 2. Composer en IONOS

Si necesitas ejecutar composer en el servidor:

```bash
# Conéctate por SSH (si tu plan lo permite)
ssh tu-usuario@tu-dominio.com

# Instalar dependencias
cd /tu/ruta/proyecto
composer install --optimize-autoloader --no-dev

# Permisos
chmod -R 755 storage bootstrap/cache
```

### 3. Permisos de Carpetas

```bash
# En IONOS, asegura estos permisos:
storage/          → 775
bootstrap/cache/  → 775
public/           → 755
```

---

## 🌐 Verificación Post-Deploy

### 1. Verificar Archivos Accesibles

Abre en tu navegador:

```
✅ https://tudominio.com/manifest.json
✅ https://tudominio.com/sw.js
✅ https://tudominio.com/offline.html
✅ https://tudominio.com/images/icon-192x192.png
✅ https://tudominio.com/images/icon-512x512.png
```

**Todos deben cargar sin error 404**

### 2. Verificar HTTPS

```
✅ https://tudominio.com
   ↳ Debe mostrar candado verde en navegador
   ↳ Certificado válido
   ↳ Sin warnings
```

### 3. DevTools Check

1. Abre tu sitio en Chrome
2. **F12** → Pestaña **Application**
3. Verifica:
   - ✅ Manifest cargado
   - ✅ Service Worker registrado
   - ✅ Todos los iconos visibles
   - ✅ Sin errores en consola

### 4. Lighthouse Test

1. **F12** → Pestaña **Lighthouse**
2. Selecciona **"Progressive Web App"**
3. Click **"Generate report"**
4. **Objetivo: 100/100** ✨

---

## 🚨 Problemas Comunes en IONOS

### ❌ Error: "Service Worker registration failed"

**Causa:** No hay HTTPS  
**Solución:**
1. Activa SSL en panel IONOS
2. Fuerza HTTPS en .htaccess
3. Espera propagación (5-15 min)

### ❌ Error: "manifest.json not found"

**Causa:** Archivo no en raíz  
**Solución:**
- Verifica que `manifest.json` esté en `public_html/`
- NO en subcarpetas
- Accesible en `https://tudominio.com/manifest.json`

### ❌ Error: "Mixed Content"

**Causa:** Recursos cargando por HTTP  
**Solución:**
En tu `.env` en IONOS:
```env
APP_URL=https://tudominio.com
ASSET_URL=https://tudominio.com
```

### ❌ Los iconos no aparecen

**Causa:** Rutas incorrectas o permisos  
**Solución:**
```bash
# Verifica permisos
chmod 644 images/icon-*.png

# Verifica rutas en manifest.json
"icons": [
  {
    "src": "/images/icon-192x192.png",  ← Debe empezar con /
    ...
  }
]
```

### ❌ Service Worker no actualiza

**Causa:** Caché del servidor  
**Solución:**
1. En IONOS panel → **Caché**
2. Limpia caché del dominio
3. O agrega en `.htaccess`:
```apache
<FilesMatch "sw\.js$">
    Header set Cache-Control "no-cache, no-store, must-revalidate"
    Header set Pragma "no-cache"
    Header set Expires 0
</FilesMatch>
```

---

## 🎯 Optimizaciones para IONOS

### 1. Caché del Servidor

Agrega al `.htaccess` (ya incluido):

```apache
# Browser Caching
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
</IfModule>
```

### 2. Compresión GZIP

```apache
# GZIP Compression
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html text/plain text/xml
    AddOutputFilterByType DEFLATE text/css application/javascript
    AddOutputFilterByType DEFLATE application/json
</IfModule>
```

### 3. Límites PHP en IONOS

Si tienes problemas, aumenta límites:

Panel IONOS → **PHP Settings**:
```
memory_limit = 256M
max_execution_time = 300
upload_max_filesize = 20M
post_max_size = 25M
```

---

## 📋 Checklist Deploy IONOS

Antes de declarar éxito:

### Pre-Deploy
- [ ] `npm run build` ejecutado localmente
- [ ] Iconos generados en `public/images/`
- [ ] Sin errores en compilación
- [ ] .env configurado para producción

### Durante Deploy
- [ ] SSL activado en IONOS
- [ ] PHP 8.1+ seleccionado
- [ ] Todos los archivos PWA subidos
- [ ] Permisos correctos (755/775)
- [ ] .htaccess subido

### Post-Deploy
- [ ] `https://tudominio.com` carga con SSL
- [ ] `/manifest.json` accesible
- [ ] `/sw.js` accesible
- [ ] `/offline.html` accesible
- [ ] Iconos cargando correctamente
- [ ] DevTools sin errores
- [ ] Service Worker registrado
- [ ] Botón "Instalar" aparece
- [ ] App se puede instalar
- [ ] Modo offline funciona
- [ ] Lighthouse PWA = 100

---

## 🔄 Proceso de Deploy Completo

### Opción 1: FTP/SFTP (Recomendado para IONOS)

```bash
# 1. Local: Compilar
npm run pwa:build

# 2. Conectar con FileZilla o WinSCP
Host: ftp.tudominio.com
Usuario: tu-usuario-ionos
Password: tu-password
Puerto: 21 (FTP) o 22 (SFTP)

# 3. Subir archivos:
Local: C:\laragon\www\EDU\public\*
Remoto: /public_html/

# 4. Verificar en navegador
https://tudominio.com
```

### Opción 2: SSH (Si tu plan IONOS lo incluye)

```bash
# Conectar
ssh tu-usuario@tu-dominio.com

# Ir a directorio
cd /tu/ruta/proyecto

# Pull desde Git (si usas)
git pull origin main

# Instalar dependencias
composer install --optimize-autoloader --no-dev

# Generar iconos (si node está disponible)
npm run generate:icons

# Compilar assets
npm run build

# Limpiar caché Laravel
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimizar
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Permisos
chmod -R 755 storage bootstrap/cache
```

---

## 📊 Monitoreo Post-Deploy

### Google Search Console

Verifica que Google reconozca tu PWA:

1. [Google Search Console](https://search.google.com/search-console)
2. Agrega tu dominio
3. Ve a **"Experiencia"** → **"Aplicaciones web"**
4. Debe reconocer tu PWA

### Verificar Instalaciones

En Chrome DevTools:

```javascript
// Ver si Service Worker está activo
navigator.serviceWorker.getRegistrations().then(regs => {
    console.log('Service Workers:', regs);
});

// Ver si en modo standalone
if (window.matchMedia('(display-mode: standalone)').matches) {
    console.log('✅ App instalada');
}
```

---

## 🆘 Soporte IONOS

Si tienes problemas:

**Contacto IONOS:**
- Teléfono: Busca en tu panel
- Email: Abrir ticket desde panel
- Chat: Disponible en panel

**Preguntas comunes para soporte:**
- "¿Cómo activo SSL gratuito en mi dominio?"
- "¿Cómo cambio la versión de PHP a 8.1?"
- "¿Mi plan incluye acceso SSH?"
- "¿Cómo limpio la caché del servidor?"

---

## ✅ IONOS Funciona Perfectamente

**Confirmado:** IONOS soporta completamente PWAs

Miles de PWAs corren en IONOS sin problemas. Solo asegúrate de:
1. ✅ HTTPS activo
2. ✅ Archivos en ubicación correcta
3. ✅ Permisos adecuados
4. ✅ PHP 8.1+

---

## 🎉 ¡Listo para Producción!

Tu PWA funcionará perfectamente en IONOS. Sigue esta guía y en 30 minutos tendrás tu app instalable en dispositivos móviles.

**¿Necesitas ayuda adicional?**  
Consulta los otros archivos de documentación o contacta soporte de IONOS.

**¡Éxito con tu deploy! 🚀📱**
