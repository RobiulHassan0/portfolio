// All Global variables and functions for the Skills section of the admin panel
let deleteSkillId = null;

// Filter skills by Search
let filter = {
    query: '',
    category: 'all'
};

let skills = []; 

// Load skills from API and render them in the skill grid
const skillGrid = document.getElementById('skillGrid');


function skillCardHtml(skill){
    return `
    <article class="skill" data-cat="${skill.category}">
        <div class="top">
            <div class="ico skill-icon" data-icon="${skill.icon || 'code'}"></div>
            <div class="meta">
                <h3 class="name">${esc(skill.name)}</h3>
                <div class="cat">${skill.category === "frontend" ? "// interfaces" : "// core stack"}</div>
            </div>
            <div class="pct">${skill.proficiency}%</div>
        </div>
        <p class="desc">${esc(skill.description || "")}</p>
        <div class="bar"><i style="--w:${skill.proficiency}%"></i></div>
        <div class="pills">
            <span class="pill level-${skill.level.toLowerCase()}">${skill.level}</span>
            ${skill.featured ? `<span class="pill feat">★ Featured</span>` : ''}
            <span class="pill order">${skill.sort_order}</span>
        </div>
        <div class="foot">
            <span class="status ${skill.is_active ? '' : 'inactive'}">
                <span class="dot"></span>
                ${skill.is_active ? 'Active' : 'Hidden'}
            </span>

            <div class="actions">

                <button title="Edit" class="icon-btn edit-skill-btn" data-modal-open="modalSkill"
                data-id="${skill.id}" 
                data-category="${skill.category}"
                data-name="${skill.name}"
                data-description="${skill.description}"
                data-level="${skill.level}"
                data-icon="${skill.icon}"
                data-proficiency="${skill.proficiency}"
                data-featured="${skill.featured}"
                data-status="${skill.is_active}"
                data-sort-order="${skill.sort_order}">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 20h9" />
                        <path d="M16.5 3.5a2.1 2.1 0 1 1 3 3L7 19l-4 1 1-4 12.5-12.5z" />
                    </svg>
                </button>
                
                <button class="icon-btn" data-status="${skill.is_active}" data-toggle="${skill.id}" title="${skill.is_active ? 'Show' : 'Hide'}">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </button>

                <button class="icon-btn danger delete-skill-btn" data-modal-open="modalConfirmDelete" data-id="${skill.id}" title="Delete ">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 6h18M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m3 0v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                    </svg>
                </button>
            </div>
        </div>
    </article>`;    
}


