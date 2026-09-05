# Homepage UX & Visual Hierarchy Guidelines

## 1. Top Showcase Layout Sequence
The homepage above-the-fold showcase follows this exact sequence:
1. **Top Section Header (`.hp-top-header mb-3`)**: Eyebrow badge, primary title ("Game Top-Up & Digital Subscriptions. Sell Gift Cards for Instant bKash."), and localized Bengali subtitle.
2. **Compact Banner Slider (`.hp-hero-compact-banner mb-3` with `.hp-slide-overlay`)**: Compact full-width banner (~240px desktop, ~165px mobile) without duplicate category tabs above it.
3. **Category Quick-Nav Tiles (`.hp-top-cats-grid mb-3`)**: The 5 core verticals directly underneath the banner:
   - 🎮 **Game Top-Up** (`FF, PUBG, MLBB`)
   - 💳 **Sell Cards** (`84–90% Cashout`)
   - 📺 **Subscriptions** (`Netflix, ChatGPT`)
   - 🎁 **Buy Gift Cards** (`Apple, Steam, PSN`)
   - 🔑 **Software** (`Windows, Office`)

## 2. Dual Terminal Hero Section (`.hp-calc-section`) — 50/50 Desktop Symmetry
- **Left Column (`.col-12 .col-lg-6`)**:
  - Houses the interactive Instant Game Top-Up Quick Pick card (`.hp-quick-topup-card`).
  - Game switch tabs (`Free Fire`, `Mobile Legends`, `PUBG Mobile`).
  - 4 quick package pill chips with live price calculations.
  - Tailored UID inputs with input validation.
  - Action button (`Recharge Now →`) leading directly to checkout.
- **Right Column (`.col-12 .col-lg-6`)**:
  - Exclusively houses the standalone Rate Calculator card (`.hp-calc-card`).
  - Sell Cards vs Buy Gift Cards tabs, currency, face value, live estimated payout in BDT.
- **Shared Trust & Payments Strip (`.hp-hero-trust-strip mt-3`)**:
  - Placed directly underneath both terminals spanning full width.
  - Shows instant UID delivery (~60s), bKash cashout (15-45m), 100% Direct Escrow, cashout rates, and supported payment methods.

