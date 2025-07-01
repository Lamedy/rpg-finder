document.addEventListener('alpine:init', () => {
    Alpine.data('deleteModal', () => ({
        isOpen: false,
        formId: null,

        openModal(id) {
            this.formId = id;
            this.isOpen = true;
            document.body.style.overflow = 'hidden'; // блокируем прокрутку
        },
        closeModal() {
            this.isOpen = false;
            this.formId = null;
            document.body.style.overflow = ''; // возвращаем прокрутку
        },
        confirmDelete() {
            document.getElementById(this.formId).submit();
            this.closeModal();
        }
    }));
});

window.addEventListener = addEventListener;