async function loadSkills() {
    try {
        const token = localStorage.getItem('auth_token');

        const response = await fetch('/api/skills', {
            method: 'GET',
            headers: {
                Accept: 'application/json',
                Authorization: 'Bearer ' + token,
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        };

        const data = await response.json();
        
        const categorizedSkills = data.skill_list;
        

        if (!categorizedSkills || Object.keys(categorizedSkills).length === 0) {
            skillGrid.innerHTML = `<div class="empty">No skills found</div>`;
        } else {
            const allSkillsArray = Object.values(categorizedSkills).flat();

            skills = allSkillsArray;
            renderSkills(); 

            // Icon injecting in skill sections.
        }

    } catch (error) {
        console.error("Something went wrong loading skills: ", error);
        skillGrid.innerHTML = `<div class="empty danger">Failed to load skills</div>`;
    }
}

function renderSkills() {
    const keywords = filter.query.trim().toLowerCase();

    const filteredSkills = skills.filter( skill => {
        
        // Check category filter
        if(filter.category !== 'all' && skill.category !== filter.category){
            return false;
        }

        // Check search query filter
        if(!keywords){
            return true;
        }

        const searchText = [
            skill.name, 
            skill.description,
            skill.category,
            skill.level,
            skill.proficiency
        ].map( value => (value ?? '').toString().toLowerCase()).join(' ');

        return searchText.includes(keywords);
    });

    skillGrid.innerHTML = filteredSkills.map( skill => skillCardHtml(skill)).join('');
    renderIcons('.skill-icon');
}

document.getElementById('query').addEventListener('input', function () {
    filter.query = this.value;
    renderSkills();
});


// filter skills by filter buttons
document.getElementById('tabs').addEventListener('click', function (e) {
    const tab = e.target.closest('.tab');
    if (!tab) return;

    document.querySelectorAll('.tab').forEach( btn => {
        btn.classList.remove('active');
    });

    tab.classList.add('active');

    filter.category = tab.dataset.category;
    renderSkills();
});


// Edit Skill in Modal
 
document.addEventListener('click', (e) => {
    
    const editBtn = e.target.closest(".edit-skill-btn");
    if (!editBtn) return;

    const form = document.getElementById("skillForm") || document.querySelector('form[data-demo="Skill saved"]');
    if (!form) return;
    form.reset();

    document.getElementById("skillModalTitle").innerText = "Edit Skill_";

    const id = editBtn.dataset.id;
    const title = editBtn.dataset.name;
    const description = editBtn.dataset.description;
    const category = editBtn.dataset.category;
    const level = editBtn.dataset.level;
    const skillIcon = editBtn.dataset.icon;
    const proficiency = editBtn.dataset.proficiency;
    const featured = editBtn.dataset.featured;
    const status = editBtn.dataset.status;
    const sortOrder = editBtn.dataset.sortOrder;

    const idInput = form.querySelector('[name="skill_id"]') || document.getElementById('skillid');
    if (idInput) idInput.value = id;

    if (form.querySelector('[name="name"]')) form.querySelector('[name="name"]').value = title;
    if (form.querySelector('[name="description"]')) form.querySelector('[name="description"]').value = description;
    if (form.querySelector('[name="category"]')) form.querySelector('[name="category"]').value = category;
    if (form.querySelector('[name="level"]')) form.querySelector('[name="level"]').value = level;
    if (form.querySelector('[name="featured"]')) form.querySelector('[name="featured"]').checked = featured === "true" || featured === "1";
    if (form.querySelector('[name="active"]')) form.querySelector('[name="active"]').checked =  status === "true" || status === "1";
    if (form.querySelector('[name="icon"]')) form.querySelector('[name="icon"]').value = skillIcon;
    if (form.querySelector('[name="sort_order"]')) form.querySelector('[name="sort_order"]').value = sortOrder;

    const profInput = form.querySelector('[name="proficiency"]') || form.querySelector('[data-range]');
    if (profInput) {
        profInput.value = proficiency;
        const profLabel = form.querySelector('[name="proficiency_level"]') || form.querySelector('.val');
        if (profLabel) profLabel.innerText = `${proficiency}%`;
    }

    if (window.skillPicker) {
       window.skillPicker.setIcon(skillIcon || 'code');
    }

});

// Add New Skill in Modal 
document.querySelector('[data-modal-open="modalSkill"]')?.addEventListener('click', () => {
    const form = document.getElementById("skillForm") || document.querySelector('form[data-demo="Skill saved"]');
    if (!form) return;
    form.reset();

    const idInput = form.querySelector('[name="skill_id"]');
    if (idInput) idInput.value = "";

    const modalTitle = document.querySelector("#skillModalTitle");
    if (modalTitle) modalTitle.innerText = "Add New Skill_";

    const iconInput = form.querySelector('[name="icon"]');
    if (iconInput) iconInput.dispatchEvent(new Event('input'));


    if (window.skillPicker) {
        window.skillPicker.setIcon(''); 
    }

});


// Update or Create with API 

document.querySelector('[data-demo="Skill saved"]')?.addEventListener('submit', async (e) => {
    e.preventDefault();

    const form = document.getElementById("skillForm") || document.querySelector('[data-demo="Skill saved"]');
    if (!form) return;

    const categoryInput = form.querySelector('[name="category"]');
    const nameInput = form.querySelector('[name="name"]');
    const descInput = form.querySelector('[name="description"]');
    const levelInput = form.querySelector('[name="level"]');
    const iconInput = form.querySelector('[name="icon"]');
    const profInput = form.querySelector('[name="proficiency"]');
    const featuredInput = form.querySelector('[name="featured"]');
    const statusInput = form.querySelector('[name="active"]');
    const sortOrderInput = form.querySelector('[name="sort_order"]');

    const payload = {
        category: categoryInput ? categoryInput.value.trim() : "",
        name: nameInput ? nameInput.value.trim() : "",
        description: descInput ? descInput.value.trim() : "",
        level: levelInput ? levelInput.value.trim() : "",
        icon: iconInput ? iconInput.value.trim() : "",
        proficiency: profInput ? Number(profInput.value) : 0,
        featured: featuredInput && featuredInput.checked ? 1 : 0,
        is_active: statusInput && statusInput.checked ? 1 : 0,
        sort_order: sortOrderInput ? Number(sortOrderInput.value) : 0,
    };
console.log("Payload:", payload);

    let url = '/api/skills';
    let method = 'POST';

    const idInput = form.querySelector('[name="skill_id"]');
    const skillid = idInput ? idInput.value : '';

    if (skillid) {
        url = `/api/skills/${skillid}`;
        method = 'PUT';
    }

    const token = localStorage.getItem("auth_token");

    try {
        const response = await fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: JSON.stringify(payload),
        });
        
        const data = await response.json();
        
        if (!response.ok) {
            console.log(data.errors);
            throw new Error(`HTTP error! status: ${response.status}`);
        };


        if (data.success) {
            alert(data.message || (skillid ?
                'Skill Updated Successfully.' :
                'Skill Created Successfully.'));
            location.reload();
            form.reset();
        } else {
            console.error('Unexpected Error:', data.error || data.message);
            alert("Action Failed: " + (data.message || 'Error'));
        }
    } catch (err) {
        console.error("Unexpected Error:", err);
        alert('An unexpected error occurred.')
    }

});

