@props(['src', 'width', 'height', 'frameborder'])

@php
    $src = $src ?? 'https://youtube.com';
    $width = $width ?? 560;
    $height = $height ?? 350;
    $frameborder = $frameborder ?? 0;
@endphp

<iframe {{ $attributes->merge(compact('src', 'width', 'height', 'frameborder')) }}>
</iframe>
