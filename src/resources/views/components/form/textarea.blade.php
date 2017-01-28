<div class="form-group @if($errors->first($name)) has-error @endif">
    {{ Form::label($name, null, [
        'class' =>  'control-label',
    ]) }}

    {{ Form::textarea($name, $value, [
        'class'         =>  'form-control',
        'placeholder'   =>  $attributes['placeholder']
    ], $attributes) }}
</div>