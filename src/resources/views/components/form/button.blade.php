<div class="form-group">
    @if(isset($attributes['class']))
        {{ Form::button($value, $attributes) }}
    @else
        {{ Form::button($value, [
            'class' =>  'btn btn-primary'
        ]) }}
    @endif
</div>