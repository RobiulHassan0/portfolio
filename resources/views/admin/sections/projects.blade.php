<!-- ============ PROJECTS ============ -->
<section class="section-page" data-section="projects">
  <div class="section-head">
    <div>
      <h2>Projects</h2>
      <div class="sub">Showcase work on the public site.</div>
    </div>
    <button type="button" class="btn btn-primary" data-modal-open="modalProject">+ New project</button>
  </div>

  <!-- In Blade: wrap the <tbody> rows in  ...  -->
  <div class="data-table-wrap">
    <table class="data-table">
      <thead>
        <tr>
          <th style="width:64px"></th>
          <th>Title</th>
          <th>Tech</th>
          <th>Featured</th>
          <th style="width:160px;text-align:right">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($projects as $project)
          <tr> 

            <td data-label="">
              @if ($project->thumbnail)
                <img src="{{ $project->thumbnail }}" alt="{{ $project->title }}"
                  style="width: 40px; height: 40px; object-fit: cover; border-radius: .35rem;">
              @else
                <span class="cell-thumb-fallback">{{ substr($project->title, 0, 1) }}</span>
              @endif
            </td>

            <td data-label="Title">
              <div class="font-medium">{{ $project->title }}</div>
              <div class="text-xs text-muted-foreground line-clamp-1" name="description">{{ $project->description }}</div>
            </td>
            <td data-label="Tech">

              @if(!empty($project->tech_stack) && is_array($project->tech_stack))
                @foreach ($project->tech_stack as $tech)
                  <span class="chip">{{ $tech }}</span>
                @endforeach
              @else

              @endif
            </td>

            <td data-label="Featured">

              @if ($project->featured)
                <span class="chip chip-emerald">Featured</span>
              @else
                <span class="text-muted-foreground text-xs">—</span>
              @endif

            </td> 

            <td data-label="Actions">
              <div class="row-actions">
                <button  
                type="button" 
                class="btn btn-sm btn-outline edit-project-btn" 
                data-modal-open="modalProject"
                data-id="{{ $project->id }}"
                data-title="{{ $project->title }}"
                data-description="{{ $project->description }}"
                data-thumbnail="{{ $project->thumbnail ?? '' }}"
                data-live-url="{{ $project->live_url ?? '' }}"
                data-github-url="{{ $project->github_url ?? '' }}"
                data-tech-stack="{{ is_array($project->tech_stack) ? implode(', ', $project->tech_stack) : '' }}"
                data-featured="{{ $project->featured ? '1' : '0' }}"
                data-is-active="{{ $project->is_active ? '1' : '0' }}"
                data-sort-order="{{ $project->sort_order}}"
                >
                Edit
              </button>

              <button type="button" 
              class="btn btn-sm btn-ghost danger delete-project-btn"
              data-modal-open="modalConfirmDelete"
              data-id="{{ $project->id }}">
                Delete
              </button>

              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</section>