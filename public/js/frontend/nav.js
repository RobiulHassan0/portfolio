// Mobile menu toggle + nav rendering

(function () {
    const links = [{
            num: '01.',
            label: 'Projects',
            href: '#projects'
        },
        {
            num: '02.',
            label: 'Skills',
            href: '#skills'
        },
        {
            num: '03.',
            label: 'About',
            href: '#about'
        },
        {
            num: '04.',
            label: 'Services',
            href: '#services'
        },
        {
            num: '05.',
            label: 'Contact',
            href: '#contact'
        },
    ];

    const navLinks = document.getElementById('nav-links');
    const mobileMenu = document.getElementById('mobile-menu-inner');

    if (navLinks) {
        navLinks.innerHTML = links.map( (link) => `<a href="${link.href}"><span class="num">${link.num}</span>${link.label}</a>`).join('');
    }

    if(mobileMenu){
      mobileMenu.innerHTML = links.map( (link) => `<a href="${link.href}"><span class="num">${link.num}</span>${link.label}</a>`).join('');
    }

    const toggleBtn = document.getElementById('nav-toggle');
    const menuMobile = document.getElementById('mobile-menu')

    if(toggleBtn && menuMobile){
      toggleBtn.innerHTML = window.Icons.menu;
      toggleBtn.addEventListener( 'click', () => {
        const open = menuMobile.classList.toggle('open');
        toggleBtn.innerHTML = open ? window.Icons.close : window.Icons.menu; 
        toggleBtn.setAttribute('aria-expanded', String(open)); 
      }); 
      menuMobile.addEventListener('click', (e) => {
        if(e.target.tagName === 'A'){
          menuMobile.classList.remove('open');
          toggleBtn.innerHTML = window.Icons.menu;
        }
      });
    }
})();
