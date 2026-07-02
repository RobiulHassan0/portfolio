// Edit Project in Modal

document.addEventListener("click", (e) => {
    const editBtn = e.target.closest(".edit-project-btn");
    if (!editBtn) return;

    document.querySelector("#projectModalTitle").innerText = "Edit Project";

    const id = editBtn.dataset.id;
    const title = editBtn.dataset.title;
    const description = editBtn.dataset.description; 
    const thumbnail = editBtn.dataset.thumbnail;
    const liveUrl = editBtn.dataset.liveUrl;
    const githubUrl = editBtn.dataset.githubUrl;
    const techStack = editBtn.dataset.techStack;
    const isFeatured = editBtn.dataset.featured;
    const isActive = editBtn.dataset.isActive;
    const sortOrder = editBtn.dataset.sortOrder;

    const form = document.querySelector('#projectForm');
    if(!form) return;

    form.querySelector("#projectId").value = id;
    form.querySelector('[name="title"]').value = title;

    const descField = form.querySelector('[name="description"]');
    
    descField.value = (description && description !== "null") ? description : "";

    form.querySelector('[name="thumbnail"]').value = thumbnail;
    form.querySelector('[name="live_url"]').value = liveUrl; 
    form.querySelector('[name="github_url"]').value = githubUrl;
    form.querySelector('[name="tech"]').value = techStack;
    form.querySelector('[name="featured"]').value = isFeatured;
    form.querySelector('[name="is_active"]').value = isActive;
    form.querySelector('[name="sort_order"]').value = sortOrder;

    const preview = document.getElementById("projImgPreview");
    if (preview && thumbnail) {
        preview.innerHTML = `<img src="${thumbnail}" alt="Project Thumbnail" />`;
    }

    console.log("Featured:", isFeatured);
});


// Add new project in Modal

document
    .querySelector('[data-modal-open="modalProject"]:not(.edit-project-btn)')
    ?.addEventListener("click", () => {
        const form = document.querySelector("#projectForm") || document.querySelector('[data-demo="Project saved"]');
        if (form) form.reset();

        document.querySelector("#projectId").value = "";
        document.querySelector("#projectModalTitle").innerText = "New Project";

        const preview = document.getElementById("projImgPreview");
        if (preview)
            preview.innerHTML = `<span class="empty">No image — paste a path above</span>`;
});


// Update or Create with API 

document
    .querySelector('[data-demo="Project saved"]')
    ?.addEventListener("submit", async (e) => {
        e.preventDefault();

        const token = localStorage.getItem("auth_token");
        const projectId = document.querySelector("#projectId").value;

        const techInput = document.querySelector('[name="tech"]').value.trim() || "";
        const techArray = techInput
            ? techInput
                  .split(",")
                  .map((tech) => tech.trim())
                  .filter((tech) => tech !== "")
            : [];

        const form = document.querySelector("#projectForm");

        const payload = {
            title: form.querySelector('[name="title"]').value.trim() || "",
            description: form.querySelector('[name="description"]').value.trim(),
            thumbnail: form.querySelector('[name="thumbnail"]').value.trim() || "",
            live_url: form.querySelector('[name="live_url"]').value.trim() || "",
            github_url: form.querySelector('[name="github_url"]').value.trim() || "",
            tech_stack: techArray,
            featured: form.querySelector('[name="featured"]').value === "1" ? 1: 0,
            is_active: form.querySelector('[name="is_active"]').value === "1" ? 1: 0,
            sort_order: parseInt(
                form.querySelector('[name="sort_order"]').value.trim() || 0
            ) || 0,
        };

        let url = "/api/projects";
        let method = "POST";

        if (projectId) {
            url = `/api/projects/${projectId}`;
            method = "PUT";
        }

        try {
            const response = await fetch(url, {
                method: method,
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    Authorization: `Bearer ${token}`,
                },
                body: JSON.stringify(payload),
            });

            if(!response.ok){
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const data = await response.json();

            if (data.success) {
                alert(
                    data.message ||
                        (projectId
                            ? "Project updated successfully"
                            : "Project created successfully")
                );
                location.reload();
            } else {
                console.error("Validation Or Server Error:", data.errors);
                alert("Action Failed: " + (data.message || "Error"));
            }
        } catch (err) {
            console.error("Unexpected Error:", err);
            alert("An unexpected error occurred.");
        }
});


let deleteProjectId = null;

document.addEventListener('click', (e) => {
    const deleteBtn = e.target.closest(".delete-project-btn");
    if(!deleteBtn) return;

    deleteProjectId = deleteBtn.dataset.id;

    document.querySelector(".modal-head h3").innerText = 'Delete this project?';
});

document.getElementById('confirmDeleteBtn').addEventListener('click', async () => {
    if(!deleteProjectId) return;

    const token = localStorage.getItem('auth_token');

    const btn = document.getElementById('confirmDeleteBtn');
    btn.disabled = true; 

    try{
        const response = await fetch(`/api/projects/${deleteProjectId}`, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                Authorization: `Bearer ${token}`,
            },
        });

        const data = await response.json();

        if( data.success ){
            alert(data.message || "Project deleted successfully");

            const row = document.
            querySelector(`.delete-project-btn[data-id="${deleteProjectId}"]`)
            ?.closest("tr");
            
            if (row) row.remove();

        }else{
            alert(data.message || 'Delete failed');
        }
    }catch( err){
        console.log(err);
        alert('Soemething went wrong');
    }finally{
        btn.disabled = false;
        deleteProjectId = null; 
    }
});