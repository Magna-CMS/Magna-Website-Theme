<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- The source sets a full title per page; meta_title carries it verbatim. --}}
    <title>{{ $seoTitle !== '' ? $seoTitle : ($title !== '' ? $title.' · '.$siteName : $siteName) }}</title>
    @if($metaDescription !== '')
        <meta name="description" content="{{ $metaDescription }}">
    @endif
    @if(count($localeAlternates ?? []) > 1)
        @foreach($localeAlternates as $alternateLocale => $alternateUrl)
            <link rel="alternate" hreflang="{{ $alternateLocale }}" href="{{ url($alternateUrl) }}">
        @endforeach
    @endif

    {{-- The mark, inline, because a theme cannot ship a file that is served. --}}
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 34 34'%3E%3ClinearGradient id='g' x1='0' y1='0' x2='34' y2='34' gradientUnits='userSpaceOnUse'%3E%3Cstop stop-color='%236366f1'/%3E%3Cstop offset='1' stop-color='%238b5cf6'/%3E%3C/linearGradient%3E%3Cpath d='M17 1 31 9v16l-14 8L3 25V9l14-8Z' stroke='url(%23g)' stroke-width='2.4' fill='rgba(99,102,241,.08)'/%3E%3Cpath d='M10 23V11.5l7 6 7-6V23' stroke='url(%23g)' stroke-width='2.4' stroke-linecap='round' stroke-linejoin='round' fill='none'/%3E%3C/svg%3E">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @if($tokensCss !== '')
        <style>{!! $tokensCss !!}</style>
    @endif

