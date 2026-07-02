/* Modals — markup lives in dashboard.html, JS only opens/closes by id.
   <div class="modal-backdrop" data-modal id="modalProject"> ... </div>
   Open:  Modal.open('modalProject');
   Close: Modal.close();  // closes any open modal
   Buttons/links with [data-modal-open="modalId"] or [data-modal-close]
   are wired automatically.
*/
(function () {
  function open(id) {
    const el = document.getElementById(id);
    if (!el) return;
    el.classList.add('open');
    document.body.style.overflow = 'hidden';
  }
  function close() {
    document.querySelectorAll('[data-modal].open').forEach(m => m.classList.remove('open'));
    document.body.style.overflow = '';
  }
  document.addEventListener('click', (e) => {
    const opener = e.target.closest('[data-modal-open]');
    if (opener) { e.preventDefault(); open(opener.dataset.modalOpen); return; }
    if (e.target.matches('[data-modal-close]') || e.target.dataset.close === '1') {
      close(); return;
    }
    // click on backdrop itself
    const backdrop = e.target.closest('[data-modal]');
    if (backdrop && e.target === backdrop) close();
  });
  document.addEventListener('keydown', (e) => { if (e.key === 'Escape') close(); });

  window.Modal = { open, close };


skillPicker = createIconPicker("#skillIconArea");
servicePicker = createIconPicker("#serviceIconArea");

function createIconPicker(containerSelector) {

    const container = document.querySelector(containerSelector);
    if (!container) return;

    container.innerHTML = `
        <label>Icon</label>

        <input type="hidden" name="icon" class="selected-icon">

        <div class="selected-icon-preview">
            <div class="preview-svg">Select</div>
            <span class="preview-name">Choose an icon</span>
        </div>

        <div class="icon-picker"></div>
    `;

    const hidden = container.querySelector(".selected-icon");
    const preview = container.querySelector(".selected-icon-preview");
    const previewSvg = preview.querySelector(".preview-svg");
    const previewName = preview.querySelector(".preview-name");
    const picker = container.querySelector(".icon-picker");

    Object.entries(AdminIcons).forEach(([name, svg]) => {

        const btn = document.createElement("button");

        btn.type = "button";
        btn.className = "icon-option";
        btn.dataset.icon = name;
        btn.innerHTML = svg;
        btn.title = name;

        picker.append(btn);

    });

    picker.addEventListener("click", e => {

        const btn = e.target.closest(".icon-option");
        if (!btn) return;

        picker.querySelectorAll(".icon-option").forEach(i => i.classList.remove("active"));

        btn.classList.add("active");

        hidden.value = btn.dataset.icon;

        previewSvg.innerHTML = AdminIcons[btn.dataset.icon];
        previewName.textContent = btn.dataset.icon;

    });

    return {

        setIcon(icon){
          if(!icon || icon === 'undefined' || icon === null){
            hidden.value = "";
            picker.querySelectorAll(".icon-option").forEach( btn => btn.classList.remove("active"));
            previewSvg.innerHTML = '';
            previewName.textContent = 'Choose an icon';
            return;
          }

          const cleanedIcon = String(icon).trim().toLowerCase();
          hidden.value = cleanedIcon;

          let matchFound = false; 
          picker.querySelectorAll('.icon-option').forEach( btn => {
            const btnIconName = String(btn.dataset.icon).trim().toLowerCase();
            
            if(btnIconName === cleanedIcon){
              btn.classList.add("active");
              matchFound = true;
            }else{
              btn.classList.remove("active");
            }
          });

          const finalIcon = matchFound ? cleanedIcon : 'code';
          if(!matchFound){
            const codeBtn = picker.querySelector('[data-icon="code"]');
            if(codeBtn) codeBtn.classList.add("active");
          }

          previewSvg.innerHTML = AdminIcons[finalIcon] || AdminIcons['code'];
          previewName.textContent = finalIcon;

        },

        getIcon(){

          return hidden.value;

        }

    };

}

window.skillPicker = createIconPicker("#skillIconArea");
window.servicePicker = createIconPicker("#serviceIconArea");

})();

