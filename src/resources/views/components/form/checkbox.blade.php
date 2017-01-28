<div class="checkbox @if($attributes['disabled'])disabled @endif">
    <label>
        {{ Form::checkbox($name, $value, $checked, $attributes) }}
        {{ $value }}
    </label>
</div>