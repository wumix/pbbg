<div class="row">
    <div class="col-sm-12">
        {{ Form::xtext('key', null, ['placeholder'=>'test']) }}
        {{ Form::xtext('value', null, ['placeholder'=>'test']) }}
        {{ Form::xselect('type', [
            'text'          =>  'Text',
            'textarea'      =>  'Text Area',
            'number'        =>  'Number'
        ]) }}
        {{ Form::xsubmit('Update setting') }}
    </div>
</div>