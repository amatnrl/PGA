import AOS from 'aos';
import 'aos/dist/aos.css';
import { gsap } from 'gsap';
import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay, EffectFade } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-fade';

AOS.init({
  duration: 700,
  once: true,
  offset: 80,
});

// Full-page loader: hide once everything (images, fonts, swiper) has loaded,
// with a fallback timeout so it never gets stuck on a slow/failed asset.
(() => {
  const loader = document.getElementById('page-loader');
  if (!loader) {
    return;
  }
  let hidden = false;
  const hideLoader = () => {
    if (hidden) {
      return;
    }
    hidden = true;
    loader.classList.add('is-hidden');
    setTimeout(() => loader.remove(), 600);
  };
  window.addEventListener('load', hideLoader);
  setTimeout(hideLoader, 4000);
})();

window.gsap = gsap;

function initSwipers() {
  if (document.querySelector('.hero-swiper')) {
    new Swiper('.hero-swiper', {
      modules: [Pagination, Autoplay, EffectFade],
      effect: 'fade',
      fadeEffect: { crossFade: true },
      loop: true,
      autoplay: { delay: 5000, disableOnInteraction: false },
      pagination: { el: '.hero-swiper .swiper-pagination', clickable: true },
    });
  }

  if (document.querySelector('.highlight-swiper')) {
    new Swiper('.highlight-swiper', {
      modules: [Navigation],
      slidesPerView: 3,
      spaceBetween: 20,
      navigation: {
        nextEl: '.highlight-swiper .swiper-button-next',
        prevEl: '.highlight-swiper .swiper-button-prev',
      },
      breakpoints: {
        480: { slidesPerView: 4 },
        768: { slidesPerView: 6 },
        1024: { slidesPerView: 7 },
      },
    });
  }

  if (document.querySelector('.featured-swiper')) {
    new Swiper('.featured-swiper', {
      modules: [Navigation, Autoplay],
      slidesPerView: 2,
      spaceBetween: 16,
      autoplay: { delay: 3500, disableOnInteraction: false },
      navigation: {
        nextEl: '.featured-swiper .swiper-button-next',
        prevEl: '.featured-swiper .swiper-button-prev',
      },
      breakpoints: {
        640: { slidesPerView: 3 },
        1024: { slidesPerView: 5 },
      },
    });
  }

  if (document.querySelector('.testimonial-swiper')) {
    new Swiper('.testimonial-swiper', {
      modules: [Pagination, Autoplay],
      slidesPerView: 1,
      spaceBetween: 20,
      autoplay: { delay: 4500, disableOnInteraction: false },
      pagination: { el: '.testimonial-swiper .swiper-pagination', clickable: true },
      breakpoints: {
        768: { slidesPerView: 2 },
        1024: { slidesPerView: 3 },
      },
    });
  }
}

window.animateCounters = function animateCounters() {
  document.querySelectorAll('.counter').forEach((el) => {
    const target = parseInt(el.dataset.count || '0', 10);
    gsap.to(el, {
      innerText: target,
      duration: 1.6,
      ease: 'power1.out',
      snap: { innerText: 1 },
      onUpdate() {
        el.innerText = Math.floor(el.innerText).toLocaleString('id-ID');
      },
    });
  });
};

document.addEventListener('DOMContentLoaded', () => {
  initSwipers();

  // Sticky header: add shadow + solid background once scrolled past hero top
  const header = document.querySelector('[data-site-header]');
  if (header) {
    const onScroll = () => header.classList.toggle('is-scrolled', window.scrollY > 20);
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
  }

  // Header reveal choreography: on the first scroll, the navbar slides
  // up out of view briefly, then slides back down and stays frozen in place.
  const headerWrap = document.querySelector('[data-site-header-wrap]');
  if (headerWrap) {
    let played = false;
    const playReveal = () => {
      if (played || window.scrollY < 4) {
        return;
      }
      played = true;
      headerWrap.classList.add('header-hide');
      setTimeout(() => {
        headerWrap.classList.remove('header-hide');
        headerWrap.classList.add('header-reveal');
      }, 380);
      window.removeEventListener('scroll', playReveal);
    };
    window.addEventListener('scroll', playReveal, { passive: true });
  }

  // Generic horizontal carousel arrows: scrolls the target container one card
  // at a time (card width + gap), falling back to ~85% of the viewport.
  document.querySelectorAll('[data-scroll-target]').forEach((btn) => {
    btn.addEventListener('click', () => {
      const target = document.getElementById(btn.dataset.scrollTarget);
      if (!target) {
        return;
      }
      const firstCard = target.firstElementChild;
      let step = target.clientWidth * 0.85;
      if (firstCard) {
        const gap = parseFloat(getComputedStyle(target).columnGap || getComputedStyle(target).gap || '0');
        step = firstCard.getBoundingClientRect().width + gap;
      }
      const amount = step * (btn.dataset.scrollDir === 'prev' ? -1 : 1);
      target.scrollBy({ left: amount, behavior: 'smooth' });
    });
  });

  // Mobile nav toggle
  const mobileBtn = document.getElementById('mobile-menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');
  if (mobileBtn && mobileMenu) {
    mobileBtn.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
  }

  // Featured products: tab filter by jenis produk, with fade/scale in-out animation
  const featuredTabs = document.querySelectorAll('[data-featured-tab]');
  if (featuredTabs.length) {
    const cards = document.querySelectorAll('[data-featured-card]');
    let featuredAnimating = false;

    featuredTabs.forEach((tab) => {
      tab.addEventListener('click', () => {
        if (featuredAnimating || tab.classList.contains('is-active')) return;
        featuredAnimating = true;

        featuredTabs.forEach((t) => t.classList.remove('is-active'));
        tab.classList.add('is-active');
        const type = tab.dataset.featuredTab;

        const visibleNow = Array.from(cards).filter((card) => card.style.display !== 'none');

        visibleNow.forEach((card) => card.classList.add('featured-card-out'));

        setTimeout(() => {
          let shownIndex = 0;
          cards.forEach((card) => {
            const show = type === 'all' || card.dataset.type === type;
            card.classList.remove('featured-card-out');
            card.style.display = show ? '' : 'none';
            if (show) {
              card.classList.remove('featured-card-in');
              card.style.animationDelay = `${Math.min(shownIndex, 7) * 60}ms`;
              // restart the animation
              void card.offsetWidth;
              card.classList.add('featured-card-in');
              shownIndex += 1;
            }
          });
          featuredAnimating = false;
        }, visibleNow.length ? 220 : 0);
      });
    });
  }

  // Lightbox for product gallery / activity gallery thumbnails
  document.querySelectorAll('[data-lightbox-trigger]').forEach((img) => {
    img.addEventListener('click', () => {
      const overlay = document.createElement('div');
      overlay.className = 'fixed inset-0 bg-black/90 z-[100] flex items-center justify-center p-6';
      overlay.innerHTML = `<img src="${img.dataset.full || img.src}" class="max-h-full max-w-full object-contain">`;
      overlay.addEventListener('click', () => overlay.remove());
      document.body.appendChild(overlay);
    });
  });
});
