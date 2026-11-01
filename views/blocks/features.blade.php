{{--
    Block: features — the pattern most of this site is made of.

    One block covers the why cards, the use-case chips, the stack layers of
    the architecture panel, the numbered plugin steps, the feature rows with
    status pills, the hero checklists and the trust marquee. Which one you
    get is decided by the SECTION's CSS class and the block's own layout
    field — both editable from the builder, neither invented here.

    Over the core view this reads three optional item keys, ignored by any
    other theme:

      status  a pill on the right of a row ("Available", "Alpha", "Planned")
      tone    what colours that pill (avail | dev | plan)
      tag     a small pill label beside the title ("API", "Alpha", "Yours")

    `icon` keeps its core meaning, a short string, and additionally resolves
    against the layout's sprite when it names one of the icons below. A name
    nobody knows prints as text, which is what keeps a step number ("1")
    working. Items with nothing but a title (and perhaps a tick) render as
    bare list rows rather than boxed cards.
--}}
@php
    // Repeater-era data arrives as an array; the json field it is stored in
    // arrives as a string. Both are real states of live content.
    $raw = $block['data']['items'] ?? [];
    $items = is_array($raw) ? $raw : (json_decode(is_string($raw) ? $raw : '[]', true) ?: []);

    $layout = $block['data']['layout'] ?? 'icon-grid';
    $layout = in_array($layout, ['icon-grid', 'horizontal-list'], true) ? $layout : 'icon-grid';

    // Mirrored from the layout's sprite so a value from a document can never
    // put an arbitrary fragment identifier into the markup.
    $sprite = [
        'check', 'close', 'arrow-up', 'arrow-right',
        'code', 'shield', 'bolt', 'modules', 'check-circle', 'pencil',
        'screen', 'terminal', 'type', 'layout', 'layers', 'target', 'clock',
        'building', 'list', 'devices', 'chart', 'users', 'cog', 'sparkle',
    ];

    $tones = ['avail', 'dev', 'plan'];
@endphp
<div class="magna-block magna-block--features magna-features magna-features--{{ $layout }}">
    <div class="magna-features__track">
        @foreach($items as $item)
            @php
                $icon = trim((string) ($item['icon'] ?? ''));
                $isSprite = in_array($icon, $sprite, true);
                $title = trim((string) ($item['title'] ?? ''));
                $description = trim((string) ($item['description'] ?? ''));
                $status = trim((string) ($item['status'] ?? ''));
                $tone = (string) ($item['tone'] ?? '');
                $tone = in_array($tone, $tones, true) ? $tone : 'plan';
                $tag = trim((string) ($item['tag'] ?? ''));
                $url = trim((string) ($item['url'] ?? ''));
                $bare = $description === '' && $status === '' && $tag === '';
            @endphp
            <div class="magna-features__item{{ $bare ? ' magna-features__item--bare' : '' }}">
                @if($icon !== '')
                    <span class="magna-features__icon" aria-hidden="true">
                        @if($isSprite)
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><use href="#i-{{ $icon }}"/></svg>
                        @else
                            {{ $icon }}
                        @endif
                    </span>
                @endif

                <div class="magna-features__body">
                    @if($title !== '')
                        {{-- A bare horizontal list is a strip of labels, not a
                             run of headings; the role keeps the outline honest. --}}
                        <h3 class="magna-features__title"@if($bare) role="presentation"@endif>
                            @if($url !== '')
                                <a href="{{ \Magna\Blocks\Support\SafeUrl::sanitize($url) }}">{{ $title }}</a>
                            @else
                                {{ $title }}
                            @endif
                            @if($tag !== '')
                                <span class="magna-features__tag">{{ $tag }}</span>
                            @endif
                            @if($status !== '')
                                <span class="magna-features__status magna-features__status--{{ $tone }}">{{ $status }}</span>
                            @endif
                        </h3>
                    @endif

                    @if($description !== '')
                        <p class="magna-features__description">{{ $description }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
