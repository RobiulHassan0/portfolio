// Footer year + reveal-on-scroll observer
(function () {
  const yearEl = document.getElementById('year');
  if (yearEl) yearEl.textContent = new Date().getFullYear();

  if ('IntersectionObserver' in window) {
    const io = new IntersectionObserver(
      (entries) => {
        entries.forEach((e) => {
          if (e.isIntersecting) {
            e.target.classList.add('is-visible');
            io.unobserve(e.target);
          }
        });
      },
      { threshold: 0.1 }
    );
    document.querySelectorAll('.reveal-on-scroll').forEach((el) => io.observe(el));
  } else {
    document.querySelectorAll('.reveal-on-scroll').forEach((el) => el.classList.add('is-visible'));
  }
})();

// (function () {
//   const yearEl = document.getElementById('year');
//   if (yearEl) yearEl.textContent = new Date().getFullYear();

//   if ('IntersectionObserver' in window) {
//     const io = new IntersectionObserver(
//       (entries) => {
//         entries.forEach((e) => {
//           if (e.isIntersecting) {
//             // ধাম করে আসা বন্ধ করতে সামান্য একটু ডিলে দিয়ে ক্লাস যুক্ত করা
//             setTimeout(() => {
//               e.target.classList.add('is-visible');
//             }, 50);
            
//             // Bar fill লজিক
//             const bars = e.target.querySelectorAll('.skill-bar-fill');
//             if (bars.length > 0) {
//               // ইনলাইন ট্রানজিশন ডিলের সাথে মিলিয়ে বার অ্যানিমেশন শুরু হবে
//               const delayAttr = e.target.style.transitionDelay || '0s';
//               const baseDelay = parseFloat(delayAttr) * 1000 + 400; 

//               setTimeout(() => {
//                 bars.forEach(bar => {
//                   bar.style.width = bar.dataset.width + '%';
//                 });
//               }, baseDelay);
//             }
            
//             io.unobserve(e.target);
//           }
//         });
//       },
//       { 
//         threshold: 0.02, // এলিমেন্টের একেবারে শীর্ষভাগ স্ক্রিনে আসামাত্রই ডিটেক্ট করবে
//         rootMargin: '0px 0px -20px 0px' 
//       }
//     );
    
//     document.querySelectorAll('.reveal-on-scroll').forEach((el) => io.observe(el));
//   } else {
//     document.querySelectorAll('.reveal-on-scroll').forEach((el) => {
//       el.classList.add('is-visible');
//       el.querySelectorAll('.skill-bar-fill').forEach(bar => {
//         bar.style.width = bar.dataset.width + '%';
//       });
//     });
//   }
// })();