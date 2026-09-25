import './bootstrap';

window.appReady = true; // see the failsafe in layout.blade.php
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import { initMotion } from './motion';
import { registerTheme } from './theme';
import { registerSplitFlap } from './split-flap';
import { registerSnapRow } from './snap-row';
import { registerJourneyFilter } from './journey-filter';
import { initJourney } from './journey';
import { initHeroMap } from './hero';

// Puts the self-hosted fonts in the Vite manifest so the layout can preload them.
import.meta.glob('../fonts/*.woff2');

Alpine.plugin(collapse);
registerTheme(Alpine);
registerSplitFlap(Alpine);
registerSnapRow(Alpine);
registerJourneyFilter(Alpine);
window.Alpine = Alpine;
Alpine.start();

initMotion();
initHeroMap();
initJourney();
