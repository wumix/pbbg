<div class="btn-group">
    @foreach($buttons as $button)

        <a href="{{ $button['link'] }}" class="btn {{ $button['class'] ?? 'btn-primary' }}" {{ isset($button['modal']) ? 'data-toggle="modal" onclick="return false" data-target="#' . $button['modal'] . '"' : ''}}>
            {!! $button['name'] !!}
        </a>

    @endforeach
</div>