<!-- Modal -->
<div class="modal fade" id="deleteModal-{{$type->id}}" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="deleteModalLabel">Deleting Type</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            You are going to delete {{$type->name}}, do you want to continue?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <form action="{{route('admin.types.destroy', $type)}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger" value="delete">
            </form>
        </div>
      </div>
    </div>
  </div>