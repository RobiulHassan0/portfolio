<!-- Project modal -->
<div class="modal-backdrop" data-modal id="modalProject">
    <div class="modal modal-lg" role="dialog" aria-modal="true">
        <div class="modal-head">
            <h3 id="projectModalTitle">New / Edit project</h3>
            <button type="button" class="icon-btn" data-modal-close aria-label="Close">✕</button>
        </div>

        <form action="#" method="POST" data-demo="Project saved" id="projectForm">
            <input type="hidden" name="project_id" id="projectId" value="">

            <div class="modal-body space-y-4">
                <div class="field-row cols-2">

                    <div class="field">
                        <label>Title</label>
                        <input name="title" required />
                    </div>

                    <div class="field">
                        <label>Featured</label>
                        <select name="featured">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                </div>

                <div class="field">
                    <label>Description</label>
                    <textarea name="description" required></textarea>
                </div>

                <div class="field">
                    <label>Image path</label>

                    <input name="thumbnail" placeholder="assets/project-1.jpg" data-preview-target="projImgPreview" />

                    <span class="hint">Relative path inside the project (e.g. assets/project-1.jpg)</span>

                    <div class="image-preview" id="projImgPreview"></div>
                </div>

                <div class="field">
                    <label>Tech stack (comma-separated)</label>
                    <input name="tech" placeholder="React, Node, Postgres" />
                </div>

                <div class="field-row cols-2">
                    <div class="field"><label>Live Link</label><input name="live_url" /></div>
                    <div class="field"><label>Gihub Ripo</label><input name="github_url" /></div>
                </div>

                <div class="field-row cols-2">
                    <div class="field">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" placeholder="priority"/>
                    </div>

                    <div class="field">
                        <label>Active</label>
                        <select name="is_active">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="modal-foot">
                <button type="button" class="btn btn-ghost" data-modal-close>Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>