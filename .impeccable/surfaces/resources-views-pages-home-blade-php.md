---
version: 1
slug: "resources-views-pages-home-blade-php"
primary_target: "resources/views/pages/home.blade.php"
related_targets: ["resources/views/components/layout.blade.php","resources/views/pages"]
---

# Surface brief: Studio marketing site (all 8 pages)

## Scope and mode
Whole public site: Home, About, Team, Services (+ detail), Work (+ case study), Pricing, Blog (+ post), Contact, shared nav/footer, 404. Mode: Persuade (Blog posts: Read).

## Audience, job, action
Founders and SMB leaders in the US and EU comparing agencies. They need to learn within one screen what Studio does, for whom, at what price range and timeline, and then book a strategy call (Calendly) or send the contact form. Proof is shown as process, services, and sample journeys; no fabricated clients, reviews, logos, or unconfirmed stats.

## Constraints
Light and dark themes: system by default, with a remembered toggle and no wrong-theme flash. Reduced motion removes spatial and continuous motion. Stack: Blade, Alpine, Tailwind 3, GSAP 3.15 (all plugins), Lenis on desktop only. Keep all routes, back ends, and the Filament content model. Mobile is designed first: the line runs vertically as the page spine.

## Chosen direction and memorable moment
One Line (transit diagram and wayfinding system). The memorable moment is the hero line drawing itself through five stations while the service lines merge in; afterwards the "you are here" train rides the page spine and slides along the nav line between pages.

## Refinements recorded during the build (R2)
- The departure board lists all three plans at once rather than cycling them, so no content auto-rotates (WCAG 2.2.2) and every fare is visible at first glance.
- The page-long spine with its train runs on lg+ only. On phones the hero trunk continues into the process line (with its own train), and a sticky "You are here" bar names the current station.
- The process section is a vertical ride scrubbed by scroll, not a pinned horizontal scroll, to avoid taking over the visitor's scrolling.

## Unresolved decisions
Real brand name and logo; confirmation of the stats; real contact details and Calendly URL; the reply-time promise; whether settings are editable in Filament. See REDESIGN_PLAN.md §11.

## Direction contract
- THESIS: One team, one line, no transfers. Studio is a single transit line from idea to launch that every service line feeds into. It refuses the dark-glow agency template (neon accent, glow blobs, centered hero, bento grids, logo marquee) and its cream-editorial opposite.
- OWN-WORLD: Enamel white (day) or deep night-black (night) grounds; ink sign bands carrying heavy, slightly condensed Archivo; five named service lines (U red, W blue, S green, M yellow, C purple) with letter bullets; thick 45°/90° lines with white interchange rings and station ticks; split-flap boards, fare tickets, platform posters. Flat colour only: no gradients, glows, or drop shadows.
- STORY: In one screen a founder sees that one team takes them from idea to launch, what it costs, and how long it takes. They ride the line to understand the process, pick their service line, see journeys like theirs, then plan the journey (form) or book a call.
- FIRST VIEWPORT: Sign-band wordmark, the nav line across the top, and "Book a call" at the right. The headline "One team. One line. From idea to launch." fills the left 7 columns, with "Book a strategy call →" directly beneath it. The ink trunk line crosses the lower third through Discover, Define, Design, Build, Refine, with service lines sweeping in from the right edge and merging at the Discover interchange, and a departure board on the right listing all three plans with journey time and starting fare. On phones the lines merge into "One team" and the trunk turns down into the process line.
- FORM: Transit diagram and wayfinding system (Vignelli / Beck / NYCTA standards, Solari boards, Mini Metro motion), #1 on the grounded list, chosen by the user as the pick over the rolled assignment; seed key b772c3ef.
- FINISH: unreviewed and undocumented is unfinished; this build ends with the finish review, the verdict, DESIGN.md, and every shipping raster carrying its provenance
