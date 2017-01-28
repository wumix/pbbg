<div class="modal fade" tabindex="-1" role="dialog" id="{{ $id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{!! $title !!}</h4>
            </div>
            <div class="modal-body">
                <p>{!! $body !!}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {{ Form::xbuttonGroup($buttons) }}
            </div>
        </div>
    </div>
</div>