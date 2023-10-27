<!-- Modal -->
<div class="modal fade" id="restoreModal-{{$project->id}}" tabindex="-1" aria-labelledby="restoreModal" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="restoreModalLabel">Restoring Project</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            You are going to restore {{$project->name}}, do you want to continue?
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="{{route('admin.projects.trash.restore', $project)}}" method="POST">
            @csrf
            @method('PATCH')
            <input type="submit" class="btn btn-danger" value="restore">
            </form>
        </div>
    </div>
    </div>
</div>