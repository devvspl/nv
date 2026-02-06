<!-- Sticky Contact (Right Side) -->
<div class="sticky-contact" id="stickyContact" aria-label="Quick contact options">
  <!-- Toggle for mobile -->
  <button class="sticky-toggle" id="stickyToggle" aria-label="Open contact options" type="button">
    <!-- simple "chat" icon -->
    <svg viewBox="0 0 24 24" aria-hidden="true">
      <path d="M4 4h16v11H7.6L4 18.2V4zm2 2v8.1l1.8-1.1H18V6H6z"/>
    </svg>
  </button>

  <a class="sticky-item wa" href="https://wa.me/919990186086" target="_blank" rel="noopener"
     aria-label="Chat on WhatsApp">
    <span class="icon">
      <!-- WhatsApp icon -->
      <svg viewBox="0 0 24 24" aria-hidden="true">
        <path d="M12 2a9.5 9.5 0 0 0-8.2 14.2L2 22l6-1.6A9.5 9.5 0 1 0 12 2zm0 17.3a7.8 7.8 0 0 1-4-1.1l-.3-.2-3.5.9.9-3.4-.2-.4A7.8 7.8 0 1 1 12 19.3zm4.6-5.1c-.3-.1-1.8-.9-2.1-1s-.5-.1-.7.1-.8 1-.9 1.2-.3.2-.6.1a6.4 6.4 0 0 1-1.9-1.2 7 7 0 0 1-1.3-1.6c-.1-.3 0-.5.1-.6l.4-.5c.1-.2.2-.3.3-.5.1-.2 0-.4 0-.6s-.7-1.7-1-2.3c-.3-.6-.6-.5-.7-.5h-.6c-.2 0-.6.1-.9.4s-1.2 1.1-1.2 2.7 1.2 3.1 1.4 3.3 2.4 3.7 5.8 5.1c.8.3 1.4.5 1.9.6.8.2 1.6.2 2.2.1.7-.1 1.8-.7 2-1.4s.3-1.3.2-1.4-.3-.2-.6-.3z"/>
      </svg>
    </span>
    <span class="label">WhatsApp</span>
  </a>

  <a class="sticky-item call" href="tel:+919990186086" aria-label="Call now">
    <span class="icon">
      <!-- Phone icon -->
      <svg viewBox="0 0 24 24" aria-hidden="true">
        <path d="M6.6 10.8c1.6 3 3.7 5.2 6.6 6.6l2.2-2.2c.3-.3.7-.4 1.1-.3 1.2.4 2.5.6 3.8.6.6 0 1 .4 1 1V21c0 .6-.4 1-1 1C10.4 22 2 13.6 2 3c0-.6.4-1 1-1h3.9c.6 0 1 .4 1 1 0 1.3.2 2.6.6 3.8.1.4 0 .8-.3 1.1l-2.2 2.2z"/>
      </svg>
    </span>
    <span class="label">Call Now</span>
  </a>

  <a class="sticky-item email" href="mailto:info@zendoindia.com" aria-label="Send email">
    <span class="icon">
      <!-- Mail icon -->
      <svg viewBox="0 0 24 24" aria-hidden="true">
        <path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4-8 5L4 8V6l8 5 8-5v2z"/>
      </svg>
    </span>
    <span class="label">Email Us</span>
  </a>
</div>

<style>
 
  .sticky-contact{
    position: fixed;
    right: 10px;
    top: 45%;
    transform: translateY(-50%);
    z-index: 9999;
    display: flex;
    flex-direction: column;
    gap: 10px;
    font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
  }

  /* ====== Items (slide-out like screenshot) ====== */
  .sticky-item{
  position: relative;
  width: 52px;
  height: 52px;
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: flex-start; /* IMPORTANT */
  text-decoration: none;
  overflow: hidden;
  box-shadow: 0 10px 25px rgba(0,0,0,.18);
  transition: width .25s ease, transform .25s ease;
  padding-right: 12px;
}

/* icon fixed width */
.sticky-item .icon{
  width: 52px;
  min-width: 52px;
  height: 52px;
  display: flex;
  align-items: center;
  justify-content: center;
}


  .sticky-item svg{
    width: 22px;
    height: 22px;
    fill: #fff;
  }

  .sticky-item .label{
    position: absolute;
    right: 52px;
    white-space: nowrap;
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    padding: 0 5px;
    opacity: 0;
    transform: translateX(10px);
    transition: opacity .22s ease, transform .22s ease;
  }

  /* Hover slide-out (desktop) */
  @media (hover:hover){
    .sticky-item:hover{
      width: 160px;
      transform: translateX(-6px);
    }
    .sticky-item:hover .label{
      opacity: 1;
      transform: translateX(0);
    }
  }

  /* Colors */
  .sticky-item.wa{ background: #25D366; }
  .sticky-item.call{ background: #3B82F6; }
  .sticky-item.email{ background: #111827; }

  /* ====== Mobile behavior (no hover) ====== */
  .sticky-toggle{
    display: none;
    width: 56px;
    height: 56px;
    border-radius: 16px;
    border: none;
    cursor: pointer;
    background: #F59E0B;
    box-shadow: 0 10px 25px rgba(0,0,0,.18);
  }
  .sticky-toggle svg{ width: 22px; height: 22px; fill:#fff; }

  @media (max-width: 768px){
    .sticky-contact{
      top: auto;
      bottom: 18px;
      transform: none;
    }
    .sticky-toggle{ display: grid; place-items: center; }

    /* collapse items by default on mobile */
    .sticky-contact .sticky-item{
      width: 52px;
      height: 52px;
      opacity: 0;
      transform: translateY(10px);
      pointer-events: none;
    }

    /* open state */
    .sticky-contact.is-open .sticky-item{
      opacity: 1;
      transform: translateY(0);
      pointer-events: auto;
    }
  }

  /* Reduced motion support */
  @media (prefers-reduced-motion: reduce){
    .sticky-item, .sticky-item .label{ transition: none; }
  }
</style>