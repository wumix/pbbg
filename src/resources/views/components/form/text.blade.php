<div class="form-group @if($errors->first($name)) has-error @endif">
    {{ Form::label($name, null, [
        'class' =>  'control-label',
    ]) }}

    {{ Form::text($name, $value, [
        'class'         =>  'form-control',
        'placeholder'   =>  $attributes['placeholder']
    ], $attributes) }}

    <span class="help-block">{{ $errors->first($name) }}</span>
</div>