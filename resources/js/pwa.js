// PWA Registration and Management
class PWAManager {
    constructor() {
        this.deferredPrompt = null;
        this.isInstalled = false;
        this.swRegistration = null;
        this.init();
    }

    init() {
        this.checkInstallation();
        this.registerServiceWorker();
        this.setupInstallPrompt();
        this.setupUpdateHandler();
        this.trackOnlineStatus();
    }

    // Verificar si la app ya está instalada
    checkInstallation() {
        if (window.matchMedia('(display-mode: standalone)').matches ||
            window.navigator.standalone === true) {
            this.isInstalled = true;
            console.log('[PWA] App está instalada');
        }
    }

    // Registrar el Service Worker
    async registerServiceWorker() {
        if ('serviceWorker' in navigator) {
            try {
                this.swRegistration = await navigator.serviceWorker.register('/sw.js', {
                    scope: '/'
                });
                
                console.log('[PWA] Service Worker registrado:', this.swRegistration.scope);

                // Verificar actualizaciones cada hora
                setInterval(() => {
                    this.swRegistration.update();
                }, 3600000);

            } catch (error) {
                console.error('[PWA] Error al registrar Service Worker:', error);
            }
        }
    }

    // Configurar el prompt de instalación
    setupInstallPrompt() {
        window.addEventListener('beforeinstallprompt', (e) => {
            // Prevenir el mini-infobar automático
            e.preventDefault();
            // Guardar el evento para usarlo después
            this.deferredPrompt = e;
            
            // Mostrar botón de instalación personalizado
            this.showInstallButton();
            
            console.log('[PWA] Evento beforeinstallprompt capturado');
        });

        // Detectar cuando se instala
        window.addEventListener('appinstalled', () => {
            console.log('[PWA] App instalada exitosamente');
            this.isInstalled = true;
            this.hideInstallButton();
            this.showNotification('¡TrignoQuest instalado! 🎉', 'success');
        });
    }

    // Mostrar botón de instalación
    showInstallButton() {
        if (this.isInstalled) return;

        const existingButton = document.getElementById('pwa-install-btn');
        if (existingButton) return;

        const button = document.createElement('button');
        button.id = 'pwa-install-btn';
        button.className = 'pwa-install-button';
        button.innerHTML = `
            <span class="install-icon">📱</span>
            <span class="install-text">Instalar App</span>
        `;
        
        button.addEventListener('click', () => this.promptInstall());
        
        document.body.appendChild(button);
        
        // Agregar estilos
        this.addInstallButtonStyles();
    }

    // Ocultar botón de instalación
    hideInstallButton() {
        const button = document.getElementById('pwa-install-btn');
        if (button) {
            button.style.opacity = '0';
            setTimeout(() => button.remove(), 300);
        }
    }

    // Prompt para instalar la app
    async promptInstall() {
        if (!this.deferredPrompt) {
            console.log('[PWA] No hay prompt disponible');
            return;
        }

        // Mostrar el prompt
        this.deferredPrompt.prompt();

        // Esperar la respuesta del usuario
        const { outcome } = await this.deferredPrompt.userChoice;
        
        console.log(`[PWA] Usuario ${outcome === 'accepted' ? 'aceptó' : 'rechazó'} la instalación`);

        if (outcome === 'accepted') {
            this.hideInstallButton();
        }

        // Limpiar el prompt
        this.deferredPrompt = null;
    }

