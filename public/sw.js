"use strict";

const CACHE_NAME = "offline-cache-v2";
const OFFLINE_URL = '/offline.html';

const filesToCache = [
    OFFLINE_URL
];

self.addEventListener("install", (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then((cache) => cache.addAll(filesToCache))
    );
});

self.addEventListener("fetch", (event) => {

    // Nunca interferir em requisições POST
    if (event.request.method !== "GET") {
        return;
    }

    const requestUrl = new URL(event.request.url);

    // Só aplicar cache para arquivos estáticos
    if (
        requestUrl.pathname.startsWith('/build/') ||
        requestUrl.pathname.startsWith('/images/') ||
        requestUrl.pathname.endsWith('.css') ||
        requestUrl.pathname.endsWith('.js') ||
        requestUrl.pathname.endsWith('.png') ||
        requestUrl.pathname.endsWith('.jpg') ||
        requestUrl.pathname.endsWith('.svg')
    ) {
        event.respondWith(
            caches.match(event.request).then((response) => {
                return response || fetch(event.request);
            })
        );
        return;
    }

    // Para navegação (páginas)
    if (event.request.mode === 'navigate') {
        event.respondWith(
            fetch(event.request).catch(() => {
                return caches.match(OFFLINE_URL);
            })
        );
    }
});

self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cacheName) => {
                    if (cacheName !== CACHE_NAME) {
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});
