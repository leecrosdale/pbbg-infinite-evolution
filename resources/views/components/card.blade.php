@props(['header'])

<div {{ $attributes->merge(['class' => 'card']) }}>

    @isset($header)
        <div class="card-header">
            {!! $header !!}
        </div>
    @endisset

    <div class="card-body {{ $bodyClass ?? null }}">
        {{ $slot }}
    </div>

</div>
