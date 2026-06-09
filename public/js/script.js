function setupModal(openButtonId, modalId, closeButtonId) {
    const openButton = document.getElementById(openButtonId);
    const modal = document.getElementById(modalId);
    const closeButton = document.getElementById(closeButtonId);

    if (openButton && modal) {
        openButton.addEventListener("click", () => {
            modal.style.display = "flex";
        });
    }

    if (closeButton && modal) {
        closeButton.addEventListener("click", () => {
            modal.style.display = "none";
        });
    }
}

setupModal("openCreateModal", "createCommunityModal", "closeCreateModal");
setupModal("openEditModal", "editCommunityModal", "closeEditModal");
setupModal("openPostModal", "postModal", "closePostModal");
