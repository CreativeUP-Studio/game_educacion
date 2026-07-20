var e=class{constructor(){this.deferredPrompt=null,this.isInstalled=!1,this.swRegistration=null,this.init()}init(){this.checkInstallation(),this.registerServiceWorker(),this.setupInstallPrompt(),this.setupUpdateHandler(),this.trackOnlineStatus()}checkInstallation(){(window.matchMedia(`(display-mode: standalone)`).matches||window.navigator.standalone===!0)&&(this.isInstalled=!0,console.log(`[PWA] App está instalada`))}async registerServiceWorker(){if(`serviceWorker`in navigator)try{this.swRegistration=await navigator.serviceWorker.register(`/sw.js`,{scope:`/`}),console.log(`[PWA] Service Worker registrado:`,this.swRegistration.scope),setInterval(()=>{this.swRegistration.update()},36e5)}catch(e){console.error(`[PWA] Error al registrar Service Worker:`,e)}}setupInstallPrompt(){window.addEventListener(`beforeinstallprompt`,e=>{e.preventDefault(),this.deferredPrompt=e,this.showInstallButton(),console.log(`[PWA] Evento beforeinstallprompt capturado`)}),window.addEventListener(`appinstalled`,()=>{console.log(`[PWA] App instalada exitosamente`),this.isInstalled=!0,this.hideInstallButton(),this.showNotification(`¡TrignoQuest instalado! 🎉`,`success`)})}showInstallButton(){if(this.isInstalled||document.getElementById(`pwa-install-btn`))return;let e=document.createElement(`button`);e.id=`pwa-install-btn`,e.className=`pwa-install-button`,e.innerHTML=`
            <span class="install-icon">📱</span>
            <span class="install-text">Instalar App</span>
        `,e.addEventListener(`click`,()=>this.promptInstall()),document.body.appendChild(e),this.addInstallButtonStyles()}hideInstallButton(){let e=document.getElementById(`pwa-install-btn`);e&&(e.style.opacity=`0`,setTimeout(()=>e.remove(),300))}async promptInstall(){if(!this.deferredPrompt){console.log(`[PWA] No hay prompt disponible`);return}this.deferredPrompt.prompt();let{outcome:e}=await this.deferredPrompt.userChoice;console.log(`[PWA] Usuario ${e===`accepted`?`aceptó`:`rechazó`} la instalación`),e===`accepted`&&this.hideInstallButton(),this.deferredPrompt=null}setupUpdateHandler(){this.swRegistration&&this.swRegistration.addEventListener(`updatefound`,()=>{let e=this.swRegistration.installing;e.addEventListener(`statechange`,()=>{e.state===`installed`&&navigator.serviceWorker.controller&&this.showUpdateNotification()})})}showUpdateNotification(){let e=document.createElement(`div`);e.className=`pwa-update-notification`,e.innerHTML=`
            <div class="update-content">
                <span class="update-icon">🔄</span>
                <div class="update-text">
                    <strong>¡Nueva versión disponible!</strong>
                    <p>Actualiza para obtener las últimas mejoras</p>
                </div>
                <button class="update-btn" id="pwa-update-btn">Actualizar</button>
                <button class="update-close" id="pwa-update-close">✕</button>
            </div>
        `,document.body.appendChild(e),this.addUpdateNotificationStyles(),document.getElementById(`pwa-update-btn`).addEventListener(`click`,()=>{this.swRegistration.waiting&&this.swRegistration.waiting.postMessage({type:`SKIP_WAITING`}),window.location.reload()}),document.getElementById(`pwa-update-close`).addEventListener(`click`,()=>{e.remove()})}trackOnlineStatus(){let e=()=>{let e=navigator.onLine?`online`:`offline`;document.body.classList.toggle(`is-offline`,!navigator.onLine),e===`online`?this.showNotification(`Conexión restaurada ✓`,`success`):this.showNotification(`Sin conexión - Modo offline`,`warning`)};window.addEventListener(`online`,e),window.addEventListener(`offline`,e)}showNotification(e,t=`info`){let n=document.createElement(`div`);n.className=`pwa-notification pwa-notification-${t}`,n.textContent=e,document.body.appendChild(n),this.addNotificationStyles(),setTimeout(()=>{n.style.opacity=`1`,n.style.transform=`translateY(0)`},100),setTimeout(()=>{n.style.opacity=`0`,n.style.transform=`translateY(-20px)`,setTimeout(()=>n.remove(),300)},3e3)}addInstallButtonStyles(){if(document.getElementById(`pwa-install-styles`))return;let e=document.createElement(`style`);e.id=`pwa-install-styles`,e.textContent=`
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
        `,document.head.appendChild(e)}addUpdateNotificationStyles(){if(document.getElementById(`pwa-update-styles`))return;let e=document.createElement(`style`);e.id=`pwa-update-styles`,e.textContent=`
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
        `,document.head.appendChild(e)}addNotificationStyles(){if(document.getElementById(`pwa-notification-styles`))return;let e=document.createElement(`style`);e.id=`pwa-notification-styles`,e.textContent=`
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
        `,document.head.appendChild(e)}cacheUrls(e){this.swRegistration&&this.swRegistration.active&&this.swRegistration.active.postMessage({type:`CACHE_URLS`,urls:e})}};document.readyState===`loading`?document.addEventListener(`DOMContentLoaded`,()=>{window.pwaManager=new e}):window.pwaManager=new e,window.PWAManager=e;