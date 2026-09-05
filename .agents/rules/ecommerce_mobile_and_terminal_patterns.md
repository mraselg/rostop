# eCommerce Mobile UX, In-Page Modals, and Terminal Architecture

## 1. Product Detail Edition / Mode Selector
- Never use horizontal scrollable pills when a product has 3+ editions, as it causes horizontal scroll fatigue and clutters the vertical reading flow on mobile.
- **Preferred Pattern**: A compact single-row "Selected Edition" trigger bar with:
  - Country/edition flag and edition name.
  - Active chip/badge and delivery speed.
  - Trailing chevron.
- Clicking the trigger bar opens an accessible Edition Picker Modal:
  - On mobile (`<=576px`): Render as a sleek bottom sheet (`max-height: 82vh`, `border-radius: 18px 18px 0 0`, slide-up transition).
  - On desktop (`>=576px`): Render as a centered modal (`max-width: 480px`, scale-in transition).
- Selecting an edition must update the trigger bar in real time, filter package cards without reloading, auto-select the first package, and adapt form inputs (e.g. UID vs Zone ID vs Email).

## 2. Homepage Dual Terminal Architecture
- The Hero Dual Terminal should remain **Calculator-Primary**:
  - **Panel 1 (Desktop `col-lg-7`, Mobile default tab index 0)**: Exchange Rate Calculator (Sell Gift Cards / Buy Gift Cards).
  - **Panel 2 (Desktop `col-lg-5`, Mobile tab index 1)**: Quick Tools Hub (Price Check, USDT ⇄ BDT Converter, Published Live Rates).
- Avoid duplicating full game recharge checkout forms inside the hero terminal when dedicated product pages, hero banners, and game card grids already serve that purpose.

## 3. Mobile Typography & Sizing Constraints (Viewport <= 768px & <= 576px)
- Input fields, dropdown selects, and secondary buttons should have a compact height of `38px` with font size `0.78rem` to `0.80rem`.
- Section titles on mobile must be scaled to `0.85rem` to `0.95rem` (avoiding oversized desktop `1.25rem+` typography).
- Payout and price values must be capped (`1.15rem` to `1.25rem`) to prevent text overflowing outside card boundaries on 375px screens.
