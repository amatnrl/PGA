import { cpSync, existsSync, mkdirSync } from 'fs';
import { dirname, resolve } from 'path';
import { fileURLToPath } from 'url';

const __dirname = dirname(fileURLToPath(import.meta.url));
const src = resolve(__dirname, '../node_modules/tinymce');
const dest = resolve(__dirname, '../public/assets/tinymce');

if (!existsSync(src)) {
  console.warn('tinymce package not found, skipping copy.');
  process.exit(0);
}

mkdirSync(dest, { recursive: true });
cpSync(src, dest, { recursive: true });
console.log('TinyMCE copied to public/assets/tinymce');
