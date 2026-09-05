/**
 * RosTop — Interactive Application Engine (rostop.com)
 * Professional UI, Responsive Calculations, Live Search
 */

(function () {
  'use strict';

  // --- Exchange Rates & Brand Data ---
  const BRAND_RATES = {
    'apple': { name: 'Apple / iTunes (US/Global)', rate: 0.88, color: '#000000', currencies: ['USD', 'EUR', 'GBP'] },
    'google-play': { name: 'Google Play Gift Card', rate: 0.85, color: '#4285F4', currencies: ['USD', 'EUR', 'GBP', 'TRY'] },
    'paysafecard': { name: 'Paysafecard Voucher', rate: 0.86, color: '#008ACA', currencies: ['EUR', 'USD', 'GBP'] },
    'transcash': { name: 'Transcash Top-up Code', rate: 0.90, color: '#D6001C', currencies: ['EUR'] },
    'neosurf': { name: 'Neosurf Cash PIN', rate: 0.84, color: '#E72582', currencies: ['EUR', 'USD', 'GBP'] },
    'pcs': { name: 'PCS Mastercard Coupon', rate: 0.90, color: '#FD3F5C', currencies: ['EUR'] },
    'razer-gold': { name: 'Razer Gold PIN (Global)', rate: 0.86, color: '#44D62C', currencies: ['USD', 'EUR', 'BRL'] },
    'steam': { name: 'Steam Wallet Card', rate: 0.87, color: '#1B2838', currencies: ['USD', 'EUR', 'GBP'] },
    'amazon': { name: 'Amazon Gift Card (US/UK)', rate: 0.88, color: '#FF9900', currencies: ['USD', 'GBP', 'EUR'] },
    'roblox': { name: 'Roblox Digital Card', rate: 0.84, color: '#E2231A', currencies: ['USD', 'EUR'] },
    'xbox': { name: 'Xbox / Microsoft Card', rate: 0.85, color: '#107C10', currencies: ['USD', 'EUR'] },
    'playstation': { name: 'PlayStation Network (PSN)', rate: 0.86, color: '#003791', currencies: ['USD', 'EUR', 'GBP'] }
  };

  const USD_TO_BDT = 124.50;
  const EUR_TO_BDT = 135.20;
  const GBP_TO_BDT = 158.00;

  // --- Search Index ---
  const SEARCH_ITEMS = [
    { title: 'Free Fire 115 Diamonds', category: 'Game Top-Up', price: '৳ 85', link: '/game-topup/free-fire', badge: 'Instant' },
    { title: 'Free Fire Weekly Membership', category: 'Game Top-Up', price: '৳ 165', link: '/game-topup/free-fire', badge: 'Popular' },
    { title: 'Free Fire Monthly Membership', category: 'Game Top-Up', price: '৳ 780', link: '/game-topup/free-fire', badge: 'Hot' },
    { title: 'PUBG Mobile 60 UC', category: 'Game Top-Up', price: '৳ 95', link: '/game-topup/pubg-mobile', badge: 'Instant' },
    { title: 'PUBG Mobile 325 UC', category: 'Game Top-Up', price: '৳ 480', link: '/game-topup/pubg-mobile', badge: 'Hot' },
    { title: 'Mobile Legends 86 Diamonds', category: 'Game Top-Up', price: '৳ 145', link: '/game-topup/mobile-legends', badge: 'Instant' },
    { title: 'Valorant 475 VP (Points)', category: 'Game Top-Up', price: '৳ 490', link: '/game-topup/valorant', badge: 'Code' },
    { title: 'Netflix 1 Month UHD (Private)', category: 'Subscription', price: '৳ 280', link: '/subscriptions/netflix', badge: 'Bestseller' },
    { title: 'ChatGPT Plus (1 Month)', category: 'Subscription', price: '৳ 450', link: '/subscriptions/chatgpt-plus', badge: 'AI Tool' },
    { title: 'Canva Pro 1 Year License', category: 'Subscription', price: '৳ 180', link: '/subscriptions/canva-pro', badge: 'Top Value' },
    { title: 'YouTube Premium 1 Month', category: 'Subscription', price: '৳ 120', link: '/subscriptions/youtube-premium', badge: 'Instant' },
    { title: 'Spotify Premium 3 Months', category: 'Subscription', price: '৳ 199', link: '/subscriptions/spotify', badge: 'Music' },
    { title: 'Google Play $10 US Gift Card', category: 'Buy Gift Card', price: '৳ 1,280', link: '/gift-cards/buy/google-play', badge: 'Instant Code' },
    { title: 'Apple $10 US iTunes Card', category: 'Buy Gift Card', price: '৳ 1,270', link: '/gift-cards/buy/apple', badge: 'Instant Code' },
    { title: 'Steam Wallet $10 Global', category: 'Buy Gift Card', price: '৳ 1,290', link: '/gift-cards/buy/steam', badge: 'Instant Code' },
    { title: 'Paysafecard Sell to bKash', category: 'Sell Gift Card', price: '86% Cashout', link: '/gift-cards/sell', badge: 'Instant Payout' },
    { title: 'Apple Gift Card Sell for Nagad', category: 'Sell Gift Card', price: '88% Cashout', link: '/gift-cards/sell', badge: 'Instant Payout' },
    { title: 'Windows 11 Pro Genuine Key', category: 'Digital Products', price: '৳ 390', link: '/digital-products/windows-11-pro', badge: 'Lifetime' },
    { title: 'Microsoft Office 2021 Pro Plus', category: 'Digital Products', price: '৳ 490', link: '/digital-products/office-2021', badge: 'Lifetime' }
  ];

  // --- Init ---
  document.addEventListener('DOMContentLoaded', () => {
    if (window.lucide && typeof window.lucide.createIcons === 'function') {
      window.lucide.createIcons();
    }
    initTheme();
    initHeaderShadow();
    initScrollReveal();
    initExchangeCalculator();
    initSearchModal();
    initFaqAccordion();
    initPackageSelector();
    initToastSystem();
    initOrderTabs();
    initHeroSlider();
    initCurrencySelector();
    initLiveHistoryModal();
    initLiveEyebrowTicker();
    initMobileDrawer();
    initRpSidebar();
    initSupportPage();
    initGameTopupFlow();
    initGameEditionsModal();
    initEditionPickerModal();
    initQuickTools();
    initDualTerminalTabs();
    initLocaleCurrency();
    initCategoryFilter();
  });

  // --- Theme Toggle ---
  function initTheme() {
    const btn = document.getElementById('theme-toggle-btn');
    const saved = localStorage.getItem('site-theme') || 'light';
    document.documentElement.setAttribute('data-theme', saved);

    if (btn) {
      btn.addEventListener('click', () => {
        const current = document.documentElement.getAttribute('data-theme');
        const next = current === 'light' ? 'dark' : 'light';
        document.documentElement.setAttribute('data-theme', next);
        localStorage.setItem('site-theme', next);
        showToast(`Switched to ${next} mode`, 'info');
      });
    }
  }

  // --- Header Shadow on Scroll ---
  function initHeaderShadow() {
    const header = document.getElementById('main-header');
    if (!header) return;

    let ticking = false;
    window.addEventListener('scroll', () => {
      if (!ticking) {
        window.requestAnimationFrame(() => {
          if (window.scrollY > 10) {
            header.classList.add('scrolled');
          } else {
            header.classList.remove('scrolled');
          }
          ticking = false;
        });
        ticking = true;
      }
    }, { passive: true });
  }

  // --- Scroll Reveal (Intersection Observer) ---
  function initScrollReveal() {
    const elements = document.querySelectorAll('.animate-in');
    if (!elements.length) return;

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.08,
      rootMargin: '0px 0px -40px 0px'
    });

    elements.forEach(el => observer.observe(el));
  }

  // --- Exchange Calculator ---
  function initExchangeCalculator() {
    const calcBrand = document.getElementById('calc-brand');
    const calcAmount = document.getElementById('calc-amount');
    const calcCurrency = document.getElementById('calc-currency');
    const calcRateDisplay = document.getElementById('calc-rate-badge');
    const calcPayoutDisplay = document.getElementById('calc-payout-total');
    const calcActionBtn = document.getElementById('calc-action-btn');
    const tabSell = document.getElementById('tab-calc-sell');
    const tabBuy = document.getElementById('tab-calc-buy');

    let currentMode = 'sell';

    if (!calcBrand || !calcAmount) return;

    function getRateMultiplier(currency) {
      if (currency === 'EUR') return EUR_TO_BDT;
      if (currency === 'GBP') return GBP_TO_BDT;
      return USD_TO_BDT;
    }

    function calculate() {
      const selectedBrandKey = calcBrand.value;
      const brand = BRAND_RATES[selectedBrandKey] || BRAND_RATES['apple'];
      const rawAmount = parseFloat(calcAmount.value) || 0;
      const currency = calcCurrency ? calcCurrency.value : 'USD';
      const bdtRate = getRateMultiplier(currency);
      const payoutLabel = document.querySelector('.hp-payout-label') || document.querySelector('.payout-label');

      if (currentMode === 'sell') {
        const ratePercent = Math.round(brand.rate * 100);
        if (payoutLabel) payoutLabel.textContent = 'Estimated Payout in BDT';
        if (calcRateDisplay) {
          calcRateDisplay.textContent = `We pay you ${ratePercent}%`;
          calcRateDisplay.className = 'hp-payout-rate payout-rate-badge';
        }
        const payoutUSD = rawAmount * brand.rate;
        const payoutBDT = Math.round(payoutUSD * bdtRate);
        if (calcPayoutDisplay) {
          calcPayoutDisplay.innerHTML = `৳ ${payoutBDT.toLocaleString()} <span style="font-size:0.75rem; font-weight:600; color:var(--text-dim);">($${payoutUSD.toFixed(2)})</span>`;
        }
        if (calcActionBtn) {
          calcActionBtn.innerHTML = `<span>Sell ${brand.name} Now</span> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>`;
          calcActionBtn.className = 'hp-btn hp-btn-sell w-100';
          calcActionBtn.onclick = () => {
            window.location.href = `/gift-cards/sell?brand=${selectedBrandKey}&amount=${rawAmount}&currency=${currency}`;
          };
        }
      } else {
        const buyMarkup = 1.05;
        const costUSD = rawAmount * buyMarkup;
        const costBDT = Math.round(costUSD * bdtRate);
        if (payoutLabel) payoutLabel.textContent = 'Estimated Cost in BDT';
        if (calcRateDisplay) {
          calcRateDisplay.textContent = 'Instant Digital Voucher';
          calcRateDisplay.className = 'hp-payout-rate payout-rate-badge';
        }
        if (calcPayoutDisplay) {
          calcPayoutDisplay.innerHTML = `৳ ${costBDT.toLocaleString()} <span style="font-size:0.75rem; font-weight:600; color:var(--text-dim);">($${costUSD.toFixed(2)})</span>`;
        }
        if (calcActionBtn) {
          calcActionBtn.innerHTML = `<span>Buy ${brand.name} Voucher</span> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>`;
          calcActionBtn.className = 'hp-btn hp-btn-primary w-100';
          calcActionBtn.onclick = () => {
            window.location.href = `/gift-cards/buy?brand=${selectedBrandKey}&amount=${rawAmount}`;
          };
        }
      }
    }

    if (tabSell && tabBuy) {
      tabSell.addEventListener('click', () => {
        currentMode = 'sell';
        tabSell.classList.add('active', 'sell-tab');
        tabBuy.classList.remove('active', 'buy-tab');
        calculate();
      });

      tabBuy.addEventListener('click', () => {
        currentMode = 'buy';
        tabBuy.classList.add('active', 'buy-tab');
        tabSell.classList.remove('active', 'sell-tab');
        calculate();
      });
    }

    calcBrand.addEventListener('change', calculate);
    calcAmount.addEventListener('input', calculate);
    if (calcCurrency) calcCurrency.addEventListener('change', calculate);

    calculate();
  }

  // --- Search Modal ---
  function initSearchModal() {
    const searchModal = document.getElementById('search-modal');
    const searchOpenBtns = document.querySelectorAll('.search-trigger-btn, .search-trigger');
    const searchCloseBtn = document.getElementById('search-close-btn');
    const searchInput = document.getElementById('search-input-field');
    const searchResults = document.getElementById('search-results-list');

    if (!searchModal) return;

    function openModal() {
      searchModal.classList.add('active');
      if (searchInput) {
        searchInput.value = '';
        renderResults('');
        setTimeout(() => searchInput.focus(), 50);
      }
    }

    function closeModal() {
      searchModal.classList.remove('active');
    }

    searchOpenBtns.forEach(btn => btn.addEventListener('click', openModal));
    if (searchCloseBtn) searchCloseBtn.addEventListener('click', closeModal);

    searchModal.addEventListener('click', (e) => {
      if (e.target === searchModal) closeModal();
    });

    // Ctrl+K shortcut
    document.addEventListener('keydown', (e) => {
      if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        openModal();
      }
      if (e.key === 'Escape') closeModal();
    });

    if (searchInput) {
      searchInput.addEventListener('input', () => {
        renderResults(searchInput.value.trim().toLowerCase());
      });
    }

    function renderResults(query) {
      if (!searchResults) return;

      if (!query) {
        searchResults.innerHTML = `<div style="text-align: center; padding: 2rem 1rem; color: var(--text-dim); font-size: 0.825rem;">
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 0.5rem; opacity: 0.4;"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
          <div>Type to search across all products and services</div>
        </div>`;
        return;
      }

      const filtered = SEARCH_ITEMS.filter(item =>
        item.title.toLowerCase().includes(query) ||
        item.category.toLowerCase().includes(query)
      );

      if (filtered.length === 0) {
        searchResults.innerHTML = `<div style="text-align: center; padding: 2rem 1rem; color: var(--text-dim); font-size: 0.825rem;">
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 0.5rem; opacity: 0.4;"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/><line x1="8" x2="14" y1="11" y2="11"/></svg>
          <div>No results found for "${query}"</div>
        </div>`;
        return;
      }

      searchResults.innerHTML = filtered.map(item => `
        <a href="${item.link}" style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem 0.85rem; border-radius: var(--radius-sm); transition: background 0.15s; text-decoration: none; margin-bottom: 2px;"
           onmouseover="this.style.background='rgba(255,255,255,0.04)'" onmouseout="this.style.background='transparent'">
          <div style="flex: 1;">
            <div style="font-weight: 700; font-size: 0.875rem; color: var(--text-main); margin-bottom: 2px;">${item.title}</div>
            <div style="font-size: 0.7rem; color: var(--text-dim);">${item.category}</div>
          </div>
          <div style="text-align: right; flex-shrink: 0; margin-left: 1rem;">
            <div style="font-weight: 800; color: var(--primary); font-size: 0.85rem;">${item.price}</div>
            ${item.badge ? `<span class="payout-rate-badge" style="font-size: 0.6rem;">${item.badge}</span>` : ''}
          </div>
        </a>
      `).join('');
    }
  }

  // --- FAQ Accordion ---
  function initFaqAccordion() {
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
      const questionBtn = item.querySelector('.faq-question');
      if (questionBtn) {
        questionBtn.addEventListener('click', () => {
          const isActive = item.classList.contains('active');
          // Close all
          faqItems.forEach(i => {
            i.classList.remove('active');
            const b = i.querySelector('.faq-question');
            if (b) b.setAttribute('aria-expanded', 'false');
          });
          // Toggle current
          if (!isActive) {
            item.classList.add('active');
            questionBtn.setAttribute('aria-expanded', 'true');
          }
        });
      }
    });
  }

  // --- Category Filter (Game Top-Up & Gift Card Listing Pages) ---
  function initCategoryFilter() {
    const pills = document.querySelectorAll('.category-filter-pill');
    const cards = document.querySelectorAll('.filterable-card');

    if (pills.length === 0 || cards.length === 0) return;

    pills.forEach(pill => {
      pill.addEventListener('click', () => {
        pills.forEach(p => {
          p.classList.remove('active');
          p.setAttribute('aria-selected', 'false');
        });
        pill.classList.add('active');
        pill.setAttribute('aria-selected', 'true');

        const cat = pill.getAttribute('data-category');

        cards.forEach(card => {
          const cardCat = card.getAttribute('data-category');
          if (cat === 'all' || cardCat === cat) {
            card.style.display = '';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });
  }

  // --- Package Selector ---
  function initPackageSelector() {
    const packageItems = document.querySelectorAll('.package-item[data-id]');
    const hiddenInput = document.getElementById('selected-package-id');
    const priceDisplay = document.getElementById('selected-pkg-price');
    const titleDisplay = document.getElementById('selected-pkg-title');

    packageItems.forEach(item => {
      item.addEventListener('click', () => {
        packageItems.forEach(i => i.classList.remove('selected'));
        item.classList.add('selected');

        if (hiddenInput) hiddenInput.value = item.dataset.id;
        if (priceDisplay) priceDisplay.textContent = `৳ ${item.dataset.price}`;
        if (titleDisplay) titleDisplay.textContent = item.dataset.name;
      });
    });
  }

  // --- Toast System ---
  let toastEl = null;
  let toastTimeout = null;

  function initToastSystem() {
    toastEl = document.createElement('div');
    toastEl.className = 'toast';
    document.body.appendChild(toastEl);
  }

  function showToast(message, type = 'info') {
    if (!toastEl) return;
    clearTimeout(toastTimeout);

    const iconMap = {
      'info': '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>',
      'success': '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
      'error': '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" x2="9" y1="9" y2="15"/><line x1="9" x2="15" y1="9" y2="15"/></svg>'
    };

    toastEl.innerHTML = `${iconMap[type] || iconMap.info} ${message}`;
    toastEl.classList.add('show');

    toastTimeout = setTimeout(() => {
      toastEl.classList.remove('show');
    }, 2800);
  }

  // Global functions
  window.showToast = showToast;

  window.copyToClipboard = function (text, label) {
    if (navigator.clipboard) {
      navigator.clipboard.writeText(text).then(() => {
        showToast(`${label || 'Text'} copied to clipboard`, 'success');
      }).catch(() => {
        fallbackCopy(text, label);
      });
    } else {
      fallbackCopy(text, label);
    }
  };

  function fallbackCopy(text, label) {
    const textarea = document.createElement('textarea');
    textarea.value = text;
    textarea.style.position = 'fixed';
    textarea.style.opacity = '0';
    document.body.appendChild(textarea);
    textarea.select();
    try {
      document.execCommand('copy');
      showToast(`${label || 'Text'} copied to clipboard`, 'success');
    } catch (e) {
      showToast('Failed to copy', 'error');
    }
    document.body.removeChild(textarea);
  }

  // --- Order Status Tabs (Admin) ---
  function initOrderTabs() {
    const tabs = document.querySelectorAll('[data-order-tab]');
    const panels = document.querySelectorAll('[data-order-panel]');

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        const target = tab.dataset.orderTab;

        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');

        panels.forEach(panel => {
          panel.style.display = panel.dataset.orderPanel === target || target === 'all' ? '' : 'none';
        });
      });
    });
  }

  // --- Hero Category Banner Slider ---
  function initHeroSlider() {
    const slider = document.getElementById('hp-hero-slider');
    if (!slider) return;

    const slides = slider.querySelectorAll('.hp-slide');
    const tabs = slider.querySelectorAll('.hp-slider-tab');
    const dots = slider.querySelectorAll('.hp-dot');
    const prevBtn = document.getElementById('hp-slide-prev-btn');
    const nextBtn = document.getElementById('hp-slide-next-btn');

    if (!slides.length) return;

    let currentIndex = 0;
    let autoInterval = null;
    const totalSlides = slides.length;
    const ROTATE_DELAY = 5500;

    function goToSlide(index) {
      if (index < 0) index = totalSlides - 1;
      if (index >= totalSlides) index = 0;
      currentIndex = index;

      // Update slides
      slides.forEach((slide, i) => {
        if (i === currentIndex) {
          slide.classList.add('active');
        } else {
          slide.classList.remove('active');
        }
      });

      // Update category switcher tabs
      tabs.forEach((tab, i) => {
        const isActive = i === currentIndex;
        tab.classList.toggle('active', isActive);
        tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
      });

      // Update pagination dots
      dots.forEach((dot, i) => {
        dot.classList.toggle('active', i === currentIndex);
      });
    }

    function nextSlide() {
      goToSlide(currentIndex + 1);
    }

    function prevSlide() {
      goToSlide(currentIndex - 1);
    }

    function startAutoPlay() {
      stopAutoPlay();
      autoInterval = setInterval(nextSlide, ROTATE_DELAY);
    }

    function stopAutoPlay() {
      if (autoInterval) {
        clearInterval(autoInterval);
        autoInterval = null;
      }
    }

    // Tab buttons
    tabs.forEach((tab, index) => {
      tab.addEventListener('click', () => {
        goToSlide(index);
        startAutoPlay();
      });
    });

    // Dot indicators
    dots.forEach((dot, index) => {
      dot.addEventListener('click', () => {
        goToSlide(index);
        startAutoPlay();
      });
    });

    // Arrow navigation
    if (prevBtn) {
      prevBtn.addEventListener('click', (e) => {
        e.preventDefault();
        prevSlide();
        startAutoPlay();
      });
    }
    if (nextBtn) {
      nextBtn.addEventListener('click', (e) => {
        e.preventDefault();
        nextSlide();
        startAutoPlay();
      });
    }

    // Pause on hover
    slider.addEventListener('mouseenter', stopAutoPlay);
    slider.addEventListener('mouseleave', startAutoPlay);

    // Touch swipe support for mobile
    let touchStartX = 0;
    let touchEndX = 0;

    slider.addEventListener('touchstart', (e) => {
      stopAutoPlay();
      touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });

    slider.addEventListener('touchend', (e) => {
      touchEndX = e.changedTouches[0].screenX;
      handleSwipe();
      startAutoPlay();
    }, { passive: true });

    function handleSwipe() {
      const diff = touchEndX - touchStartX;
      if (Math.abs(diff) > 40) {
        if (diff < 0) {
          nextSlide();
        } else {
          prevSlide();
        }
      }
    }

    // Start auto rotation
    startAutoPlay();
  }

  // --- Country & Currency Selector ---
  function initCurrencySelector() {
    const triggerBtn = document.getElementById('currency-selector-btn');
    const modal = document.getElementById('currency-modal');
    const closeBtn = document.getElementById('currency-close-btn');
    const options = document.querySelectorAll('.currency-option-card');
    const activeFlag = document.getElementById('active-curr-flag');
    const activeCode = document.getElementById('active-curr-code');
    const activeSym = document.getElementById('active-curr-sym');

    if (!triggerBtn || !modal) return;

    const REGIONAL_PAYMENTS = {
      'BDT': [
        { name: 'bKash', class: 'hp-dot-bkash' },
        { name: 'Nagad', class: 'hp-dot-nagad' },
        { name: 'Rocket', class: 'hp-dot-rocket' },
        { name: 'Upay', class: 'hp-dot-usdt' }
      ],
      'USD': [
        { name: 'Binance Pay', class: 'hp-dot-nagad' },
        { name: 'USDT (TRC20)', class: 'hp-dot-usdt' },
        { name: 'Visa/Mastercard', class: 'hp-dot-rocket' },
        { name: 'Apple Pay', class: 'hp-dot-bkash' }
      ],
      'EUR': [
        { name: 'Paysafecard', class: 'hp-dot-nagad' },
        { name: 'Transcash', class: 'hp-dot-bkash' },
        { name: 'SEPA Instant', class: 'hp-dot-usdt' },
        { name: 'Revolut', class: 'hp-dot-rocket' }
      ],
      'GBP': [
        { name: 'Faster Payments', class: 'hp-dot-usdt' },
        { name: 'Apple Pay', class: 'hp-dot-bkash' },
        { name: 'UK Bank Card', class: 'hp-dot-rocket' }
      ],
      'AED': [
        { name: 'PayBy / Botim', class: 'hp-dot-nagad' },
        { name: 'Apple Pay', class: 'hp-dot-bkash' },
        { name: 'USDT (Crypto)', class: 'hp-dot-usdt' }
      ],
      'SAR': [
        { name: 'STC Pay', class: 'hp-dot-bkash' },
        { name: 'Urpay', class: 'hp-dot-nagad' },
        { name: 'Mada Card', class: 'hp-dot-rocket' }
      ]
    };

    function openModal() {
      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closeModal() {
      modal.classList.remove('active');
      document.body.style.overflow = '';
    }

    triggerBtn.addEventListener('click', (e) => {
      e.preventDefault();
      openModal();
    });

    const drawerTrigger = document.getElementById('drawer-lc-trigger');
    if (drawerTrigger) {
      drawerTrigger.addEventListener('click', (e) => {
        e.preventDefault();
        openModal();
      });
    }

    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', (e) => {
      if (e.target === modal) closeModal();
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && modal.classList.contains('active')) {
        closeModal();
      }
    });

    // Handle currency selection
    options.forEach(opt => {
      opt.addEventListener('click', () => {
        const curr = opt.dataset.currency;
        const flag = opt.dataset.flag;
        const sym = opt.dataset.symbol;
        const name = opt.querySelector('.curr-opt-name')?.textContent || curr;

        options.forEach(o => o.classList.remove('active'));
        opt.classList.add('active');

        if (activeFlag) activeFlag.textContent = flag;
        if (activeCode) activeCode.textContent = curr;
        if (activeSym) activeSym.textContent = sym;

        // Sync drawer currency elements
        const drawerFlag = document.getElementById('drawer-curr-flag');
        const drawerCode = document.getElementById('drawer-curr-code');
        const drawerSym = document.getElementById('drawer-curr-sym');
        if (drawerFlag) drawerFlag.textContent = flag;
        if (drawerCode) drawerCode.textContent = curr;
        if (drawerSym) drawerSym.textContent = sym;

        localStorage.setItem('rostop_currency', curr);
        localStorage.setItem('rostop_flag', flag);
        localStorage.setItem('rostop_symbol', sym);

        // Dynamically update payment pills on hero if present
        updateHeroPaymentPills(curr);

        closeModal();
        showToast(`Region & currency set to ${name} (${curr} ${sym})`, 'success');

        // Dispatch global event for calculator or checkout
        window.dispatchEvent(new CustomEvent('rostopCurrencyChange', {
          detail: { currency: curr, flag, symbol: sym }
        }));
      });
    });

    // Drawer currency button opens currency modal
    const drawerTriggers = document.querySelectorAll('#drawer-lc-trigger, #drawer-currency-btn, .rp-lc-trigger');
    drawerTriggers.forEach((btn) => {
      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const drawerOverlay = document.getElementById('mobile-drawer-overlay');
        if (drawerOverlay) {
          drawerOverlay.classList.remove('active');
          document.body.style.overflow = '';
        }
        openModal();
      });
    });

    function updateHeroPaymentPills(curr) {
      // Target the dedicated pills container first; the broad class selector below
      // is a legacy fallback (it previously wiped the hero CTA button row).
      const pillsContainer = document.getElementById('hp-pay-pills')
        || document.querySelector('.hp-hero .d-flex.flex-wrap.gap-2');
      if (!pillsContainer) return;
      const methods = REGIONAL_PAYMENTS[curr] || REGIONAL_PAYMENTS['BDT'];

      pillsContainer.innerHTML = methods.map(m => `
        <span class="hp-pay-pill">
          <span class="hp-pill-dot ${m.class}"></span> ${m.name}
        </span>
      `).join('');
    }

    // Restore saved currency on load
    const savedCurr = localStorage.getItem('rostop_currency');
    if (savedCurr) {
      const targetOpt = Array.from(options).find(o => o.dataset.currency === savedCurr);
      if (targetOpt) {
        options.forEach(o => o.classList.remove('active'));
        targetOpt.classList.add('active');
        if (activeFlag) activeFlag.textContent = targetOpt.dataset.flag;
        if (activeCode) activeCode.textContent = targetOpt.dataset.currency;
        if (activeSym) activeSym.textContent = targetOpt.dataset.symbol;

        const drawerFlag = document.getElementById('drawer-curr-flag');
        const drawerCode = document.getElementById('drawer-curr-code');
        const drawerSym = document.getElementById('drawer-curr-sym');
        if (drawerFlag) drawerFlag.textContent = targetOpt.dataset.flag;
        if (drawerCode) drawerCode.textContent = targetOpt.dataset.currency;
        if (drawerSym) drawerSym.textContent = targetOpt.dataset.symbol;

        updateHeroPaymentPills(savedCurr);
      }
    }
  }

  // --- Live Activity & History Modal ---
  function initLiveHistoryModal() {
    const badgeTrigger = document.getElementById('open-live-history-badge');
    const btnTrigger = document.getElementById('open-live-history-btn');
    const modal = document.getElementById('live-history-modal');
    const closeBtn = document.getElementById('live-history-close-btn');
    const tabs = document.querySelectorAll('.live-modal-tab');
    const searchInput = document.getElementById('live-history-search-input');
    const list = document.getElementById('live-history-list');

    if (!modal) return;

    function openModal() {
      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
      if (searchInput) searchInput.focus();
    }

    function closeModal() {
      modal.classList.remove('active');
      document.body.style.overflow = '';
    }

    const eyebrowHistoryBtn = document.getElementById('eyebrow-open-history');
    const eyebrowLiveBadge = document.getElementById('eyebrow-live-badge');

    if (badgeTrigger) badgeTrigger.addEventListener('click', openModal);
    if (btnTrigger) btnTrigger.addEventListener('click', openModal);
    if (eyebrowHistoryBtn) eyebrowHistoryBtn.addEventListener('click', openModal);
    if (eyebrowLiveBadge) eyebrowLiveBadge.addEventListener('click', openModal);
    if (closeBtn) closeBtn.addEventListener('click', closeModal);

    modal.addEventListener('click', (e) => {
      if (e.target === modal) closeModal();
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && modal.classList.contains('active')) {
        closeModal();
      }
    });

    // Category Tabs Filtering
    let currentFilter = 'all';

    function filterCards() {
      const query = (searchInput ? searchInput.value : '').toLowerCase().trim();
      const cards = list ? list.querySelectorAll('.live-history-card') : [];

      cards.forEach(card => {
        const cat = card.dataset.category;
        const title = card.dataset.title || '';
        const method = card.dataset.method || '';

        const matchesCat = (currentFilter === 'all') || (cat === currentFilter);
        const matchesSearch = !query || title.includes(query) || method.includes(query);

        card.style.display = (matchesCat && matchesSearch) ? 'flex' : 'none';
      });
    }

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        currentFilter = tab.dataset.filter;
        filterCards();
      });
    });

    if (searchInput) {
      searchInput.addEventListener('input', filterCards);
    }
  }

  // --- Homepage Live Eyebrow Vertical Sliding Ticker with Random Intervals & Controls ---
  function initLiveEyebrowTicker() {
    const track = document.getElementById('hp-live-track');
    const viewport = document.getElementById('hp-live-viewport');
    if (!track || !viewport) return;

    const items = track.querySelectorAll('.hp-live-vt-item');
    if (items.length <= 1) return;

    let currentIndex = 0;
    const total = items.length;
    let isPaused = false;
    let timerId = null;

    function goToIndex(idx) {
      if (idx < 0) {
        currentIndex = total - 1;
      } else if (idx >= total) {
        currentIndex = 0;
      } else {
        currentIndex = idx;
      }
      const itemHeight = items[0] ? items[0].offsetHeight || 36 : 36;
      track.style.transform = `translateY(-${currentIndex * itemHeight}px)`;
    }

    function scheduleNextRandom() {
      if (timerId) clearTimeout(timerId);
      // Random delay between 2.5s and 4.5s (2500ms - 4500ms)
      const randomInterval = Math.floor(Math.random() * (4500 - 2500 + 1)) + 2500;
      timerId = setTimeout(() => {
        if (!isPaused) {
          goToIndex(currentIndex + 1);
        }
        scheduleNextRandom();
      }, randomInterval);
    }

    // Prev / Next button controls
    const prevBtn = document.getElementById('hp-live-prev-btn');
    const nextBtn = document.getElementById('hp-live-next-btn');

    if (prevBtn) {
      prevBtn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        goToIndex(currentIndex - 1);
        scheduleNextRandom();
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        goToIndex(currentIndex + 1);
        scheduleNextRandom();
      });
    }

    viewport.addEventListener('mouseenter', () => { isPaused = true; });
    viewport.addEventListener('mouseleave', () => { isPaused = false; });
    viewport.addEventListener('touchstart', () => { isPaused = true; }, { passive: true });
    viewport.addEventListener('touchend', () => { isPaused = false; });

    scheduleNextRandom();
  }

  // --- Mobile Navigation Drawer (Shaako Support Style Offcanvas) ---
  function initMobileDrawer() {
    const openBtn = document.getElementById('mobile-menu-open-btn');
    const overlay = document.getElementById('mobile-drawer-overlay');
    const drawer = document.getElementById('mobile-drawer');
    const closeBtn = document.getElementById('mobile-drawer-close-btn');
    const drawerThemeBtn = document.getElementById('drawer-theme-toggle-btn');

    if (!overlay || !drawer) return;

    function openDrawer() {
      overlay.classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closeDrawer() {
      overlay.classList.remove('active');
      document.body.style.overflow = '';
    }

    if (openBtn) {
      openBtn.addEventListener('click', (e) => {
        e.preventDefault();
        openDrawer();
      });
    }

    if (closeBtn) {
      closeBtn.addEventListener('click', (e) => {
        e.preventDefault();
        closeDrawer();
      });
    }

    overlay.addEventListener('click', (e) => {
      if (e.target === overlay) {
        closeDrawer();
      }
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && overlay.classList.contains('active')) {
        closeDrawer();
      }
    });

    // Theme toggle inside drawer
    if (drawerThemeBtn) {
      drawerThemeBtn.addEventListener('click', () => {
        const current = document.documentElement.getAttribute('data-theme') || 'light';
        const next = current === 'dark' ? 'light' : 'dark';
        document.documentElement.setAttribute('data-theme', next);
        localStorage.setItem('site-theme', next);
      });
    }
  }

  // --- Dedicated Support Page & Live Chat Modal ---
  function initSupportPage() {
    const chatModal = document.getElementById('support-chat-modal');
    const chatOpenBtn = document.getElementById('trigger-live-chat-btn');
    const chatCloseBtn = document.getElementById('support-chat-close-btn');
    const chatInput = document.getElementById('support-chat-input');
    const chatMessages = document.getElementById('support-chat-messages');
    const topicTriggers = document.querySelectorAll('.topic-chat-trigger');
    const quickPills = document.querySelectorAll('.quick-pill-btn:not(.whatsapp-pill)');
    const faqBtns = document.querySelectorAll('.support-faq-btn');

    // FAQ Accordions on Support Page
    faqBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        const item = btn.closest('.support-faq-item');
        if (item) {
          const isActive = item.classList.contains('active');
          document.querySelectorAll('.support-faq-item').forEach(i => i.classList.remove('active'));
          if (!isActive) item.classList.add('active');
        }
      });
    });

    if (!chatModal) return;

    function openChat(initialPrompt) {
      chatModal.classList.add('active');
      document.body.style.overflow = 'hidden';
      if (initialPrompt && chatInput) {
        chatInput.value = initialPrompt;
        window.sendChatMessage();
      } else if (chatInput) {
        setTimeout(() => chatInput.focus(), 150);
      }
    }

    function closeChat() {
      chatModal.classList.remove('active');
      document.body.style.overflow = '';
    }

    if (chatOpenBtn) chatOpenBtn.addEventListener('click', () => openChat());
    if (chatCloseBtn) chatCloseBtn.addEventListener('click', closeChat);

    chatModal.addEventListener('click', (e) => {
      if (e.target === chatModal) closeChat();
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && chatModal.classList.contains('active')) {
        closeChat();
      }
    });

    topicTriggers.forEach(btn => {
      btn.addEventListener('click', () => {
        const issue = btn.getAttribute('data-issue') || 'Customer Support';
        openChat(`Hello, I need assistance regarding: ${issue}`);
      });
    });

    quickPills.forEach(pill => {
      pill.addEventListener('click', () => {
        const msg = pill.getAttribute('data-msg');
        if (msg) {
          if (chatInput) chatInput.value = msg;
          window.sendChatMessage();
        }
      });
    });

    window.sendChatMessage = function() {
      if (!chatInput) return;
      const text = chatInput.value.trim();
      if (!text) return;

      // Remove empty state if present
      const emptyState = chatMessages.querySelector('.support-chat-empty');
      if (emptyState) emptyState.remove();

      // Append User message
      const userMsgDiv = document.createElement('div');
      userMsgDiv.style.cssText = 'align-self: flex-end; background: var(--primary); color: #fff; padding: 0.65rem 0.95rem; border-radius: 14px 14px 2px 14px; max-width: 82%; font-size: 0.85rem; margin-bottom: 0.65rem; box-shadow: 0 2px 8px rgba(16,185,129,0.25); word-break: break-word;';
      userMsgDiv.textContent = text;
      chatMessages.appendChild(userMsgDiv);
      chatInput.value = '';
      chatMessages.scrollTop = chatMessages.scrollHeight;

      // Automated Support response
      setTimeout(() => {
        const botMsgDiv = document.createElement('div');
        botMsgDiv.style.cssText = 'align-self: flex-start; background: var(--bg-surface); border: 1px solid var(--border-color); color: var(--text-main); padding: 0.75rem 1rem; border-radius: 14px 14px 14px 2px; max-width: 85%; font-size: 0.825rem; margin-bottom: 0.65rem; line-height: 1.5;';
        botMsgDiv.innerHTML = `
          <div style="font-weight:700; color:var(--primary); margin-bottom:2px; font-size:0.75rem;">RosTop Live Support</div>
          <div>ধন্যবাদ আপনার বার্তার জন্য! আমাদের সাপোর্ট টিম সাধারণত ২-৫ মিনিটের মধ্যে উত্তর দেয়। দ্রুত উত্তরের জন্য সরাসরি হোয়াটসঅ্যাপেও যোগাযোগ করতে পারেন।</div>
          <a href="https://wa.me/8801700000000?text=${encodeURIComponent(text)}" target="_blank" rel="noopener noreferrer" style="display:inline-flex; align-items:center; gap:4px; color:#25D366; font-weight:700; text-decoration:none; margin-top:6px; font-size:0.75rem;">
            <span>WhatsApp-এ সরাসরি কথা বলুন &rarr;</span>
          </a>
        `;
        chatMessages.appendChild(botMsgDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
      }, 600);
    };
  }

  // --- RosTop SaaS Sidebar (Drawer + Desktop Rail) Engine ---
  function initRpSidebar() {
    const rail = document.getElementById('rp-desktop-rail');
    const pinBtns = document.querySelectorAll('.rp-pin-btn');
    const accordionBtns = document.querySelectorAll('.rp-accordion-btn');
    const searchBtns = document.querySelectorAll('.rp-search-trigger');
    const themeOpts = document.querySelectorAll('.rp-theme-opt');
    const currChips = document.querySelectorAll('.rp-curr-chip');
    const countryBtns = document.querySelectorAll('.rp-open-curr-modal');
    const greetings = document.querySelectorAll('.rp-greeting');

    // 1. Dynamic Greeting based on client local time
    const hour = new Date().getHours();
    let greetingText = 'Good day';
    if (hour >= 5 && hour < 12) greetingText = 'Good morning';
    else if (hour >= 12 && hour < 17) greetingText = 'Good afternoon';
    else if (hour >= 17 && hour < 21) greetingText = 'Good evening';
    else greetingText = 'Good night';

    greetings.forEach(el => {
      const userProfile = el.closest('.rp-profile-user');
      if (userProfile && userProfile.querySelector('.rp-user-name')) {
        el.textContent = greetingText;
      } else {
        el.textContent = `${greetingText}, Welcome`;
      }
    });

    // 2. Desktop Rail Pinning (persistent via localStorage)
    const savedPinned = localStorage.getItem('rostop_rail_pinned') === 'true';
    if (savedPinned && rail) {
      document.body.classList.add('rp-rail-pinned');
      rail.classList.add('rp-pinned');
      pinBtns.forEach(b => b.classList.add('pinned'));
    }

    pinBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        const isPinned = document.body.classList.toggle('rp-rail-pinned');
        if (rail) rail.classList.toggle('rp-pinned', isPinned);
        pinBtns.forEach(b => b.classList.toggle('pinned', isPinned));
        localStorage.setItem('rostop_rail_pinned', isPinned ? 'true' : 'false');
      });
    });

    // 3. Accordions inside Sidebar
    accordionBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        const expanded = btn.getAttribute('aria-expanded') === 'true';
        btn.setAttribute('aria-expanded', !expanded);
      });
    });

    // 4. Quick Search Trigger (Ctrl+K)
    searchBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        const globalBtn = document.getElementById('global-search-btn');
        if (globalBtn) {
          globalBtn.click();
        } else {
          const searchModal = document.getElementById('search-modal');
          if (searchModal) {
            searchModal.classList.add('active');
            document.body.style.overflow = 'hidden';
            const input = searchModal.querySelector('input');
            if (input) setTimeout(() => input.focus(), 100);
          }
        }
      });
    });

    // Keyboard shortcut Ctrl+K / Cmd+K
    document.addEventListener('keydown', (e) => {
      if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
        e.preventDefault();
        const globalBtn = document.getElementById('global-search-btn');
        if (globalBtn) globalBtn.click();
      }
    });

    // 5. Theme Segmented Pill Sync
    function syncThemePills(theme) {
      themeOpts.forEach(opt => {
        const val = opt.getAttribute('data-theme-val');
        if (val === theme) {
          opt.classList.add('active');
          opt.setAttribute('aria-checked', 'true');
        } else {
          opt.classList.remove('active');
          opt.setAttribute('aria-checked', 'false');
        }
      });
    }

    const currentTheme = document.documentElement.getAttribute('data-theme') || localStorage.getItem('site-theme') || 'light';
    syncThemePills(currentTheme);

    themeOpts.forEach(opt => {
      opt.addEventListener('click', () => {
        const targetTheme = opt.getAttribute('data-theme-val');
        if (!targetTheme) return;
        document.documentElement.setAttribute('data-theme', targetTheme);
        localStorage.setItem('site-theme', targetTheme);
        syncThemePills(targetTheme);
        showToast(`Switched to ${targetTheme} mode`, 'info');
      });
    });

    // Observe data-theme changes made elsewhere on the site
    const themeObserver = new MutationObserver(() => {
      const activeTheme = document.documentElement.getAttribute('data-theme') || 'light';
      syncThemePills(activeTheme);
    });
    themeObserver.observe(document.documentElement, { attributes: true, attributeFilter: ['data-theme'] });

    // 6. Currency Switcher & Live Product Conversion
    const CURRENCY_RATES = {
      'BDT': { sym: '৳', rate: 1, flag: '🇧🇩', country: 'Bangladesh' },
      'USD': { sym: '$', rate: 124.50, flag: '🇺🇸', country: 'United States' },
      'EUR': { sym: '€', rate: 135.20, flag: '🇪🇺', country: 'European Union' },
      'GBP': { sym: '£', rate: 158.00, flag: '🇬🇧', country: 'United Kingdom' },
      'INR': { sym: '₹', rate: 1.49, flag: '🇮🇳', country: 'India' },
      'AED': { sym: 'د.إ', rate: 33.90, flag: '🇦🇪', country: 'United Arab Emirates' },
      'SAR': { sym: '﷼', rate: 33.20, flag: '🇸🇦', country: 'Saudi Arabia' }
    };

    function applyCurrency(currCode) {
      const meta = CURRENCY_RATES[currCode] || CURRENCY_RATES['BDT'];
      localStorage.setItem('rostop_currency', currCode);

      // Update chip active states in rail & drawer
      currChips.forEach(chip => {
        chip.classList.toggle('active', chip.getAttribute('data-curr') === currCode);
      });

      // Update country labels and flags
      document.querySelectorAll('.rp-dyn-flag').forEach(el => el.textContent = meta.flag);
      document.querySelectorAll('.rp-dyn-country').forEach(el => el.textContent = meta.country);

      // Update header currency pill if present
      const currCodeEl = document.getElementById('curr-code');
      const currSymEl = document.getElementById('curr-sym');
      const currFlagEl = document.getElementById('curr-flag');
      if (currCodeEl) currCodeEl.textContent = currCode;
      if (currSymEl) currSymEl.textContent = meta.sym;
      if (currFlagEl) currFlagEl.textContent = meta.flag;

      // Dynamic Price Conversion across all [data-bdt] elements
      const priceEls = document.querySelectorAll('[data-bdt]');
      priceEls.forEach(el => {
        const bdt = parseFloat(el.getAttribute('data-bdt'));
        if (isNaN(bdt)) return;

        if (currCode === 'BDT') {
          el.textContent = `৳ ${Math.round(bdt).toLocaleString()}`;
        } else {
          const converted = bdt / meta.rate;
          if (converted < 5) {
            el.textContent = `${meta.sym} ${converted.toFixed(2)}`;
          } else {
            el.textContent = `${meta.sym} ${Math.round(converted).toLocaleString()}`;
          }
        }
      });
    }

    // Initialize currency from localStorage key 'rostop_currency' (or fallback)
    const initialCurrency = localStorage.getItem('rostop_currency') || 'BDT';
    applyCurrency(initialCurrency);

    currChips.forEach(chip => {
      chip.addEventListener('click', () => {
        const curr = chip.getAttribute('data-curr');
        if (curr && CURRENCY_RATES[curr]) {
          applyCurrency(curr);
          showToast(`Currency updated to ${curr}`, 'info');
        }
      });
    });

    // 7. Country Selector Modal trigger
    countryBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        const currModal = document.getElementById('currency-modal');
        if (currModal) {
          currModal.classList.add('active');
          document.body.style.overflow = 'hidden';
        }
      });
    });
  }

  // --- VertexBazaar 3-Step Game Top-Up Flow ---
  function initGameTopupFlow() {
    const pkgCards = document.querySelectorAll('.pp-var-card');
    const selectedPkgInput = document.getElementById('selected-package-id');
    const summaryPkgName = document.getElementById('summary-package-name');
    const summaryPkgPrice = document.getElementById('summary-package-price');
    const buyNowPrice = document.getElementById('pp-buy-now-price');
    const clearBtn = document.getElementById('pp-clear-pkg-btn');
    const buyNowBtn = document.getElementById('pp-buy-now-btn');
    const checkoutForm = document.getElementById('game-checkout-form');
    const paymentOptions = document.querySelectorAll('.pp-payment-option');
    const selectedPayInput = document.getElementById('selected-payment-method');

    // Edition / Top-Up Mode Switcher (Modal Picker)
    const noticeAlertText = document.getElementById('pp-notice-alert-text');
    const editionStatusText = document.getElementById('pp-active-edition-status');
    const triggerFlag = document.getElementById('pp-ed-sel-flag');
    const triggerBadge = document.getElementById('pp-ed-sel-badge');
    const triggerSpeed = document.getElementById('pp-ed-sel-speed');
    const ffLabelText = document.getElementById('pp-ff-label-text');
    const ffInput = document.getElementById('input-ff-player-id');
    const ffTipText = document.getElementById('pp-ff-tip-text');
    const pubgLabelText = document.getElementById('pp-pubg-label-text');
    const pubgInput = document.getElementById('input-pubg-player-id');
    const pubgTipText = document.getElementById('pp-pubg-tip-text');
    const stockCountLabel = document.getElementById('pp-stock-count-label');

    function selectPackageCard(card) {
      if (!card) return;
      pkgCards.forEach(c => c.classList.remove('selected'));
      card.classList.add('selected');

      const pkgId = card.getAttribute('data-id');
      const pkgName = card.getAttribute('data-name');
      const pkgPrice = card.getAttribute('data-price');

      if (selectedPkgInput) selectedPkgInput.value = pkgId;
      if (summaryPkgName) summaryPkgName.textContent = pkgName;
      if (summaryPkgPrice) summaryPkgPrice.textContent = `৳ ${pkgPrice}`;
      if (buyNowPrice) buyNowPrice.textContent = `— ৳ ${pkgPrice}`;
      const sidePkg = document.getElementById('side-selected-pkg');
      const sidePrice = document.getElementById('side-selected-price');
      if (sidePkg) sidePkg.textContent = pkgName;
      if (sidePrice) sidePrice.textContent = `৳ ${pkgPrice}`;
      const buyNowPriceMobile = document.getElementById('pp-buy-now-price-mobile');
      if (buyNowPriceMobile) buyNowPriceMobile.textContent = `— ৳ ${pkgPrice}`;
      if (buyNowBtn) buyNowBtn.removeAttribute('disabled');
    }

    function applyEdition(option) {
      if (!option) return;
      const editionOptions = document.querySelectorAll('.pp-edition-option');
      editionOptions.forEach(opt => {
        opt.classList.remove('active');
        opt.setAttribute('aria-selected', 'false');
      });
      option.classList.add('active');
      option.setAttribute('aria-selected', 'true');

      const edKey = option.getAttribute('data-edition-key');
      const edName = option.getAttribute('data-edition-name');
      const edNotice = option.getAttribute('data-edition-notice');
      const edTip = option.getAttribute('data-edition-tip');
      const edInputLabel = option.getAttribute('data-edition-input-label');
      const edInputPlaceholder = option.getAttribute('data-edition-input-placeholder');
      const edFlag = option.getAttribute('data-edition-flag');
      const edBadge = option.getAttribute('data-edition-badge');
      const edSpeed = option.getAttribute('data-edition-speed');

      if (editionStatusText) editionStatusText.textContent = `● ${edName}`;
      if (noticeAlertText && edNotice) noticeAlertText.textContent = edNotice;

      // Update trigger bar
      if (triggerFlag && edFlag) triggerFlag.textContent = edFlag;
      if (triggerBadge) {
        if (edBadge) {
          triggerBadge.textContent = edBadge;
          triggerBadge.style.display = '';
        } else {
          triggerBadge.style.display = 'none';
        }
      }
      if (triggerSpeed && edSpeed) triggerSpeed.textContent = edSpeed;

      // Update Free Fire input field if present
      if (ffInput && edInputPlaceholder) ffInput.placeholder = edInputPlaceholder;
      if (ffLabelText && edInputLabel) ffLabelText.innerHTML = `${edInputLabel} <span class="req">*</span>`;
      if (ffTipText && edTip) ffTipText.textContent = edTip;

      // Update PUBG input field if present
      if (pubgInput && edInputPlaceholder) pubgInput.placeholder = edInputPlaceholder;
      if (pubgLabelText && edInputLabel) pubgLabelText.innerHTML = `${edInputLabel} <span class="req">*</span>`;
      if (pubgTipText && edTip) pubgTipText.textContent = edTip;

      // Filter package cards
      let visibleCount = 0;
      let firstMatchingCard = null;
      pkgCards.forEach(card => {
        const cardEd = card.getAttribute('data-edition');
        if (cardEd === edKey) {
          card.style.display = '';
          visibleCount++;
          if (!firstMatchingCard) firstMatchingCard = card;
        } else {
          card.style.display = 'none';
        }
      });

      if (stockCountLabel) {
        stockCountLabel.textContent = `● ${visibleCount} Packages In Stock`;
      }

      // Auto-select the first card of the new edition
      if (firstMatchingCard) {
        selectPackageCard(firstMatchingCard);
      }
    }

    const editionOptions = document.querySelectorAll('.pp-edition-option');
    if (editionOptions.length > 0) {
      editionOptions.forEach(option => {
        option.addEventListener('click', () => {
          applyEdition(option);
          closeEditionPickerModal();
        });
      });
    }

    // 1. Package Selection
    if (pkgCards.length > 0) {
      pkgCards.forEach(card => {
        card.addEventListener('click', () => selectPackageCard(card));
      });
    }

    // 2. Clear Button
    if (clearBtn && pkgCards.length > 0) {
      clearBtn.addEventListener('click', (e) => {
        e.preventDefault();
        pkgCards.forEach(c => c.classList.remove('selected'));
        if (selectedPkgInput) selectedPkgInput.value = '';
        if (summaryPkgName) summaryPkgName.textContent = 'None';
        if (summaryPkgPrice) summaryPkgPrice.textContent = '৳ 0';
        if (buyNowPrice) buyNowPrice.textContent = '— Select Package';
        const sidePkg = document.getElementById('side-selected-pkg');
        const sidePrice = document.getElementById('side-selected-price');
        if (sidePkg) sidePkg.textContent = 'None';
        if (sidePrice) sidePrice.textContent = '৳ 0';
        const buyNowPriceMobile = document.getElementById('pp-buy-now-price-mobile');
        if (buyNowPriceMobile) buyNowPriceMobile.textContent = '— Select Package';
        if (buyNowBtn) buyNowBtn.setAttribute('disabled', 'true');
      });
    }

    // 3. Payment Option Selection
    if (paymentOptions.length > 0) {
      paymentOptions.forEach(opt => {
        opt.addEventListener('click', () => {
          paymentOptions.forEach(o => o.classList.remove('selected'));
          opt.classList.add('selected');

          const radio = opt.querySelector('input[type="radio"]');
          if (radio) radio.checked = true;

          const methodVal = opt.getAttribute('data-method');
          if (selectedPayInput && methodVal) {
            selectedPayInput.value = methodVal;
          }
        });
      });
    }

    // 4. Tab Navigation (Description, Guide, Reviews)
    const tabBtns = document.querySelectorAll('.pp-tab-nav-btn');
    const tabPanes = document.querySelectorAll('.pp-tab-pane');
    if (tabBtns.length > 0) {
      tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
          const targetTab = btn.getAttribute('data-tab');
          tabBtns.forEach(b => b.classList.remove('active'));
          tabPanes.forEach(p => p.classList.remove('active'));

          btn.classList.add('active');
          const pane = document.getElementById(`tab-${targetTab}`);
          if (pane) pane.classList.add('active');
        });
      });
    }

    // 5. Buy Now Validation & Smooth Scroll
    if (checkoutForm && buyNowBtn) {
      checkoutForm.addEventListener('submit', (e) => {
        // Check package
        if (selectedPkgInput && !selectedPkgInput.value) {
          e.preventDefault();
          showToast('অনুগ্রহ করে একটি প্যাকেজ সিলেক্ট করুন (Please select a package)', 'warning');
          const firstCard = document.querySelector('.pp-var-card');
          if (firstCard) firstCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
          return;
        }

        // Check required input fields in Step 2
        const requiredInputs = checkoutForm.querySelectorAll('.pp-input[required]');
        for (let input of requiredInputs) {
          if (!input.value.trim()) {
            e.preventDefault();
            const label = input.closest('.pp-input-group')?.querySelector('.pp-input-label span:first-child')?.textContent || 'তথ্য';
            showToast(`অনুগ্রহ করে আপনার ${label} দিন`, 'warning');
            input.focus();
            input.classList.add('input-shake');
            setTimeout(() => input.classList.remove('input-shake'), 600);
            input.scrollIntoView({ behavior: 'smooth', block: 'center' });
            return;
          }
        }
      });
    }
  }

  // --- Subcategory / Regional Editions Modal (Screenshots 4 & 5) ---
  function initGameEditionsModal() {
    const modal = document.getElementById('game-editions-modal');
    if (!modal) return;

    const modalTitle = document.getElementById('game-editions-title');
    const modalGrid = document.getElementById('game-editions-grid');
    const modalCloseBtn = document.getElementById('game-editions-close');
    const seeAllBtn = document.getElementById('game-editions-all-link');

    const EDITIONS_DATA = {
      'free-fire': {
        title: 'FREE FIRE',
        link: '/game-topup/free-fire',
        items: [
          { name: 'Free Fire BD', flag: '🇧🇩', badge: '10 সেকেন্ড ডেলিভারি', meta: '5.0 | 142k+ Sold', slug: 'free-fire', img: '/images/games/freefire.jpg' },
          { name: 'Free Fire Indonesia Top Up', flag: '🇮🇩', badge: 'Automated', meta: '5.0 | 2.2k+ Sold', slug: 'free-fire', img: '/images/games/freefire.jpg' },
          { name: 'Free Fire Membership', flag: '🇧🇩', badge: '10 সেকেন্ড ডেলিভারি', meta: '5.0 | 1.4k+ Sold', slug: 'free-fire', img: '/images/games/freefire.jpg' },
          { name: 'Free Fire Level Up Pass', flag: '🇧🇩', badge: 'Automated', meta: '5.0 | 1.2k+ Sold', slug: 'free-fire', img: '/images/games/freefire.jpg' },
          { name: 'Free Fire Weekly Lite', flag: '🇧🇩', badge: '10 সেকেন্ড ডেলিভারি', meta: '5.0 | 461 Sold', slug: 'free-fire', img: '/images/games/freefire.jpg' },
          { name: 'Free Fire Mystery Box', flag: '🇧🇩', badge: 'Automated', meta: '5.0 | 446 Sold', slug: 'free-fire', img: '/images/games/freefire.jpg' },
          { name: 'Garena Shell Indonesia', flag: '🇮🇩', badge: 'Automated', meta: '5.0 | 50 Sold', slug: 'free-fire', img: '/images/games/freefire.jpg' },
          { name: 'Free Fire MY/SG', flag: '🇲🇾', badge: 'Automated', meta: '5.0 | 10 Sold', slug: 'free-fire', img: '/images/games/freefire.jpg' },
          { name: 'Free Fire Voucher (USD)', flag: '🌐', badge: 'Automated', meta: '3 Sold', slug: 'free-fire', img: '/images/games/freefire.jpg' },
          { name: 'Free Fire: EVO ACCESS', flag: '🇧🇩', badge: '10 সেকেন্ড ডেলিভারি', meta: '5.0 | 85 Sold', slug: 'free-fire', img: '/images/games/freefire.jpg' },
          { name: 'Garena Shells Malaysia', flag: '🇲🇾', badge: 'Automated', meta: '5.0 | 4 Sold', slug: 'free-fire', img: '/images/games/freefire.jpg' },
          { name: 'Garena Shell Singapore (BD Shell)', flag: '🇸🇬', badge: 'Automated', meta: '5.0 | 27 Sold', slug: 'free-fire', img: '/images/games/freefire.jpg' },
        ]
      },
      'pubg-mobile': {
        title: 'PUBG MOBILE',
        link: '/game-topup/pubg-mobile',
        items: [
          { name: 'PUBG Mobile (Global)', flag: '🌐', badge: '⚡ Automated', meta: '5.0 | 2.4k+ Sold', slug: 'pubg-mobile', img: '/images/games/pubg.jpg' },
          { name: 'PUBG Mobile Packs', flag: '🌐', badge: '⚡ Automated', meta: '5.0 | 336 Sold', slug: 'pubg-mobile', img: '/images/games/pubg.jpg' },
          { name: 'PUBG Mobile WOW Coins', flag: '🌐', badge: '⚡ Automated', meta: '5.0 | 120 Sold', slug: 'pubg-mobile', img: '/images/games/pubg.jpg' },
          { name: 'PUBG Mobile Voucher (Global)', flag: '🌐', badge: '⚡ Automated', meta: '5.0 | 38 Sold', slug: 'pubg-mobile', img: '/images/games/pubg.jpg' },
          { name: 'PUBG Mobile New State NC', flag: '🌐', badge: '⚡ Automated', meta: '1 Sold', slug: 'pubg-mobile', img: '/images/games/pubg.jpg' },
          { name: 'PUBG Mobile Taiwan', flag: '🇹🇼', badge: '⚡ Automated', meta: '1 Sold', slug: 'pubg-mobile', img: '/images/games/pubg.jpg' },
          { name: 'PUBG Mobile Malaysia', flag: '🇲🇾', badge: '⚡ Automated', meta: '5.0 | 92 Sold', slug: 'pubg-mobile', img: '/images/games/pubg.jpg' },
          { name: 'PUBG Mobile Indonesia', flag: '🇮🇩', badge: '⚡ Automated', meta: '5.0 | 114 Sold', slug: 'pubg-mobile', img: '/images/games/pubg.jpg' },
          { name: 'PUBG Mobile Russia', flag: '🇷🇺', badge: '⚡ Automated', meta: '5.0 | 48 Sold', slug: 'pubg-mobile', img: '/images/games/pubg.jpg' },
        ]
      },
      'mobile-legends': {
        title: 'MOBILE LEGENDS (MLBB)',
        link: '/game-topup/mobile-legends',
        items: [
          { name: 'MLBB Diamonds Global', flag: '🌐', badge: '⚡ Instant', meta: '5.0 | 42k+ Sold', slug: 'mobile-legends', img: '/images/games/mlbb.jpg' },
          { name: 'MLBB Weekly Diamond Pass', flag: '🌐', badge: '⚡ Instant', meta: '5.0 | 14k+ Sold', slug: 'mobile-legends', img: '/images/games/mlbb.jpg' },
          { name: 'MLBB Twilight Pass', flag: '🌐', badge: '⚡ Instant', meta: '5.0 | 3.8k+ Sold', slug: 'mobile-legends', img: '/images/games/mlbb.jpg' },
          { name: 'MLBB 50+50 Double Bonus', flag: '🌐', badge: '100% Bonus', meta: '5.0 | 8.9k+ Sold', slug: 'mobile-legends', img: '/images/games/mlbb.jpg' },
          { name: 'MLBB 150+150 Double Bonus', flag: '🌐', badge: '100% Bonus', meta: '5.0 | 6.5k+ Sold', slug: 'mobile-legends', img: '/images/games/mlbb.jpg' },
          { name: 'MLBB Monthly Elite Pack', flag: '🌐', badge: 'VIP Pack', meta: '5.0 | 2.1k+ Sold', slug: 'mobile-legends', img: '/images/games/mlbb.jpg' },
          { name: 'MLBB Starlight Member', flag: '🌐', badge: '⚡ Instant', meta: '5.0 | 5.2k+ Sold', slug: 'mobile-legends', img: '/images/games/mlbb.jpg' },
        ]
      }
    };

    function openModal(gameKey) {
      const data = EDITIONS_DATA[gameKey];
      if (!data) return;

      modalTitle.textContent = data.title;
      if (seeAllBtn) seeAllBtn.href = data.link;

      modalGrid.innerHTML = data.items.map(item => `
        <a href="${item.slug.startsWith('/') ? item.slug : '/game-topup/' + item.slug}" class="game-edition-card">
          <div class="game-edition-thumb">
            <img src="${item.img}" alt="${item.name}" loading="lazy">
            ${item.flag ? `<span class="game-edition-flag">${item.flag}</span>` : ''}
            <span class="game-edition-badge">${item.badge}</span>
          </div>
          <div class="game-edition-info">
            <div class="game-edition-name" title="${item.name}">${item.name}</div>
            <div class="game-edition-meta">
              <span class="rating">★</span>
              <span>${item.meta}</span>
            </div>
          </div>
        </a>
      `).join('');

      modal.classList.add('show');
      document.body.style.overflow = 'hidden';
    }

    function closeModal() {
      modal.classList.remove('show');
      document.body.style.overflow = '';
    }

    // Trigger buttons via event delegation
    document.addEventListener('click', (e) => {
      const trigger = e.target.closest('[data-open-editions]');
      if (trigger) {
        e.preventDefault();
        e.stopPropagation();
        const gameKey = trigger.getAttribute('data-open-editions');
        openModal(gameKey);
      }
    });

    window.openGameEditionsModal = openModal;
    window.closeGameEditionsModal = closeModal;

    if (modalCloseBtn) modalCloseBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', (e) => {
      if (e.target === modal) closeModal();
    });
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && modal.classList.contains('show')) closeModal();
    });
  }

  // --- Edition Picker Modal (Product Detail) ---
  function closeEditionPickerModal() {
    const modal = document.getElementById('pp-edition-picker-modal');
    const trigger = document.getElementById('pp-edition-selected-trigger');
    if (modal && modal.classList.contains('show')) {
      modal.classList.remove('show');
      modal.setAttribute('hidden', '');
      document.body.style.overflow = '';
      if (trigger) {
        trigger.setAttribute('aria-expanded', 'false');
        trigger.focus();
      }
    }
  }

  function initEditionPickerModal() {
    const modal = document.getElementById('pp-edition-picker-modal');
    const trigger = document.getElementById('pp-edition-selected-trigger');
    if (!modal || !trigger) return;

    trigger.addEventListener('click', () => {
      const isExpanded = trigger.getAttribute('aria-expanded') === 'true';
      if (isExpanded) {
        closeEditionPickerModal();
      } else {
        modal.removeAttribute('hidden');
        requestAnimationFrame(() => modal.classList.add('show'));
        document.body.style.overflow = 'hidden';
        trigger.setAttribute('aria-expanded', 'true');
        const activeOption = modal.querySelector('.pp-edition-option.active') || modal.querySelector('.pp-edition-option');
        if (activeOption) activeOption.focus();
      }
    });

    modal.querySelectorAll('[data-edition-close]').forEach(btn => {
      btn.addEventListener('click', () => closeEditionPickerModal());
    });

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && modal.classList.contains('show')) {
        closeEditionPickerModal();
      }
    });
  }

  // --- Quick Tools Hub (Price Check, USDT Converter, Live Rates) ---
  function initQuickTools() {
    const panePrice = document.getElementById('hp-qt-pane-price');
    if (!panePrice) return;

    // Mini tabs switching
    const tabs = document.querySelectorAll('.hp-qt-tab');
    const panes = document.querySelectorAll('.hp-qt-pane');

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        tabs.forEach(t => {
          t.classList.remove('active');
          t.setAttribute('aria-selected', 'false');
        });
        panes.forEach(p => p.classList.remove('active'));

        tab.classList.add('active');
        tab.setAttribute('aria-selected', 'true');
        const targetId = tab.getAttribute('data-pane');
        const target = document.getElementById(targetId);
        if (target) target.classList.add('active');
      });
    });

    // 1. Price Check Tool
    const gameSelect = document.getElementById('hp-qt-game');
    const pkgSelect = document.getElementById('hp-qt-package');
    const pkgNameDisp = document.getElementById('hp-qt-pkg-name');
    const pkgPriceDisp = document.getElementById('hp-qt-pkg-price');
    const goBtn = document.getElementById('hp-qt-go');
    const dataScript = document.getElementById('hp-qt-packages');

    let packagesData = {};
    if (dataScript) {
      try {
        packagesData = JSON.parse(dataScript.textContent);
      } catch (e) {
        console.error('Error parsing hp-qt-packages JSON', e);
      }
    }

    function updatePriceCheckResult() {
      if (!gameSelect || !pkgSelect) return;
      const gameSlug = gameSelect.value;
      const selectedOption = pkgSelect.options[pkgSelect.selectedIndex];
      const pkgName = selectedOption ? selectedOption.value : '';
      const pkgPrice = selectedOption ? parseFloat(selectedOption.getAttribute('data-price') || 0) : 0;

      if (pkgNameDisp) pkgNameDisp.textContent = pkgName || 'Select Package';
      if (pkgPriceDisp) pkgPriceDisp.innerHTML = `&#2547; ${pkgPrice.toLocaleString('en-US')}`;

      if (goBtn) {
        goBtn.href = `/game-topup/${gameSlug}?pkg=${encodeURIComponent(pkgName)}`;
      }
    }

    if (gameSelect && pkgSelect) {
      gameSelect.addEventListener('change', () => {
        const slug = gameSelect.value;
        const pkgs = packagesData[slug] || [];

        pkgSelect.innerHTML = '';
        pkgs.forEach(pkg => {
          const opt = document.createElement('option');
          opt.value = pkg.name;
          opt.setAttribute('data-price', pkg.price);
          opt.textContent = `${pkg.name} — ৳${pkg.price.toLocaleString('en-US')}`;
          pkgSelect.appendChild(opt);
        });

        updatePriceCheckResult();
      });

      pkgSelect.addEventListener('change', updatePriceCheckResult);
    }

    // 2. USDT Converter Tool
    const dirUsdt2Bdt = document.getElementById('hp-qt-dir-usdt2bdt');
    const dirBdt2Usdt = document.getElementById('hp-qt-dir-bdt2usdt');
    const usdtAmount = document.getElementById('hp-qt-usdt-amount');
    const usdtLabel = document.getElementById('hp-qt-usdt-label');
    const usdtSublabel = document.getElementById('hp-qt-usdt-sublabel');
    const usdtResult = document.getElementById('hp-qt-usdt-result');

    let currentDirection = 'usdt2bdt';
    const USDT_RATE = 128.0;

    function recalculateUsdt() {
      if (!usdtAmount || !usdtResult) return;
      const val = parseFloat(usdtAmount.value) || 0;

      if (currentDirection === 'usdt2bdt') {
        const bdt = val * USDT_RATE;
        usdtResult.innerHTML = `&#2547; ${bdt.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
      } else {
        const usdt = val / USDT_RATE;
        usdtResult.innerHTML = `$ ${usdt.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
      }
    }

    if (dirUsdt2Bdt && dirBdt2Usdt) {
      dirUsdt2Bdt.addEventListener('click', () => {
        currentDirection = 'usdt2bdt';
        dirUsdt2Bdt.classList.add('active');
        dirBdt2Usdt.classList.remove('active');
        if (usdtLabel) usdtLabel.textContent = 'USDT Amount ($)';
        if (usdtSublabel) usdtSublabel.textContent = 'Approximate Value';
        if (usdtResult) usdtResult.style.color = 'var(--vb-emerald)';
        if (usdtAmount && (!usdtAmount.value || usdtAmount.value === '1280')) usdtAmount.value = '10';
        recalculateUsdt();
      });

      dirBdt2Usdt.addEventListener('click', () => {
        currentDirection = 'bdt2usdt';
        dirBdt2Usdt.classList.add('active');
        dirUsdt2Bdt.classList.remove('active');
        if (usdtLabel) usdtLabel.textContent = 'BDT Amount (৳)';
        if (usdtSublabel) usdtSublabel.textContent = 'Approximate Value';
        if (usdtResult) usdtResult.style.color = 'var(--vb-orange)';
        if (usdtAmount && (!usdtAmount.value || usdtAmount.value === '10')) usdtAmount.value = '1280';
        recalculateUsdt();
      });
    }

    if (usdtAmount) {
      usdtAmount.addEventListener('input', recalculateUsdt);
    }
  }

  // --- Mobile Dual-Terminal Tabs (<992px Only) ---
  function initDualTerminalTabs() {
    const track = document.getElementById('hp-dual-track');
    const tabs = document.querySelectorAll('.hp-dual-tab');
    const dots = document.querySelectorAll('.hp-dual-dot');
    const viewport = document.querySelector('.hp-dual-viewport');
    const swipeHint = document.querySelector('.hp-dual-swipe-hint');
    const panels = document.querySelectorAll('.hp-dual-panel');

    if (!track || tabs.length === 0) return;

    let currentIndex = 0;

    function setIndex(index) {
      if (index < 0) index = 0;
      if (index > 1) index = 1;
      currentIndex = index;

      // Update track attribute
      track.setAttribute('data-active-index', String(index));

      // Update tabs
      tabs.forEach((tab, i) => {
        const isActive = i === index;
        tab.classList.toggle('active', isActive);
        tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
      });

      // Update dots
      dots.forEach((dot, i) => {
        dot.classList.toggle('active', i === index);
      });

      // Accessibility / keyboard safety on inactive panel
      panels.forEach((panel, i) => {
        if (i === index) {
          panel.removeAttribute('inert');
          panel.querySelectorAll('button, input, select, a').forEach(el => el.removeAttribute('tabindex'));
        } else {
          panel.setAttribute('inert', '');
          panel.querySelectorAll('button, input, select, a').forEach(el => el.setAttribute('tabindex', '-1'));
        }
      });
    }

    // Tab click handlers
    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        const idx = parseInt(tab.getAttribute('data-index') || '0', 10);
        setIndex(idx);
        if (swipeHint) swipeHint.classList.add('hint-hidden');
      });
    });

    // Dot click handlers
    dots.forEach(dot => {
      dot.addEventListener('click', () => {
        const idx = parseInt(dot.getAttribute('data-index') || '0', 10);
        setIndex(idx);
        if (swipeHint) swipeHint.classList.add('hint-hidden');
      });
    });

    // Swipe gesture support on viewport (<992px)
    if (viewport) {
      let touchStartX = 0;
      let touchStartY = 0;

      viewport.addEventListener('touchstart', (e) => {
        if (e.touches.length === 1) {
          touchStartX = e.touches[0].screenX;
          touchStartY = e.touches[0].screenY;
        }
      }, { passive: true });

      viewport.addEventListener('touchend', (e) => {
        if (e.changedTouches.length === 1) {
          const deltaX = e.changedTouches[0].screenX - touchStartX;
          const deltaY = e.changedTouches[0].screenY - touchStartY;

          // Only trigger if horizontal swipe is dominant and exceeds 50px
          if (Math.abs(deltaX) >= 50 && Math.abs(deltaX) > Math.abs(deltaY)) {
            if (deltaX < 0 && currentIndex === 0) {
              setIndex(1); // Swipe left -> next
              if (swipeHint) swipeHint.classList.add('hint-hidden');
            } else if (deltaX > 0 && currentIndex === 1) {
              setIndex(0); // Swipe right -> prev
              if (swipeHint) swipeHint.classList.add('hint-hidden');
            }
          }
        }
      }, { passive: true });
    }

    // Initialize at index 0
    setIndex(0);
  }

  /* ==========================================================================
     Locale / Country / Currency state engine (mock panel + header pill)
     Storage keys: rostop_locale (en|bn|hi), rostop_country (BD|IN|US|...),
     rostop_currency (BDT|USD|...) — first visit auto-detects country by IP.
     ========================================================================== */
  function initLocaleCurrency() {
    const LS = { locale: 'rostop_locale', country: 'rostop_country', currency: 'rostop_currency' };

    const COUNTRIES = {
      BD: { name: 'Bangladesh',      flag: 'bd', curr: 'BDT' },
      IN: { name: 'India',           flag: 'in', curr: 'INR' },
      US: { name: 'United States',   flag: 'us', curr: 'USD' },
      AE: { name: 'UAE',             flag: 'ae', curr: 'AED' },
      SA: { name: 'Saudi Arabia',    flag: 'sa', curr: 'SAR' },
      GB: { name: 'United Kingdom',  flag: 'gb', curr: 'GBP' },
      EU: { name: 'Europe',          flag: 'eu', curr: 'EUR' },
    };
    const EU_SET = 'AT,BE,BG,HR,CY,CZ,DK,EE,FI,FR,DE,GR,HU,IE,IT,LV,LT,LU,MT,NL,PL,PT,RO,SK,SI,ES,SE';

    const CURRENCIES = {
      BDT: { sym: '৳',    name: 'Bangladeshi Taka' },
      INR: { sym: '₹',    name: 'Indian Rupee' },
      USD: { sym: '$',    name: 'US Dollar' },
      EUR: { sym: '€',    name: 'Euro' },
      GBP: { sym: '£',    name: 'British Pound' },
      AED: { sym: 'AED',  name: 'UAE Dirham' },
      SAR: { sym: 'SAR',  name: 'Saudi Riyal' },
      USDT:{ sym: '₮',    name: 'Tether USD' },
    };

    const LANG_LABELS = { en: 'English', bn: 'Bangla', hi: 'Hindi' };

    const state = {
      locale:   localStorage.getItem(LS.locale) || 'en',
      country:  localStorage.getItem(LS.country) || null,
      currency: localStorage.getItem(LS.currency) || 'BDT',
    };

    const flagUrl = (code) => `/images/flags/${code}.svg`;

    function persist() {
      localStorage.setItem(LS.locale, state.locale);
      localStorage.setItem(LS.country, state.country);
      localStorage.setItem(LS.currency, state.currency);
    }

    function syncUi() {
      const cMeta = COUNTRIES[state.country] || COUNTRIES.BD;
      const mMeta = CURRENCIES[state.currency] || CURRENCIES.BDT;

      // Header pill
      const flagEl = document.getElementById('lc-pill-flag');
      if (flagEl) { flagEl.src = flagUrl(cMeta.flag); flagEl.alt = cMeta.name; }
      const langEl = document.getElementById('lc-pill-lang');
      if (langEl) langEl.textContent = `${state.locale.toUpperCase()}-${state.country}`;
      const currEl = document.getElementById('active-curr-code');
      if (currEl) currEl.textContent = state.currency;

      // Drawer trigger sync
      const drawerFlag = document.getElementById('drawer-flag-img');
      if (drawerFlag) { drawerFlag.src = flagUrl(cMeta.flag); drawerFlag.alt = cMeta.name; }
      const drawerLabel = document.getElementById('drawer-lc-label');
      if (drawerLabel) drawerLabel.textContent = `${state.locale.toUpperCase()}-${state.country} / ${state.currency}`;
      const drawerChip = document.getElementById('drawer-curr-chip');
      if (drawerChip) drawerChip.textContent = `${mMeta.sym} ${state.currency}`;

      // All [data-lc-scope] instances (modal + drawer)
      document.querySelectorAll('[data-lc-country]').forEach(s => { s.value = state.country; });
      document.querySelectorAll('[data-lc-lang]').forEach(s => { s.value = state.locale; });
      document.querySelectorAll('[data-lc-curr]').forEach(s => { s.value = state.currency; });

      document.querySelectorAll('[data-lc-country-text]').forEach(el => { el.textContent = cMeta.name; });
      document.querySelectorAll('[data-lc-country-flag]').forEach(el => { el.src = flagUrl(cMeta.flag); });
      document.querySelectorAll('[data-lc-lang-text]').forEach(el => { el.textContent = LANG_LABELS[state.locale] || 'English'; });
      document.querySelectorAll('[data-lc-curr-text]').forEach(el => { el.textContent = `${mMeta.name} (${mMeta.sym})`; });
      document.querySelectorAll('[data-lc-curr-sym]').forEach(el => { el.textContent = mMeta.sym; });
    }

    function navigateToLocale(locale) {
      const segs = window.location.pathname.replace(/^\//, '').split('/').filter(Boolean);
      if (segs.length && ['en', 'bn', 'hi'].includes(segs[0])) segs.shift();
      const base = segs.join('/');
      const dest = locale === 'en'
        ? '/' + base
        : '/' + locale + (base ? '/' + base : '');
      if (dest !== window.location.pathname) window.location.assign(dest);
    }

    // --- Event bindings (one per instance, all class/data based) ---
    document.querySelectorAll('[data-lc-country]').forEach(sel => {
      sel.addEventListener('change', () => {
        state.country = sel.value;
        // Explicit country change: also move currency to the country default
        state.currency = (COUNTRIES[state.country] || {}).curr || state.currency;
        persist();
        syncUi();
        if (typeof applyCurrency === 'function') applyCurrency(state.currency);
      });
    });

    document.querySelectorAll('[data-lc-curr]').forEach(sel => {
      sel.addEventListener('change', () => {
        state.currency = sel.value;
        persist();
        syncUi();
        if (typeof applyCurrency === 'function') applyCurrency(state.currency);
      });
    });

    document.querySelectorAll('[data-lc-lang]').forEach(sel => {
      sel.addEventListener('change', () => {
        const next = sel.value;
        if (next === state.locale) return;
        state.locale = next;
        persist();
        syncUi();
        navigateToLocale(next);
      });
    });

    // Save button (modal): commit + close + toast
    document.querySelectorAll('[data-lc-save]').forEach(btn => {
      btn.addEventListener('click', () => {
        persist();
        const modal = document.getElementById('currency-modal');
        if (modal) modal.classList.remove('active');
        document.body.style.overflow = '';
        const cur = document.documentElement.lang || 'en';
        const savedMsg = cur === 'bn' ? 'সেটিংস সেভ হয়েছে' : (cur === 'hi' ? 'सेटिंग्स सहेजी गईं' : 'Settings saved');
        showToast(savedMsg, 'success');
      });
    });

    // --- First visit: auto-detect country by IP (silent, 2.5s timeout) ---
    if (!state.country) {
      const ctrl = new AbortController();
      const t = setTimeout(() => ctrl.abort(), 2500);
      fetch('https://api.country.is', { signal: ctrl.signal })
        .then(r => r.json())
        .then(data => {
          clearTimeout(t);
          const iso = (data && data.country) || 'BD';
          let key = ['BD', 'IN', 'US', 'AE', 'SA', 'GB'].includes(iso)
            ? iso
            : (EU_SET.includes(iso) ? 'EU' : 'BD');
          state.country = key;
          if (!localStorage.getItem(LS.currency)) {
            state.currency = (COUNTRIES[key] || {}).curr || 'BDT';
          }
          persist();
          syncUi();
        })
        .catch(() => {
          clearTimeout(t);
          state.country = 'BD';
          persist();
          syncUi();
        });
    } else {
      syncUi();
    }
  }

})();
