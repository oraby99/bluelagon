import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

// ──────────────────────────────────────────────────────────
// GLOBAL SPEED MULTIPLIER
// Adjust this to speed up (< 1) or slow down (> 1) all animations
// ──────────────────────────────────────────────────────────
export const MOTION_SPEED = 1.0;

// ──────────────────────────────────────────────────────────
// MOTION LIBRARY — Predefined animation profiles
// ──────────────────────────────────────────────────────────
// ──────────────────────────────────────────────────────────
// MOTION LIBRARY — Predefined animation profiles
// ──────────────────────────────────────────────────────────
export const MotionProfiles = {
    // 1. Hero Reveal — Premium, slow, powerful entrance
    HeroReveal: {
        duration: 2.0 * MOTION_SPEED,
        ease: 'expo.out',
        y: 60,
        opacity: 0,
        stagger: 0.15,
        scrollTrigger: {
            start: 'top 85%',
            toggleActions: 'play none none none',
        },
    },

    // 2. Card Stagger — Bouncy, modern, playful
    CardStagger: {
        duration: 0.8 * MOTION_SPEED,
        ease: 'back.out(1.7)',
        y: 30,
        scale: 0.95,
        opacity: 0,
        stagger: 0.1, // Default, can be overridden
        scrollTrigger: {
            start: 'top 80%', // Changed to 80% as requested (20% in view)
            toggleActions: 'play none none none',
        },
    },

    // 3. Text Flow — Gentle, elegant paragraph reveal
    TextFlow: {
        duration: 2.5 * MOTION_SPEED,
        ease: 'power1.out',
        y: 15,
        opacity: 0,
        stagger: 0.05,
        scrollTrigger: {
            start: 'top 94%',
            toggleActions: 'play none none none',
        },
    },

    // 4. Button Pulse — Quick, attention-grabbing CTA
    ButtonPulse: {
        duration: 0.5 * MOTION_SPEED,
        ease: 'elastic.out(1, 0.5)',
        scale: 0.9,
        opacity: 0,
        stagger: 0.08,
        scrollTrigger: {
            start: 'top 88%',
            toggleActions: 'play none none none',
        },
    },

    // 5. Slide In — Horizontal entrance from side
    SlideIn: {
        duration: 1.2 * MOTION_SPEED,
        ease: 'power3.out',
        x: -50,
        opacity: 0,
        stagger: 0.12,
        scrollTrigger: {
            start: 'top 92%',
            toggleActions: 'play none none none',
        },
    },

    // 6. Fade In — Slow, secondary content (Footer etc)
    FadeIn: {
        duration: 2.0 * MOTION_SPEED,
        ease: 'power1.out',
        opacity: 0,
        scrollTrigger: {
            start: 'top 95%',
            toggleActions: 'play none none none',
        },
    },
};

// ──────────────────────────────────────────────────────────
// UTILITY: Random delay for natural feel
// ──────────────────────────────────────────────────────────
const randomDelay = (min = 0, max = 0.2) => {
    return Math.random() * (max - min) + min;
};

// ──────────────────────────────────────────────────────────
// UTILITY: Check reduced motion preference
// ──────────────────────────────────────────────────────────
const prefersReducedMotion = () =>
    window.matchMedia('(prefers-reduced-motion: reduce)').matches;

// ──────────────────────────────────────────────────────────
// CORE ANIMATION ENGINE
// Applies a motion profile to elements with optional randomization
// ──────────────────────────────────────────────────────────
export const animate = (selector, profileName = 'HeroReveal', options = {}) => {
    const elements = gsap.utils.toArray(selector);
    if (!elements.length) return;

    const profile = MotionProfiles[profileName] || MotionProfiles.HeroReveal;

    if (prefersReducedMotion()) {
        gsap.set(elements, { opacity: 1, clearProps: 'all' });
        return;
    }

    const config = { ...profile, ...options };

    elements.forEach((el, index) => {
        const baseDelay = config.stagger ? config.stagger * index : 0;
        const variation = options.randomize ? randomDelay(0, 0.15) : 0;

        gsap.from(el, {
            ...config,
            delay: baseDelay + variation,
            scrollTrigger: config.scrollTrigger
                ? {
                    ...config.scrollTrigger,
                    trigger: el,
                }
                : null,
        });
    });
};

// ──────────────────────────────────────────────────────────
// PRESET FUNCTIONS for common use cases
// ──────────────────────────────────────────────────────────

export const heroReveal = (selector, options = {}) =>
    animate(selector, 'HeroReveal', { randomize: true, ...options });

export const cardStagger = (selector, options = {}) =>
    animate(selector, 'CardStagger', { randomize: true, ...options });

