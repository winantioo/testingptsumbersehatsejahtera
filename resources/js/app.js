/* resources/js/app.js */
import Alpine from 'alpinejs';
window.Alpine = Alpine;

function initReveal() {
  const items = document.querySelectorAll('.reveal');
  const io = new IntersectionObserver((entries) => {
    entries.forEach((e) => {
      if (e.isIntersecting) e.target.classList.add('is-visible');
    });
  }, { threshold: 0.12 });

  items.forEach((el) => io.observe(el));
}

function initLiquidCanvas() {
  const canvas = document.getElementById('liquid-canvas');
  if (!canvas) return;

  const ctx = canvas.getContext('2d');
  let w, h, t = 0;

  const resize = () => {
    w = canvas.width = canvas.offsetWidth * devicePixelRatio;
    h = canvas.height = canvas.offsetHeight * devicePixelRatio;
  };

  resize();
  window.addEventListener('resize', resize);

  function draw() {
    t += 0.01;
    ctx.clearRect(0, 0, w, h);

    ctx.globalAlpha = 0.18;
    ctx.fillStyle = 'rgb(15,23,42)';
    ctx.beginPath();
    for (let x = 0; x <= w; x += 10) {
      const y = (h * 0.58)
        + Math.sin((x / 150) + t) * (h * 0.04)
        + Math.sin((x / 75) + t * 1.6) * (h * 0.02);
      ctx.lineTo(x, y);
    }
    ctx.lineTo(w, h);
    ctx.lineTo(0, h);
    ctx.closePath();
    ctx.fill();
    ctx.globalAlpha = 1;

    requestAnimationFrame(draw);
  }

  draw();
}

function initMottoInteraction() {
  const el = document.getElementById('motto-stage');
  if (!el) return;

  const setActive = (key) => {
    el.dataset.active = key;
    const out = el.querySelector('[data-motto-output]');
    const text = out?.dataset?.text ?? '';
    if (out) out.textContent = text;

    if (window.gsap && out) {
      window.gsap.fromTo(out, { y: 8, opacity: 0, scale: 0.98 }, { y: 0, opacity: 1, scale: 1, duration: 0.45, ease: 'power2.out' });
    }
  };

  const btns = el.querySelectorAll('[data-motto-btn]');
  btns.forEach((b) => {
    b.addEventListener('pointerdown', () => {
      const key = b.getAttribute('data-motto-btn') || 'main';
      setActive(key);
    });
  });
}

document.addEventListener('DOMContentLoaded', () => {
  Alpine.start();
  initReveal();
  initLiquidCanvas();
  initMottoInteraction();
});
