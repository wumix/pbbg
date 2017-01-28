<div class="form-group">

    @php
    $attributes = $attributes ?? [];

    $attributes = array_merge([
        'class' =>  'btn btn-primary'
    ], $attributes)
    @endphp

    {{ Form::submit($value, $attributes) }}
</div>