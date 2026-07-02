// Scroll-triggered reveal
const revealEls = document.querySelectorAll('.reveal-up');
const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting) {
            e.target.classList.add('visible');
            io.unobserve(e.target);

            // Animate bars when card group becomes visible
            const bars = e.target.querySelectorAll('.skill-bar-fill');
            setTimeout(() => {
                bars.forEach(bar => {
                    bar.style.width = bar.dataset.width + '%';
                });
            }, 200);
        }
    });
}, {
    threshold: 0.15
});

revealEls.forEach(el => io.observe(el));

// Also trigger bars already visible on load
window.addEventListener('load', () => {
    document.querySelectorAll('.reveal-up.visible .skill-bar-fill').forEach(bar => {
        bar.style.width = bar.dataset.width + '%';
    });
});









// (function () {
//   const groups = [
//     {
//       title: 'Frontend',
//       sub: '// interfaces',
//       accent: 'var(--primary)',
//       skills: [
//         {
//           name: 'HTML5 & CSS3',
//           desc: 'Semantic markup, responsive layouts, modern CSS (Grid, Flexbox, animations).',
//           level: 95,
//           icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 3l1.6 17L12 22l6.4-2L20 3H4z"/><path d="M8 8h8l-.6 4H9"/><path d="M9.2 14l.3 2.5L12 17"/></svg>`,
//         },
//         {
//           name: 'JavaScript / TS',
//           desc: 'Vanilla JS, ES2023+, DOM APIs, TypeScript for safer, scalable code.',
//           level: 90,
//           icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M10 12v5a2 2 0 0 1-2 2"/><path d="M18 13a2 2 0 0 0-2-2h-1a2 2 0 0 0 0 4h1a2 2 0 0 1 0 4h-1a2 2 0 0 1-2-2"/></svg>`,
//         },
//         {
//           name: 'Tailwind & UI',
//           desc: 'Utility-first CSS, design systems, accessible component patterns.',
//           level: 88,
//           icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12c2-4 5-5 8-3 2 1.3 3 2 5 1.5 1.5-.4 2.5-1.4 3-2.5-2 4-5 5-8 3-2-1.3-3-2-5-1.5C4.5 9.9 3.5 10.9 3 12z"/><path d="M3 18c2-4 5-5 8-3 2 1.3 3 2 5 1.5 1.5-.4 2.5-1.4 3-2.5-2 4-5 5-8 3-2-1.3-3-2-5-1.5-1.5.4-2.5 1.4-3 2.5z"/></svg>`,
//         },
//       ],
//     },
//     {
//       title: 'Backend',
//       sub: '// core stack',
//       accent: 'var(--emerald)',
//       skills: [
//         {
//           name: 'PHP / Laravel',
//           desc: 'MVC apps, Eloquent ORM, queues, auth, Livewire & API resources.',
//           level: 92,
//           icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="12" rx="10" ry="6"/><path d="M7 9l-1 6M8.5 9h2a1.5 1.5 0 0 1 0 3H8"/><path d="M13.5 9l-1 6M14 12h2"/><path d="M17.5 9l-1 6M18 12h1.5a1.5 1.5 0 0 0 0-3H18"/></svg>`,
//         },
//         {
//           name: 'Databases',
//           desc: 'MySQL, PostgreSQL, Redis — schema design, indexing, query tuning.',
//           level: 85,
//           icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="8" ry="3"/><path d="M4 5v6c0 1.7 3.6 3 8 3s8-1.3 8-3V5"/><path d="M4 11v6c0 1.7 3.6 3 8 3s8-1.3 8-3v-6"/></svg>`,
//         },
//         {
//           name: 'REST & GraphQL',
//           desc: 'Designing clean APIs, auth flows, versioning, caching & rate limits.',
//           level: 87,
//           icon: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c2.5 3 2.5 15 0 18M12 3c-2.5 3-2.5 15 0 18"/></svg>`,
//         },
//       ],
//     },
//   ];

//   const root = document.getElementById('skills-grid');
//   if (!root) return;

//   root.innerHTML = groups
//     .map(
//       (g) => `
//     <div class="skill-group" style="--accent:${g.accent}">
//       <div class="skill-group-head">
//         <div>
//           <h3>${g.title}</h3>
//           <span class="font-mono skill-group-sub">${g.sub}</span>
//         </div>
//         <span class="skill-group-count font-mono">0${g.skills.length}</span>
//       </div>
//       <div class="skill-cards">
//         ${g.skills
//           .map(
//             (s) => `
//           <article class="skill-card" data-level="${s.level}">
//             <div class="skill-card-top">
//               <div class="skill-icon" aria-hidden="true">${s.icon}</div>
//               <div class="skill-meta">
//                 <h4>${s.name}</h4>
//                 <p>${s.desc}</p>
//               </div>
//               <div class="skill-percent font-mono"><span class="skill-percent-num">0</span>%</div>
//             </div>
//             <div class="skill-bar"><div class="skill-bar-fill" style="width:0%"></div></div>
//           </article>`
//           )
//           .join('')}
//       </div>
//     </div>`
//     )
//     .join('');

//   // Animate bars on view
//   const cards = root.querySelectorAll('.skill-card');
//   const io = new IntersectionObserver(
//     (entries) => {
//       entries.forEach((e) => {
//         if (!e.isIntersecting) return;
//         const card = e.target;
//         const level = +card.dataset.level || 0;
//         const bar = card.querySelector('.skill-bar-fill');
//         const num = card.querySelector('.skill-percent-num');
//         bar.style.width = level + '%';
//         let cur = 0;
//         const step = Math.max(1, Math.round(level / 30));
//         const t = setInterval(() => {
//           cur += step;
//           if (cur >= level) { cur = level; clearInterval(t); }
//           num.textContent = cur;
//         }, 22);
//         io.unobserve(card);
//       });
//     },
//     { threshold: 0.25 }
//   );
//   cards.forEach((c) => io.observe(c));
// })();
