<div class="radio @if($attributes['disabled']) disabled @endif">
    <label>
        {{ Form::radio($name, $value, $checked, $attributes) }}
        {{ $value }}
    </label>
</div>