console.log('PGA Admin CMS ready');

// Full-page loader: hidden once everything has loaded (fallback timeout so
// it never gets stuck), and re-shown whenever a form is submitted so the
// add/update/delete navigation round-trip stays branded instead of blank.
(() => {
    const loader = document.getElementById('page-loader');
    if (!loader) {
        return;
    }

    const hideLoader = () => {
        loader.classList.add('is-hidden');
    };
    const showLoader = () => {
        loader.classList.remove('is-hidden');
    };

    window.addEventListener('load', hideLoader);
    setTimeout(hideLoader, 4000);

    // Exposed so the delete-confirm modal (which submits forms
    // programmatically, bypassing the 'submit' event) can trigger it too.
    window.pgaShowLoader = showLoader;

    document.addEventListener('submit', (e) => {
        const form = e.target;
        // Forms with data-confirm open the custom confirm modal instead of
        // submitting right away (see the confirm-modal script below) — the
        // loader for those must wait until the user actually clicks "Ya, Hapus".
        if (
            form instanceof HTMLFormElement &&
            !form.hasAttribute('data-no-loader') &&
            !form.hasAttribute('data-confirm')
        ) {
            showLoader();
        }
    });
})();

function initUploadDropzones() {
    document.querySelectorAll('.upload-form').forEach((form) => {
        const input      = form.querySelector('.upload-input');
        const browseBtn  = form.querySelector('.upload-browse-btn');
        const preview    = form.querySelector('.upload-preview');
        const countLabel = form.querySelector('.upload-count');
        const submit     = form.querySelector('.upload-submit');
        const dropzone   = form.querySelector('.upload-dropzone');

        if (!input || !preview || !dropzone) return;

        const multiple = input.hasAttribute('multiple');
        let selected = [];

        const syncInput = () => {
            const dt = new DataTransfer();
            selected.forEach((file) => dt.items.add(file));
            input.files = dt.files;
        };

        const render = () => {
            preview.innerHTML = '';

            if (selected.length === 0) {
                if (submit) submit.classList.add('hidden');
                if (countLabel) countLabel.classList.add('hidden');
                return;
            }

            selected.forEach((file, idx) => {
                const url  = URL.createObjectURL(file);
                const wrap = document.createElement('div');
                wrap.className = 'group relative overflow-hidden rounded-xl border border-sky-200 ring-1 ring-sky-100';
                wrap.innerHTML = `
                    <img src="${url}" class="h-28 w-full object-cover">
                    <span class="absolute left-1 top-1 rounded bg-amber-500 px-1.5 text-[10px] font-semibold text-white">Baru</span>
                    <button type="button" data-idx="${idx}" class="upload-remove absolute right-1 top-1 flex h-6 w-6 items-center justify-center rounded-full bg-white/90 text-rose-600 opacity-0 shadow-sm transition group-hover:opacity-100">✕</button>
                    <span class="absolute inset-x-0 bottom-0 truncate bg-black/50 px-1.5 py-0.5 text-[10px] text-white">${file.name}</span>`;
                preview.appendChild(wrap);
            });

            if (countLabel) {
                countLabel.textContent = multiple
                    ? `${selected.length} foto dipilih, siap diupload`
                    : `${selected.length} foto dipilih, akan mengganti foto saat ini`;
                countLabel.classList.remove('hidden');
            }
            if (submit) submit.classList.remove('hidden');
        };

        preview.addEventListener('click', (e) => {
            const btn = e.target.closest('.upload-remove');
            if (!btn) return;
            selected.splice(Number(btn.dataset.idx), 1);
            syncInput();
            render();
        });

        const addFiles = (fileList) => {
            const files = Array.from(fileList || []).filter((f) => f.type.startsWith('image/'));
            if (files.length === 0) return;
            selected = multiple ? selected.concat(files) : [files[0]];
            syncInput();
            render();
        };

        if (browseBtn) {
            browseBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                input.click();
            });
        }
        dropzone.addEventListener('click', () => input.click());
        input.addEventListener('change', () => addFiles(input.files));

        ['dragover', 'dragleave', 'drop'].forEach((evt) => {
            dropzone.addEventListener(evt, (e) => {
                e.preventDefault();
                dropzone.classList.toggle('border-sky-400', evt === 'dragover');
                dropzone.classList.toggle('scale-[1.01]', evt === 'dragover');
            });
        });
        dropzone.addEventListener('drop', (e) => addFiles(e.dataTransfer.files));
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initUploadDropzones();

    if (window.tinymce && document.querySelector('.tinymce-editor')) {
        tinymce.init({
            license_key: 'gpl',
            selector: '.tinymce-editor',
            height: 400,
            menubar: false,
            plugins: 'lists link image table code',
            toolbar: 'undo redo | blocks | bold italic | bullist numlist | link image table | code',
        });
    }
});
