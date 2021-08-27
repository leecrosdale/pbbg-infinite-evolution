@props(['header'])

<div {{ $attributes->merge(['class' => 'card']) }}>

    @isset($header)
        <div class="card-header text-white bg-secondary">
            {{ $header }}
        </div>
    @endisset

    <div class="card-body {{ $bodyClass ?? null }}">
        {{ $slot }}
    </div>

</div>
