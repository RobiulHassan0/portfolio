  <!-- Confirm-delete modal -->
  <div class="modal-backdrop" data-modal id="modalConfirmDelete">
    <div class="modal delete-modal" role="dialog" aria-modal="true">
      <div class="modal-head">
        <h3>Delete item?</h3>
        <button type="button" class="icon-btn" data-modal-close aria-label="Close">✕</button>
      </div>
      <div class="modal-body">
        <p class="text-sm text-muted-foreground" style="margin:0">This action cannot be undone.</p>
      </div>
      <div class="modal-foot">
        <button 
        type="button" 
        class="btn btn-ghost" 
        data-modal-close>
        Cancel
        </button>
        {{-- <!-- In Blade replace this with a real <form method="POST" action="{{ route('...destroy', $id) }}"> @csrf @method('DELETE') --> --}}
        <button 
        type="button" 
        class="btn btn-outline danger" 
        data-modal-close 
        data-demo-toast="Deleted" 
        data-demo-type="success"
        id="confirmDeleteBtn">
        Delete
      </button>
      </div>
    </div>
  </div>