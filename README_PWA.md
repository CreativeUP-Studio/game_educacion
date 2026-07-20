# 📱 TrignoQuest - Configuración PWA

## ✅ Cambios Implementados

Tu aplicación ahora es una **Progressive Web App (PWA)** completa y se puede instalar en dispositivos móviles y escritorio.

### 🎯 Características Implementadas

1. **Instalable**: Los usuarios pueden instalar la app desde el navegador
2. **Funciona Offline**: Caché inteligente de recursos para uso sin conexión
3. **Actualizaciones Automáticas**: Notificaciones cuando hay nuevas versiones
4. **Modo Standalone**: Se ejecuta como app nativa sin barra del navegador
5. **Sincronización**: Detecta cuando la conexión se pierde/recupera
6. **Responsive**: Optimizada para todos los tamaños de pantalla

---

## 📁 Archivos Creados/Modificados

### Nuevos Archivos

1. **`resources/js/pwa.js`** - Gestor de PWA principal
   - Registro del Service Worker
   - Prompt de instalación
   - Manejo de actualizaciones
   - Detección de conexión

2. **`public/sw.js`** - Service Worker
   - Estrategias de caché
   - Funcionalidad offline
   - Sincronización en segundo plano

3. **`public/manifest.json`** - Manifest de la PWA
   - Metadatos de la aplicación
   - Iconos y screenshots
   - Atajos de la app

4. **`public/offline.html`** - Página offline
   - Interfaz cuando no hay conexión
   - Auto-recarga al recuperar conexión

5. **`public/images/generate-icons.html`** - Generador de iconos
   - Herramienta para crear todos los iconos necesarios

6. **`resources/views/layouts/app.blade.php`** - Layout base con PWA

### Archivos Modificados

1. **`resources/views/layouts/game.blade.php`**
   - Meta tags PWA
   - Enlaces al manifest
   - Apple touch icons
   - Script PWA

2. **`vite.config.js`**
   - Inclusión de pwa.js en el build
   - Configuración de chunks

---

## 🚀 Pasos para Completar la Instalación

### 1. Generar los Iconos

**Opción A: Generador Automático (Recomendado)**
```bash
# Abre en tu navegador:
http://localhost/generate-icons.html
```

Haz clic en "Generar Todos los Iconos" y descarga cada uno en `public/images/`

**Opción B: Usar tus propios iconos**

Crea los siguientes archivos PNG en `public/images/`:
- `icon-16x16.png`
- `icon-32x32.png`
- `icon-72x72.png`
- `icon-96x96.png`
- `icon-128x128.png`
- `icon-144x144.png`
- `icon-152x152.png`
- `icon-192x192.png`
- `icon-384x384.png`
- `icon-512x512.png`

### 2. Compilar los Assets

```bash
npm install
npm run build
```

### 3. Verificar la Configuración

1. Abre tu app en Chrome DevTools
2. Ve a la pestaña "Application"
3. Verifica:
   - ✅ Manifest cargado correctamente
   - ✅ Service Worker registrado
   - ✅ Iconos disponibles

### 4. Probar la Instalación

**En Android/Chrome:**
1. Abre la app en Chrome
2. Verás un banner o botón "Instalar"
3. También en menú ⋮ → "Instalar aplicación"

**En iOS/Safari:**
1. Abre la app en Safari
2. Toca el icono de compartir
3. Selecciona "Agregar a pantalla de inicio"

**En Desktop:**
1. Busca el icono de instalación (+) en la barra de direcciones
2. O en menú → "Instalar TrignoQuest"

---

## 🧪 Probar Funcionalidad Offline

1. Instala la app
2. Abre DevTools → Network
3. Selecciona "Offline"
4. Navega por la app - verás contenido cacheado
5. Intenta acceder a páginas nuevas - verás la página offline.html

---

## 🎨 Personalización

### Cambiar Colores del Theme

Edita `public/manifest.json`:
```json
{
  "theme_color": "#4F46E5",
  "background_color": "#ffffff"
}
```

### Modificar Estrategia de Caché

Edita `public/sw.js`:
```javascript
const CACHE_NAME = 'trignoquest-v1.0.0'; // Cambia la versión
const STATIC_CACHE_URLS = [
  // Agrega URLs que quieras cachear
];
```

### Personalizar Prompt de Instalación

Edita `resources/js/pwa.js` método `showInstallButton()` para cambiar el diseño del botón.

---

## 📊 Verificar PWA Score

Usa Lighthouse para verificar que todo esté correcto:

1. Abre DevTools en Chrome
2. Ve a pestaña "Lighthouse"
3. Selecciona "Progressive Web App"
4. Haz clic en "Analyze page load"
5. Deberías obtener 100/100

---

## 🔧 Troubleshooting

### El Service Worker no se registra
- Verifica que estés en HTTPS (o localhost)
- Revisa la consola para errores
- Limpia la caché del navegador

### Los iconos no aparecen
- Verifica que existan en `public/images/`
- Verifica las rutas en `manifest.json`
- Limpia caché y recarga

### No aparece el prompt de instalación
- Verifica que el manifest esté correctamente vinculado
- Verifica que todos los criterios PWA se cumplan
- En Android, algunos navegadores no muestran el prompt automáticamente

### Cambios no se reflejan
- Incrementa la versión en `sw.js` (CACHE_NAME)
- Desregistra el Service Worker en DevTools
- Limpia todos los caches
- Recarga forzado (Ctrl + Shift + R)

---

## 📱 Características Específicas por Plataforma

### Android
- ✅ Instalación desde Chrome/Edge
- ✅ Pantalla de splash automática
- ✅ Integración con sistema
- ✅ Notificaciones push (futuro)

### iOS
- ✅ Agregar a pantalla de inicio
- ✅ Iconos y meta tags de Apple
- ⚠️ Sin Service Worker completo (limitado)
- ⚠️ Sin notificaciones push

### Desktop (Windows/Mac/Linux)
- ✅ Instalar desde Chrome/Edge
- ✅ Ventana standalone
- ✅ Integración con barra de tareas
- ✅ Actualizaciones automáticas

---

## 🎯 Próximos Pasos Opcionales

1. **Notificaciones Push** - Para alertar sobre nuevos contenidos
2. **Background Sync** - Sincronizar progreso en segundo plano
3. **Web Share API** - Compartir logros en redes sociales
4. **Badging API** - Mostrar badges con progreso
5. **File System Access** - Guardar/cargar configuraciones

---

## 📚 Recursos Adicionales

- [PWA Builder](https://www.pwabuilder.com/)
- [Web.dev PWA Guide](https://web.dev/progressive-web-apps/)
- [MDN Service Workers](https://developer.mozilla.org/es/docs/Web/API/Service_Worker_API)
- [Can I Use - PWA](https://caniuse.com/serviceworkers)

---

## ✨ ¡Listo!

Tu aplicación TrignoQuest ahora es una PWA completa. Los usuarios podrán:

- 📱 Instalarla en sus dispositivos
- 🚀 Usarla sin conexión
- 🎨 Tener una experiencia nativa
- 🔄 Recibir actualizaciones automáticas

**¡Disfruta de tu nueva PWA!** 🎉
