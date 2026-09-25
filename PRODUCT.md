# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Users

Founders and leaders of startups and growing companies in the US and EU who need an outside team to design and build a digital product: a SaaS platform, marketing or web app, mobile app, or CMS-driven site. They arrive while comparing agencies, usually from a referral, search, or a shared case-study link. They want to decide quickly whether this studio can be trusted with their product, budget, and timeline, and then book a strategy call or send a brief.

## Product Purpose

Marketing and portfolio site for a design + development agency. Success means a qualified founder books a strategy call (Calendly) or submits the contact form with a scoped project description, budget range, and timeline.

## Positioning

Strategy, product design, and engineering under one accountable team, not handed off between vendors. The pitch is business outcomes (conversion, launch, scale) over deliverables.

## Operating Context

- Visitors compare several agency sites side by side, often on mobile first (shared link) and then on desktop before booking.
- The primary actions are "Book a strategy call" (external Calendly link) and the contact form (name, email, company, project type, budget range, timeline, description; honeypot + rate limit).
- Content is edited by the studio through the Filament admin at `/admin`: services, case studies, team, testimonials, blog posts and categories, pricing plans. Contact submissions and newsletter signups are read-only there.

## Capabilities and Constraints

- Stack is fixed: Laravel 11, Blade, Alpine.js, Tailwind CSS 3, Vite, GSAP + ScrollTrigger, Lenis, Filament 3, Spatie Media Library. SQLite locally, MySQL in production.
- Sitemap is fixed at 8 pages: Home, About, Team, Services (index + `/services/{slug}`, detail currently "coming soon"), Work (index + case-study detail), Pricing, Blog (index + post), Contact. Plus sitemap.xml, robots.txt, newsletter signup.
- The Filament content model stays: the redesign re-skins these pages and may add media fields, but does not re-scope the content.
- The site must offer both a light and a dark theme. It follows the visitor's system preference by default, with a visible toggle that remembers the choice.
- `prefers-reduced-motion` must be honored across all motion.
- Services (5): UI/UX Design, Web Development, SaaS Product Development, Mobile App Design & Dev, CMS Development.
- Pricing (3): Starter Plan (MVP Launch, $2,000–$7,500, 3–8 weeks), Growth Plan (Full Product Build, $7,000–$20,000, 3–6 months), Scale Plan (Enterprise Solution, custom from $25,000+, 6–12+ months).
- Process: Discover, Define, Design, Build, Refine.

## Brand Commitments

- Name: "Studio" is a placeholder until the real agency name is supplied. Everything must work when the name changes (it comes from `APP_NAME`).
- No visual commitments carry over from the previous design: the old near-black + electric-lime look is replaced, not refined.

## Evidence on Hand

- Real copy: the SRS/FSD document's service, pricing, process, about/mission, and contact copy, already in seeders and page templates.
- No real case studies, client logos, team photos, testimonials, video, or photography exist yet. The 3 seeded case studies, 6 team members, the "Jane Doe, CEO of Tech Solutions Inc." testimonial, and contact details (contact@agency.com, +1 (555) 123-4567, New York) are placeholders.
- The stats in the copy (8+ years, 150+ projects, 60+ clients, 40% conversion lift) come from the client's SRS. Treat them as client-supplied claims to confirm before launch, never as something to extend.
- Imagery and video will be free-licensed stock or purpose-made visuals, labeled as samples in the CMS, with a swap list handed to the studio.
- Never fabricate clients, logos, reviews, ratings, or results.

## Product Principles

1. Prove, don't claim: show work and process before adjectives.
2. One clear next step on every page: a call or a brief.
3. Founder-speed: a first-time visitor understands what the studio does, for whom, and at what price range within one screen.
4. Editable by the studio: every visible piece of content that changes over time lives in Filament, not in templates.

## Accessibility & Inclusion

WCAG 2.2 AA in both themes. Full keyboard navigation, visible focus, and reduced-motion support that removes scroll-driven and continuous motion rather than merely speeding it up.
