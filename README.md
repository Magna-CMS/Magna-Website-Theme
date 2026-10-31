# Magna Website Theme

The official [Magna CMS](https://github.com/Magna-CMS/Magna) website — its static HTML pages and the content strategy behind them.

**Status:** static prototype. The pages here are being ported to an open-source Magna CMS theme built on [Magna Pages](https://github.com/Magna-CMS/Magna-Pages). Until then, the HTML is the design reference and the Markdown files are the source copy.

## Preview

Open `index.html` in a browser. Every page is self-contained (inline CSS, Google Fonts), so no build step is needed.

## Site kit

`build/convert.py` turns the HTML pages into a Magna site-kit bundle (real Magna Pages block documents, menus and settings) that a Magna install can import:

```bash
pip install beautifulsoup4
python build/convert.py magna-website.json
```

## Files

### Pages

| File | Page |
|---|---|
| `index.html` / `home.html` | Home |
| `why-magna.html` | Why Magna |
| `features.html` | Features |
| `page-builder.html` | Page Builder |
| `developers.html` | Developers |
| `agencies.html` | Agencies |
| `use-cases.html` | Use Cases |
| `plugins.html` | Plugins & Extensions |
| `about.html` | About |
| `compare.html` | Comparison |

### Content strategy

| File | Contents |
|---|---|
| `01-brand-messaging.md` | Messaging system: positioning, taglines, pitches, pillars, voice |
| `02-sitemap.md` | Information architecture, navigation, page roles |
| `03-home.md` | Home page copy |
| `04-why-magna.md` | Why Magna page copy |
| `05-features.md` | Features page copy (with status badges) |
| `06-page-builder.md` | Page Builder product page copy |
| `07-developers.md` | Developers page copy |
| `08-agencies.md` | Agencies page copy |
| `09-use-cases.md` | Use Cases page copy |
| `10-plugins-extensions.md` | Plugins & Extensions page copy |
| `11-about.md` | About page copy |
| `12-comparison.md` | Comparison page copy |
| `13-seo-metadata.md` | SEO title, description, slug, theme per page |
| `14-cta-strategy.md` | CTA inventory, usage rules, per-page CTA map |

## Before launch

1. Verify every **Available / In development / Planned** status badge in `05-features.md` and `10-plugins-extensions.md` against the real product. Downgrade anything unconfirmed.
2. Keep the voice rules in `01-brand-messaging.md` — especially the WordPress-respect rule and the "modern" ration — when writing any new copy.
3. British English throughout.
