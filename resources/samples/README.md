# Sample product screens

Development-only source for the **sample** case-study visuals (REDESIGN_PLAN.md §7, phase R4). The site never serves this folder.

Three fictional products, one per sample case study:

| Case study | Sample product | Screens |
|---|---|---|
| SaaS Platform Redesign | Plexo Ops, an operations dashboard | `saas/before.html`, `saas/after.html`, `saas/onboarding.html` |
| E-Commerce Relaunch | Grid & Grain, a print shop | `store/before.html`, `store/after.html`, `store/checkout.html` |
| Mobile Booking App | Juniper, a wellness-studio booking app | `booking/phone.html?v=before|after&screen=1-3`, composed by `booking/compose.html?v=before|after` |

`cover.html?p=saas|store|booking` composes the 4:5 poster covers from the captured screens.

The products, names, people and numbers in these screens are invented. Everything captured from here is labelled "Sample project" on the site and listed in `docs/asset-sources.md`, so it can be swapped for real client work.

To recapture: serve this folder (`php -S 127.0.0.1:8124 -t resources/samples`) and follow the capture notes in `docs/asset-sources.md`.
