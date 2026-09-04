# Agency Website — Laravel Rebuild
Reference inspiration: tapline.studio (and cieden.com / designjoy.co / momentumdesignlab.com per SRS doc)
Content source: Design-and-Development-Agency-Website SRS/FSD PDF + [PPT — pending upload]

> **How to use this file:** This is the single source of truth for scope + status. Update the checkboxes and the "Log" section at the bottom every session (yourself or Claude Code). Don't delete finished items — check them off, so the history stays visible.

---

## 1. Reference Site Analysis (tapline.studio — confirmed from live fetch)

Tapline Studio is built on **Webflow**. Real nav is only 5 pages: Home, About Us, Services, Portfolio, Contact Us (no team/pricing/blog pages on their site — our SRS's 8-page scope is our own choice and stays as-is; only the visual/motion language is being borrowed).

### Confirmed page structure

**Home**, in order:
1. Nav: logo, Home/About/Services/Portfolio/Contact links (each with a "White Arrow" hover icon), "Get In Touch" button, phone number
2. Hero: oversized wordmark ("TAPLINE") repeated as a background ticker/marquee behind the headline, orange radial glow background effect, headline "Designing the Smartest Route to Growth", subhead, two CTAs (solid "Start Your Journey" + text-link "See What We Deliver"), an autoplaying background **video** with a pause control, and small floating case-study thumbnail images layered near it
3. Client logo strip — an infinitely looping marquee (logos repeated ~4x in the markup to fake seamless looping)
4. "The Perfect Solutions" — small rating badge ("4.5 Client review") + problem/agitation copy + 3 benefit cards (Brand Clarity / Growth Momentum / Measurable Results), each with an icon
5. Services grid — 6 link-cards (Product Design, Website Design, Application Design, Branding & Identity, Printable Media, Digital Media), each listing 3–5 sub-services and an arrow icon that swaps color on hover
6. "Our Growth Framework" — a 3-step process (Tap – Spark Attention / Stay – Build Trust / Convert – Drive Growth), icon + short copy per step
7. "Why Choose Us" — collage of 3 stacked images + descriptive bullets + a stats strip (350+ Projects Delivered, 02x Higher Conversion Rate, 98% Client Satisfaction) over a dotted background texture
8. Portfolio teaser — row of case-study cards, each tagged by category (SaaS Application, Media House, Social Application, Sustainable Lifestyle), linking to `/portfolio-details/{slug}`
9. Testimonials — looped/tripled marquee or carousel of client quotes with name + title + client logo
10. Footer CTA — mini repeat of the hero (heading + subtext + single CTA button linking straight to an **external Calendly URL**, not an embed), with a marquee strip of service tags above it
11. Footer nav: logo, condensed nav links, phone/email, copyright

**About**, in order:
1. Hero: "About Us" eyebrow, headline "We Are The Strategists Behind Design That Delivers.", 3 decorative frame graphics, star-rating badge ("50+ Reviews (4.9 of 5)"), large hero image
2. Client logo marquee (same component as Home)
3. "We Are The Navigators of Brand Journeys" — narrative + 2 highlighted trait callouts (Strategic by Nature / Driven by Results), two CTAs (Explore Services / Contact Us)
4. "Why Brands Choose Tapline" — 4-card grid (Strategic Problem-Solvers, Conversion-Driven Creators, Tech Forward Designers, High-Performance Innovators), each card on its own background image
5. "We Deliver Results That Speak for Themselves" — same 3-stat block as Home (Projects Delivered, Higher Conversion Rate, Client Satisfaction Score) + a "Let's Talk" CTA + a Trustpilot badge
6. Footer CTA (same component as Home)
7. **FAQ accordion** — 8 questions (pricing, differentiation, onboarding, ongoing support, what's needed to start, international clients, typical timeline, self-editing after launch), single-open accordion with a rotating arrow icon
8. Footer (same as Home)

**Services**, in order:
1. Hero: "Our Services" eyebrow, headline "Design Services Engineered for Growth", subhead, single CTA ("Get Started" → Calendly link), hero image, 3 small floating icon badges
2. Service tag marquee (looped)
3. 6 detailed service cards (Product Design, Branding & Identity, Website Design, Printable Media Design, Application Design, Digital Media Design) — each with a one-sentence description and a "Request This Service" link (→ Contact page, not a per-service detail page)
4. Service tag marquee again (repeated as a section divider)
5. "Our Process" — a **6-step** process (Diagnose the Issue → Consult & Listen → Design the Solution Set → Test & Refine → Measure & Deliver Impact → Build Lasting Partnership), numbered, icon per step — this is a more detailed version of Home's simplified 3-step "Tap/Stay/Convert" framework
6. "Our Core Promise & Purpose" — 3 checkmark bullets + the same 3-stat block (odometer-style, see below) + CTA
7. Service tag marquee again
8. Portfolio teaser (same 6-project row as Home, "View All Projects" → `/portfolio`)
9. Testimonials (same looped strip as Home)
10. Footer CTA + footer

**Portfolio (index)**, in order:
1. Hero: "Our Portfolio" eyebrow, headline "Unleashing the Power of Collaborative Creativity", subhead, small decorative graphic
2. Category filter pills (Application Design, Branding & Identity, Product Design, Product Development, Website Design, Printable Media Design) — styled as a marquee-looped strip; likely doubles as an actual clickable filter, worth confirming visually before committing to filter-vs-decoration
3. Full project grid — 12 case studies listed (Bureau Of Reclamation, Stori Group, Neon Forge, Green Threads, Qrder, Flexhaul, BrewNest, Sarah.AI, ChordHR, Task Sync, Dent Makers, MIST Gallery), each card showing the project name + its service tags + a hover arrow icon (white→grey swap), linking to `/portfolio-details/{slug}`
4. Same tag marquee repeated below the grid
5. Footer (no footer CTA block on this page in the fetched markup)

**Contact**, in order:
1. Hero: "We Are A Tap Away" eyebrow, two-line headline ("Have an idea? let's work together"), subhead, 3 decorative frame graphics, star-rating badge (50+ Reviews, 4.9/5)
2. **Real contact form** ("Send a message") with success/error state messaging — confirms the form-based approach (not just a link-out) for the primary contact path
3. A separate "Prefer Talking It Through?" panel — "Talk to an Expert" button linking to the external Calendly URL, positioned as an alternative to the form, not a replacement for it
4. 3 supporting info blocks: Dedicated Support (phone), Simple & Transparent Billing (email), Join Our Team (careers — "Submit Your Resume" mailto link)
5. Tag marquee + footer

**Case study detail template** (confirmed from a live project page), in order:
1. Hero image
2. "About the Project" — narrative paragraph
3. Meta row: Project Name / Category / Tools (icon row: Figma, Photoshop, Illustrator, etc.) / Service tags
4. "Challenges We Faced" — numbered list
5. Supporting screenshot
6. "Problems & Their Solutions" — numbered pairs (problem stated, then solution stated)
7. More supporting screenshots / a "Color Distribution" visual section
8. "Outcome & Results" — narrative paragraph with concrete numbers (e.g. "completed in 2 weeks, 9 screens, 15+ reusable components")
9. Client testimonial quote (name + title)
10. Same footer CTA as home page

### Motion & interaction — confirmed + inferred
Confirmed from markup, appearing consistently across all 5 pages: heavy, repeated use of **marquee/ticker strips** — this is the site's single most distinctive device (hero wordmark, client logos, testimonials, service-tag strips used as section dividers on Services/Portfolio, footer service-tags). Also confirmed: the stat counters (350+/02x/98% on Home; a differently-scoped 3-stat block on About and Services) render as **odometer/slot-machine-style rolling digit reels** (a scrambled sequence of digits settling on the final number), not a simple count-up — this is a more distinctive effect worth actually replicating rather than defaulting to a plain count-up animation. Beyond marquees and odometer counters, treat the rest of this list as reasonable inference for this tier of Webflow site, not confirmed by inspecting JS/CSS directly:
- **Marquee/ticker** (confirmed, build first): reusable component, infinite horizontal loop, pause-on-hover optional
- **Odometer-style stat counters** (confirmed pattern, build second): digits roll/scramble before settling on the final value when scrolled into view — appears with "+", "x", and "%" suffixes across Home/About/Services
- **Smooth scroll**: Lenis-style inertia scroll (typical for this tier of Webflow site)
- **Scroll-triggered fade/slide-up entrance** on section headings and cards (services grid, benefit cards, framework/process steps, FAQ items)
- **FAQ accordion** (About page): single-open accordion, rotating chevron icon
- **Hover states**: arrow icon color swap (white↔grey) on service/portfolio cards and nav links; subtle image scale/zoom on portfolio card hover
- **Video hero** (Home only): autoplay, muted, looping background video with a manual pause toggle
- **Background decorative effects**: radial gradient glow in hero, dotted texture behind stats section, small frame/graphic accents on About/Contact heroes — likely static SVG/CSS, not animated, but could have subtle parallax drift
- Custom cursor and magnetic buttons were **not confirmed** in the fetched markup — don't over-invest here; treat as optional polish, not a core requirement, unless you can confirm it visually
- No evidence of full-page route-transition wipes — this reinforces the earlier recommendation to skip that

### New scope items worth a deliberate decision (present on tapline.studio, not yet in the SRS)
- **Star-rating / review-count badge** (e.g. "50+ Reviews (4.9 of 5)") shown near hero copy on About/Contact — decide whether to use a real review count (Google/Trustpilot/Clutch) or omit until you have one; don't fabricate a number
- **FAQ accordion** on About page — a good addition for an agency site, not in the original SRS sitemap; recommend adding it to your About or a shared FAQ partial
- **"Join Our Team" / careers mailto** block on Contact — optional, only include if you actually want inbound applications going to a real inbox
- **Services page links to Contact per-service** ("Request This Service") rather than to individual service detail pages — simpler than the SRS's implied per-service depth; worth confirming which you want, since the SRS content (tools/best-for/use-cases per service) reads more like it wants full detail pages

### Responsiveness
- Breakpoints: `<640px` mobile, `640–1024px` tablet, `1024–1440px` desktop, `1440px+` large desktop
- Fluid type via `clamp()` rather than fixed breakpoint jumps
- Marquees are cheap and should stay active on mobile; scroll-triggered reveals should simplify to plain fades; hero background video should likely swap to a static poster image on mobile to protect load time and battery
- Hamburger menu with full-screen overlay on mobile (standard for this nav style)
- `prefers-reduced-motion: reduce` must pause marquees and disable scroll-triggered motion — treat as a hard requirement

---

## 2. Sitemap (from SRS doc — 8 pages)

| # | Page | Route | Notes |
|---|------|-------|-------|
| 1 | Home | `/` | Hero, trust bar, services overview, featured case studies, process, testimonials, CTA |
| 2 | About | `/about` | Story, mission/vision, culture, trust indicators |
| 3 | Team | `/team` | Member cards: photo, role, expertise, socials, bio |
| 4 | Services | `/services` + `/services/{slug}` | UI/UX, Web Dev, SaaS Product Dev, Mobile, CMS Dev — index + detail |
| 5 | Work / Portfolio | `/work` + `/work/{slug}` | Filterable grid + case study detail (Problem → Solution → Process → UI Screens → Results → Tech Stack) |
| 6 | Pricing | `/pricing` | Starter / Growth / Scale tiers + FAQ |
| 7 | Blog / Insights | `/blog` + `/blog/{slug}` | Category filter, share, related posts, newsletter box |
| 8 | Contact | `/contact` | Form + Calendly embed + direct contact info |

---

## 2.5 Confirmed decisions (locked)

- **Accent color: Electric Lime (`#D7FF3F`-ish)** on a near-black base (`#0B0B0C`) with warm off-white text (`#F5F5F0`). Chosen deliberately distinct from tapline.studio's orange glow. CTA buttons: lime fill + black text. Hero glow effect: soft lime radial glow (replaces tapline's orange). Exact hex values to be finalized as Tailwind tokens in Phase 1 — treat `#D7FF3F` as a starting point, not final, until it's checked against contrast ratios (WCAG AA) for text-on-lime and lime-on-black use cases.
- **Local database: SQLite** (Laravel 11's own default). Chosen for zero-config speed; the user noted the site's requirements may still change, so we're keeping infra swap-cost low — Eloquent abstracts the engine, so moving to XAMPP's MySQL (or a managed MySQL/Postgres host) later is a `.env` change plus re-running migrations, not a code change. Revisit before production deploy (Phase 8).
- **Runtime PHP: a dedicated PHP 8.3.33 install at `C:\php\8.3\php.exe`**, not XAMPP's bundled PHP. **Judgment call / flag for review — this took several iterations, documented here so it isn't re-litigated:**
  - XAMPP ships PHP 8.1.6, but Laravel 11 requires PHP ^8.2, and XAMPP's PHP also lacks the `gd` extension Spatie Media Library needs.
  - The machine's Herd Lite install (`C:\Users\User\.config\herd-lite\bin\php.exe`) has PHP 8.4 but is a bare static binary with no loadable extensions (no `ext` folder at all) — missing `ext-intl`, which `filament/support` requires. Not usable for this project.
  - Downloaded an official PHP 8.4.25 Windows build (full `ext` folder, `intl`/`gd`/`exif` all present) — but it fails to even boot on this machine: `VCRUNTIME140.dll 14.28 is not compatible, build linked with 14.44` (needs a newer VC++ 2022 redistributable than what's installed, which requires an elevated system-wide installer run — deliberately not done without asking first, since it changes shared OS state).
  - Fell back to an official **PHP 8.3.33** Windows build instead (VC++ 2019-linked, matches what's already on the system), extracted to `C:\php\8.3`, with `php.ini` built from `php.ini-production` and `curl/fileinfo/gd/intl/mbstring/openssl/pdo_mysql/pdo_sqlite/sqlite3/zip/exif` enabled.
  - Even on 8.3, `composer require filament/filament spatie/laravel-medialibrary` initially failed: the freshly-scaffolded Laravel 11.31+ project's lock file had already resolved several Symfony components to their **v8.0.x** line (current as of this environment's package index), which requires PHP ≥8.4 — a problem baked into the base scaffold, not caused by Filament/Spatie. Fixed by adding explicit root `require` pins in `composer.json` forcing `symfony/console`, `css-selector`, `error-handler`, `finder`, `http-foundation`, `http-kernel`, `mailer`, `mime`, `process`, `routing`, `string`, `translation`, `uid`, `var-dumper` to `^7.0`, then `composer update` before installing Filament/Spatie. **Revisit this pin set if a future `composer update` reintroduces a similar PHP-8.4-only transitive dependency**, and reconsider moving to real PHP 8.4 (fixing the VC++ redistributable properly, with the user's OK) once that's convenient — pinning to Symfony 7 is a workaround, not a permanent stance.
  - **All `artisan`/`composer` commands for this project must use `C:\php\8.3\php.exe`** (composer.phar lives at `C:\Users\User\.config\herd-lite\bin\composer.phar`, which works fine with any PHP version — it's just the Herd-bundled *PHP binary* that's unusable, not its composer.phar). Example: `C:\php\8.3\php.exe C:\Users\User\.config\herd-lite\bin\composer.phar require ...` / `C:\php\8.3\php.exe artisan migrate`.
  - For local serving, use `php artisan serve` (with the 8.3 binary above) rather than XAMPP's Apache. If Apache-via-XAMPP is wanted later, it needs a vhost pointed at `studio/public` (not `studio/` directly, which would expose the whole app source) with its PHP handler swapped to this same PHP 8.3 build.

## 2.6 Tooling decisions (2026-09-05)

- **No additional tools installed speculatively.** Considered now vs. later: Mailpit (SMTP catcher, for Phase 5 contact-form email QA), Lighthouse CLI (Phase 6 performance audits), Larastan/PHPStan (static analysis). User's call: add each only when its phase actually needs it, not before. Revisit Mailpit specifically at the start of Phase 5, Lighthouse at the start of Phase 6.
- **Images/placeholders**: no real photos, team headshots, client logos, or case-study screenshots exist yet. Phase 2+ will use neutral placeholders (gradient/pattern blocks or simple placeholder boxes, not fake stock photos pretending to be real clients/team) so layouts are provably correct, swapped for real assets the moment they're provided — not held up waiting on them.
- **Note for future sessions**: Blade Icons + Heroicons (`blade-ui-kit/blade-icons`, `blade-ui-kit/blade-heroicons`) are already installed as a Filament dependency — use `<x-heroicon-o-{name} />` / `<x-heroicon-s-{name} />` components for icons (arrows, checkmarks, social links, etc.) going forward instead of hand-writing inline SVGs like Phase 1's nav did.

---

## 3. Tech Stack

| Layer | Choice | Why |
|---|---|---|
| Framework | Laravel 11 | Latest LTS-track, clean routing/Eloquent |
| Frontend | Blade + Alpine.js | Alpine for lightweight interactivity (menus, filters, form states) without a full SPA rebuild |
| Styling | Tailwind CSS | Fast to hit the dense, precise spacing this design language needs |
| Animation | GSAP (+ ScrollTrigger) | Industry standard for this exact style of scroll-driven motion; free core license covers everything needed here |
| Smooth scroll | Lenis | Pairs cleanly with GSAP ScrollTrigger |
| Admin/CMS | Filament (Laravel package) | Gives you a working admin panel for case studies, blog posts, team, pricing, testimonials without hand-building CRUD — directly serves the SRS's "CMS Development" and content-editing needs |
| Forms | Laravel Mail + honeypot + rate limiting (skip a paid captcha unless spam becomes a real problem) | Matches "spam protection" requirement in SRS |
| Media | Spatie Media Library | Responsive image conversions, keeps Filament uploads clean |
| Build | Vite | Laravel default, fast HMR |
| Booking | Calendly embed (inline widget or popup) | Matches SRS requirement |

**Note on page transitions:** true SPA-style full-screen wipe transitions are easiest in an SPA (Inertia/Vue/React). In a classic Blade multi-page app you have two realistic options:
- (a) skip full transitions, rely on in-page scroll/entrance animations only (simplest, still looks premium)
- (b) fake it with a lightweight overlay + `pagehide`/`fetch`-based partial navigation (more work, some fragility)
Recommendation: start with (a). Revisit (b) only if it's a must-have after the core site is live.

---

## 4. Data Model (draft)

- `case_studies` (title, slug, client, category, about, tools[], service_tags[], challenges[] (numbered list), problems_solutions[] (paired list: problem + solution), gallery[], outcome_results, testimonial_quote, testimonial_author, testimonial_title, cover_image, published_at) — field list confirmed against a live tapline.studio case study page (see §1)
- `services` (title, slug, description, tools_technologies[], best_for, use_cases[], icon, sort_order)
- `team_members` (name, role, bio, photo, socials{json}, sort_order)
- `testimonials` (quote, author_name, author_title, company, photo)
- `blog_categories` (name, slug)
- `blog_posts` (title, slug, excerpt, body, cover_image, category_id, author, reading_time, published_at)
- `pricing_plans` (name, tagline, price_range, timeline, deliverables[], best_for, sort_order)
- `contact_submissions` (name, email, company, project_type, budget_range, timeline, description, created_at)
- `newsletter_subscribers` (email, subscribed_at)

---

## 5. Build Phases & Progress

Update these checkboxes as work lands. `[ ]` not started · `[~]` in progress · `[x]` done.

### Phase 0 — Setup
- [x] Laravel 11 project scaffolded (11.31+, PHP ^8.2), Vite + Tailwind configured — scaffold already ships `tailwind.config.js` + `resources/css/app.css` with `@tailwind base/components/utilities`; verified `npm run build` compiles cleanly
- [x] Alpine.js, GSAP, Lenis installed via npm — Alpine wired + started in `resources/js/app.js` (baseline interactivity for Phase 1 nav/menu/accordion); GSAP + Lenis installed but intentionally left unwired until Phase 4 (animation layer), per build-order instructions
- [x] Filament installed, admin auth set up — Filament v3.3.55 panel scaffolded at `app/Providers/Filament/AdminPanelProvider.php`, registered in `bootstrap/providers.php`; local dev admin user created (login at `/admin/login`, credentials shared in session chat, not stored in this file — change the password after first login)
- [x] Base folder structure + `.env` / deployment config decided — standard Laravel 11 structure kept as-is; `.env` set to `APP_NAME=Studio` (placeholder brand name — replace once the PPT/real brand name arrives), `DB_CONNECTION=sqlite`; deployment hosting itself stays an open Phase 8 decision
- [ ] **Open decision, not yet made — needs your input:** no git repository has been initialized for this project yet (confirmed via `git status` → "not a git repository"). Recommend initializing one now (with a `.gitignore` already in place from the Laravel scaffold) so history exists from the start of real development — but per instructions this isn't done without being asked first

### Phase 1 — Design system
- [x] Typography scale (fluid clamp() headings/body) defined in Tailwind config — `display-xl/lg/md`, `heading-lg/md`, `body-lg/md/sm`, `eyebrow`, all clamp()-based except the two smallest sizes (`tailwind.config.js`)
- [x] Color tokens defined — `ink-950…600` (near-black surfaces), `paper`/`paper-dim` (warm off-white text), `muted`, `lime` (accent, `DEFAULT #D7FF3F` + 400/600/700 for hover/pressed states)
- [x] Base Blade components: `<x-container>`, `<x-button variant="primary|outline|ghost">`, `<x-section-heading eyebrow= align= subtext=>`, `<x-card>` — all in `resources/views/components/`
- [x] Nav + footer components (with mobile overlay menu) — `<x-nav>` (sticky, all 8 sitemap links, Alpine-driven full-screen mobile overlay with escape-to-close) and `<x-footer>`; both pull link list from `config/navigation.php` (single source, not duplicated). `<x-layout>` component wraps both around `{{ $slot }}` for every page.
- [x] Route skeleton for all 8 sitemap pages wired (`routes/web.php`), each rendering a stub view so `<x-nav>` has real destinations — `/` shows a temporary design-system preview (type scale, color swatches, button/card/section-heading samples) for review; the other 7 show a plain "Phase 2" placeholder. **All of this stub content gets replaced in Phase 2** — nothing here is final page content.

**Judgment calls made in Phase 1 — flagging for your review, none are final:**
- **Font: Inter** (Google Fonts, loaded via `<link>` in `<x-layout>`) — a neutral, widely-used premium sans-serif placeholder. Not tied to any brand identity yet since none exists; swap freely once you have a preferred typeface. Loaded via Google Fonts CDN link for now (fine for dev; Phase 6 performance pass should consider self-hosting/`font-display` tuning).
- **Exact lime hex (`#D7FF3F`) and its 400/600/700 shades** — picked as reasonable hover/pressed variants, not checked against WCAG AA contrast yet (especially lime text on the near-black background, and black text on lime buttons — the latter should be fine, the former needs a check before using lime for body copy at small sizes).
- **Button shape: fully rounded pill** (`rounded-full`) with three variants (solid lime / outlined / ghost text) — a common premium-studio pattern, not yet confirmed against any specific reference.
- **Nav shows all 8 sitemap links flatly** at `lg+` width in small uppercase tracked type, collapsing to a full-screen overlay below `lg`. Eight top-level links is a lot for a single row — worth a visual gut-check once real content is in; grouping (e.g. folding Team under About) is an easy change later if it feels crowded.
- **Easing name `ease-out-expo`** added as a Tailwind transition-timing-function token (cubic-bezier for a fast-start/slow-settle feel) for hover transitions now; this is the same easing family Phase 4's scroll-triggered animations should reuse for consistency, not a final specific timing value.
- ~~Could not visually verify in a browser~~ — **resolved 2026-09-05**: Playwright + Chromium installed for this purpose (see "Visual QA tooling" below). Actual screenshots now confirm the desktop preview, mobile closed state, and mobile menu open/close all render correctly.

### Visual QA tooling (added 2026-09-05)
No `chromium-cli` was available in this environment, so per the `run` skill's own documented fallback, Playwright was installed instead — deliberately **outside** this project's `package.json`/`node_modules`, since it's a QA tool for verifying the build, not a site dependency:
- Playwright installed globally (`npm install -g playwright`, v1.62.1) + Chromium browser binary (`npx playwright install chromium`, cached at `C:\Users\User\AppData\Local\ms-playwright\`).
- A persistent driver script lives at **`C:\tools\qa-browser\run.mjs`** (own local `npm install playwright` there for reliable ESM resolution) — a small chromium-cli-style REPL: pipe it newline-delimited commands (`nav`, `viewport`, `wait-for text=... `, `click`, `fill`, `press`, `sleep`, `screenshot [name] [--full]`, `console-errors`) via stdin, e.g. `node run.mjs <<'EOF' ... EOF`. Screenshots save to `C:\tools\qa-browser\screenshots\`.
- **Known gotcha already fixed once, documented in the script's header comment**: `wait-for text=...` polls for any *visible* match rather than trusting `.first()`, because this project's mobile-nav pattern (desktop nav + mobile overlay both rendering the same link text, one hidden via CSS at a time) means the DOM-first match is sometimes the hidden one. Also: `wait-for` doesn't wait out CSS transitions — add a `sleep` before `screenshot` for anything that fades/slides in, or the shot catches it mid-transition.
- To use this in a future session: boot the app (`C:\php\8.3\php.exe artisan serve --port=<port>`), then `cd C:\tools\qa-browser && node run.mjs <<'EOF' ... EOF`, then `Read` the resulting PNG(s) to actually look at them.

**Real bug this caught immediately**: the mobile nav overlay (`<x-nav>`) was nested inside the `<header>` element, which carries `backdrop-blur` (`backdrop-filter`). Per the CSS spec, a `filter`/`backdrop-filter` ancestor becomes the containing block for any `position: fixed` descendant — so the overlay's `fixed inset-0` was sizing itself against the ~80px-tall header box instead of the viewport. Its content still rendered (and overflowed visibly down the page via default `overflow: visible`), but with no opaque background behind most of it, so the actual page content bled through visibly behind the nav links. **Fixed** by moving `x-data` off `<header>` onto a plain wrapping `<div>` with no `backdrop-filter`, keeping `<header>` (with the blur) and the mobile overlay as siblings under it rather than parent/child. Confirmed fixed via screenshot: overlay is now fully opaque edge-to-edge. This is a good example of a class of bug (`backdrop-filter`/`filter`/`transform` ancestors silently breaking `position: fixed` descendants) worth staying alert to as more overlays/modals get built — check for it any time a `fixed`-positioned element lives inside a `backdrop-blur` or `transform`-using container.

### Phase 2 — Static/content pages
- [ ] Home
- [ ] About
- [ ] Team
- [ ] Services (index)
- [ ] Pricing
- [ ] Contact (form + Calendly embed)

### Phase 3 — Dynamic content + admin
- [ ] Migrations + models (section 4)
- [ ] Filament resources for all models
- [ ] Work/Portfolio index + detail templates
- [ ] Blog index + detail templates, category filter
- [ ] Seed sample content (until real content arrives)

### Phase 4 — Animation layer
- [ ] Reusable marquee/ticker component (build first — used repeatedly across every page: wordmark, logos, testimonials, service-tag dividers, footer tags) with pause-on-hover and `prefers-reduced-motion` handling
- [ ] Odometer-style rolling-digit stat counter component (build second — confirmed pattern on Home/About/Services; digits scramble/roll before settling, not a plain count-up), reusable with configurable suffix (+, x, %)
- [ ] Lenis smooth scroll wired globally
- [ ] Scroll-triggered fade/slide-up entrance for section headings and grid cards (services, benefit cards, framework/process steps, FAQ items)
- [ ] FAQ accordion component (single-open, rotating chevron) — needed for About page
- [ ] Hover states: arrow-icon color swap on cards/nav, image scale on portfolio hover
- [ ] Hero background video with pause toggle (desktop) / static poster fallback (mobile) — Home only
- [ ] Optional polish only, confirm visually before building: custom cursor, magnetic buttons — not confirmed present on the reference site, don't over-invest here

### Phase 5 — Forms & integrations
- [ ] Contact form (name, email, company, project type, budget range, timeline, description) → sends email notification to admin + stores submission in DB + honeypot + rate limiting for spam protection
- [ ] Calendly: simple CTA button linking out to a Calendly URL (matches tapline.studio's actual pattern — decided over embedding a widget; easy to swap to an embed later if wanted)
- [ ] Newsletter signup → stored + (optional) provider sync

### Phase 6 — SEO & performance
- [ ] Meta tags + Open Graph per page
- [ ] JSON-LD (Organization, Article for blog posts)
- [ ] `sitemap.xml`, `robots.txt`
- [ ] Image optimization / lazy loading via Spatie conversions
- [ ] Lighthouse pass — target 85+ (per SRS)

### Phase 7 — QA
- [ ] Responsive pass at 375 / 768 / 1024 / 1440
- [ ] Reduced-motion pass
- [ ] Cross-browser check (Chrome, Safari, Firefox)
- [ ] Form validation + spam protection test

### Phase 8 — Deployment
- [ ] Hosting decided (Forge/VPS/other)
- [ ] Queue worker for mail
- [ ] SSL, backups, monitoring

---

## 6. Content status
- [ ] SRS/FSD PDF content mapped into seeders/CMS — **not yet seeded** (Phase 3 work); the PDF's homepage copy, services, pricing tiers, and about copy is usable as-is or as a first draft once seeders are built
- [x] **Content source confirmed as final for now**: the "PPT" mentioned in the original brief and the `Design-and-Development-Agency-Website.pdf` (SRS/FSD doc) are the same deliverable — the user confirmed 2026-09-05 there is no separate PPT still to come. Treat the PDF's copy as the real content source for seeders (Phase 3), not placeholder text pending replacement. If the user provides updated copy later, treat that as a revision to seed data, not a new content source.

---

## 7. Log
Add a dated line each session.

- `2026-09-05` — Set up visual QA tooling: Playwright + Chromium (global install + `C:\tools\qa-browser\run.mjs` driver script, kept outside this project's own `package.json`) since no `chromium-cli` was available. First real test run immediately caught a genuine bug: the mobile nav overlay was nested inside `<header>`'s `backdrop-blur`, which per the CSS spec makes that header the containing block for the overlay's `position: fixed`, breaking full-viewport coverage and letting page content bleed through behind the open mobile menu. Fixed by moving `x-data` to a filter-free wrapper `<div>` so `<header>` and the overlay are siblings, not parent/child. Confirmed fixed via before/after screenshots. Full details in §Phase 1 "Visual QA tooling". Git auth also set up this session (Git Credential Manager, already bundled with Git for Windows, configured as the global credential helper) — pushed both Phase 0 and Phase 1 commits to `github.com/BilalChaudhry032/studiolara` successfully.

- `2026-09-04` — Plan created from SRS PDF + tapline.studio reference (initial version, no live browsing).
- `2026-09-04` — Fetched live tapline.studio homepage + a case study detail page. Confirmed real page structure, marquee-heavy motion pattern, case-study template, and Calendly link-out (not embed) pattern. Updated §1, §4, and Phase 4/5 checklists accordingly. Decided: contact form emails admin + stores submission (native Laravel Mail, no third-party service); Calendly is a link-out button, not an embed.
- `2026-09-04` — Fetched all remaining tapline.studio pages (About, Services, Portfolio index, Contact). Confirmed: stat counters are odometer/rolling-digit style, not plain count-up; About has an FAQ accordion; Services has a more detailed 6-step process distinct from Home's 3-step framework; Contact has both a real form AND a separate Calendly link-out, not one or the other; Portfolio index has 12 sample projects with category tag pills. Rewrote §1 with full per-page breakdown and flagged new scope items (review badge, FAQ, careers block, services page depth) for a decision.
- `2026-09-05` — **Phase 1 complete.** Built the Tailwind design tokens (fluid clamp() type scale, ink/paper/lime color palette) and base Blade components (`<x-container>`, `<x-button>`, `<x-section-heading>`, `<x-card>`, `<x-nav>` with Alpine-driven full-screen mobile overlay, `<x-footer>`, `<x-layout>`). Wired route stubs for all 8 sitemap pages so navigation is fully clickable; `/` currently shows a temporary design-system preview page for review, the other 7 show a plain placeholder — both are Phase 2's job to replace with real content. Verified via HTTP + rendered-markup checks (no browser automation available in this environment — flagged for the user to eyeball visually). User also clarified the "PPT" and the SRS/FSD PDF are the same document — no separate content deck is coming; updated §6 accordingly. User confirmed git target repo (`github.com/BilalChaudhry032/studiolara`); initialized git, made the Phase 0 commit locally, but push failed (no GitHub credentials in this sandboxed environment) — user needs to run `git push -u origin main` themselves.
- `2026-09-04/05` — **Phase 0 complete.** User confirmed accent color (Electric Lime, `#D7FF3F`-ish, on near-black) and local DB (SQLite). Scaffolded Laravel 11.31+ into this directory (previously only held this plan file). Hit and resolved a chain of toolchain issues on this Windows machine: XAMPP's PHP 8.1.6 too old for Laravel 11 → Herd Lite's PHP 8.4 has no extension support at all (missing `ext-intl`) → official PHP 8.4 Windows build won't boot here (`VCRUNTIME140.dll` too old, needs a system VC++ redistributable update not done without asking) → landed on a manually-configured official PHP 8.3.33 build at `C:\php\8.3` with all needed extensions enabled → the fresh Laravel scaffold's own lock file had already drifted to Symfony 8.x components requiring PHP 8.4, fixed by pinning root `composer.json` requires to Symfony `^7.0` across the affected packages. Full details in §2.5. Installed Filament v3.3.55 (admin panel scaffolded + registered, local dev admin user created) and Spatie Media Library v11.23.7 (migration published + run). Installed Alpine.js/GSAP/Lenis via npm; wired Alpine into `resources/js/app.js` (GSAP/Lenis intentionally left unwired until Phase 4). Verified `npm run build` compiles and both `/` and `/admin/login` return 200 via `php artisan serve`. Open item flagged for the user: no git repo initialized yet — recommend doing so before real development starts, but not done unilaterally.
