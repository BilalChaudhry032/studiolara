# Studio redesign plan: "One Line"

Status: **plan approved in direction, not started.** Written 2026-09-24.
Product truth lives in [PRODUCT.md](PRODUCT.md). Build history for the old site stays in [PROJECT_PLAN_AND_PROGRESS.md](PROJECT_PLAN_AND_PROGRESS.md).

---

## 1. Why the current site isn't working

From the desktop (1440px) and mobile (390px) screenshots of all 8 pages taken on 2026-09-24:

- **It looks like a template.** Near-black background, one lime accent, a big centered headline, then the same bordered card grid over and over. Every section has the same rhythm, so nothing stands out and nothing is remembered.
- **Visitors see placeholders.** Every image slot is a grey box with text like "Client logo" or "Product showcase reel (no video file yet…)". The case studies are three empty boxes.
- **The motion is decoration, not meaning.** Every section has drifting blurred colour blobs and a scrolling dot texture, but nothing moves to explain anything. The stat counters show "0+" until they happen to trigger.
- **Mobile is desktop stacked into one column.** Services is about 9,900px tall on a phone and Home about 8,800px. Card grids turn into long single-file lists, the hero stat line wraps awkwardly, and the chip marquees are clipped.
- **There's no identity.** The brand rendered as "Laravel" (now fixed to "Studio" in `.env`), and nothing on the page belongs to this studio in particular.

## 2. The direction: One Line

**Thesis:** One team, one line, no transfers. The whole site is drawn as a transit system. The studio is a single line that takes a founder from idea to launch through five stations (Discover → Define → Design → Build → Refine), and each service is a coloured line that feeds into it.

**What it refuses:** the category default of a dark page with a neon accent, glow effects, a centered hero, bento grids and a logo marquee. It also refuses the common swing to the other extreme, cream paper with an editorial serif.

**Lineage:** Massimo Vignelli's 1972 NYC subway diagram, the 1970 NYCTA Graphics Standards Manual (Unimark), Harry Beck's London Tube map, Solari split-flap departure boards, and *Mini Metro* as the motion reference for lines drawing themselves and trains moving along them.

**Why it fits this product:**
- The pitch *is* a route: strategy, design and engineering under one accountable team, with no hand-offs between vendors.
- Founders already know how to read a transit map, so the metaphor needs no explaining.
- It lets us draw rich, real visuals from the content itself (the process, the services, the timelines) instead of depending on photography the studio doesn't have yet.

**Honest risk:** transit maps are a familiar trope for agency "our process" sections. The direction only works if the whole site commits to it (navigation, buttons, forms, page transitions, footer), not one diagram in one section.

### 2.1 The visual world

| Element | Decision |
|---|---|
| Colour strategy | **Full palette.** Ink and white carry the signage; five named line colours each belong to one service, site-wide. No gradients, no glows, no drop shadows. |
| Line colours (starting values, to be checked for contrast at build) | **U** UI/UX Design: signal red `#E63B2E` · **W** Web Development: route blue `#1F4FD8` · **S** SaaS Product Development: line green `#0E9F4F` · **M** Mobile App Design & Dev: platform yellow `#F7C600` (always with black text) · **C** CMS Development: interchange purple `#9B3FC8` |
| The Studio trunk line | Ink: `#111214` on light, `#F4F4F2` on dark. All five service lines merge into it. |
| Light theme ("day service") | Enamel white `#FFFFFF` ground, cool panel `#F1F2F4`, ink text, black sign bands with white type (the NYC signage look). |
| Dark theme ("night service") | Ground `#0B0C0E`, panel `#17181B`, text `#F4F4F2`. Sign bands invert to light-on-dark with a hairline rule. Line colours get slightly lifted variants so they pass contrast on dark. |
| Type | One grotesque family with a width axis doing signage duty: **Archivo** (variable weight and width, open licence). Heavy and slightly condensed for station names and headlines, normal width for body copy, tabular figures for times, prices and timelines. No second display face. |
| Materials | Enamel sign panels (flat colour, square corners); route bullets (circles holding a letter); thick lines with 45° and 90° bends and rounded joins; station ticks and white interchange rings; the signage arrow; split-flap characters; perforated ticket stubs; poster frames on a platform wall. |
| Iconography | Custom SVG signage arrows plus route bullets. Heroicons (already installed) only for utility icons like menu, close and external link. |
| Layout grid | A 12-column grid, with every diagram on a 45° and 90° lattice. One spacing rhythm throughout, with more space above headings than below. |

