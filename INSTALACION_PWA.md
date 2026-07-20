# 🚀 Guía Rápida de Instalación PWA

## Pasos para Activar la PWA

### 1️⃣ Instalar Dependencias

```bash
npm install
```

Esto instalará el paquete `sharp` necesario para generar los iconos.

### 2️⃣ Generar Iconos

```bash
npm run generate:icons
```

Este comando creará automáticamente todos los iconos necesarios en `public/images/`:
- icon-16x16.png
- icon-32x32.png
- icon-72x72.png
- icon-96x96.png
- icon-128x128.png
- icon-144x144.png
- icon-152x152.png
- icon-192x192.png
- icon-384x384.png
- icon-512x512.png
- favicon.ico

### 3️⃣ Compilar Assets

```bash
npm run build
```

O si quieres generar iconos y compilar en un solo comando:

```bash
npm run pwa:build
```

### 4️⃣ Verificar la Instalación

1. Abre tu aplicación en Chrome
2. Presiona F12 para abrir DevTools
3. Ve a la pestaña **Application**
4. Verifica:
   - ✅ **Manifest**: Debe mostrar todos los datos correctamente
   - ✅ **Service Workers**: Debe estar registrado
   - ✅ **Icons**: Deben aparecer todos los tamaños

### 5️⃣ Probar la Instalación

#### En Android:
1. Abre la app en Chrome
2. Verás un banner "Agregar TrignoQuest a inicio"
3. O toca el menú (⋮) → "Instalar aplicación"

#### En iOS:
1. Abre la app en Safari
2. Toca el botón de compartir 
3. Selecciona "Agregar a pantalla de inicio"

#### En Desktop:
1. Busca el icono + en la barra de direcciones
2. O en el menú → "Instalar TrignoQuest"

---

## 🧪 Probar Modo Offline

1. Abre DevTools (F12)
2. Ve a la pestaña **Network**
3. Cambia "Online" a **Offline**
4. Navega por la aplicación
5. Deberías ver contenido cacheado y la página offline cuando sea necesario

---

## ✅ Checklist de Verificación

- [ ] npm install ejecutado
- [ ] Iconos generados en public/images/
- [ ] npm run build ejecutado
- [ ] Manifest.json accesible en /manifest.json
- [ ] Service Worker registrado en DevTools
- [ ] Prompt de instalación aparece
- [ ] App funciona offline
- [ ] App se puede instalar en móvil

---

## 🆘 Solución de Problemas

### Los iconos no se generaron
```bash
# Asegúrate que sharp esté instalado
npm install sharp --save-dev
npm run generate:icons
```

### El Service Worker no se registra
- Verifica que estés en HTTPS o localhost
- Limpia la caché del navegador (Ctrl + Shift + Delete)
- Revisa la consola para errores

### No aparece el prompt de instalación
- Verifica que el manifest esté correctamente vinculado
- Verifica que todos los iconos existan
- En algunos navegadores el prompt solo aparece después de cierto tiempo de uso

### Los cambios no se reflejan
```bash
# Limpia todo y reconstruye
npm run build
# En DevTools > Application > Service Workers
# Haz clic en "Unregister" y recarga la página
```

---

## 📱 Características Implementadas

✅ **Instalable** - Se puede agregar a la pantalla de inicio  
✅ **Offline** - Funciona sin conexión a internet  
✅ **Responsive** - Se adapta a todos los dispositivos  
✅ **Rápida** - Caché inteligente de recursos  
✅ **Actualizable** - Notifica cuando hay nuevas versiones  
✅ **Standalone** - Se ejecuta como app nativa  

---

## 📚 Más Información

Para información detallada, consulta `README_PWA.md`

¡Tu PWA está lista! 🎉