// Active / Inactive toggling for skill section
document.addEventListener('click', async (e) => {
    const toggleBtn = e.target.closest('[data-toggle]');
    if(!toggleBtn) return;
    e.preventDefault(); 

    const skillId = toggleBtn.dataset.toggle;
    const token = localStorage.getItem('auth_token');

    try {
        toggleBtn.disabled = true;

        const response = await fetch(`/api/skills/${skillId}/toggle-status`, {
            method: 'PATCH',
            headers: {
                'Accept': 'application/json',
                'Authorization' : `Bearer ${token}`
            }
        });

        const data = await response.json();
        if(response.ok && data.success){
            location.reload();
        }else{
            alert('Failed to update status: ' + (data.message || 'Error'));
            toggleBtn.disabled = false; 
        }
    } catch (error) {
        console.error('Error toggling status:', error);
        alert('An error occured.');
        toggleBtn.disabled = false; 
    }

});


// Delete Skill in Modal
document.addEventListener('click', (e) => {
    const deleteSkillBtn = e.target.closest('.delete-skill-btn');
    if (!deleteSkillBtn) {
        return;
    } else {
        deleteSkillId = deleteSkillBtn.dataset.id;
    }

    document.querySelector('.modal-head h3').innerText = "Delete this skill?";
});

document.getElementById('confirmDeleteBtn')?.addEventListener('click', async (e) => {
    if (!deleteSkillId) return;

    const btn = document.getElementById('confirmDeleteBtn');
    btn.disabled = true;

    const token = localStorage.getItem('auth_token');

    try {
        const response = await fetch(`/api/skills/${deleteSkillId}`, {
            method: 'DELETE',
            headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${token}`
            }
        });

        const data = await response.json();

        if (data.success) {
            alert(data.message || 'Skill deleted successfully.');
            const skillRow = document.querySelector(`.delete-skill-btn[data-id="${deleteSkillId}"]`)?.closest('article');
            if (skillRow) skillRow.remove();
        } else {
            alert(data.message || 'Delete failed.');
        }

    } catch (err) {
        console.log(err);
        alert('Something went wrong!');
    } finally {
        btn.disabled = false;
        deleteSkillId = null;
    }
});


document.addEventListener('DOMContentLoaded', loadSkills);