### 2.2 Shared components (rebuilt in this language, replacing the old ones)

| Component | Replaces | Notes |
|---|---|---|
| `<x-sign>` sign band | section headings and eyebrows | A black or ink band with white type, optional route bullets on the left and an arrow on the right. |
| `<x-bullet>` route bullet | tags and chips | A coloured circle with the service letter. Always paired with the service name, so colour is never the only signal. |
| `<x-line>` / `<x-station>` | process steps, dividers | SVG line segments and stations drawn from data. The station states are *upcoming*, *here*, *passed*. |
| `<x-split-flap>` | odometer stat counter | A departure-board text flip for statuses, prices and timelines. Under reduced motion it shows the final text straight away. |
| `<x-ticket>` | pricing cards | A fare ticket with a perforated stub holding the price range and "journey time". |
| `<x-poster>` | case-study cards | A platform poster frame for a cover image or video, with line bullets and a "Sample project" label when relevant. |
| `<x-journey-planner>` | contact form layout | Same fields and back end, laid out as "Plan your journey" (see Contact). |
| `<x-button>` | button | Primary is a sign band with an arrow ("Book a strategy call →"); secondary is text with an underline rule. |
| `<x-theme-toggle>` | (new) | System / Light / Dark. Labelled plainly; the sign styling is the only transit touch. |
| `<x-nav>` | nav | The pages as stations on a horizontal line, with the current page as the "you are here" station. |

## 3. Signature interactions and motion

