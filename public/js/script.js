function openModal(modal) {
    if (modal) {
        modal.style.display = "flex";
    }
}

function closeModal(modal) {
    if (modal) {
        modal.style.display = "none";
    }
}

function setupModal(openButtonId, modalId, closeButtonId) {
    const openButton = document.getElementById(openButtonId);
    const modal = document.getElementById(modalId);
    const closeButton = document.getElementById(closeButtonId);

    if (openButton) {
        openButton.addEventListener("click", () => openModal(modal));
    }

    if (closeButton) {
        closeButton.addEventListener("click", () => closeModal(modal));
    }
}

setupModal("openCreateModal", "createCommunityModal", "closeCreateModal");
setupModal("openEditModal", "editCommunityModal", "closeEditModal");
setupModal("openPostModal", "postModal", "closePostModal");

document.querySelectorAll("[data-modal-open]").forEach((button) => {
    button.addEventListener("click", () => {
        openModal(document.getElementById(button.dataset.modalOpen));
    });
});

document.querySelectorAll(".modal").forEach((modal) => {
    const closeButton = modal.querySelector("[id^='close']");

    if (closeButton) {
        closeButton.addEventListener("click", () => closeModal(modal));
    }
});