export const textFlow = (selector, options = {}) =>
    animate(selector, 'TextFlow', { randomize: false, ...options });

export const buttonPulse = (selector, options = {}) =>
    animate(selector, 'ButtonPulse', { randomize: true, ...options });

export const slideIn = (selector, options = {}) =>
    animate(selector, 'SlideIn', { randomize: true, ...options });

export const fadeIn = (selector, options = {}) =>
    animate(selector, 'FadeIn', { randomize: false, ...options });

// ──────────────────────────────────────────────────────────
// BATCH ANIMATION for grids (better performance)
// ──────────────────────────────────────────────────────────
export const batchAnimate = (selector, profileName = 'CardStagger', options = {}) => {
    const elements = gsap.utils.toArray(selector);
    if (!elements.length) return;

    const profile = MotionProfiles[profileName] || MotionProfiles.CardStagger;

    if (prefersReducedMotion()) {
        gsap.set(elements, { opacity: 1, clearProps: 'all' });
        return;
    }

    ScrollTrigger.batch(elements, {
        start: profile.scrollTrigger?.start || 'top 90%',
        onEnter: (batch) => {
            gsap.from(batch, {
                ...profile,
                ...options,
                stagger: {
                    amount: (options.stagger || profile.stagger) * batch.length,
                    from: 'start',
                    ease: 'power1.in',
                },
            });
        },
        once: true,
    });
};

// ──────────────────────────────────────────────────────────
// PARALLAX SCRUB EFFECT
// ──────────────────────────────────────────────────────────
export const parallaxScrub = (selector, options = {}) => {
    const elements = gsap.utils.toArray(selector);
    if (!elements.length || prefersReducedMotion()) return;

    elements.forEach(el => {
        gsap.to(el, {
            y: options.y || 100,
            ease: 'none',
            scrollTrigger: {
                trigger: el,
                start: 'top bottom',
                end: 'bottom top',
                scrub: true,
            }
        });
    });
};

// ──────────────────────────────────────────────────────────
// MICRO-INTERACTIONS
// ──────────────────────────────────────────────────────────
export const initMicroInteractions = () => {
    if (prefersReducedMotion()) return;

    document.querySelectorAll('.gsap-stagger-grid > *').forEach((card) => {
        card.addEventListener('mouseenter', () => {
            gsap.to(card, {
                y: -8,
                scale: 1.02,
                boxShadow: '0 20px 40px rgba(0,0,0,0.12)',
                duration: 0.3,
                ease: 'power2.out',
            });
        });
        card.addEventListener('mouseleave', () => {
            gsap.to(card, {
                y: 0,
                scale: 1,
                boxShadow: '0 4px 6px rgba(0,0,0,0.05)',
                duration: 0.4,
                ease: 'power2.inOut',
            });
        });
    });

    document.querySelectorAll('a.safari-gradient, button.safari-gradient').forEach((btn) => {
        btn.addEventListener('mouseenter', () => {
            gsap.to(btn, { scale: 1.05, duration: 0.25, ease: 'back.out(1.7)' });
        });
        btn.addEventListener('mouseleave', () => {
            gsap.to(btn, { scale: 1, duration: 0.35, ease: 'power2.out' });
        });
    });
};

// ──────────────────────────────────────────────────────────
// INIT — Auto-initialize animations on page load
// ──────────────────────────────────────────────────────────
export const initAnimations = () => {
    // Hero headings — slow, powerful
    heroReveal('h1');

    // Section headings — medium speed
    animate('h2', 'HeroReveal', { duration: 1.2 * MOTION_SPEED });

    // Card grids — batch with 0.2s stagger per batch length logic (passed as amount/length usually, or here just explicit stagger)
    // Logic in batchAnimate uses `amount: stagger * batch.length`. 
    // User requested "0.2s stagger between cards". 
    // If I pass stagger: 0.2, the batch amount will be 0.2 * length. 
    batchAnimate('.gsap-stagger-grid > *', 'CardStagger', { stagger: 0.2 });

    // Paragraphs — gentle flow
    textFlow('section p');

    // CTA buttons
    buttonPulse('a.safari-gradient, button.safari-gradient');

    // Footer / Secondary Info — Slow FadeIn
    fadeIn('footer', { duration: 2.0 });

    // Background Scrub
    parallaxScrub('.bg-scrub', { y: 200 });

    // Hover interactions
    initMicroInteractions();
};

// ──────────────────────────────────────────────────────────
// EXPORTS
// ──────────────────────────────────────────────────────────
export const createTimeline = (opts = {}) => gsap.timeline(opts);
export { gsap, ScrollTrigger };

