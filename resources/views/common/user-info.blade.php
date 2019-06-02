<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 style="float: left;" class="modal-title" id="student-info">{{ $user->full_name }}</h4>

    <div style="float: left; padding: 1px 0; margin-left: 5px;">
        <small style="font-size: 9px;" class="label label-primary">{{ $user->role->display_name }}</small>
        <small style="font-size: 9px;" class="label label-{{ $user->status == 1 ? 'success' : 'danger' }}">{{ $user->status == 1 ? 'Active' : 'Inactive' }}</small>
    </div>
</div>
<div class="modal-body">
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" class="form-control" id="first_name" value="{{ $user->first_name }}" disabled>
    </div>

    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" class="form-control" id="last_name" value="{{ $user->last_name }}" disabled>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" value="{{ $user->email }}" disabled>
    </div>

    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="phone" class="form-control" id="phone" value="{{ $user->phone }}" disabled>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>