    // Manejar actualizaciones del Service Worker
    setupUpdateHandler() {
        if (!this.swRegistration) return;

        this.swRegistration.addEventListener('updatefound', () => {
            const newWorker = this.swRegistration.installing;
            
            newWorker.addEventListener('statechange', () => {
                if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
                    // Hay una nueva versión disponible
                    this.showUpdateNotification();
                }
            });
        });
    }

    // Mostrar notificación de actualización
    showUpdateNotification() {
        const notification = document.createElement('div');
        notification.className = 'pwa-update-notification';
        notification.innerHTML = `
            <div class="update-content">
                <span class="update-icon">🔄</span>
                <div class="update-text">
                    <strong>¡Nueva versión disponible!</strong>
                    <p>Actualiza para obtener las últimas mejoras</p>
                </div>
                <button class="update-btn" id="pwa-update-btn">Actualizar</button>
                <button class="update-close" id="pwa-update-close">✕</button>
            </div>
        `;

        document.body.appendChild(notification);
        
        // Agregar estilos
        this.addUpdateNotificationStyles();

        // Manejar actualización
        document.getElementById('pwa-update-btn').addEventListener('click', () => {
            if (this.swRegistration.waiting) {
                this.swRegistration.waiting.postMessage({ type: 'SKIP_WAITING' });
            }
            window.location.reload();
        });

        document.getElementById('pwa-update-close').addEventListener('click', () => {
            notification.remove();
        });
    }

    // Rastrear estado de conexión
    trackOnlineStatus() {
        const updateOnlineStatus = () => {
            const status = navigator.onLine ? 'online' : 'offline';
            document.body.classList.toggle('is-offline', !navigator.onLine);
            
            if (status === 'online') {
                this.showNotification('Conexión restaurada ✓', 'success');
            } else {
                this.showNotification('Sin conexión - Modo offline', 'warning');
            }
        };

        window.addEventListener('online', updateOnlineStatus);
        window.addEventListener('offline', updateOnlineStatus);
    }

    // Mostrar notificación genérica
    showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `pwa-notification pwa-notification-${type}`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        // Agregar estilos
        this.addNotificationStyles();

        setTimeout(() => {
            notification.style.opacity = '1';
            notification.style.transform = 'translateY(0)';
        }, 100);

        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateY(-20px)';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    // Agregar estilos del botón de instalación
    addInstallButtonStyles() {
        if (document.getElementById('pwa-install-styles')) return;

        const styles = document.createElement('style');
        styles.id = 'pwa-install-styles';
        styles.textContent = `
            .pwa-install-button {
                position: fixed;
                bottom: 20px;
                right: 20px;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                border: none;
                padding: 12px 24px;
                border-radius: 50px;
                font-weight: 700;
                font-size: 14px;
                cursor: pointer;
                box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
                display: flex;
                align-items: center;
                gap: 8px;
                transition: all 0.3s ease;
                z-index: 9999;
                animation: slideIn 0.5s ease;
            }

            .pwa-install-button:hover {
                transform: translateY(-3px);
                box-shadow: 0 15px 40px rgba(102, 126, 234, 0.5);
            }

            .pwa-install-button .install-icon {
                font-size: 20px;
            }

            @keyframes slideIn {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @media (max-width: 768px) {
                .pwa-install-button {
                    bottom: 70px;
                    right: 10px;
                    padding: 10px 20px;
                    font-size: 13px;
                }
            }
        `;
        document.head.appendChild(styles);
    }

    // Agregar estilos de notificación de actualización
    addUpdateNotificationStyles() {
        if (document.getElementById('pwa-update-styles')) return;

        const styles = document.createElement('style');
        styles.id = 'pwa-update-styles';
        styles.textContent = `
            .pwa-update-notification {
                position: fixed;
                top: 20px;
                right: 20px;
                background: white;
                border-radius: 12px;
                box-shadow: 0 10px 40px rgba(0,0,0,0.15);
                z-index: 10000;
                animation: slideDown 0.5s ease;
                max-width: 400px;
            }

            .update-content {
                padding: 20px;
                display: flex;
                align-items: center;
                gap: 15px;
            }

            .update-icon {
                font-size: 32px;
            }

            .update-text {
                flex: 1;
            }

            .update-text strong {
                display: block;
                margin-bottom: 5px;
                color: #333;
            }

            .update-text p {
                margin: 0;
                font-size: 14px;
                color: #666;
            }

            .update-btn {
                background: #667eea;
                color: white;
                border: none;
                padding: 8px 16px;
                border-radius: 6px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .update-btn:hover {
                background: #5568d3;
            }

            .update-close {
                background: none;
                border: none;
                font-size: 20px;
                color: #999;
                cursor: pointer;
                padding: 5px;
                line-height: 1;
            }

            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @media (max-width: 768px) {
                .pwa-update-notification {
                    left: 10px;
                    right: 10px;
                    max-width: none;
                }
            }
        `;
        document.head.appendChild(styles);
    }

    // Agregar estilos de notificaciones
    addNotificationStyles() {
        if (document.getElementById('pwa-notification-styles')) return;

        const styles = document.createElement('style');
        styles.id = 'pwa-notification-styles';
        styles.textContent = `
            .pwa-notification {
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 15px 25px;
                border-radius: 8px;
                font-weight: 600;
                z-index: 10000;
                opacity: 0;
                transform: translateY(-20px);
                transition: all 0.3s ease;
                box-shadow: 0 5px 20px rgba(0,0,0,0.15);
            }

            .pwa-notification-success {
                background: #10b981;
                color: white;
            }

            .pwa-notification-warning {
                background: #f59e0b;
                color: white;
            }

            .pwa-notification-info {
                background: #3b82f6;
                color: white;
            }

            @media (max-width: 768px) {
                .pwa-notification {
                    left: 10px;
                    right: 10px;
                    text-align: center;
                }
            }
        `;
        document.head.appendChild(styles);
    }

    // Método para cachear URLs dinámicamente
    cacheUrls(urls) {
        if (this.swRegistration && this.swRegistration.active) {
            this.swRegistration.active.postMessage({
                type: 'CACHE_URLS',
                urls: urls
            });
        }
    }
}

// Inicializar PWA cuando el DOM esté listo
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        window.pwaManager = new PWAManager();
    });
} else {
    window.pwaManager = new PWAManager();
}

// Exportar para uso global
window.PWAManager = PWAManager;
