@php
    $options = array_merge([
        'data-pjax' =>  true,
        'class' =>  'hidden'
    ], $options);
@endphp


{{ Form::open($options) }}