@verbatim
    <style>
        /* ============================================================
           KIZMATH — the Magna CMS marketing-site theme.

           Ported from the hand-written site's shared stylesheet, with
           every selector re-pointed at the renderer's markup:
           .magna-section.<band> > .magna-section__inner > .magna-columns
           > .magna-column, and the core block classes inside them. The
           band vocabulary (hero, why, arch, headless, cases, plugins,
           builder, audiences, faq, cta, …) is what the converter writes
           into each section's cssClass field.
           ============================================================ */

        /* ---- Alias layer: editable tokens in, source names out. ----
           Internal names differ from the token-emitted ones so a saved
           token always wins; literals carry what a token cannot (any
           value with parentheses). */
        :root {
            --accent: var(--color-accent, #6366f1);
            --accent-2: var(--color-accent-2, #8b5cf6);
            --accent-3: var(--color-accent-3, #4facfe);
            --accent-hover: var(--color-accent-hover, #4f52e0);
            --accent-light: var(--color-accent-light, #eef0fe);
            --bg-main: var(--color-bg-main, #f7f7fb);
            --bg-white: var(--color-bg-white, #ffffff);
            --bg-soft: var(--color-bg-soft, #f1f1f8);
            --bg-dark: var(--color-bg-dark, #0c1022);
            --bg-darker: var(--color-bg-darker, #070a18);
            --text-main: var(--color-text-main, #12142b);
            --text-muted: var(--color-text-muted, #5c6078);
            --text-light: var(--color-text-light, #9aa0b8);
            --text-on-dark: var(--color-text-on-dark, #ffffff);
            --text-muted-dark: var(--color-text-muted-dark, #c3c8de);
            --border: var(--color-border, #e4e4f0);
            --border-dark: var(--color-border-dark, #1d2142);
            --status-avail: var(--color-status-avail, #10b981);
            --status-dev: var(--color-status-dev, #f59e0b);
            --status-plan: var(--color-status-plan, #9aa0b8);
            --maxw: var(--max-width, 1240px);
            --rad: var(--radius, 14px);
            --rad-lg: var(--radius-lg, 24px);
            --band-pad: var(--band-padding, 110px);
            --serif: var(--display-family, 'Figtree', system-ui, -apple-system, sans-serif);
            --sans: var(--body-family, 'Inter', system-ui, -apple-system, sans-serif);
            --mono: var(--mono-family, ui-monospace, 'SF Mono', Menlo, Consolas, monospace);
            --accent-glow: rgba(99, 102, 241, 0.35);
            --shadow-sm: 0 2px 8px rgba(18, 20, 43, 0.05);
            --shadow-md: 0 12px 40px rgba(18, 20, 43, 0.08);
            --shadow-lg: 0 30px 80px rgba(18, 20, 43, 0.14);
            --ease: cubic-bezier(0.16, 1, 0.3, 1);
            /* Surfaces the kit's container style settings reference. */
            --card-invert: rgba(255, 255, 255, 0.05);
            --border-invert: rgba(255, 255, 255, 0.12);
        }

        /* ---- Reset and base type. ---- */
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: var(--sans);
            font-size: var(--base-size, 16px);
            color: var(--text-main);
            background: var(--bg-main);
            line-height: 1.65;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }
        h1, h2, h3, h4 { letter-spacing: -0.03em; font-weight: 700; color: var(--text-main); }
        a { text-decoration: none; color: inherit; }
        img, svg.logo-mark { display: block; max-width: 100%; }
        ::selection { background: var(--accent); color: #fff; }
        a:focus-visible, button:focus-visible, summary:focus-visible {
            outline: 3px solid var(--accent-3); outline-offset: 3px; border-radius: 6px;
        }
        .skip-link {
            position: fixed; top: -60px; left: 16px; z-index: 3000; padding: 10px 18px;
            background: var(--accent); color: #fff; border-radius: 10px; font-weight: 600;
            transition: top 0.2s var(--ease);
        }
        .skip-link:focus-visible { top: 12px; }

        /* ============================================================
           RENDERER CONTRACT — the shell every page builder page needs.
           ============================================================ */
        .magna-section { padding: var(--band-pad) 0; position: relative; }
        .magna-section__inner { width: 100%; max-width: var(--maxw); margin: 0 auto; padding: 0 32px; position: relative; z-index: 2; }
        .magna-columns { display: flex; flex-wrap: wrap; gap: 40px; }
        .magna-column { min-width: 0; }

        /* A head section flows into the grid section the converter split off it. */
        .magna-section.head-continue { padding-bottom: 0; }
        .magna-section.tail-continue { padding-top: 56px; }

        /* Generic text alignment helpers the converter writes. */
        .magna-section.center .magna-heading,
        .magna-section.center .magna-prose { text-align: center; }
        .magna-section.center .magna-prose > p { margin-left: auto; margin-right: auto; }

        /* ---- Section-head typography (first blocks of most bands). ---- */
        .magna-heading h1, .magna-prose h1 { font-family: var(--serif); font-size: clamp(38px, 5.4vw, 64px); line-height: 1.06; letter-spacing: -0.04em; font-weight: 700; margin-bottom: 24px; }
        .magna-heading h2, .magna-prose h2 { font-family: var(--serif); font-size: clamp(30px, 4vw, 46px); line-height: 1.1; letter-spacing: -0.035em; font-weight: 700; margin-bottom: 16px; max-width: 680px; }
        .magna-section.center .magna-heading h2, .magna-section.center .magna-prose h2 { margin-left: auto; margin-right: auto; }
        .magna-heading h3, .magna-prose h3 { font-family: var(--serif); font-size: 22px; font-weight: 600; margin-bottom: 10px; }
        .magna-prose h1 em, .magna-prose h2 em, .magna-prose h3 em {
            font-style: normal; font-weight: 800; color: var(--accent);
        }
        .magna-prose > p { color: var(--text-muted); font-size: 16.5px; margin-bottom: 18px; max-width: 680px; }
        .magna-prose > p:last-child { margin-bottom: 0; }
        .magna-prose ul { margin: 0 0 18px 20px; color: var(--text-muted); }
        .magna-prose a { color: var(--accent); font-weight: 600; }
        .magna-prose a:hover { color: var(--accent-hover); }
        .magna-block { margin-bottom: 0; }
        .magna-block + .magna-block { margin-top: 18px; }

        /* ---- H6 heading = badge pill. ---- */
        .magna-heading--left h6, .magna-heading--center h6, .magna-heading--right h6 { margin-bottom: 0; }
        .magna-heading h6 {
            display: inline-flex; align-items: center; gap: 8px; padding: 7px 16px;
            background: var(--accent-light); color: var(--accent); border-radius: 100px;
            font-size: 12px; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase;
            border: 1px solid rgba(99, 102, 241, 0.15);
        }
        .magna-heading h6::before { content: ""; width: 6px; height: 6px; border-radius: 50%; background: var(--accent); animation: pulse 2s infinite; }
        .magna-heading--center { text-align: center; }
        .magna-heading--right { text-align: right; }
        @keyframes pulse { 0%, 100% { box-shadow: 0 0 0 0 var(--accent-glow); } 50% { box-shadow: 0 0 0 6px transparent; } }

        /* ============================================================
           BUTTONS — core block classes.
           ============================================================ */
        .magna-block--button { display: inline-block; margin-right: 12px; }
        .magna-block--button + .magna-block--button { margin-top: 0; }
        .magna-btn {
            position: relative; display: inline-flex; align-items: center; justify-content: center;
            gap: 10px; padding: 15px 30px; border-radius: 100px; font-weight: 600; font-size: 14px;
            transition: all 0.35s var(--ease); cursor: pointer; border: 1px solid transparent;
            white-space: nowrap;
        }
        .magna-btn::after {
            content: ""; width: 17px; height: 17px; flex-shrink: 0;
            background-color: currentColor; transition: transform 0.35s var(--ease);
            -webkit-mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M5 12h14M13 6l6 6-6 6'/%3E%3C/svg%3E") center / contain no-repeat;
            mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M5 12h14M13 6l6 6-6 6'/%3E%3C/svg%3E") center / contain no-repeat;
        }
        .magna-btn:hover::after { transform: translateX(4px); }
        .magna-btn--sm { padding: 10px 20px; font-size: 13px; }
        .magna-btn--sm::after { width: 14px; height: 14px; }
        .magna-btn--lg { padding: 18px 36px; font-size: 15px; }
        .magna-btn--primary { background: linear-gradient(120deg, var(--accent), var(--accent-2)); color: #fff; box-shadow: 0 10px 30px -8px var(--accent-glow); }
        .magna-btn--primary:hover { filter: brightness(1.08); transform: translateY(-3px); box-shadow: 0 18px 40px -10px var(--accent-glow); }
        .magna-btn--secondary { background: var(--text-main); color: #fff; }
        .magna-btn--secondary:hover { background: #232649; transform: translateY(-3px); box-shadow: var(--shadow-md); }
        .magna-btn--outline { background: var(--bg-white); color: var(--text-main); border-color: var(--border); }
        .magna-btn--outline:hover { border-color: var(--accent); color: var(--accent); transform: translateY(-3px); box-shadow: var(--shadow-md); }
        .magna-btn--ghost { background: rgba(255, 255, 255, 0.08); color: #fff; border-color: rgba(255, 255, 255, 0.2); backdrop-filter: blur(6px); }
        .magna-btn--ghost:hover { background: rgba(255, 255, 255, 0.16); border-color: rgba(255, 255, 255, 0.4); }

        /* Ghost buttons on light bands read as quiet links. */
        .magna-section.headless .magna-btn--ghost, .magna-section.problem .magna-btn--ghost,
        .magna-section.why .magna-btn--ghost, .magna-section.builder .magna-btn--ghost {
            background: transparent; color: var(--text-muted); border-color: var(--border);
        }

        /* ============================================================
           LOGO BLOCK (header and footer parts).
           ============================================================ */
        .magna-logo__link { display: inline-flex; align-items: center; gap: 11px; font-family: var(--serif); font-size: 24px; font-weight: 700; letter-spacing: -0.04em; color: var(--text-main); transition: color 0.4s var(--ease); }
        .magna-logo .logo-mark { width: 34px; height: 34px; flex-shrink: 0; }
        .magna-logo .cms { font-weight: 500; color: var(--accent-3); font-size: 15px; margin-left: 2px; letter-spacing: 0.08em; text-transform: uppercase; align-self: center; margin-top: 4px; }

        /* ============================================================
           QUOTE, CALLOUT, TABLE, FAQ, CODE — core block markup.
           ============================================================ */
        .magna-quote {
            border-left: 3px solid var(--accent); background: var(--accent-light);
            border-radius: 0 var(--rad) var(--rad) 0; padding: 22px 26px; margin: 28px 0 0;
            font-family: var(--serif); font-size: 19px; font-weight: 600; color: var(--text-main);
        }
        .magna-quote__text { font-style: normal; line-height: 1.5; }
        .magna-quote__attribution { margin-top: 10px; font-family: var(--sans); font-size: 13px; font-weight: 500; color: var(--text-muted); }

        .magna-callout { border: 1px solid var(--border); border-left: 3px solid var(--accent); background: var(--bg-white); border-radius: var(--rad); padding: 20px 24px; }
        .magna-callout__heading { font-weight: 700; margin-bottom: 6px; }
        .magna-callout__body { color: var(--text-muted); font-size: 14.5px; }
        .magna-callout--warning { border-left-color: var(--status-dev); }
        .magna-callout--danger { border-left-color: #ef4444; }
        .magna-callout--success { border-left-color: var(--status-avail); }

        .magna-table { overflow-x: auto; border: 1px solid var(--border); border-radius: var(--rad-lg); background: var(--bg-white); box-shadow: var(--shadow-sm); }
        .magna-table__table { width: 100%; border-collapse: collapse; font-size: 14.5px; }
        .magna-table__table th, .magna-table__table td { padding: 16px 22px; text-align: left; border-bottom: 1px solid var(--border); vertical-align: top; }
        .magna-table__table thead th { font-family: var(--serif); font-size: 13px; letter-spacing: 0.06em; text-transform: uppercase; color: var(--text-muted); background: var(--bg-soft); }
        .magna-table__table tbody tr:last-child th, .magna-table__table tbody tr:last-child td { border-bottom: none; }
        .magna-table__table tbody th[scope="row"], .magna-table__table tbody td:first-child { font-weight: 600; color: var(--text-main); }
        .magna-table__table td { color: var(--text-muted); }
        .magna-table__caption { caption-side: top; text-align: left; padding: 18px 22px 6px; font-weight: 700; font-family: var(--serif); }

        .magna-faq { max-width: 820px; margin: 0 auto; }
        .magna-faq__item { background: var(--bg-white); border: 1px solid var(--border); border-radius: var(--rad); margin-bottom: 14px; overflow: hidden; transition: box-shadow 0.3s, border-color 0.3s; }
        .magna-faq__item[open] { border-color: var(--accent); box-shadow: var(--shadow-md); }
        .magna-faq__question { display: flex; align-items: center; justify-content: space-between; gap: 20px; padding: 24px 28px; cursor: pointer; font-weight: 600; font-size: 17px; list-style: none; }
        .magna-faq__question::-webkit-details-marker { display: none; }
        .magna-faq__question::after {
            content: ""; flex-shrink: 0; width: 32px; height: 32px; border-radius: 50%;
            background-color: var(--accent-light); transition: transform 0.3s var(--ease), background-color 0.3s var(--ease);
            -webkit-mask: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236366f1' stroke-width='2.5' stroke-linecap='round'%3E%3Cpath d='M12 5v14M5 12h14'/%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: center; background-size: 18px;
        }
        .magna-faq__item[open] .magna-faq__question::after { transform: rotate(45deg); }
        .magna-faq__answer { padding: 0 28px 26px; color: var(--text-muted); font-size: 15px; }

        .magna-code { border-radius: var(--rad-lg); overflow: hidden; box-shadow: var(--shadow-lg); border: 1px solid var(--border-dark); background: var(--bg-dark); }
        .magna-code__filename {
            display: flex; align-items: center; padding: 13px 18px 13px 66px; position: relative;
            background: rgba(255, 255, 255, 0.04); border-bottom: 1px solid var(--border-dark);
            font-size: 12px; color: #676d8c; font-family: var(--mono);
        }
        .magna-code__filename::before {
            content: ""; position: absolute; left: 18px; top: 50%; transform: translateY(-50%);
            width: 39px; height: 11px;
            background:
                radial-gradient(circle 5.5px at 5.5px 50%, #f87171 97%, transparent),
                radial-gradient(circle 5.5px at 19.5px 50%, #fbbf24 97%, transparent),
                radial-gradient(circle 5.5px at 33.5px 50%, #34d399 97%, transparent);
        }
        .magna-code__pre { padding: 24px 26px; font-family: var(--mono); font-size: 13px; line-height: 1.75; color: #c3c8de; overflow-x: auto; }
        .magna-code__pre code { font-family: inherit; }

        /* ============================================================
           FEATURES BLOCK — the workhorse. The override renders
           __track > __item (+__icon/__tag/__title/__status/__description)
           and each band restyles it.
           ============================================================ */
        .magna-features__track { display: grid; gap: 26px; }
        .magna-features--icon-grid .magna-features__track { grid-template-columns: repeat(3, 1fr); }
        .magna-features--horizontal-list .magna-features__track { display: grid; gap: 14px; }
        .magna-features__item { min-width: 0; }
        .magna-features__icon { display: flex; align-items: center; justify-content: center; }
        .magna-features__icon svg { width: 26px; height: 26px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
        .magna-features__title { font-size: 16px; margin-bottom: 3px; }
        .magna-features__description { font-size: 13.5px; color: var(--text-muted); margin: 0; }
        .magna-features__tag {
            display: inline-block; margin-left: 8px; font-size: 10.5px; font-weight: 700; letter-spacing: 0.07em;
            text-transform: uppercase; color: var(--accent); background: var(--accent-light);
            border-radius: 100px; padding: 3px 10px; vertical-align: middle;
        }
        .magna-features__status {
            display: inline-block; margin-left: 10px; font-size: 10.5px; font-weight: 700; letter-spacing: 0.07em;
            text-transform: uppercase; border-radius: 100px; padding: 3px 10px; vertical-align: middle;
            background: var(--bg-soft); color: var(--text-muted);
        }
        .magna-features__status--avail { background: #e7f8f1; color: #0d9668; border: 1px solid rgba(13, 150, 104, 0.2); }
        .magna-features__status--dev { background: #fdf3e7; color: #c07817; border: 1px solid rgba(192, 120, 23, 0.2); }
        .magna-features__status--plan { background: var(--accent-light); color: var(--accent); border: 1px solid rgba(99, 102, 241, 0.18); }

        /* Default card look for icon-grid items (the `why` treatment). */
        .magna-features--icon-grid .magna-features__item {
            position: relative; background: var(--bg-white); border: 1px solid var(--border);
            border-radius: var(--rad-lg); padding: 36px 32px; transition: all 0.45s var(--ease); overflow: hidden;
        }
        .magna-features--icon-grid .magna-features__item::before {
            content: ""; position: absolute; inset: 0; z-index: 0; opacity: 0; transition: opacity 0.45s ease;
            background: linear-gradient(160deg, #fff 0%, var(--accent-light) 100%);
        }
        .magna-features--icon-grid .magna-features__item > * { position: relative; z-index: 1; }
        .magna-features--icon-grid .magna-features__item:hover { transform: translateY(-8px); border-color: rgba(99, 102, 241, 0.4); box-shadow: var(--shadow-lg); }
        .magna-features--icon-grid .magna-features__item:hover::before { opacity: 1; }
        .magna-features--icon-grid .magna-features__icon {
            width: 56px; height: 56px; background: linear-gradient(135deg, var(--accent), var(--accent-2)); color: #fff;
            border-radius: 16px; margin-bottom: 24px; box-shadow: 0 12px 26px -8px var(--accent-glow);
            transition: transform 0.4s var(--ease);
        }
        .magna-features--icon-grid .magna-features__item:hover .magna-features__icon { transform: rotate(-8deg) scale(1.05); }
        .magna-features--icon-grid .magna-features__title { font-family: var(--serif); font-size: 21px; font-weight: 600; margin-bottom: 10px; }
        .magna-features--icon-grid .magna-features__description { font-size: 14.5px; }
        .magna-section.grid-2 .magna-features--icon-grid .magna-features__track { grid-template-columns: repeat(2, 1fr); }

        /* Default row look for horizontal-list items (the shift/path treatment). */
        .magna-features--horizontal-list .magna-features__item {
            display: flex; gap: 18px; align-items: flex-start; padding: 20px;
            background: var(--bg-white); border: 1px solid var(--border); border-radius: var(--rad);
            transition: all 0.3s var(--ease);
        }
        .magna-features--horizontal-list .magna-features__item:hover { border-color: var(--accent); transform: translateX(6px); box-shadow: var(--shadow-sm); }
        .magna-features--horizontal-list .magna-features__icon {
            width: 44px; height: 44px; flex-shrink: 0; background: var(--accent-light); color: var(--accent); border-radius: 12px;
        }
        .magna-features--horizontal-list .magna-features__icon svg { width: 22px; height: 22px; }
        .magna-features--horizontal-list .magna-features__body { min-width: 0; }

        /* Checklist rows: items whose icon is the tick and that carry no
           description read as a compact list, not boxed cards. */
        .magna-features--horizontal-list .magna-features__item--bare {
            background: transparent; border: none; padding: 4px 0; gap: 10px; align-items: center;
        }
        .magna-features--horizontal-list .magna-features__item--bare:hover { transform: none; box-shadow: none; }
        .magna-features--horizontal-list .magna-features__item--bare .magna-features__icon {
            width: 18px; height: 18px; background: transparent; color: var(--accent); border-radius: 0;
        }
        .magna-features--horizontal-list .magna-features__item--bare .magna-features__icon svg { width: 18px; height: 18px; stroke-width: 2.5; }
        .magna-features--horizontal-list .magna-features__item--bare .magna-features__title { font-size: 15px; font-weight: 500; margin: 0; color: var(--text-main); }

        /* ============================================================
           CHROME — fixed header, drawer, scroll furniture.
           ============================================================ */
        .scroll-progress {
            position: fixed; top: 0; left: 0; height: 3px; width: 0%;
            background: linear-gradient(90deg, var(--accent-3), var(--accent), var(--accent-2));
            z-index: 2000; transition: width 0.1s linear;
        }
        [data-header] {
            position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
            padding: 20px 0; transition: all 0.4s var(--ease); background: transparent;
        }
        [data-header].scrolled {
            padding: 12px 0; background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(18px) saturate(180%); border-bottom: 1px solid var(--border);
            box-shadow: 0 4px 30px rgba(18, 20, 43, 0.04);
        }

        /* The header part: one row, no band padding, builder blocks inside. */
        [data-header] .magna-section { padding: 0; }
        [data-header] .magna-section__inner { padding: 0 32px; }
        [data-header] .magna-columns { display: flex; flex-wrap: nowrap; align-items: center; gap: 24px; }
        [data-header] .magna-column { display: flex; align-items: center; }
        [data-header] .magna-column:nth-child(2) { justify-content: center; }
        [data-header] .magna-column:last-child { justify-content: flex-end; }
        [data-header] .magna-block + .magna-block { margin-top: 0; }
        [data-header] .drawer-menu { display: none; }

        /* Over a dark hero the header text is light; scrolled it flips. */
        [data-header] .magna-logo__link { color: #fff; }
        [data-header].scrolled .magna-logo__link { color: var(--text-main); }
        [data-header] .magna-nav__list { display: flex; gap: 34px; list-style: none; }
        [data-header] .magna-nav__list--depth-1 { display: none; }
        [data-header] .magna-nav__item a { position: relative; color: rgba(255, 255, 255, 0.75); font-size: 14px; font-weight: 500; transition: color 0.25s; padding: 4px 0; }
        [data-header] .magna-nav__item a::after { content: ""; position: absolute; left: 0; bottom: -2px; width: 0; height: 2px; background: var(--accent); transition: width 0.3s var(--ease); }
        [data-header] .magna-nav__item a:hover { color: #fff; }
        [data-header] .magna-nav__item a:hover::after, [data-header] .magna-nav__item a[aria-current="page"]::after { width: 100%; }
        [data-header].scrolled .magna-nav__item a { color: var(--text-muted); }
        [data-header].scrolled .magna-nav__item a:hover { color: var(--text-main); }
        [data-header] .magna-btn { padding: 10px 22px; font-size: 13px; }
        [data-header] .magna-nav__description { display: none; }

        .hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; background: none; border: none; padding: 8px; position: absolute; right: 22px; top: 50%; transform: translateY(-50%); }
        .hamburger span { width: 24px; height: 2px; background: #fff; border-radius: 2px; transition: all 0.3s var(--ease); }
        [data-header].scrolled .hamburger span { background: var(--text-main); }
        .hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        .hamburger.open span:nth-child(2) { opacity: 0; }
        .hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

        /* ---- Mobile drawer. Filled by the layout script from the header
           part's hidden drawer-menu section. ---- */
        .mobile-menu {
            position: fixed; inset: 0; z-index: 1100;
            background: linear-gradient(160deg, #0f1330 0%, #070a18 100%);
            display: flex; flex-direction: column; padding: 20px 26px 34px;
            opacity: 0; visibility: hidden; transform: translateY(-10px);
            transition: opacity 0.45s var(--ease), visibility 0.45s var(--ease), transform 0.45s var(--ease);
        }
        .mobile-menu::before {
            content: ""; position: absolute; inset: 0; pointer-events: none;
            background: radial-gradient(420px circle at 88% 10%, rgba(99, 102, 241, 0.20), transparent 55%),
                        radial-gradient(380px circle at 0% 100%, rgba(79, 172, 254, 0.10), transparent 50%);
        }
        .mobile-menu.open { opacity: 1; visibility: visible; transform: translateY(0); }
        .mm-top { position: relative; z-index: 1; display: flex; align-items: center; justify-content: space-between; padding-bottom: 8px; }
        .mm-top .logo { display: inline-flex; align-items: center; gap: 11px; font-family: var(--serif); font-size: 24px; font-weight: 700; color: #fff; letter-spacing: -0.04em; }
        .mm-top .logo .logo-mark { width: 34px; height: 34px; }
        .mm-top .logo .cms { font-weight: 500; color: var(--accent-3); font-size: 15px; margin-left: 2px; letter-spacing: 0.08em; text-transform: uppercase; align-self: center; margin-top: 4px; }
        .mm-close {
            width: 46px; height: 46px; border-radius: 50%; border: 1px solid rgba(255, 255, 255, 0.18);
            background: rgba(255, 255, 255, 0.05); color: #fff; display: flex; align-items: center; justify-content: center;
            cursor: pointer; transition: all 0.3s var(--ease);
        }
        .mm-close:hover { background: rgba(99, 102, 241, 0.16); border-color: var(--accent); color: var(--accent-3); transform: rotate(90deg); }
        .mm-close svg { width: 20px; height: 20px; }
        .mm-links { position: relative; z-index: 1; flex: 1; display: flex; flex-direction: column; justify-content: center; overflow-y: auto; }
        .mm-links a, .mm-links summary {
            display: flex; align-items: center; gap: 18px; padding: 14px 2px; color: #f1f5f9;
            font-family: var(--serif); font-size: clamp(24px, 7vw, 32px); font-weight: 700; letter-spacing: -0.03em;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08); transition: color 0.25s; cursor: pointer; list-style: none;
        }
        .mm-links summary::-webkit-details-marker { display: none; }
        .mm-links a:hover, .mm-links summary:hover { color: var(--accent-3); }
        .mm-links .mm-group a { font-size: 17px; font-weight: 500; padding: 11px 2px 11px 22px; border-bottom-color: rgba(255, 255, 255, 0.05); color: #c3c8de; }
        .mm-foot { position: relative; z-index: 1; display: flex; flex-direction: column; gap: 16px; padding-top: 18px; }
        .mm-foot .magna-btn { width: 100%; }
        .mm-note { font-size: 13px; color: #9aa0b8; text-align: center; }

        .to-top {
            position: fixed; bottom: 30px; right: 30px; z-index: 900; width: 52px; height: 52px; border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--accent-2)); color: #fff;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; box-shadow: 0 12px 30px -6px var(--accent-glow); border: none;
            opacity: 0; visibility: hidden; transform: translateY(20px) scale(0.8); transition: all 0.4s var(--ease);
        }
        .to-top.show { opacity: 1; visibility: visible; transform: translateY(0) scale(1); }
        .to-top:hover { transform: translateY(-4px) scale(1.05); }
        .to-top svg { width: 20px; height: 20px; }

        /* ============================================================
           BANDS.
           ============================================================ */

        /* ---- HERO (dark, grid + mesh backdrop). ---- */
        .magna-section.hero {
            min-height: 92vh; display: flex; align-items: center;
            padding: 170px 0 90px; overflow: hidden; background: var(--bg-dark); color: #fff;
        }
        .magna-section.hero::before {
            content: ""; position: absolute; inset: 0; z-index: 0; opacity: 0.5;
            background-image: linear-gradient(rgba(255, 255, 255, 0.035) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255, 255, 255, 0.035) 1px, transparent 1px);
            background-size: 56px 56px;
            -webkit-mask-image: radial-gradient(900px circle at 50% 40%, #000 20%, transparent 75%);
            mask-image: radial-gradient(900px circle at 50% 40%, #000 20%, transparent 75%);
        }
        .magna-section.hero::after {
            content: ""; position: absolute; inset: 0; z-index: 1;
            background:
                radial-gradient(620px circle at 12% 25%, rgba(99, 102, 241, 0.22), transparent 48%),
                radial-gradient(700px circle at 88% 72%, rgba(139, 92, 246, 0.16), transparent 48%),
                radial-gradient(460px circle at 70% 12%, rgba(79, 172, 254, 0.10), transparent 50%);
        }
        .magna-section.hero .magna-section__inner { width: 100%; }
        .magna-section.hero .magna-columns { display: grid; grid-template-columns: 1.15fr 0.85fr; gap: 60px; align-items: center; }
        .magna-section.hero .magna-heading h1, .magna-section.hero .magna-prose h1 { color: #fff; }
        .magna-section.hero .magna-prose h1 em {
            color: transparent; background: linear-gradient(100deg, var(--accent-3), var(--accent-2));
            -webkit-background-clip: text; background-clip: text;
        }
        .magna-section.hero .magna-prose > p { color: #c3c8de; font-size: 18px; max-width: 560px; }
        .magna-section.hero .magna-heading h6 { background: rgba(255, 255, 255, 0.08); color: var(--accent-3); border-color: rgba(255, 255, 255, 0.14); }
        .magna-section.hero .magna-heading h6::before { background: var(--accent-3); }

        /* Hero trust strip: bare checklist, muted, in a row. */
        .magna-section.hero .magna-features--horizontal-list .magna-features__track { display: flex; flex-wrap: wrap; gap: 18px; }
        .magna-section.hero .magna-features--horizontal-list .magna-features__item--bare .magna-features__title { color: #8b91ad; font-size: 13px; }
        .magna-section.hero .magna-features--horizontal-list .magna-features__item--bare .magna-features__icon { color: var(--accent-3); }

        /* Hero card: the kit styles the surface; the theme adds glass + mark. */
        .magna-section.hero .magna-container {
            backdrop-filter: blur(20px); box-shadow: 0 30px 70px rgba(0, 0, 0, 0.35); text-align: center;
        }
        .magna-section.hero .magna-container::before {
            content: ""; display: block; width: 116px; height: 116px; margin: 6px auto 22px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 34 34'%3E%3ClinearGradient id='g' x1='0' y1='0' x2='34' y2='34' gradientUnits='userSpaceOnUse'%3E%3Cstop stop-color='%236366f1'/%3E%3Cstop offset='1' stop-color='%238b5cf6'/%3E%3C/linearGradient%3E%3Cpath d='M17 1 31 9v16l-14 8L3 25V9l14-8Z' stroke='url(%23g)' stroke-width='2.4' fill='rgba(99,102,241,.06)'/%3E%3Cpath d='M10 23V11.5l7 6 7-6V23' stroke='url(%23g)' stroke-width='2.4' stroke-linecap='round' stroke-linejoin='round' fill='none'/%3E%3C/svg%3E") center / contain no-repeat;
            filter: drop-shadow(0 0 34px rgba(99, 102, 241, 0.45));
        }
        .magna-section.hero .magna-container .magna-heading h6 { margin-bottom: 6px; }
        .magna-section.hero .magna-container .magna-heading h3 { font-size: 23px; color: #fff; font-weight: 600; margin-bottom: 22px; }
        .magna-section.hero .magna-container .magna-features__track { display: grid; gap: 12px; text-align: left; border-top: 1px solid rgba(255, 255, 255, 0.12); padding-top: 24px; }
        .magna-section.hero .magna-container .magna-features__item--bare .magna-features__title { font-size: 14px; color: #d6daec; font-weight: 500; }

        /* Short hero for inner pages and the 404. */
        .magna-section.hero.short { min-height: 0; padding: 170px 0 80px; }
        .magna-section.hero.short .magna-columns { display: flex; }

        /* ---- TRUST MARQUEE (rides the hero's dark band). ---- */
        .magna-section.trust { background: var(--bg-dark); padding: 0 0 60px; overflow: hidden; }
        .magna-section.trust .magna-heading--center h6 {
            background: transparent; border: none; color: #676d8c; letter-spacing: 0.15em; padding: 0; margin-bottom: 26px;
        }
        .magna-section.trust .magna-heading h6::before { display: none; }
        .magna-section.trust .magna-section__inner { max-width: none; padding: 0; }
        .magna-section.trust .magna-heading { max-width: var(--maxw); margin: 0 auto; padding: 0 32px; }
        .magna-section.trust .magna-block--features {
            overflow: hidden;
            -webkit-mask-image: linear-gradient(90deg, transparent, #000 12%, #000 88%, transparent);
            mask-image: linear-gradient(90deg, transparent, #000 12%, #000 88%, transparent);
        }
        .magna-section.trust .magna-features__track {
            display: flex; gap: 64px; padding-right: 64px; animation: scrollX 30s linear infinite; white-space: nowrap; width: max-content;
        }
        .magna-section.trust .magna-block--features:hover .magna-features__track { animation-play-state: paused; }
        .magna-section.trust .magna-features__item--bare { padding: 0; border: none; background: transparent; }
        .magna-section.trust .magna-features__item--bare .magna-features__icon { display: none; }
        .magna-section.trust .magna-features__item--bare .magna-features__title {
            font-family: var(--serif); font-size: 26px; font-weight: 500; color: rgba(255, 255, 255, 0.26); transition: color 0.3s;
        }
        .magna-section.trust .magna-features__item--bare:hover .magna-features__title { color: rgba(255, 255, 255, 0.6); }
        @keyframes scrollX { to { transform: translateX(-50%); } }

        /* ---- PROBLEM (white, prose + list). ---- */
        .magna-section.problem { background: var(--bg-white); border-bottom: 1px solid var(--border); }
        .magna-section.problem-grid .magna-columns { display: grid; grid-template-columns: 1fr 1fr; gap: 70px; align-items: start; }

        /* ---- WHY (card grid on the page background). ---- */
        .magna-section.why { background: var(--bg-main); }

        /* ---- ARCH (white, text + dark stack panel). ---- */
        .magna-section.arch { background: var(--bg-white); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); }
        .magna-section.arch-grid .magna-columns { display: grid; grid-template-columns: 1fr 1fr; gap: 70px; align-items: center; }
        .magna-section.arch .magna-quote { background: transparent; border-left: 3px solid var(--accent-2); border-radius: 0; padding: 0 0 0 20px; margin: 26px 0; font-size: 18px; }
        .magna-section.arch .magna-column:last-child .magna-block--features {
            background: var(--bg-dark); border-radius: var(--rad-lg); padding: 44px;
            box-shadow: var(--shadow-lg); position: relative; overflow: hidden;
        }
        .magna-section.arch .magna-column:last-child .magna-block--features::before {
            content: ""; position: absolute; inset: 0;
            background: radial-gradient(420px circle at 30% 20%, rgba(99, 102, 241, 0.22), transparent 55%),
                        radial-gradient(380px circle at 80% 90%, rgba(79, 172, 254, 0.14), transparent 55%);
        }
        .magna-section.arch .magna-column:last-child .magna-features__track {
            position: relative; z-index: 1; display: grid; grid-template-columns: 1fr; gap: 10px;
        }
        .magna-section.arch .magna-column:last-child .magna-features__item {
            display: flex; justify-content: space-between; align-items: center; gap: 14px;
            border: 1px solid rgba(255, 255, 255, 0.14); background: rgba(255, 255, 255, 0.05);
            border-radius: 12px; padding: 12px 18px; overflow: visible;
        }
        .magna-section.arch .magna-column:last-child .magna-features__item::before { display: none; }
        .magna-section.arch .magna-column:last-child .magna-features__item:hover { transform: none; box-shadow: none; border-color: rgba(255, 255, 255, 0.3); }
        .magna-section.arch .magna-column:last-child .magna-features__icon { display: none; }
        .magna-section.arch .magna-column:last-child .magna-features__title { font-family: var(--sans); font-size: 13px; color: #d6daec; font-weight: 500; margin: 0; }
        .magna-section.arch .magna-column:last-child .magna-features__tag {
            margin: 0; background: transparent; padding: 0; font-size: 10.5px; letter-spacing: 0.08em; color: var(--accent-3);
        }
        .magna-section.arch .magna-column:last-child .magna-features__item:nth-child(3) {
            border-color: rgba(99, 102, 241, 0.55); background: rgba(99, 102, 241, 0.14);
        }

        /* ---- HEADLESS (page background, terminal + path cards). ---- */
        .magna-section.headless { background: var(--bg-main); }
        .magna-section.headless-grid .magna-columns { display: grid; grid-template-columns: 0.95fr 1.05fr; gap: 64px; align-items: center; }
        .magna-features__item .magna-features__icon--path,
        .magna-section.headless .magna-features--horizontal-list .magna-features__icon,
        .magna-section.problem .magna-features--horizontal-list .magna-features__icon {
            background: linear-gradient(135deg, var(--accent), var(--accent-2)); color: #fff;
            box-shadow: 0 10px 22px -8px var(--accent-glow);
        }
        .magna-section.headless .magna-features--horizontal-list .magna-features__item { padding: 24px; }
        .magna-section.headless .magna-features--horizontal-list .magna-features__title { font-size: 17px; margin-bottom: 4px; }
        .magna-section.headless .magna-features--horizontal-list .magna-features__description { font-size: 14px; }

        /* ---- CASES (dark chip grid). ---- */
        .magna-section.cases { background: var(--bg-dark); color: #fff; overflow: hidden; }
        .magna-section.cases::before {
            content: ""; position: absolute; inset: 0;
            background: radial-gradient(700px circle at 80% 20%, rgba(139, 92, 246, 0.14), transparent 50%),
                        radial-gradient(600px circle at 10% 90%, rgba(99, 102, 241, 0.12), transparent 50%);
        }
        .magna-section.cases .magna-heading h2, .magna-section.cases .magna-prose h2 { color: #fff; }
        .magna-section.cases .magna-prose h2 em { color: var(--accent-3); }
        .magna-section.cases .magna-prose > p { color: #c3c8de; }
        .magna-section.cases .magna-heading h6 { background: rgba(255, 255, 255, 0.08); color: var(--accent-3); border-color: rgba(255, 255, 255, 0.14); }
        .magna-section.cases .magna-heading h6::before { background: var(--accent-3); }
        .magna-section.cases .magna-features--icon-grid .magna-features__track { grid-template-columns: repeat(4, 1fr); gap: 16px; }
        .magna-section.cases .magna-features--icon-grid .magna-features__item {
            border: 1px solid var(--border-dark); background: rgba(255, 255, 255, 0.04); border-radius: var(--rad);
            padding: 22px 20px; transition: all 0.35s var(--ease);
        }
        .magna-section.cases .magna-features--icon-grid .magna-features__item::before { display: none; }
        .magna-section.cases .magna-features--icon-grid .magna-features__item:hover {
            border-color: var(--accent); background: rgba(99, 102, 241, 0.10); transform: translateY(-5px); box-shadow: none;
        }
        .magna-section.cases .magna-features--icon-grid .magna-features__icon { display: none; }
        .magna-section.cases .magna-features--icon-grid .magna-features__title { color: #fff; font-size: 15.5px; font-family: var(--sans); font-weight: 700; margin-bottom: 4px; }
        .magna-section.cases .magna-features--icon-grid .magna-features__description { font-size: 12.5px; color: #9aa0b8; }
        .magna-section.cases .magna-container { margin-top: 44px; }
        .magna-section.cases .magna-container .magna-prose p { font-family: var(--serif); font-size: 19px; font-weight: 600; color: #e8eaf6; margin: 0; }

        /* ---- PLUGINS (soft band, numbered steps). ---- */
        .magna-section.plugins { background: var(--bg-soft); overflow: hidden; }
        .magna-section.plugins .magna-features--icon-grid .magna-features__track { grid-template-columns: repeat(3, 1fr); gap: 0; }
        .magna-section.plugins .magna-features--icon-grid .magna-features__item {
            background: transparent; border: none; border-radius: 0; padding: 0 26px; text-align: center; overflow: visible;
        }
        .magna-section.plugins .magna-features--icon-grid .magna-features__item::before { display: none; }
        .magna-section.plugins .magna-features--icon-grid .magna-features__item:hover { transform: none; box-shadow: none; }
        .magna-section.plugins .magna-features--icon-grid .magna-features__icon {
            width: 72px; height: 72px; margin: 0 auto 24px; border-radius: 50%; background: var(--bg-white);
            border: 2px solid var(--accent); color: var(--accent); box-shadow: var(--shadow-sm);
            font-family: var(--serif); font-size: 25px; font-weight: 700;
            transition: transform 0.4s var(--ease), background 0.4s var(--ease), color 0.4s var(--ease), box-shadow 0.4s var(--ease);
        }
        .magna-section.plugins .magna-features--icon-grid .magna-features__item:hover .magna-features__icon {
            background: var(--accent); color: #fff; transform: translateY(-6px) scale(1.08);
            box-shadow: 0 18px 36px -10px var(--accent-glow);
        }
        .magna-section.plugins .magna-features--icon-grid .magna-features__title { font-size: 19px; font-family: var(--serif); margin-bottom: 10px; }
        .magna-section.plugins .magna-features--icon-grid .magna-features__description { font-size: 14px; }
        .magna-section.plugins .magna-block--features + .magna-block--text { max-width: 720px; margin: 56px auto 0; text-align: center; }
        .magna-section.plugins .magna-block--features + .magna-block--text p { font-size: 15px; }

        /* ---- BUILDER (white split; the mock is drawn by the theme). ---- */
        .magna-section.builder { background: var(--bg-white); border-top: 1px solid var(--border); }
        .magna-section.builder-grid .magna-columns { display: grid; grid-template-columns: 1fr 1fr; gap: 70px; align-items: center; }
        .magna-section.builder-grid .magna-columns::before {
            content: ""; display: block; min-height: 360px; border: 1px solid var(--border);
            border-radius: var(--rad-lg); box-shadow: var(--shadow-lg);
            background:
                radial-gradient(circle 5.5px at 18px 20px, #f87171 97%, transparent),
                radial-gradient(circle 5.5px at 36px 20px, #fbbf24 97%, transparent),
                radial-gradient(circle 5.5px at 54px 20px, #34d399 97%, transparent),
                linear-gradient(var(--bg-soft), var(--bg-soft)) 0 0 / 100% 40px no-repeat,
                linear-gradient(var(--bg-main), var(--bg-main)) 0 40px / 64px 100% no-repeat,
                linear-gradient(var(--accent-light), var(--accent-light)) 86px 62px / calc(100% - 108px) 92px no-repeat,
                linear-gradient(var(--bg-main), var(--bg-main)) 86px 170px / calc(33% - 44px) 66px no-repeat,
                linear-gradient(var(--bg-main), var(--bg-main)) calc(33% + 54px) 170px / calc(33% - 44px) 66px no-repeat,
                linear-gradient(var(--bg-main), var(--bg-main)) calc(66% + 22px) 170px / calc(33% - 44px) 66px no-repeat,
                linear-gradient(var(--bg-main), var(--bg-main)) 86px 252px / calc(100% - 108px) 56px no-repeat,
                var(--bg-white);
        }
        .magna-section.builder .magna-features--horizontal-list .magna-features__track { gap: 12px; }

        /* ---- AUDIENCES (two big cards built from containers). ---- */
        .magna-section.audiences { background: var(--bg-main); }
        .magna-section.audiences > .magna-section__inner > .magna-columns > .magna-column > .magna-container > .magna-container,
        .magna-section.aud-grid .magna-container > .magna-container { flex: 1 1 420px; }
        .magna-section.audiences .magna-container .magna-container { transition: all 0.45s var(--ease); }
        .magna-section.audiences .magna-container .magna-container:hover { transform: translateY(-8px); border-color: rgba(99, 102, 241, 0.4) !important; box-shadow: var(--shadow-lg); }
        .magna-section.audiences .magna-container .magna-heading h6 { background: transparent; border: none; padding: 0; color: var(--accent); letter-spacing: 0.1em; }
        .magna-section.audiences .magna-container .magna-heading h6::before { display: none; }
        .magna-section.audiences .magna-container .magna-heading h3 { font-size: 24px; margin-bottom: 14px; }
        .magna-section.audiences .magna-container .magna-prose > p { font-size: 15px; }
        .magna-section.audiences .magna-container .magna-block--features { border-top: 1px solid var(--border); padding-top: 22px; }
        .magna-section.audiences .magna-features--horizontal-list .magna-features__track { gap: 12px; }

        /* ---- FEAT-ROWS (features page listings with status pills). ---- */
        .magna-section.feat-rows .magna-features--horizontal-list .magna-features__item { padding: 22px 26px; background: var(--bg-white); }
        .magna-section.feat-rows .magna-features__title { font-size: 16.5px; }
        .magna-section.feat-rows .magna-features__description { font-size: 14px; }

        /* ---- PROSE sections (long-form columns). ---- */
        .magna-section.prose .magna-prose > p { font-size: 16px; }

        /* ---- FAQ band. ---- */
        .magna-section.faq { background: var(--bg-soft); }

        /* ---- CTA (darkest, centred). ---- */
        .magna-section.cta { background: var(--bg-darker); color: #fff; text-align: center; padding: 120px 0; overflow: hidden; }
        .magna-section.cta::before {
            content: ""; position: absolute; inset: 0;
            background: radial-gradient(600px circle at 50% 0%, rgba(99, 102, 241, 0.26), transparent 55%);
        }
        .magna-section.cta .magna-columns { display: block; max-width: 700px; margin: 0 auto; }
        .magna-section.cta .magna-heading h2, .magna-section.cta .magna-prose h2 {
            font-size: clamp(34px, 5vw, 54px); letter-spacing: -0.04em; margin-bottom: 18px; color: #fff; max-width: none;
        }
        .magna-section.cta .magna-prose h2 em { color: var(--accent-3); }
        .magna-section.cta .magna-prose > p { color: #c3c8de; font-size: 18px; margin: 0 auto 28px; }
        .magna-section.cta .magna-heading h6 { background: rgba(255, 255, 255, 0.08); color: var(--accent-3); border-color: rgba(255, 255, 255, 0.14); }
        .magna-section.cta .magna-heading h6::before { background: var(--accent-3); }
        .magna-section.cta .magna-block--button { margin: 6px; }
        .magna-section.cta .magna-block--button + .magna-block--button { margin-top: 6px; }
        .magna-section.cta .magna-btn--ghost.magna-btn--sm { background: transparent; border-color: transparent; color: #9aa0b8; box-shadow: none; }
        .magna-section.cta .magna-btn--ghost.magna-btn--sm:hover { color: var(--accent-3); }

        /* ============================================================
           FOOTER CHROME (the footer template part).
           ============================================================ */
        .magna-chrome--footer { background: var(--bg-darker); color: var(--text-light); font-size: 14px; border-top: 1px solid var(--border-dark); }
        .magna-chrome--footer .magna-section { padding: 0; background: transparent; }
        .magna-chrome--footer .magna-section.footer-main { padding: 90px 0 56px; }
        .magna-chrome--footer .magna-section.footer-main .magna-columns { gap: 48px; }
        .magna-chrome--footer .magna-section.footer-bottom { padding: 0 0 40px; }
        .magna-chrome--footer .magna-section.footer-bottom .magna-section__inner { border-top: 1px solid var(--border-dark); padding-top: 34px; }
        .magna-chrome--footer .magna-section.footer-bottom p { font-size: 13px; color: var(--text-light); margin: 0; }
        .magna-chrome--footer .magna-logo__link { color: #fff; margin-bottom: 18px; }
        .magna-chrome--footer .magna-prose > p { color: var(--text-light); font-size: 14px; max-width: 300px; }
        .magna-chrome--footer .magna-prose a { color: var(--text-light); border: 1px solid var(--border-dark); border-radius: 100px; padding: 8px 18px; display: inline-block; margin-top: 6px; font-weight: 600; transition: all 0.3s var(--ease); }
        .magna-chrome--footer .magna-prose a:hover { background: var(--accent); border-color: var(--accent); color: #fff; }
        .magna-chrome--footer .magna-heading h6 { background: transparent; border: none; padding: 0; color: #fff; font-size: 14px; letter-spacing: 0.02em; text-transform: none; margin-bottom: 10px; }
        .magna-chrome--footer .magna-heading h6::before { display: none; }
        .magna-chrome--footer .magna-nav__list { list-style: none; display: grid; gap: 13px; }
        .magna-chrome--footer .magna-nav__item a { color: var(--text-light); transition: color 0.2s, padding-left 0.2s; font-size: 14px; }
        .magna-chrome--footer .magna-nav__item a:hover { color: var(--accent-3); padding-left: 5px; }
        .magna-chrome--footer .magna-nav__description { display: none; }

        /* Fallback footer (no part designed yet). */
        .footer-fallback { background: var(--bg-darker); color: var(--text-light); padding: 48px 32px; text-align: center; font-size: 14px; }

        /* ============================================================
           REVEAL — bands arrive. Gated behind html.js so nothing hides
           when scripts are off or stripped.
           ============================================================ */
        html.js main .magna-section { opacity: 0; transform: translateY(40px); transition: opacity 0.8s var(--ease), transform 0.8s var(--ease); }
        html.js main .magna-section.in { opacity: 1; transform: none; }
        html.js main .magna-section.hero, html.js main .magna-section.trust { opacity: 1; transform: none; }

        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            .magna-section.trust .magna-features__track, .magna-heading h6::before { animation: none !important; }
            html.js main .magna-section { opacity: 1 !important; transform: none !important; transition: none !important; }
        }

        /* ============================================================
           RESPONSIVE. Every multi-column base selector is restated here.
           ============================================================ */
        @media (max-width: 1024px) {
            .magna-section.hero .magna-columns,
            .magna-section.problem-grid .magna-columns,
            .magna-section.arch-grid .magna-columns,
            .magna-section.headless-grid .magna-columns,
            .magna-section.builder-grid .magna-columns { display: grid; grid-template-columns: 1fr; gap: 40px; }
            .magna-section.builder-grid .magna-columns::before { display: none; }
            .magna-features--icon-grid .magna-features__track { grid-template-columns: repeat(2, 1fr); }
            .magna-section.cases .magna-features--icon-grid .magna-features__track { grid-template-columns: repeat(2, 1fr); }
            .magna-section.plugins .magna-features--icon-grid .magna-features__track { grid-template-columns: 1fr; gap: 40px; }
            .magna-section.hero { min-height: 0; padding-bottom: 70px; }
            .magna-chrome--footer .magna-section.footer-main .magna-columns { flex-wrap: wrap; }
            .magna-chrome--footer .magna-section.footer-main .magna-column { flex: 1 1 40% !important; }
            [data-header] .magna-column { flex: 0 0 auto !important; }
            [data-header] .magna-columns { justify-content: space-between; }
        }
        @media (max-width: 680px) {
            .magna-section { padding: 80px 0; }
            .magna-section__inner { padding: 0 22px; }
            .magna-columns { gap: 32px; }
            .magna-column { flex: 1 1 100% !important; }
            .magna-section.hero .magna-columns,
            .magna-section.problem-grid .magna-columns,
            .magna-section.arch-grid .magna-columns,
            .magna-section.headless-grid .magna-columns,
            .magna-section.builder-grid .magna-columns { grid-template-columns: 1fr; }
            .magna-features--icon-grid .magna-features__track,
            .magna-section.cases .magna-features--icon-grid .magna-features__track,
            .magna-section.grid-2 .magna-features--icon-grid .magna-features__track { grid-template-columns: 1fr; }
            [data-header] nav, [data-header] .magna-nav, [data-header] .magna-block--button, [data-header] .magna-column:nth-child(2), [data-header] .magna-column:last-child { display: none; }
            .hamburger { display: flex; }
            [data-header] .magna-columns { flex-wrap: nowrap; }
            .magna-section.hero { padding-top: 130px; }
            .magna-section.hero.short { padding-top: 130px; }
            .magna-section.arch .magna-column:last-child .magna-block--features { padding: 28px; }
            .magna-section.cta { padding: 90px 0; }
            .magna-chrome--footer .magna-section.footer-main .magna-column { flex: 1 1 100% !important; }
            .to-top { bottom: 20px; right: 20px; width: 46px; height: 46px; }
        }
    </style>
@endverbatim
</head>
<body>

{{-- The mark and the icons the features override may name. --}}
<svg width="0" height="0" style="position:absolute" aria-hidden="true" focusable="false"
     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <defs>
        <linearGradient id="kiz-mg" x1="0" y1="0" x2="34" y2="34" gradientUnits="userSpaceOnUse">
            <stop stop-color="#6366f1"/>
            <stop offset="1" stop-color="#8b5cf6"/>
        </linearGradient>
    </defs>
    <symbol id="magna-mark" viewBox="0 0 34 34" stroke="none">
        <path d="M17 1 31 9v16l-14 8L3 25V9l14-8Z" stroke="url(#kiz-mg)" stroke-width="2.4" fill="rgba(99,102,241,.06)"/>
        <path d="M10 23V11.5l7 6 7-6V23" stroke="url(#kiz-mg)" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
    </symbol>
    <symbol id="i-close" viewBox="0 0 24 24"><path d="M18 6 6 18M6 6l12 12"/></symbol>
    <symbol id="i-arrow-up" viewBox="0 0 24 24"><path d="M12 19V5M5 12l7-7 7 7"/></symbol>
    <symbol id="i-arrow-right" viewBox="0 0 24 24"><path d="M5 12h14M13 6l6 6-6 6"/></symbol>
    <symbol id="i-check" viewBox="0 0 24 24"><path d="M20 6 9 17l-5-5"/></symbol>
    <symbol id="i-code" viewBox="0 0 24 24"><path d="M16 18l6-6-6-6M8 6l-6 6 6 6"/></symbol>
    <symbol id="i-shield" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></symbol>
    <symbol id="i-bolt" viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></symbol>
    <symbol id="i-modules" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></symbol>
    <symbol id="i-check-circle" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M8 12l3 3 5-6"/></symbol>
    <symbol id="i-pencil" viewBox="0 0 24 24"><path d="M12 20h9M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></symbol>
    <symbol id="i-screen" viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><path d="M8 21h8M12 17v4"/></symbol>
    <symbol id="i-terminal" viewBox="0 0 24 24"><path d="M4 17l6-6-6-6M12 19h8"/></symbol>
    <symbol id="i-type" viewBox="0 0 24 24"><path d="M4 7V4h16v3M9 20h6M12 4v16"/></symbol>
    <symbol id="i-layout" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="7" rx="1"/><rect x="3" y="14" width="8" height="7" rx="1"/><rect x="15" y="14" width="6" height="7" rx="1"/></symbol>
    <symbol id="i-layers" viewBox="0 0 24 24"><path d="M12 3l9 5-9 5-9-5 9-5zM3 13l9 5 9-5"/></symbol>
    <symbol id="i-target" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="3"/></symbol>
    <symbol id="i-clock" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></symbol>
    <symbol id="i-building" viewBox="0 0 24 24"><path d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6"/></symbol>
    <symbol id="i-list" viewBox="0 0 24 24"><path d="M3 6h18M3 12h18M3 18h18"/></symbol>
    <symbol id="i-devices" viewBox="0 0 24 24"><rect x="2" y="4" width="13" height="16" rx="2"/><rect x="17" y="8" width="5" height="12" rx="1.5"/></symbol>
    <symbol id="i-chart" viewBox="0 0 24 24"><path d="M3 3v18h18M18 17l-3-3-4 4-5-5"/></symbol>
    <symbol id="i-users" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></symbol>
    <symbol id="i-cog" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3M5 5l2 2M17 17l2 2M19 5l-2 2M7 17l-2 2"/></symbol>
    <symbol id="i-sparkle" viewBox="0 0 24 24"><path d="M12 3l1.8 5.2L19 10l-5.2 1.8L12 17l-1.8-5.2L5 10l5.2-1.8z"/></symbol>
</svg>

@php
    $home = $homeUrl ?? '/';
    $repoUrl = 'https://github.com/Magna-CMS/Magna/';
    $brandParts = preg_split('/\s+/', trim($siteName)) ?: [$siteName];
    $brandSuffix = count($brandParts) > 1 ? array_pop($brandParts) : '';
    $brandName = implode(' ', $brandParts) !== '' ? implode(' ', $brandParts) : 'Magna';
@endphp

@unless($builderMode ?? false)
    <a class="skip-link" href="#main">Skip to content</a>
    <div class="scroll-progress" data-progress></div>
@endunless

@if(!empty($headerPartHtml))
    {{-- The part draws the header; the chrome that opens the drawer stays
         here, so it survives whatever an editor builds. --}}
    <header data-header>
        {!! $headerPartHtml !!}
        @unless($builderMode ?? false)
            <button class="hamburger" type="button" aria-label="Menu" aria-expanded="false" data-burger><span></span><span></span><span></span></button>
        @endunless
    </header>
@else
    <header data-header class="magna-chrome--header">
        <div class="magna-section__inner" style="display:flex;align-items:center;justify-content:space-between;position:relative;">
            <a href="{{ $home }}" class="magna-logo__link logo">
                <svg class="logo-mark" aria-hidden="true" focusable="false"><use href="#magna-mark"/></svg>
                <span>{{ strtolower($brandName) }}@if($brandSuffix !== '')<span class="cms">{{ $brandSuffix }}</span>@endif</span>
            </a>
            @if(!empty($headerMenu))
                <nav class="magna-nav">
                    <ul class="magna-nav__list">
                        @foreach($headerMenu as $item)
                            <li class="magna-nav__item"><a href="{{ \Magna\Blocks\Support\SafeUrl::sanitize($item['url'] ?? null) }}"
                                @if(!empty($item['target'])) target="{{ $item['target'] }}" rel="noopener noreferrer" @endif>{{ $item['label'] }}</a></li>
                        @endforeach
                    </ul>
                </nav>
            @endif
            <a href="{{ $repoUrl }}" target="_blank" rel="noopener noreferrer" class="magna-btn magna-btn--primary magna-btn--sm">View on GitHub</a>
            @unless($builderMode ?? false)
                <button class="hamburger" type="button" aria-label="Menu" aria-expanded="false" data-burger><span></span><span></span><span></span></button>
            @endunless
        </div>
    </header>
@endif

@unless($builderMode ?? false)
    <div class="mobile-menu" data-menu aria-hidden="true">
        <div class="mm-top">
            <a href="{{ $home }}" class="logo">
                <svg class="logo-mark" aria-hidden="true" focusable="false"><use href="#magna-mark"/></svg>
                <span>{{ strtolower($brandName) }}@if($brandSuffix !== '')<span class="cms">{{ $brandSuffix }}</span>@endif</span>
            </a>
            <button class="mm-close" type="button" aria-label="Close menu" data-menu-close>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><use href="#i-close"/></svg>
            </button>
        </div>
        <nav class="mm-links" aria-label="Mobile" data-menu-links></nav>
        <div class="mm-foot">
            <a href="{{ $repoUrl }}" target="_blank" rel="noopener noreferrer" class="magna-btn magna-btn--primary">View on GitHub</a>
            <div class="mm-note">Open source · MIT licence</div>
        </div>
    </div>
@endunless

<main id="main">
    @if(!empty($mainHtml))
        {!! $mainHtml !!}
    @else
        @include('magna-pages::partials.sections')
    @endif
</main>

@if(!empty($popupsHtml))
    {!! $popupsHtml !!}
@endif

@if(!empty($footerPartHtml))
    <footer class="magna-chrome--footer">{!! $footerPartHtml !!}</footer>
@else
    <footer class="magna-chrome--footer">
        <div class="footer-fallback">
            <span>&copy; {{ now()->year }} {{ $siteName }}. Open source, released under the MIT licence.</span>
        </div>
    </footer>
@endif

@unless($builderMode ?? false)
    <button class="to-top" type="button" aria-label="Back to top" data-to-top>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><use href="#i-arrow-up"/></svg>
    </button>

@verbatim
    <script>
        (function () {
            var root = document.documentElement;
            root.classList.add('js');

            var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            function ready(fn) {
                if (document.readyState !== 'loading') { fn(); } else { document.addEventListener('DOMContentLoaded', fn); }
            }

            ready(function () {
                var header = document.querySelector('[data-header]');
                var progress = document.querySelector('[data-progress]');
                var toTop = document.querySelector('[data-to-top]');
                var ticking = false;

                function frame() {
                    var y = window.pageYOffset || root.scrollTop;
                    if (header) { header.classList.toggle('scrolled', y > 40); }
                    if (toTop) { toTop.classList.toggle('show', y > 600); }
                    if (progress) {
                        var max = root.scrollHeight - window.innerHeight;
                        progress.style.width = (max > 0 ? (y / max) * 100 : 0) + '%';
                    }
                    ticking = false;
                }
                window.addEventListener('scroll', function () {
                    if (!ticking) { ticking = true; window.requestAnimationFrame(frame); }
                }, { passive: true });
                frame();

                if (toTop) {
                    toTop.addEventListener('click', function () {
                        window.scrollTo({ top: 0, behavior: reduced ? 'auto' : 'smooth' });
                    });
                }

                /* The drawer fills from the header part's hidden `drawer-menu`
                   section when there is one, and from the visible header nav
                   when there is not. A one-level group becomes <details>, the
                   same native accordion the FAQ uses. */
                var burger = document.querySelector('[data-burger]');
                var menu = document.querySelector('[data-menu]');
                var links = document.querySelector('[data-menu-links]');
                if (burger && menu) {
                    if (links && !links.children.length) {
                        var source = document.querySelector('[data-header] .drawer-menu nav')
                            || document.querySelector('[data-header] nav');
                        if (source) {
                            var top = source.querySelector('ul');
                            var rows = top ? top.children : [];
                            Array.prototype.forEach.call(rows, function (row) {
                                var a = row.querySelector('a');
                                if (!a) { return; }
                                var nested = row.querySelector('ul');

                                if (!nested) {
                                    var copy = document.createElement('a');
                                    copy.href = a.getAttribute('href') || '/';
                                    copy.textContent = a.textContent.trim();
                                    links.appendChild(copy);
                                    return;
                                }

                                var group = document.createElement('details');
                                group.className = 'mm-group';
                                var head = document.createElement('summary');
                                head.textContent = a.textContent.trim();
                                group.appendChild(head);

                                nested.querySelectorAll('a').forEach(function (child) {
                                    var link = document.createElement('a');
                                    link.href = child.getAttribute('href') || '/';
                                    link.textContent = child.textContent.trim();
                                    group.appendChild(link);
                                });

                                links.appendChild(group);
                            });
                        }
                    }
                    var setMenu = function (open, moveFocus) {
                        burger.classList.toggle('open', open);
                        menu.classList.toggle('open', open);
                        burger.setAttribute('aria-expanded', open ? 'true' : 'false');
                        menu.setAttribute('aria-hidden', open ? 'false' : 'true');
                        document.body.style.overflow = open ? 'hidden' : '';
                        if (!moveFocus) { return; }
                        if (open) {
                            var first = menu.querySelector('a, button');
                            if (first) { first.focus(); }
                        } else { burger.focus(); }
                    };
                    burger.addEventListener('click', function () { setMenu(!menu.classList.contains('open'), true); });
                    var close = menu.querySelector('[data-menu-close]');
                    if (close) { close.addEventListener('click', function () { setMenu(false, true); }); }
                    menu.querySelectorAll('a').forEach(function (a) {
                        a.addEventListener('click', function () { setMenu(false, false); });
                    });
                    document.addEventListener('keydown', function (e) {
                        if (e.key === 'Escape' && menu.classList.contains('open')) { setMenu(false, true); }
                    });
                }

                /* Mark the current page in whatever navigation is on screen. */
                var here = window.location.pathname.replace(/\/$/, '');
                document.querySelectorAll('[data-header] a, .mm-links a, .magna-chrome--footer a').forEach(function (a) {
                    var href = (a.getAttribute('href') || '').replace(/\/$/, '');
                    if (href && href === here) { a.setAttribute('aria-current', 'page'); }
                });

                /* Hover prefetch for in-site links. */
                var prefetched = {};
                var prefetch = function (href) {
                    if (!href || prefetched[href]) { return; }
                    prefetched[href] = true;
                    var l = document.createElement('link');
                    l.rel = 'prefetch'; l.href = href; l.as = 'document';
                    document.head.appendChild(l);
                };
                document.querySelectorAll('a[href^="/"]').forEach(function (a) {
                    var on = function () { prefetch(a.getAttribute('href')); };
                    a.addEventListener('mouseenter', on, { once: true });
                    a.addEventListener('touchstart', on, { once: true, passive: true });
                });

                /* Bands arrive rather than snapping in. The hidden state is
                   gated behind html.js, so with JS off every band is visible. */
                var bands = document.querySelectorAll('main .magna-section');
                if (reduced || !('IntersectionObserver' in window)) {
                    bands.forEach(function (b) { b.classList.add('in'); });
                } else {
                    var io = new IntersectionObserver(function (entries) {
                        entries.forEach(function (entry) {
                            if (entry.isIntersecting) { entry.target.classList.add('in'); io.unobserve(entry.target); }
                        });
                    }, { threshold: 0.08 });
                    bands.forEach(function (b) { io.observe(b); });
                }
            });
        }());
    </script>
@endverbatim
@endunless

</body>
</html>
