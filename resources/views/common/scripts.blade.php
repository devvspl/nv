<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // --- Preloader ---
    const preloader = document.getElementById('preloader');
    window.addEventListener('load', () => {
         setTimeout(() => {
            document.body.classList.add('loaded');
        }, 200);
    });

    // --- Sticky Header Shadow ---
    const header = document.getElementById('main-header');
    const headerLogo = header.querySelector('.header-logo-img');
    const logoDark = '{{ asset('main/images/zendo.png') }}';
    const logoLight = '{{ asset('main/images/zendo.png') }}';
    const navLinks = header.querySelectorAll('.header-nav-link');
    const headerButton = header.querySelector('.header-button');
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    
    function handleScroll() {
        if (window.scrollY > 10) {
            header.classList.add('scrolled');
            if (headerLogo) headerLogo.src = logoDark;
            navLinks.forEach(link => {
                link.classList.add('text-gray-700', 'hover:text-zendo-navy');
                link.classList.remove('text-white', 'hover:text-zendo-gold');
            });
            if (headerButton) {
                headerButton.classList.add('btn-light-bg');
                headerButton.classList.remove('btn-dark-bg');
            }
            if (mobileMenuButton) {
                mobileMenuButton.classList.add('text-zendo-navy');
                mobileMenuButton.classList.remove('text-white');
            }
        } else {
            header.classList.remove('scrolled');
             if (headerLogo) headerLogo.src = logoLight;
            navLinks.forEach(link => {
                link.classList.remove('text-gray-700', 'hover:text-zendo-navy');
                link.classList.add('text-white', 'hover:text-zendo-gold');
            });
            if (headerButton) {
                headerButton.classList.add('btn-dark-bg');
                headerButton.classList.remove('btn-light-bg');
            }
             if (mobileMenuButton) {
                mobileMenuButton.classList.remove('text-zendo-navy');
                mobileMenuButton.classList.add('text-white');
            }
        }
    }
    
    window.addEventListener('scroll', handleScroll);
    handleScroll();

    // --- Mobile Menu Toggle ---
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');

    if (mobileMenuButton) { 
        mobileMenuButton.addEventListener('click', function() { 
            mobileMenu.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
            if (!header.classList.contains('scrolled')) {
                 mobileMenu.classList.add('bg-zendo-light-bg');
            }
        });
    }
    
    // --- Search Bar Tabs ---
    const tabs = document.querySelectorAll('.search-tab-button');
     const zendoNavyColor = '#0B2C3D';
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            tabs.forEach(t => {
                t.classList.remove('active', 'bg-white', 'text-zendo-navy', 'font-bold');
                t.classList.add('bg-gray-200/80', 'text-gray-700', 'font-semibold', 'hover:bg-white', 'hover:text-zendo-navy');  
                 const pointer = t.querySelector('div:not(.hidden)');
                 if(pointer) pointer.classList.add('hidden');
            });
            
            this.classList.add('active', 'bg-white', 'text-zendo-navy', 'font-bold');
            this.classList.remove('bg-gray-200/80', 'text-gray-700', 'font-semibold', 'hover:bg-white', 'hover:text-zendo-navy');  
             this.style.borderColor = zendoNavyColor;  
            const pointer = this.querySelector('div');
            if(pointer) pointer.classList.remove('hidden');
            
            console.log('Switched to tab:', this.dataset.tab);
        });
    });

    // --- Animated Counter ---
    const animateCounter = (el) => {
        const target = parseFloat(el.dataset.target);
        const duration = 1500;
        const decimals = parseInt(el.dataset.decimals) || 0;
        const prefix = el.dataset.prefix || '';
        const suffix = el.dataset.suffix || '';
        let startTime = null;

        const step = (timestamp) => {
            if (!startTime) startTime = timestamp;
            const progress = Math.min((timestamp - startTime) / duration, 1);
            let currentVal = progress * target;
            
            if (el.dataset.suffix === 'K+' && target === 25) {
                currentVal = Math.round(currentVal); 
                 el.textContent = prefix + Math.min(currentVal, target) + suffix;
            } else if (el.dataset.suffix === '+' && target === 1500) {
                currentVal = Math.round(currentVal);
                 el.textContent = prefix + Math.min(currentVal, target) + suffix;
            }
            else {
                el.textContent = prefix + currentVal.toFixed(decimals) + suffix;
            }

            if (progress < 1) {
                window.requestAnimationFrame(step);
            } else {
                 if ((el.dataset.suffix === 'K+' && target === 25) || (el.dataset.suffix === '+' && target === 1500)) {
                     el.textContent = prefix + target + suffix;
                 } else {
                    el.textContent = prefix + target.toFixed(decimals) + suffix;
                 }
            }
        };
        window.requestAnimationFrame(step);
    };

    const statsBar = document.getElementById('stats-bar');
    const counters = document.querySelectorAll('.counter-value');
    let hasAnimated = false;

    if(statsBar && counters.length > 0){
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !hasAnimated) {
                    counters.forEach(counter => {
                        animateCounter(counter);
                    });
                    hasAnimated = true;
                    observer.unobserve(statsBar);
                }
            });
        }, {
            threshold: 0.5
        });
         observer.observe(statsBar);
    }

    // --- Testimonial Carousel ---
    const carousel = document.getElementById('testimonial-carousel');
    const slides = carousel ? carousel.querySelectorAll('.testimonial-slide') : [];
    const dotsContainer = document.getElementById('testimonial-dots');
    let currentIndex = 0;
    let itemsPerView = 3;

    function updateItemsPerView() {
        if (window.innerWidth < 768) {
            itemsPerView = 1;
        } else if (window.innerWidth < 1024) {
            itemsPerView = 2;
        } else {
            itemsPerView = 3;
        }
    }

    function createDots() {
        if (!dotsContainer || slides.length === 0) return;
        dotsContainer.innerHTML = '';
        const numDots = Math.ceil(slides.length / itemsPerView);
        if (numDots > 1) { 
            for (let i = 0; i < numDots; i++) {
                const button = document.createElement('button');
                button.setAttribute('aria-label', `Go to slide ${i + 1}`);
                button.addEventListener('click', () => goToSlide(i));
                dotsContainer.appendChild(button);
            }
            updateDots();
        }
    }
    
    function updateDots() {
        if (!dotsContainer) return;
        const dots = dotsContainer.querySelectorAll('button');
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentIndex);
        });
    }

    function goToSlide(index) {
         if (!carousel || slides.length === 0) return;
        const numSlides = slides.length;
        const numDots = Math.ceil(numSlides / itemsPerView);
         if (numDots <= 1) return;

        currentIndex = index;
        if (currentIndex >= numDots) {
            currentIndex = 0;
        } else if (currentIndex < 0) {
            currentIndex = numDots - 1;
        }
        
        let translatePercentage = -(currentIndex * 100); 

        carousel.style.transform = `translateX(${translatePercentage}%)`;
        updateDots();
    }
    
    function setupCarousel() {
         if (!carousel || slides.length === 0) return;
        updateItemsPerView();
         slides.forEach(slide => {
            if (itemsPerView === 1) {
                slide.style.flex = '0 0 100%';
            } else if (itemsPerView === 2) {
                slide.style.flex = '0 0 50%';
            } else {
                slide.style.flex = '0 0 33.333%';
            }
        });
        createDots();
        goToSlide(0);
    }

     if (carousel) {
         setupCarousel();
         window.addEventListener('resize', setupCarousel);
     }

    // --- Scroll Animations ---
    const animatedElements = document.querySelectorAll('.animate-on-scroll');
    if (animatedElements.length > 0) {
        const animationObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });

        animatedElements.forEach(el => {
            animationObserver.observe(el);
        });
    }

    // Mobile toggle open/close for social icons
    const wrap = document.getElementById('stickyContact');
    const btn = document.getElementById('stickyToggle');

    if(wrap && btn) {
        btn.addEventListener('click', () => {
            wrap.classList.toggle('is-open');
            btn.setAttribute('aria-label', wrap.classList.contains('is-open') ? 'Close contact options' : 'Open contact options');
        });

        document.addEventListener('click', (e) => {
            if(window.innerWidth > 768) return;
            if(!wrap.contains(e.target)) wrap.classList.remove('is-open');
        });
    }

});
</script>