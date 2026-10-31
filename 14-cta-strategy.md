# Phase 7 — CTA Strategy

One consistent system across the site. Every page has exactly one primary CTA per screen; everything else is secondary.

---

## CTA Inventory

### Primary (conversion)

| CTA | Destination | Use |
|---|---|---|
| **Get Started** | `/get-started` | The master conversion action. Default primary CTA site-wide. |
| **Explore Magna CMS** | `/features` | Softer primary for early-funnel contexts (blog, campaigns) where "Get Started" is premature. |
| **Download Magna CMS** | `/get-started` (download section) | Only where download intent is explicit. Use sparingly; "Get Started" covers it. |

### Developer

| CTA | Destination | Use |
|---|---|---|
| **Read the Docs / Read the Documentation** | `/docs` | Primary on Developers page; secondary elsewhere for technical audiences. |
| **Explore the Architecture** | `/docs` (architecture) | Mid-page developer engagement; never the sole CTA on a page. |
| **Build a Plugin** | `/docs` (plugin guide) | Ecosystem and Developers pages; the deepest-commitment developer action. |

### Evaluation

| CTA | Destination | Use |
|---|---|---|
| **See How It Works** | `/page-builder` or product demo | Hero-level secondary for visual/product-curious visitors. |
| **Explore Features** | `/features` | The universal "not ready yet" secondary. |
| **Compare Magna CMS** | `/compare` | For visitors weighing alternatives; footer and evaluation contexts. |

---

## Usage Rules

1. **One primary per screen.** A hero never carries two buttons of equal weight — primary is filled, secondary is outline/text.
2. **Primary follows funnel stage, not page vanity.** Home/Features/Agencies/Compare → **Get Started**. Developers → **Read the Documentation**. Page Builder → **See How It Works** (hero) resolving to **Get Started** (close).
3. **Secondary always offers a lower-commitment step.** Pair "Get Started" with "See How It Works" or "Explore Features" — never with another high-commitment ask.
4. **Developer CTAs only where developers are.** No "Build a Plugin" on business-facing pages; no "Get Started" as the *only* option on the Developers page.
5. **Every page closes with a CTA section.** Full-width, one heading, one supporting line, primary + one secondary. No page dead-ends.
6. **Verb-first, three words where possible.** No "Learn more" — it's a destination-free verb. Use the named destination instead ("Explore Features", "Compare Magna CMS").
7. **Consistency beats novelty.** Reuse the inventory verbatim; do not coin page-specific CTA phrasings.

---

## Per-Page CTA Map

| Page | Hero primary | Hero secondary | Closing primary | Closing secondary |
|---|---|---|---|---|
| Home | Get Started | See How It Works | Get Started | View Documentation |
| Why Magna | — (editorial hero) | — | Explore Features | Read the Docs |
| Features | Get Started | Compare Magna CMS | Get Started | Compare Magna CMS |
| Page Builder | See How It Works | Get Started | Get Started | Explore Features |
| Developers | Read the Documentation | Explore the Architecture | Read the Documentation | Build a Plugin |
| Agencies | Get Started | Read the Documentation | Get Started | Explore the Architecture |
| Use Cases | — (editorial hero) | — | Explore Features | Read the Documentation |
| Plugins | Browse Extensions | Build a Plugin | Get Started | — |
| About | — (editorial hero) | — | Get Started | Why Magna → |
| Compare | — (editorial hero) | — | Get Started | Read the Documentation |
