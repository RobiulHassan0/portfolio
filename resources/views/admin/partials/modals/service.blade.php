<!-- Service modal -->
<div class="modal-backdrop" data-modal id="modalService">
  <div class="modal" role="dialog" aria-modal="true">

    <div class="modal-head">
      <h3 id="serviceModalTitle">New / Edit Service</h3>
      <button type="button" class="icon-btn" data-modal-close>✕</button>
    </div>

    <form data-demo="Service saved" id="serviceForm">

      <input type="hidden" name="service_id" id="serviceId"> 

      <div class="modal-body ">

        <!-- Row -->
        <div class="field-row cols-2">

          <div class="field">
            <label>Title</label>
            <input name="title" required>
          </div>

          <div class="field">
            <label>Category</label>

            <select name="category">
              <option value="frontend">Frontend</option>
              <option value="backend">Backend</option>
            </select>
          </div>

        </div>

        <!-- Icon Picker -->
        <div class="field">
          <div id="serviceIconArea"></div>
        </div>

        <!-- Description -->
        <div class="field">

          <label>Description</label>
          <textarea name="description" rows="3"></textarea>

        </div>

        <!-- Stack -->
        <div class="field">

          <label>Stack</label>
          <input name="stack" placeholder="Laravel, Livewire, MySQL">

        </div>

        <!-- Features -->
        <div class="field">

          <label>Features</label>
          <input name="features" placeholder="CRUD, Authentication, REST API">

        </div>

        <!-- Setup -->
        <div class="field">

          <label>Setup</label>
          <input name="setup" placeholder="Domain Setup, cPanel, Hosting Setup">

        </div>

        <!-- Bottom Row -->
        <div class="field-row cols-2">

          <div class="field">

            <label>Sort Order</label>
            <input type="number" name="sort_order" value="0">

          </div>

          <div class="field">

            <label>Status</label>

            <select name="is_active">
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>

          </div>

        </div>

      </div>

      <div class="modal-foot">

        <button type="button" class="btn btn-ghost" data-modal-close>
          Cancel
        </button>

        <button class="btn btn-primary">
          Save
        </button>

      </div>

    </form>

  </div>
</div>

