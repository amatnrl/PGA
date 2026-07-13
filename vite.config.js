import { defineConfig } from 'vite';

export default defineConfig({
  base: '/build/',
  build: {
    manifest: true,
    outDir: 'public/build',
    rollupOptions: {
      input: {
        'admin-css': 'resources/css/admin.css',
        'admin-js': 'resources/js/admin.js',
        'site-css': 'resources/css/site.css',
        'site-js': 'resources/js/site.js',
      },
    },
  },
  server: {
    host: 'localhost',
    port: 5173,
    strictPort: true,
    cors: true,
  },
});
