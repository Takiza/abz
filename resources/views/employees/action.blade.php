<a href="{{ route('admin.employees.edit', ['id' => $row->id]) }}" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" data-title="Edit">
    <i class="fa fa-edit"></i>
</a>
<button type="submit" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal-{{ $row->id }}" data-placement="top" data-title="Delete">
    <i class="fa fa-trash"></i>
</button>
<form method="post" action="{{ route('admin.employees.delete', ['id' => $row->id]) }}" enctype="multipart/form-data">
    @method('delete')
    @csrf
    <div class="modal fade show" id="modal-{{ $row->id }}" style="display: none; padding-right: 17px;" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content bg-default">
                <div class="modal-header">
                    <h4 class="modal-title">Delete position?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <p>This action can affect a certain number of employees. This action cannot be undone</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, delete</button>
                </div>
            </div>
        </div>
    </div>
</form>
