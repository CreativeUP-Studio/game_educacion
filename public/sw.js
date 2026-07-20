// Service Worker para TrignoQuest PWA
const CACHE_NAME = 'trignoquest-v1.0.0';
const OFFLINE_URL = '/offline.html';

// Recursos estáticos para cachear
const STATIC_CACHE_URLS = [
  '/',
  '/offline.html',
  '/css/game.css',
  '/js/quiz.js',
  '/js/widgets.js',
  '/manifest.json'
];

// Recursos dinámicos que queremos cachear
const DYNAMIC_CACHE_URLS = [
  '/game/map',
  '/game/profile',
  '/game/laboratory',
  '/game/leaderboard'
];

// Instalación del Service Worker
self.addEventListener('install', (event) => {
  console.log('[SW] Instalando Service Worker...');
  
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then((cache) => {
        console.log('[SW] Cacheando archivos estáticos');
        return cache.addAll(STATIC_CACHE_URLS.map(url => new Request(url, {cache: 'reload'})));
      })
      .catch((error) => {
        console.error('[SW] Error al cachear:', error);
      })
  );
  
  self.skipWaiting();
});

// Activación del Service Worker
self.addEventListener('activate', (event) => {
  console.log('[SW] Activando Service Worker...');
  
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.map((cacheName) => {
          if (cacheName !== CACHE_NAME) {
            console.log('[SW] Eliminando caché antigua:', cacheName);
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
  
  return self.clients.claim();
});

// Estrategia de caché
self.addEventListener('fetch', (event) => {
  const { request } = event;
  const url = new URL(request.url);

  // Ignorar requests que no sean del mismo origen
  if (url.origin !== location.origin) {
    return;
  }

  // Ignorar requests del hot reload de Vite
  if (url.pathname.includes('hot') || url.searchParams.has('hot')) {
    return;
  }

  // Para navegación (HTML)
  if (request.mode === 'navigate') {
    event.respondWith(
      fetch(request)
        .then((response) => {
          // Cachear la respuesta
          const responseClone = response.clone();
          caches.open(CACHE_NAME).then((cache) => {
            cache.put(request, responseClone);
          });
          return response;
        })
        .catch(() => {
          // Si falla, intentar desde caché
          return caches.match(request).then((response) => {
            return response || caches.match(OFFLINE_URL);
          });
        })
    );
    return;
  }

  // Para recursos estáticos (CSS, JS, imágenes)
  if (
    request.destination === 'style' ||
    request.destination === 'script' ||
    request.destination === 'image' ||
    request.destination === 'font'
  ) {
    event.respondWith(
      caches.match(request).then((cachedResponse) => {
        if (cachedResponse) {
          return cachedResponse;
        }

        return fetch(request).then((response) => {
          // Si la respuesta es válida, cachearla
          if (response.status === 200) {
            const responseClone = response.clone();
            caches.open(CACHE_NAME).then((cache) => {
              cache.put(request, responseClone);
            });
          }
          return response;
        });
      })
    );
    return;
  }

  // Para API requests (Network First)
  if (url.pathname.startsWith('/api/')) {
    event.respondWith(
      fetch(request)
        .then((response) => {
          const responseClone = response.clone();
          caches.open(CACHE_NAME).then((cache) => {
            cache.put(request, responseClone);
          });
          return response;
        })
        .catch(() => {
          return caches.match(request);
        })
    );
    return;
  }

  // Para todo lo demás, intentar red primero
  event.respondWith(
    fetch(request).catch(() => {
      return caches.match(request);
    })
  );
});

// Escuchar mensajes del cliente
self.addEventListener('message', (event) => {
  if (event.data && event.data.type === 'SKIP_WAITING') {
    self.skipWaiting();
  }
  
  if (event.data && event.data.type === 'CACHE_URLS') {
    event.waitUntil(
      caches.open(CACHE_NAME).then((cache) => {
        return cache.addAll(event.data.urls);
      })
    );
  }
});

// Sincronización en segundo plano
self.addEventListener('sync', (event) => {
  console.log('[SW] Sincronización en segundo plano:', event.tag);
  
  if (event.tag === 'sync-progress') {
    event.waitUntil(syncUserProgress());
  }
});

// Función para sincronizar progreso del usuario
async function syncUserProgress() {
  try {
    // Aquí podrías implementar lógica para sincronizar datos guardados offline
    console.log('[SW] Sincronizando progreso del usuario...');
  } catch (error) {
    console.error('[SW] Error al sincronizar:', error);
  }
}