The rule, adapted from the challengers this direction beat: **motion only marks real events.** A station reached, a line selected, a page changed, a value updated. Everything runs on one shared clock (GSAP's ticker), and there is no ambient drifting motion anywhere.

| Moment | What happens | How it's built |
|---|---|---|
| **1. The line draws in (focal moment, hero)** | On load, the trunk line draws across the hero, the five stations light up in order, and the service lines slide in and merge at their interchanges. It runs once, in 1.2–1.6s. | GSAP timeline + DrawSVGPlugin (included free in GSAP 3.15) |
| **2. "You are here" follows the scroll** | A train marker rides the trunk line, which runs down the page as the spine (the left edge on desktop, the left gutter on mobile). Each section is a station: its ring fills when the marker arrives and its name sign flips. This doubles as the scroll-progress indicator. | ScrollTrigger + MotionPathPlugin; the spine path is generated from the section positions |
| **3. Page change = the train moves** | Clicking a nav link slides the "you are here" dot along the nav line to the new station, and the next page's sign band morphs in. | Cross-document **View Transitions** (`@view-transition { navigation: auto; }`) plus `view-transition-name` on the nav dot and the page title. Works in Chrome, Edge and Safari 18.2+; Firefox just navigates normally. |
| **4. Pick a line** | Hovering or tapping a service on the system map pulls that line to the front and shows its stations (use cases), while the other lines fade to about 20%. | CSS state classes + GSAP for the line emphasis |
| **5. Departure board** | Prices, timelines and statuses change as split-flap flips, one character at a time with a staggered settle. | SplitText + a small flip keyframe; about 400ms per board |
| **6. Case-study arrival** | On the case study page, a before/after scrubber turns "departure" (the old product) into "arrival" (the result). | Pointer and keyboard slider (range input semantics) + `clip-path` |
| Feedback (buttons, links, form) | Hover and press: the arrow moves 4px along its axis and the sign band inverts. Focus: a thick 3px ring in the line colour. Form success: the journey-planner route completes to "Arrived". | CSS transitions, 150–250ms |

**Timings:** feedback 100–150ms · state changes 150–300ms · overlays and page transitions 300–500ms · the hero focal sequence 1.2–1.6s, once only. Easing is `cubic-bezier(0.16, 1, 0.3, 1)`. No bounce or elastic easing.

**Reduced motion (hard requirement):**
- Lines render fully drawn and the train marker jumps between stations without travelling.
- Split-flaps show their final text and view transitions are turned off.
- Videos don't autoplay; they show a poster frame with a play button.
- Colour and state changes stay, because they carry meaning.

**Removed:** the glow blobs and moving dot texture in `app.css`, the odometer counter, every chip marquee (one exception: a single LED-style "service status" ticker is allowed in the footer), and Lenis on touch devices (Lenis stays on desktop only, with native scroll everywhere else).

**Performance budget:**
- The first viewport is SVG and text, which is fast for LCP. Target LCP under 2.5s on mid-range mobile over 4G.
- Motion JS is about 70KB gzipped for GSAP and its plugins, plus Alpine.
- Every video is `preload="none"`, plays only while on screen, and pauses when hidden. There's no video in the mobile first viewport.

## 4. Page by page

Every page is a "station" on the nav line and is built on the same spine. **D** means desktop and **M** means mobile.

### Home: "The line"
1. **Hero (first viewport).**
   - **D:** The Studio sign band sits top-left, the nav line across the top, and "Book a call" top-right. The left 7 columns hold the headline in heavy condensed signage type: *"One team. One line. From idea to launch."* Under it goes a one-sentence subhead: strategy, product design and engineering for startups and growing companies, with no hand-offs between vendors. Then two buttons: **Book a strategy call →** and *See the work*. Across the lower hero the trunk line runs through the five stations, with the five coloured service lines merging in from the upper right. A departure board on the right cycles through the three plans: "MVP Launch · 3–8 weeks · from $2,000", and so on.
   - **M:** Sign band header with a menu button, a three-line headline, a full-width primary button, and a one-row departure board. The trunk line then turns and runs *down* the left gutter to become the page spine.
2. **The line (process).** The five stations, each with what happens, what you get and roughly how long it takes.
   - **D:** A pinned horizontal ride where scrolling moves the train through the stations.
   - **M:** A vertical ride with the same content, and no pinning.
3. **System map (services).** The five coloured lines converge on the trunk. Picking a line reveals its stations (use cases), who it's best for, and its tools, and links to its service page.
   - **M:** The lines stack as a swipeable set with scroll-snap, one line per screen width, instead of five tall cards.
4. **Featured journeys (work).** Case studies as posters on a platform wall.
   - **D:** A horizontal drag and scroll strip.
   - **M:** A scroll-snap carousel.
   - Each poster shows line bullets, a before→after headline and, where it applies, a "Sample project" label.
5. **Fares (pricing preview).** Three tickets, linking to Pricing.
6. **Passenger notices (testimonials).** **Hidden until a real testimonial exists** (see §7). No fabricated quotes are shown.
7. **Plan your journey (closing call to action).** A short journey planner: "Where are you now?" (Idea / MVP / Scaling) leads to the full contact form or to Calendly.
8. **Footer: end of line.** A mini system map, contact details, and the theme toggle (the toggle also lives in the header).

### About: "Our line"
- Hero: a sign band, the mission line, and one ambient stock video in a poster frame. The footage shows the transit world, like a night train pulling in, not people passed off as the team.
- The story as a line history.
- Values as station signs.
- FAQ as "Passenger information": the same single-open accordion, restyled.
- The stats band appears only after the studio confirms the figures (see §9).

### Team: "Crew"
- Crew cards with the person's line bullets for their disciplines and role.
- **No stock faces.** Until real photos exist, each card shows a monogram inside a large route bullet. Real photos slot into a Spatie `photo` media collection.

### Services: "System map"
- **Index:** the full-page interactive system map. Each line's panel follows the "promise on the front, details on the back" rule: the outcome first, then the tools, who it's best for and use cases (all existing data).
- **Detail pages (`/services/{slug}`):** built properly instead of the current "coming soon" page, as a single-line diagram for that service. It shows:
  - the outcome and the line's stations (use cases)
  - who it's best for, and its tools
  - related journeys (case studies tagged with that service)
  - a call to action
- **M:** Each line is a full-width panel. The Services page should end up about half its current mobile height.

### Work: "Journeys"
- **Index:** a poster wall, filtered by line using route bullets as filter chips (Alpine, updating the URL query string). Case studies are grid posters on desktop and a single column of large posters on mobile.
- **Case study detail:** a journey template.
  - Top: departure → arrival with the before/after scrubber.
  - Below it:
    - the route taken, with challenges and solutions as stations
    - tools as a legend
    - outcome as the arrival board
    - testimonial (only if real)
    - next journey → (a view-transition link)

### Pricing: "Fares"
- The three tickets, Starter / Growth / Scale, each showing:
  - price range
  - journey time
  - who it's best for
  - deliverables as the stations included
- Pricing FAQ below.
- **M:** Tickets stack with the price and journey time always visible, and deliverables behind a "See what's included" disclosure.

### Blog: "Notices"
- **Index:** a departure-board list (date, title, category bullet, reading time). The category filter uses bullets.
- **Post:** a calm reading page with a comfortable line length, a category bullet, and one cover photo (stock, credited in media metadata). The newsletter signup appears as "Get service updates".

### Contact: "Plan your journey"
- The same fields and back end, reorganised as a route: **From** (where you are now) → **Line** (project type) → **Fare** (budget range) → **Journey time** (timeline) → **Tell us about it** (description) → **Send**. The route draws forward as each step is filled in.
- On success, the route completes with an "Arrived: we'll reply within [confirm time]" board.
- Calendly sits alongside as "Rather talk it through? Book a strategy call."
- The honeypot and rate limiting stay exactly as they are.

## 5. Mobile strategy (designed first, not squeezed down)

- **The spine is vertical by nature** on phones: the line runs down the left gutter and every section is a station on it.
- **No long single-file stacks:**
  - services, journeys and fares use scroll-snap carousels or disclosures
  - every page aims for roughly half its current mobile height
- **Sticky bottom bar** after the hero scrolls away: "Book a call" plus a small "you are here" station name. It hides while the keyboard is open.
- **Menu:** a full-screen overlay drawn as a vertical line diagram, with the 8 pages as stations and the current one filled. The theme toggle sits at the bottom of the overlay.
- **Tap targets** are at least 44px and form inputs at least 16px (so iOS doesn't zoom). Station names use Archivo's narrower width axis so long names don't wrap badly.
- **No autoplay video** in the first mobile viewport; the rest play only while visible.
- **QA widths:** 360, 390, 430, 768, 1024, 1280, 1440 and 1920.

## 6. Light and dark themes

- `<html data-theme="light|dark">` is set by a tiny inline script in `<head>` *before* CSS paints, so the page never flashes the wrong theme. It reads `localStorage.theme` (`system`, `light` or `dark`) and falls back to `prefers-color-scheme`.
- **Default is System.** The toggle cycles System → Light → Dark and remembers the choice. While on System it also follows live OS theme changes through `matchMedia`.
- Tailwind uses `darkMode: ['selector', '[data-theme="dark"]']`, and colours come from CSS variables (tokens defined once per theme) so components never hard-code either theme.
- Every page gets QA'd in both themes at every width. Contrast is checked for line colours as text, as fills behind text, and as focus rings, in both themes.

## 7. Images and video: sourcing and production

**Principles:**
- Nothing may pretend to be a real client, person, review or result.
- Sample material is labelled "Sample project" on the page (driven by a CMS flag).
- Every file records where it came from.
- A swap list is handed to the studio.

| Need | Source | Pipeline |
|---|---|---|
| Transit diagrams, lines, bullets, tickets | **Drawn in code from CMS data** (services, process, plans) | Blade + SVG components. This is the main visual material, so it's free and sharp at every size. |
| Case-study visuals (3 sample projects: SaaS Platform Redesign, E-Commerce Relaunch, Mobile Booking App) | **Made by us**: three small, realistic sample product UIs built as static HTML screens in a dev-only folder (`resources/samples/`, never served in production) | Playwright captures 2x PNG stills (cover, before, after, gallery) and 6–10s walkthrough videos (WebM). **ffmpeg** converts them to MP4 H.264 + WebM, with poster frames. ffmpeg is run from `npx ffmpeg-static` as a one-off tool, not added to the project. |
| Ambient video (About hero, 404 / "end of line") | **Pexels** and **Mixkit** stock footage from the transit world: trains arriving, platforms, city lines at night. No people presented as staff. | Download, trim to a 6–8s loop, and compress to at most about 2.5MB (desktop) and 1MB (mobile) as MP4 + WebM with a poster frame. **Check each Mixkit clip's licence individually** (some clips are non-commercial only). |
| Blog covers | Pexels / Unsplash photos chosen for each post's subject | Uploaded through Spatie Media so the existing responsive conversions produce WebP. |
| Team photos | **None.** Monogram route bullets until real photos arrive. | A Spatie `photo` collection, ready for when they do. |
| Client logos | **None, and the logo strip is removed.** It comes back only with real, permitted logos. | n/a |

**Provenance:** each asset's origin (source URL, author and licence for stock; "authored sample" plus the generating screen for our own) goes in Spatie media custom properties and in a `docs/asset-sources.md` swap list.

**Licences:**
- **Pexels:** free for commercial use and no attribution required. You can't imply that people shown endorse the studio, and you can't resell the files unmodified.
- **Mixkit:** some clips are under a *restricted, non-commercial* licence, so each one is checked before use.

## 8. CMS and back-end changes (small, additive)

| Model | Change |
|---|---|
| `services` | Add `line_letter` (U, W, S, M, C) and `line_color` (from a fixed palette select, not free hex, so the system stays coherent). Seed the five. |
| `case_studies` | Add `is_sample` (boolean), a `before` / `after` image pair (Spatie collections), and `video` (Spatie collection, MP4 + WebM + poster). Also add `duration_label` (e.g. "6 weeks") and `headline_result`. |
| `testimonials` | Add `is_sample`. The public site shows only non-sample testimonials, so the section hides itself until a real one exists. |
| `team_members` | Add a `photo` media collection, with a monogram fallback. |
| Site settings | Calendly URL, email, phone, location and the confirmed stats, moved from hard-coded Blade into `config/studio.php` backed by `.env`. Use a Filament settings page only if the studio wants to edit these themselves (open decision §11). |
| Routes | `/services/{service}` becomes a real controller action with slug binding. |

Everything else stays: routes, controllers, the contact and newsletter back ends, the sitemap, robots.txt and Filament resources.

## 9. Accessibility, SEO, performance

- WCAG 2.2 AA in both themes.
- Line colour is never the only signal: bullets carry letters and every line is named.
- Diagrams get `role="img"` and a text alternative, with a visually hidden ordered list of stations underneath, so screen readers get the process as text.
- Fully keyboard-operable: system map lines are buttons, the scrubber is a real range input, the carousels have prev/next buttons, and skip links are provided.
- Focus is always visible (a 3px ring).
- Keep the existing OG/Twitter meta, JSON-LD and sitemap. Add `color-scheme` meta and a `theme-color` per theme.
- Budgets:
  - LCP under 2.5s, CLS under 0.05 and INP under 200ms on mobile.
  - Lighthouse at least 90 for Performance and 100 for Accessibility, Best Practices and SEO, checked with the Chrome DevTools MCP.
- **Client-supplied stats** (8+ years, 150+ projects, 60+ clients, 40% conversion lift) stay off the site until the studio confirms them; after that they appear on the departure board.

## 10. Build phases

Each phase ends with a check before moving on. Screenshots are taken at desktop and mobile, in light and dark.

**Phase R0: Foundations** (done 2026-09-24)
- [x] Direction contract recorded in the surface brief: `.impeccable/surfaces/resources-views-pages-home-blade-php.md`, with all six blocks and the seed key.
- [x] Design tokens for both themes in `tailwind.config.js`, emitted as CSS variables and contrast-checked. Archivo is self-hosted from `resources/fonts` (Vite-processed, preloaded, OFL licence alongside). Type scale retuned: display tops out at 6rem.
- [x] Theme system: the `<head>` script applies the theme before first paint, there's a shared Alpine store (`resources/js/theme.js`), and `<x-theme-toggle>` sits in the header, mobile menu and footer. Theme changes crossfade through a View Transition when motion is allowed.
- [x] Removed the glow blobs, dot field, floating dots, marquee, odometer, 3D tilt, hero-video placeholder and the per-section `data-reveal` fade-in. Stats and hero stat lines are off until confirmed (§9).
- [x] New `motion.js` core: GSAP ticker as the one clock, a live reduced-motion check, and Lenis only for a fine pointer with motion allowed.
- **Deviation:** `<x-placeholder-image>` stays for case-study covers, team cards and blog covers until R4, R5 and R7 replace those uses. Deleting it now would leave empty holes on those pages.
- **Deviation:** visibility-based video play and pause moves to R4, where the first video ships, so it isn't written untested.
- **Interim:** the old colour names (`ink-*`, `paper`, `lime-*`) are aliased onto the new tokens so the not-yet-rebuilt pages follow the theme. Remove each alias as R2–R5 rebuild the pages.
- *Checked:* themes resolve from the system setting and from a saved choice, and the theme is already set when the body starts rendering. All three toggles stay in sync and the choice survives a reload. Reduced motion disables Lenis. No 404s or console errors. All 13 routes return 200.

**Phase R1: Component kit** (done 2026-09-24)
- [x] Built on `/_kit`, which is registered only when `APP_ENV=local`. Delete `resources/views/kit.blade.php` and its route before launch.
- [x] New components:
  - `x-sign`, `x-bullet`, `x-arrow` (authored signage arrow), `x-wordmark`
  - `x-route`, which does the job of the planned `x-line` + `x-station`: a real `<ol>` with horizontal or vertical lines, sizes sm/md/lg, upcoming/passed/current states, and an ink casing for the yellow line on day white
  - `x-split-flap` (server-rendered tiles, GSAP flip on first view or on change, plain text for screen readers), `x-ticket`, `x-poster` (typographic poster when there's no image; "Sample project" label)
  - `x-button`, now with primary/outline/ghost/on-sign variants and sm/md sizes
- [x] The nav is now a line of 8 stations. The current section stays lit on its detail pages. The mobile menu shows the same line vertically; everything behind it is `inert`, Escape closes it and returns focus to Menu.
- [x] New footer ("End of line"): trunk terminus, the five service lines, stations, contact details, and the theme toggle. Skip link added.
- [x] `services.line` column added (one of u/w/s/m/c, unique, backfilled). It replaces the planned `line_letter` + `line_color`, since the letter and colour both come from the key. Admin gets a select field for it.
- [x] Contact details and the Calendly URL moved to `config/studio.php`, set from `.env` (commented examples in `.env.example`).
- *Checked:*
  - keyboard: tab order, visible 3px focus everywhere, `aria-current` on the current page, the toggle works from the keyboard, the skip link lands on `main`, and focus stays inside the mobile menu
  - contrast: automated scan of every visible text element on `/_kit` and `/`, light and dark, at 1440 and 390, with zero failures
  - no horizontal overflow and no console errors; all routes return 200
- **Carried to R2:**
  - the hero departure board needs its own stacked mobile layout (19 + 15 tiles don't fit 390px side by side)
  - horizontal routes with 5+ stations should switch to vertical below `md`
  - old pages still use the legacy colour aliases and the old `x-card` / `x-section-heading`

**Phase R2: Home** (done 2026-09-24)
- [x] **Hero:**
  - a new headline and subhead, "Book a strategy call" and "See the work"
  - a departure board listing all three plans (journey time and starting fare, via new `PricingPlan` helpers `short_timeline` and `fare_from`)
  - the line diagram (`x-hero-map`): five service lines drawn as a true parallel bundle (miter-offset 45° bends), sweeping in from the right edge and merging at the Discover interchange, then one trunk through the stations to a Launch terminus
  - on phones, a compact version where the lines merge into "One team" and the trunk turns down into the process line
- [x] **Focal sequence** (`resources/js/hero.js`): lines sweep in with each casing in step, the interchange appears, and the trunk draws with each station appearing as the line reaches it. The drawing is hidden before first paint via `html.motion` (with a 3s failsafe) so it never flashes fully drawn. Under reduced motion it's shown complete.
- [x] **Journey** (`resources/js/journey.js`): stops fill as the middle of the screen passes them and stay filled to the page bottom. On lg+, a spine with a train runs down the left gutter through every station. On phones, the process line has its own train, and a sticky "You are here" bar (`x-here-bar`, in the layout) names the current station on a split-flap next to "Book a call".
- [x] **Sections:**
  - The line: 5 stations with what happens and what you get; copy in `config/studio.php`
  - Pick your line: arrow-key tabs on desktop; a swipeable row with bullet pager and prev/next on phones and tablets (`snap-row.js`)
  - Journeys: posters with "Sample project" labels
  - Fares: tickets, swipeable on phones
  - Plan your journey: closing station
- [x] **Data:** `is_sample` added to case studies and testimonials (all seeded ones flagged, admin toggles). The placeholder testimonial is no longer shown.
- *Checked:*
  - the first viewport shows what, who, prices from $2,000 and the next step, at both 1440×900 and 390×844
  - no contrast failures, light and dark, at both widths
  - no horizontal overflow and no console errors
  - tabs work by keyboard, and all routes return 200
  - reduced motion: no motion class, the drawing appears complete, trains hidden, boards show text at once, stops still update
- **Deviations** (also recorded in the surface brief):
  - the board lists all three plans instead of cycling them, since auto-rotating content needs a pause control
  - the process is a scroll-scrubbed vertical ride, not a pinned horizontal one
  - on phones the spine is replaced by the hero-to-process line plus the "You are here" bar
  - the split-flap no longer flips section headings; stops fill instead
- **Honest miss:** the phone page is 7,284px, 17% shorter than the old 8,764px but not the "roughly half" target. It now carries more real content: prices, deliverables, process outputs. Cutting further would mean removing that content, so it's left for you to judge.

**Phase R3: Services + detail pages** (done 2026-09-24)
- [x] **Services index:**
  - hero ("Five lines. One team.")
  - a strip-map "System map": each service is one row (bullet, name, promise, its stations drawn in its colour), and the whole row links to its page. While one line is hovered or focused, the other lines' drawing fades while their words stay AA; this uses `:has()`, with CSS in `app.css`.
  - on phones, the stations become a compact dotted list
  - "How every line runs" (the shared process), then the closing station
- [x] **Detail pages** (`/services/{slug}`, `PageController@service`, replacing the "coming soon" view, which is deleted):
  - breadcrumb, then the bullet and name, the promise (the description's first sentence), and the service's own line with its use cases as stations
  - "On board" (the rest of the description), "Who rides it", tools
  - "Journeys on this line" (case studies tagged with the service)
  - "Change here for" (the other four lines), then the closing station
  - Service JSON-LD; unknown slugs return 404
- [x] **Shared:**
  - `x-closing` (the "Plan your journey" section) and `x-poster-row` (swipeable on phones), both now also used on Home
  - `[data-line-in]`: a line reveals along its own direction the first time it scrolls into view
- [x] **Sitemap:** now lists all service pages.
- [x] **Failsafe fixed:** the hidden-until-animated failsafe moved from a CSS keyframe to the head script. A delayed CSS animation overrides GSAP's inline styles, so below-the-fold entrances would never have animated. Now, if the app hasn't started 4s after load, `html.motion` is removed so nothing stays hidden.
- *Checked:*
  - phone Services page is 4,928px, down from 9,941 (the "half" target is met)
  - no contrast failures in either theme at 1440 and 390, including the hover state
  - no overflow and no errors; all routes return 200
  - reduced motion shows every line unclipped

**Phase R4: Work + case study** (done 2026-09-24)
- [x] **CMS:**
  - `headline_result` and `duration_label` fields
  - media collections `before`, `after`, `video` (MP4 + WebM), `video_poster`, all in the admin
  - WebP conversions `medium` (960w) and `large` (1920w)
  - `CaseStudy::linesFrom()` and `videoSources()` helpers
- [x] **Sample product visuals:**
  - three fictional products built as HTML in `resources/samples/`: Plexo Ops (SaaS dashboard), Grid & Grain (print shop, prints generated as SVG), and Juniper (booking app)
  - captured with Playwright as 2× stills, 4:5 covers and 1280×800 walkthrough videos, encoded to MP4 H.264 and WebM VP9 with a standalone ffmpeg (about 0.1–0.4 MB per video)
  - every PNG carries embedded provenance (`impeccable embed-prompt --scan`: 15 rasters, 0 missing)
  - the seeder attaches the files idempotently; the swap list is in `docs/asset-sources.md`
- [x] **Work index:**
  - a "Journeys" poster wall with filter buttons, one per line
  - posters glide to their new places on filter (GSAP Flip, instant under reduced motion)
  - the count is announced politely, `?line=` deep links work, and an empty line points to its service page
- [x] **Case study ("journey") template:**
  - hero with a facts panel (lines ridden, journey time, tools, client)
  - `x-compare` before/after scrubber: a real range input, keyboard, focus ring, value text
  - "The route" (challenges and problem→solution stations with a scroll-scrubbed train)
  - walkthrough video and a gallery in 16:10 frames
  - "Arrival" (headline result and outcome); the testimonial only shows when real
  - next journey, then the closing section
- [x] **Video** (`x-video` plus `initVideos` in `motion.js`, deferred from R0): plays only while half in view, pauses offscreen and in hidden tabs, keeps a visitor's pause, never autoplays under reduced motion, and has a visible Play/Pause button.
- [x] **Fixed:** `APP_URL` in `.env` was `http://localhost`, so every media URL missed the dev server port. It's now `http://127.0.0.1:8000`; production must set the real domain.
- *Checked:*
  - `/work` and a case study, light and dark, at 1440 and 390: no contrast failures, overflow, broken images or errors
  - filter, deep link, slider keyboard, and video in-view play/pause/manual-pause/reduced-motion all verified
- **Notes:**
  - Playwright's video recorder mis-scales phone-sized viewports, so Juniper is recorded on a 1280×800 stage (`booking/stage.html`)
  - admin video uploads will need PHP `upload_max_filesize` and `post_max_size` above the 2 MB default in production (tracked for R8)

**Phase R5: Pricing, About, Team, Blog, Contact**
- [ ] Tickets
- [ ] Line history and passenger info
- [ ] Crew
- [ ] Notices board and reading page
- [ ] Journey-planner form, keeping the existing back end

**Phase R6: Continuity**
- [ ] Cross-document view transitions between all pages (the nav train)
- [ ] A 404 "end of line" page
- *Check:* Chrome, Safari (via WebKit) and Firefox: Firefox just navigates normally.

**Phase R7: Assets + content**
- [ ] Stock footage and photos sourced, compressed and credited
- [ ] `docs/asset-sources.md` swap list
- [ ] Seeders updated so a fresh install shows the full design

**Phase R8: Finish**
- [ ] Impeccable detector run
- [ ] Fresh-eyes finish review (the impeccable finish-reviewer agent)
- [ ] Lighthouse + accessibility audit
- [ ] At most one fix round
- [ ] `DESIGN.md` written from the built site (impeccable documenter)

### Which tool does what

| Job | Tool |
|---|---|
| Direction, build discipline, detector, finish review, DESIGN.md | **impeccable** (the skill + its finish-reviewer and documenter agents). One design skill owns the look, so we don't mix in advice from `frontend-design` or `ui-ux-pro-max`. |
| Screenshots at every width and theme, video capture of sample UIs | **Playwright MCP** |
| Lighthouse, performance traces, LCP debugging, accessibility checks | **Chrome DevTools MCP** (`debug-optimize-lcp`, `a11y-debugging` skills) |
| Keeping the code lean (no new dependencies; GSAP plugins and Alpine cover everything) | **ponytail** |
| Evidence before claiming a phase done | **superpowers: verification-before-completion** |

## 11. Open decisions for you

1. **The real agency name and logo.** Everything is built to swap from "Studio" via `APP_NAME`. The wordmark sits on a sign band, so any name works.
2. **Stats:** confirm or drop 8+ years / 150+ projects / 60+ clients / 40% conversion lift.
3. **Contact details and the Calendly URL** (currently placeholders: contact@agency.com, +1 (555) 123-4567, New York).
4. **Reply-time promise** for the contact success message (e.g. "within one business day").
5. **Settings editing:** is `.env` + config enough for contact details and stats, or should the studio edit them in Filament (adds a small settings page)?
6. **Production PHP:** for local work, moving from Herd's PHP 8.5 to the system PHP 8.4 needs `sudo apt install php8.4-sqlite3`.

## 12. Direction contract (to be recorded as the surface brief at the start of R0)

- **THESIS:** One team, one line, no transfers. Studio is a single transit line from idea to launch that every service line feeds into. It refuses the dark-glow agency template and its cream-editorial opposite.
- **OWN-WORLD:** Enamel white (day) or deep night-black (night) grounds, black sign bands with white heavy grotesque type (Archivo), five named service line colours with letter bullets, thick 45°/90° lines with white interchange rings, split-flap boards, fare tickets, platform posters. Flat colour only.
- **STORY:** A founder sees in one screen that one team takes them from idea to launch, what that costs and how long it takes, rides the line to understand the process, picks their line, sees journeys like theirs, and plans the journey (form) or books a call.
- **FIRST VIEWPORT:** Sign-band wordmark and the nav line across the top. The headline "One team. One line. From idea to launch." fills the left 7 columns, with **Book a strategy call →** directly beneath it. The trunk line with five stations crosses the lower third, service lines merge in from the upper right, and the departure board sits on the right cycling the three plans. On mobile, the line turns down into the spine.
- **FORM:** Transit diagram and wayfinding system, #1 on the grounded list (chosen by the user over the rolled assignment); seed key `b772c3ef`.
- **FINISH:** unreviewed and undocumented is unfinished; this build ends with the finish review, the verdict, DESIGN.md, and every shipping raster carrying its provenance.

## 13. Research sources

- Pexels licence (free commercial use, no attribution, no implied endorsement): https://www.pexels.com/license/
- Mixkit free vs. restricted video licences: https://mixkit.co/free-stock-video/
- Cross-document View Transitions support (Chrome/Edge, Safari 18.2+, Firefox pending): https://developer.mozilla.org/en-US/docs/Web/API/View_Transition_API
- CSS scroll-driven animations support (Firefox still behind a flag in 2026, which is why the spine uses GSAP ScrollTrigger): https://developer.mozilla.org/en-US/docs/Web/CSS/Guides/Scroll-driven_animations
- 2026 award trends (immersive, real-time interaction): https://www.awwwards.com/websites/sites_of_the_day/ and https://digitalstrategyforce.com/journal/why-are-immersive-experiences-dominating-the-2026-awwwards/
