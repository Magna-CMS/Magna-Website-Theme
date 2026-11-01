{{--
    Block: logo — core's behaviour, plus the two things the Magna wordmark
    is made of: the hexagon mark and the small uppercase suffix.

    The mark is the layout's own sprite symbol, so it inherits the palette
    and costs no extra request. An uploaded image still wins, exactly as in
    core: a site that has replaced the logo should not get the product's.

    A multi-word text ("magna CMS") splits at the last space: the last word
    becomes the small .cms suffix the source wordmark sets beside the name.
--}}
@php
    $mediaId = $block['data']['media_id'] ?? null;
    $media = $mediaId ? \Magna\Media\Media::find($mediaId) : null;
    $src = $media ? \Illuminate\Support\Facades\Storage::disk($media->disk)->url($media->path) : null;

    $text = trim((string) ($block['data']['text'] ?? ''));
    $alt = trim((string) ($block['data']['alt'] ?? ''));
    $url = $block['data']['url'] ?? '/';
    $height = (string) ($block['data']['height'] ?? '40px');
    $height = preg_match('/^[0-9.]+(px|rem|em|%|vh)$/', $height) === 1 ? $height : '40px';

    $isHeading = ($block['data']['heading'] ?? 'no') === 'yes';

    $word = $text !== '' ? $text : (string) \Magna\Settings\GeneralSettings::get()->site_name;
    $label = $alt !== '' ? $alt : ($word !== '' ? $word : 'Home');

    $parts = preg_split('/\s+/', trim($word)) ?: [$word];
    $suffix = count($parts) > 1 ? array_pop($parts) : '';
    $main = implode(' ', $parts);
@endphp
<div class="magna-block magna-block--logo magna-logo">
    @if($isHeading)<h1 class="magna-logo__heading">@endif
    <a href="{{ \Magna\Blocks\Support\SafeUrl::sanitize(is_string($url) && $url !== '' ? $url : '/') }}"
       class="magna-logo__link"
       @if($src === null && $main === '') aria-label="{{ $label }}" @endif>
        @if($src !== null)
            <img src="{{ $src }}"
                 alt="{{ $label }}"
                 class="magna-logo__image"
                 style="height:{{ $height }};width:auto"
                 decoding="async"
                 @if($media && $media->width && $media->height) width="{{ $media->width }}" height="{{ $media->height }}" @endif>
        @else
            <svg class="logo-mark" aria-hidden="true" focusable="false"><use href="#magna-mark"/></svg>
            <span class="magna-logo__text">{{ $main }}@if($suffix !== '')<span class="cms">{{ $suffix }}</span>@endif</span>
        @endif
    </a>
    @if($isHeading)</h1>@endif
</div>
