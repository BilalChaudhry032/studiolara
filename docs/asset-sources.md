# Asset sources and swap list

Every image and video the site shows, where it came from, and how to replace it. Nothing on the site may pass for a real client, person, review or result (see `PRODUCT.md`), so every sample asset is labelled "Sample project" on the page and flagged `is_sample` in the admin.

## Sample case studies (authored, fictional)

The three seeded case studies show three invented products, designed and captured for this site. They are not client work.

| Case study (slug) | Sample product | Files in `database/seeders/media/samples/<slug>/` |
|---|---|---|
| `saas-platform-redesign` | Plexo Ops, an operations dashboard | cover, before, after, gallery-1 (onboarding), walkthrough (mp4, webm, poster) |
| `e-commerce-relaunch` | Grid & Grain, a print shop (prints are generated SVG art) | cover, before, after, gallery-1 (mobile checkout), walkthrough |
| `mobile-booking-app` | Juniper, a wellness-studio booking app | cover, before, after (three phones each), gallery-1 (class list), walkthrough |

- **Source:** HTML screens in `resources/samples/` (dev-only, never served). Names, people and numbers inside them are invented.
- **Provenance:** every PNG carries its origin in a PNG text chunk. Read it with `impeccable embed-prompt <file> --read`. Media records also carry a custom property `origin`.
- **Licences:** none needed; everything was authored for this project. Fonts used inside the screens (Manrope, Fraunces, Work Sans, Plus Jakarta Sans) are SIL Open Font License.

### How they were made (to recapture)

1. `php -S 127.0.0.1:8124 -t resources/samples`
2. **Stills:** Playwright at 1440×900, device scale 2 (phone screens 390×844 @2×), saved to `resources/samples/captures/` (gitignored). Covers: `cover.html?p=saas|store|booking` at 1200×1500.
3. **Walkthroughs:** Playwright `recordVideo` at 1280×800. Juniper is recorded through `booking/stage.html`, because Playwright's recorder mis-scales phone-sized viewports.
4. **Encoding:** a standalone ffmpeg (`npm i ffmpeg-static` in a scratch folder, not the project):
   - MP4: `-ss 0.3 -c:v libx264 -preset slow -crf 23 -pix_fmt yuv420p -movflags +faststart -an` (Juniper uses `-ss 1.0`, which skips the frame before its inner screen loads)
   - WebM: `-c:v libvpx-vp9 -crf 36 -b:v 0 -row-mt 1 -an`
   - Poster: the first frame of the MP4.
5. Copy the finals into `database/seeders/media/samples/<slug>/` and run `impeccable embed-prompt <png> --prompt "<origin>"` on every PNG.
6. `php artisan db:seed --class=CaseStudySeeder` attaches them to any empty media slots. Spatie generates the WebP versions (`medium` 960w, `large` 1920w).

### Replacing with real work

In the admin (**Case Studies → edit**):
1. Turn off **Sample project**.
2. Upload real **Cover**, **Before**, **After**, **Gallery**, **Video** (MP4 and WebM, muted, under 10 seconds) and **Video poster**.
3. Fill in **Headline result** and **Journey time**, but only with figures the client has approved.

Delete the sample media from the same screen. The seeder never overwrites media that already exists.

## Other assets

| Asset | Source | Licence |
|---|---|---|
| Archivo (site typeface), `resources/fonts/` | Google Fonts, Omnibus-Type | SIL OFL 1.1, `resources/fonts/OFL-Archivo.txt` |
| Line diagrams, bullets, tickets, signage arrows | Drawn in code (Blade and SVG) from CMS data | Project code |
| Icons (menu, close, theme, play/pause) | Heroicons via blade-heroicons | MIT |

## Still to come (REDESIGN_PLAN.md §7)

- About: ambient transit footage from Pexels or Mixkit, with each clip's licence checked individually (some Mixkit clips are non-commercial only).
- Blog covers: Pexels or Unsplash photos.
- Team photos: none until real ones exist. Cards show monogram bullets instead.
