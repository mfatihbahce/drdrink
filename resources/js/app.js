import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Scroll reveal
function initScrollReveal() {
  const reveals = document.querySelectorAll('.reveal');
  const revealOnScroll = () => {
    reveals.forEach((el) => {
      const windowHeight = window.innerHeight;
      const elementTop = el.getBoundingClientRect().top;
      const elementVisible = 150;
      if (elementTop < windowHeight - elementVisible) {
        el.classList.add('revealed');
      }
    });
  };
  window.addEventListener('scroll', revealOnScroll);
  revealOnScroll(); // Initial check
}

// Navbar scroll effect
function initNavbar() {
  const nav = document.getElementById('main-nav');
  if (!nav) return;
  const handleScroll = () => {
    if (window.scrollY > 50) {
      nav.classList.add('nav-scrolled');
    } else {
      nav.classList.remove('nav-scrolled');
    }
  };
  window.addEventListener('scroll', handleScroll);
  handleScroll();
}

document.addEventListener('DOMContentLoaded', () => {
  initScrollReveal();
  initNavbar();
});
