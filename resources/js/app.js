import './bootstrap';
import Alpine from 'alpinejs';
import {
    initAnimations,
    heroReveal,
    cardStagger,
    textFlow,
    buttonPulse,
    slideIn,
    animate,
    batchAnimate,
    MotionProfiles,
    gsap,
    ScrollTrigger
} from './utils/animations';

window.Alpine = Alpine;
Alpine.start();

// Initialize GSAP animations after DOM is painted
document.addEventListener('DOMContentLoaded', () => {
    requestAnimationFrame(() => {
        initAnimations();
    });
});

// Export motion library for ad-hoc use in Blade templates
window.gsapAnimations = {
    // Preset functions
    heroReveal,
    cardStagger,
    textFlow,
    buttonPulse,
    slideIn,
    // Core functions
    animate,
    batchAnimate,
    // Library
    MotionProfiles,
    // GSAP core
    gsap,
    ScrollTrigger
};
