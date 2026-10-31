"""Static checks on the generated site kit.

Everything here mirrors a rule the renderer or the sync enforces, so a kit
that passes converts cleanly on a real install:

  - the envelope is magna-site-kit v1 with schemaVersion 1.0 documents;
  - column spans are integers that sum to 12 in every section;
  - node ids are unique across each document and carry the kiz- prefix;
  - block nesting stays within the renderer's depth limit;
  - every block handle is one the site actually has (core + Pages), so the
    kit never depends on a plugin that is not installed;
  - every section cssClass token is in the theme's styled vocabulary;
  - every internal link resolves to a kit page or a page anchor.

Usage: python kitcheck.py [path/to/kit.json]
"""

from __future__ import annotations

import json
import re
import sys
from pathlib import Path

KIT = Path(sys.argv[1]) if len(sys.argv) > 1 else Path(__file__).resolve().parent.parent / "magna-website.json"

# Core blocks plus the Pages plugin's own. No forms, no blog: the site
# must render with nothing but core and magna-cms/pages installed.
HANDLES = {
    "heading", "text", "container", "features", "button", "table",
    "quote", "callout", "faq", "code", "nav", "logo",
}

# The section classes the theme's stylesheet knows. A token outside this
# list would render unstyled, which is how design drift starts.
VOCABULARY = {
    # bands
    "hero", "short", "trust", "marquee", "problem", "why", "arch",
    "headless", "cases", "plugins", "builder", "audiences", "faq", "cta",
    # rows the converter carries over from the source grids
    "split", "hero-grid", "problem-grid", "arch-grid", "headless-grid",
    "builder-grid",
    # modifiers
    "center", "grid-2", "prose", "feat-rows", "aud-grid", "cmp-wrap",
    "cases-foot", "head-continue", "tail-continue",
    # chrome parts
    "header-main", "drawer-menu", "footer-main", "footer-bottom",
}

MAX_DEPTH = 6

errors: list[str] = []


def fail(msg: str) -> None:
    errors.append(msg)


def walk_blocks(blocks, doc: str, ids: set[str], depth: int) -> None:
    if depth > MAX_DEPTH:
        fail(f"{doc}: block nesting deeper than {MAX_DEPTH}")
        return
    for node in blocks:
        bid = node.get("id", "")
        if bid in ids:
            fail(f"{doc}: duplicate node id {bid}")
        ids.add(bid)
        if not bid.startswith("kiz-"):
            fail(f"{doc}: node id {bid!r} is not deterministic (kiz- prefix)")
        handle = node.get("block")
        if handle not in HANDLES:
            fail(f"{doc}: block handle {handle!r} is outside the core+pages set")
        for child in node.get("children", []) or []:
            pass
        if node.get("children"):
            walk_blocks(node["children"], doc, ids, depth + 1)


def check_document(doc: str, blocks_data: dict, slugs: set[str]) -> None:
    if blocks_data.get("schemaVersion") != "1.0":
        fail(f"{doc}: schemaVersion is {blocks_data.get('schemaVersion')!r}, not '1.0'")
    ids: set[str] = set()
    for section in blocks_data.get("sections", []):
        sid = section.get("id", "")
        if sid in ids:
            fail(f"{doc}: duplicate node id {sid}")
        ids.add(sid)
        css = section.get("settings", {}).get("cssClass", "")
        for token in css.split():
            if token not in VOCABULARY:
                fail(f"{doc}: cssClass token {token!r} is outside the theme vocabulary")
        spans = [col.get("span") for col in section.get("columns", [])]
        if any(not isinstance(s, int) for s in spans):
            fail(f"{doc}: non-integer span in section {sid}")
        elif sum(spans) != 12:
            fail(f"{doc}: spans {spans} sum to {sum(spans)}, not 12, in section {sid}")
        for col in section.get("columns", []):
            cid = col.get("id", "")
            if cid in ids:
                fail(f"{doc}: duplicate node id {cid}")
            ids.add(cid)
            walk_blocks(col.get("blocks", []), doc, ids, 1)


def internal_links(obj) -> list[str]:
    found: list[str] = []
    if isinstance(obj, dict):
        for key, value in obj.items():
            if key in ("url", "body") and isinstance(value, str):
                if key == "url":
                    found.append(value)
                else:
                    found.extend(re.findall(r'href="([^"]+)"', value))
            else:
                found.extend(internal_links(value))
    elif isinstance(obj, list):
        for value in obj:
            found.extend(internal_links(value))
    return found


def main() -> None:
    kit = json.loads(KIT.read_text(encoding="utf-8"))

    if kit.get("format") != "magna-site-kit" or kit.get("version") != 1:
        fail(f"envelope is {kit.get('format')!r} v{kit.get('version')!r}")

    slugs = {page["slug"] for page in kit.get("pages", [])}
    for page in kit.get("pages", []):
        check_document(f"page:{page['slug']}", page.get("blocks_data", {}), slugs)
        if page.get("status") != "published":
            fail(f"page:{page['slug']} is not published")
    for template in kit.get("templates", []):
        check_document(f"template:{template['slug']}", template.get("blocks_data", {}), slugs)
        if template.get("kind") != "part":
            fail(f"template:{template['slug']} kind is {template.get('kind')!r}")

    for handle_block in (kit.get("menus") or []):
        if not handle_block.get("handle"):
            fail("menu without a handle")

    for link in internal_links(kit):
        if not link.startswith("/"):
            continue
        target = link.split("#", 1)[0].strip("/")
        if target == "":
            continue
        if target not in slugs:
            fail(f"internal link {link!r} resolves to no kit page")

    settings = kit.get("settings", {})
    for key in ("maintenance_mode", "collection_mounts"):
        if key in settings:
            fail(f"settings carries {key!r}; a sync must not touch it")
    for key in ("home_page_slug", "not_found_page_slug"):
        if settings.get(key) not in slugs:
            fail(f"settings.{key} = {settings.get(key)!r} is not a kit page")

    if errors:
        print(f"kitcheck: {len(errors)} problem(s) in {KIT.name}")
        for line in errors:
            print(f"  ✗ {line}")
        sys.exit(1)
    pages = len(kit.get("pages", []))
    sections = sum(len(p["blocks_data"]["sections"]) for p in kit.get("pages", []))
    print(f"kitcheck: OK — {pages} pages, {sections} sections, {len(kit.get('menus', []))} menus.")


if __name__ == "__main__":
    main()
