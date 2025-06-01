document.addEventListener('DOMContentLoaded', () => {
    const openModalButton = document.getElementById('openMessageModal');
    const messageModal = document.getElementById('messageModal');

    if (openModalButton) {
        openModalButton.addEventListener('click', () => {
            messageModal.classList.remove('hidden');
        });
    }
});