# ⚡ Comandos Rápidos - PWA TrignoQuest

## 🚀 Setup Inicial (Solo una vez)

```bash
# 1. Instalar todas las dependencias
npm install

# 2. Generar iconos PWA
npm run generate:icons

# 3. Compilar todo para producción
npm run build
```

**O hazlo todo de una vez:**
```bash
npm install && npm run pwa:build
```

---

## 🔄 Desarrollo Diario

```bash
# Modo desarrollo (hot reload)
npm run dev

# Compilar para producción
npm run build
```

---

## 🎨 Trabajando con Iconos

```bash
# Regenerar todos los iconos
npm run generate:icons

# O usa el generador visual en tu navegador:
# http://localhost/images/generate-icons.html
```

---

## 🧹 Limpiar y Reconstruir

```bash
# Windows (CMD)
rmdir /s /q node_modules
rmdir /s /q public\build
del package-lock.json
npm install
npm run pwa:build

# Windows (PowerShell)
Remove-Item -Recurse -Force node_modules
Remove-Item -Recurse -Force public\build
Remove-Item package-lock.json
npm install
npm run pwa:build
```

---

## 🔍 Verificar PWA

```bash
# Verificar que los archivos PWA existen
dir public\manifest.json
dir public\sw.js
dir public\offline.html
dir public\images\icon-192x192.png
dir public\images\icon-512x512.png

# Ver el manifest
type public\manifest.json

# Ver la versión del Service Worker
findstr "CACHE_NAME" public\sw.js
```

---

## 🐛 Debug y Troubleshooting

### Limpiar caché del Service Worker

**En el navegador:**
1. F12 → Application tab
2. Service Workers → Unregister
3. Clear storage → Clear site data
4. Ctrl + Shift + R (hard refresh)

### Ver logs del Service Worker

**En el navegador:**
1. F12 → Console tab
2. Filtra por `[SW]` o `[PWA]`

### Verificar qué está en caché

**En el navegador:**
1. F12 → Application tab
2. Cache Storage → trignoquest-v1.0.0
3. Verás todos los archivos cacheados

---

## 📊 Lighthouse Audit

```bash
# Instalar Lighthouse CLI (opcional)
npm install -g lighthouse

# Ejecutar audit
lighthouse http://localhost --view

# O usa Chrome DevTools:
# F12 → Lighthouse tab → Generate report
```

---

## 🔧 Actualizar Service Worker

```javascript
// 1. Editar public/sw.js
// Cambiar la versión:
const CACHE_NAME = 'trignoquest-v1.0.1'; // Incrementar

// 2. Recompilar
npm run build

// 3. Los usuarios verán notificación de actualización
```

---

## 📱 Probar en Dispositivos Reales

### Android (Chrome Remote Debugging)

```bash
# 1. Conecta tu Android por USB
# 2. Habilita "Depuración USB" en opciones de desarrollador
# 3. En Chrome desktop: chrome://inspect
# 4. Selecciona tu dispositivo
# 5. Abre tu app y verás DevTools
```

### iOS (Safari Web Inspector)

```bash
# 1. En iPhone: Ajustes → Safari → Avanzado → Web Inspector: ON
# 2. Conecta iPhone por cable
# 3. En Mac: Safari → Desarrollador → [Tu iPhone]
# 4. Selecciona tu página
```

### Simular Móvil en Desktop

```bash
# Chrome DevTools:
# F12 → Toggle device toolbar (Ctrl + Shift + M)
# Selecciona dispositivo o dimensiones custom
```

---

## 🌐 Deploy y Producción

### Verificar antes de deploy

```bash
# ✅ Build exitoso
npm run build

# ✅ Manifest accesible
curl http://localhost/manifest.json

# ✅ Service Worker accesible
curl http://localhost/sw.js

# ✅ Iconos existen
dir public\images\icon-*.png

# ✅ HTTPS habilitado (requerido para PWA en producción)
```

### Subir a producción

```bash
# 1. Compilar para producción
npm run build

# 2. Subir archivos
# - public/build/*
# - public/manifest.json
# - public/sw.js
# - public/offline.html
# - public/images/icon-*.png
# - public/browserconfig.xml

# 3. Verificar HTTPS activo

# 4. Probar instalación
```

---

## 🔄 Actualizar PWA en Producción

```bash
# 1. Incrementar versión en public/sw.js
# const CACHE_NAME = 'trignoquest-v1.0.2';

# 2. Compilar
npm run build

# 3. Deploy

# 4. Los usuarios verán:
# "¡Nueva versión disponible! [Actualizar]"
```

---

## 📦 Instalar Dependencias Específicas

```bash
# Si sharp no se instaló correctamente
npm install sharp --save-dev

# Reinstalar Laravel Vite Plugin
npm install laravel-vite-plugin@latest --save-dev

# Reinstalar Tailwind
npm install tailwindcss@latest @tailwindcss/vite@latest --save-dev
```

---

## 🎯 Comandos Git

```bash
# Agregar archivos PWA al repositorio
git add public/manifest.json
git add public/sw.js
git add public/offline.html
git add public/browserconfig.xml
git add resources/js/pwa.js
git add resources/css/pwa.css
git add generate-pwa-icons.js
git add package.json
git add vite.config.js
git commit -m "Implementar PWA con instalación y modo offline"
git push
```

---

## 📝 Notas Importantes

### ⚠️ HTTPS es Obligatorio
PWAs requieren HTTPS en producción (localhost funciona sin HTTPS)

### ⚠️ Incrementar Versión
Cada vez que hagas cambios, incrementa la versión en `sw.js`:
```javascript
const CACHE_NAME = 'trignoquest-v1.0.X';
```

### ⚠️ Test en Dispositivos Reales
Siempre prueba en dispositivos reales antes de lanzar:
- Android (Chrome)
- iOS (Safari)
- Desktop (Chrome/Edge)

---

## 🎊 One-Liners Útiles

```bash
# Setup completo desde cero
npm install && npm run pwa:build

# Rebuild rápido
npm run build

# Limpiar y rebuild
rmdir /s /q public\build & npm run build

# Ver archivos PWA
dir public\manifest.json & dir public\sw.js & dir public\offline.html

# Grep en Service Worker (PowerShell)
Select-String -Path public\sw.js -Pattern "CACHE_NAME"

# Contar líneas de código PWA
Get-ChildItem -Path resources\js\pwa.js,public\sw.js | Get-Content | Measure-Object -Line
```

---

## ✅ Checklist Rápido

```bash
# Antes de commit
[ ] npm run build sin errores
[ ] manifest.json accesible
[ ] sw.js accesible  
[ ] Iconos generados
[ ] DevTools sin errores

# Antes de deploy
[ ] Build de producción
[ ] HTTPS configurado
[ ] Prueba en móvil real
[ ] Lighthouse score > 90
[ ] Instalación funciona
```

---

## 🔗 Enlaces Rápidos

- Manifest: `http://localhost/manifest.json`
- Service Worker: `http://localhost/sw.js`
- Offline: `http://localhost/offline.html`
- Generador Iconos: `http://localhost/images/generate-icons.html`
- DevTools: `chrome://inspect` (Android)
- ServiceWorker Debug: `chrome://serviceworker-internals/`

---

**¡Guarda este archivo para referencia rápida! 📌**
