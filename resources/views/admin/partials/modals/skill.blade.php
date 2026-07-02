<!-- Skill modal -->

<div class="modal-backdrop" data-modal id="modalSkill">
  <div class="modal" role="dialog" aria-modal="true">

    <div class="modal-head">
      <h3 id="skillModalTitle">New / Edit skill</h3>
      <button type="button" class="icon-btn" data-modal-close aria-label="Close">✕</button>
    </div>

    <form id="skillForm" action="#" method="POST" data-demo="Skill saved" id="skillForm">

      <div class="modal-body space-y-4">
        <input type="hidden" id="skillid" name="skill_id" value="" />

        <div class="row two ">
          <div class="row">
            <label for="formName">Name</label>
            <input class="input" id="fName" name="name" placeholder="e.g. PHP / Laravel" required />
          </div>

          <div class="row">
            <label for="fromCategory">Category</label>
            <select class="select" id="formCategory" name="category">
              <option value="frontend">Frontend</option>
              <option value="backend">Backend</option>
            </select>
          </div>
        </div>

        <div class="row two">
          <div class="row">
            <label for="formLevel">Level</label>
            <select class="select" id="fromLevel" name="level">
              <option value="Beginner">Beginner</option>
              <option value="Intermediate">Intermediate</option>
              <option value="Expert">Expert</option>
            </select>
          </div>

          <div class="row">
            <label for="formPct">Proficiency</label>
            <div class="range-wrap">
              <input type="range" id="fPct" name="proficiency" min="0" max="100" step="1" value="80" data-range />
              <span class="val" name="proficiency_level">80%</span>
            </div>
          </div>
        </div>

        <!-- Icon Picker -->
        <div class="row">
          <div id="skillIconArea"></div>
        </div>

        <div class="row">
          <label for="fDesc">Description</label>
          <textarea class="textarea" id="fDesc" name="description"
            placeholder="One short line about this skill."></textarea>
        </div>

        <div class="row two" id="check-button">

          <div class="sorting">
            <span>Sort Order</span>
            <input class="input" type="number" name="sort_order" placeholder="Priority" />
          </div>

          <div class="tgls-btn">
            <label class="toggle">
              <span class="txt">Featured</span>
              <input type="checkbox" id="fFeat" name="featured" />
              <span class="track"></span>
            </label>

            <label class="toggle tgl-active">
              <span class="txt">Active (visible on site)</span>
              <input type="checkbox" id="fActive" name="active" />
              <span class="track"></span>
            </label>
          </div>

        </div>

      </div>

      <div class="modal-foot">
        <button type="button" class="btn btn-ghost" data-modal-close>
          Cancel
        </button>
        <button type="submit" class="btn btn-primary">Save skill</button>
      </div>
    </form>
  </div>
</div>










