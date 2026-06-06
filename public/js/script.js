const openCreateModal = document.getElementById("openCreateModal");
const createCommunityModal = document.getElementById("createCommunityModal");
const closeCreateModal = document.getElementById("closeCreateModal");

if (openCreateModal) {
    openCreateModal.addEventListener("click", () => {
        createCommunityModal.style.display = "flex";
    });
}

if (closeCreateModal) {
    closeCreateModal.addEventListener("click", () => {
        createCommunityModal.style.display = "none";
    });
}

const openEditModal = document.getElementById("openEditModal");
const editCommunityModal = document.getElementById("editCommunityModal");
const closeEditModal = document.getElementById("closeEditModal");

if (openEditModal) {
    openEditModal.addEventListener("click", () => {
        editCommunityModal.style.display = "flex";
    });
}

if (closeEditModal) {
    closeEditModal.addEventListener("click", () => {
        editCommunityModal.style.display = "none";
    });
}

const openPostModal = document.getElementById("openPostModal");
const postModal = document.getElementById("postModal");
const closePostModal = document.getElementById("closePostModal");
const publishPostBtn = document.getElementById("publishPostBtn");
const postContent = document.getElementById("postContent");
const postsContainer = document.getElementById("postsContainer");

let postBeingEdited = null;

function createPostElement(content) {
    const post = document.createElement("div");
    post.classList.add("post-card");

    post.innerHTML = `
    <h3>Carlos Eduardo</h3>
    <p class="post-text"></p>

    <div class="post-actions">
      <button class="btn-secondary edit-post-btn">Editar</button>
      <button class="btn-secondary btn-danger delete-post-btn">Excluir</button>
    </div>
  `;

    post.querySelector(".post-text").textContent = content;
    connectPostActions(post);

    return post;
}

function connectPostActions(post) {
    const editBtn = post.querySelector(".edit-post-btn");
    const deleteBtn = post.querySelector(".delete-post-btn");

    if (editBtn) {
        editBtn.addEventListener("click", () => {
            postBeingEdited = post;
            postContent.value = post.querySelector(".post-text").textContent;
            postModal.style.display = "flex";
        });
    }

    if (deleteBtn) {
        deleteBtn.addEventListener("click", () => {
            const confirmed = confirm(
                "Tem certeza que deseja excluir esta publicação?",
            );

            if (confirmed) {
                post.remove();
            }
        });
    }
}

if (postsContainer) {
    document.querySelectorAll(".post-card").forEach((post) => {
        if (!post.querySelector(".post-actions")) {
            const actions = document.createElement("div");
            actions.classList.add("post-actions");

            actions.innerHTML = `
        <button class="btn-secondary edit-post-btn">Editar</button>
        <button class="btn-secondary btn-danger delete-post-btn">Excluir</button>
      `;

            post.appendChild(actions);

            const text = post.querySelector("p");
            if (text) {
                text.classList.add("post-text");
            }
        }

        connectPostActions(post);
    });
}

if (openPostModal) {
    openPostModal.addEventListener("click", () => {
        postBeingEdited = null;
        postContent.value = "";
        postModal.style.display = "flex";
    });
}

if (closePostModal) {
    closePostModal.addEventListener("click", () => {
        postModal.style.display = "none";
        postContent.value = "";
        postBeingEdited = null;
    });
}

if (publishPostBtn) {
    publishPostBtn.addEventListener("click", () => {
        if (postContent.value.trim() === "") {
            alert("Digite algo para publicar.");
            return;
        }

        if (postBeingEdited) {
            postBeingEdited.querySelector(".post-text").textContent =
                postContent.value;
            postBeingEdited = null;
        } else {
            const post = createPostElement(postContent.value);
            postsContainer.prepend(post);
        }

        postContent.value = "";
        postModal.style.display = "none";
    });
}

const deleteCommunityBtn = document.getElementById("deleteCommunityBtn");

if (deleteCommunityBtn) {
    deleteCommunityBtn.addEventListener("click", () => {
        const confirmed = confirm(
            "Tem certeza que deseja excluir esta comunidade?",
        );

        if (confirmed) {
            alert("Comunidade excluída com sucesso!");
            window.location.href = "/comunidades";
        }
    });
}
