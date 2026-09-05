import './bootstrap';
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import { initMotion, registerAlpineMotionComponents } from './motion';

Alpine.plugin(collapse);
registerAlpineMotionComponents(Alpine);
window.Alpine = Alpine;
Alpine.start();

initMotion();
