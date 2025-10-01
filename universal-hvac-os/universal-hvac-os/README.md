# UI Bundle — Universal HVAC OS

This bundle contains two ready-made UI themes (Professional and Modern) and docs for hosting on GitHub Pages or serving locally.

Structure:
- professional/index.html — Corporate dashboard demo
- modern/index.html — Modern dashboard demo
- shared/* — shared CSS and JS
- docs/index.html — landing page for GitHub Pages

These pages are **frontend only**; they expect a backend at `/api/*` for full functionality (see PoC backend). Buttons and setpoint actions are demo placeholders that will attempt to POST to `/api/v1/...`.

## How to run locally
1. Serve files with a static server (Python):
   ```
   cd ui_bundle/professional
   python -m http.server 8000
   ```
   Then open http://localhost:8000

2. Or use the repo's `docker-compose` to run the full PoC backend (if available).

## Hosting on GitHub Pages
- Copy the `docs/` folder contents to the repo's `docs/` directory (or set Pages to `gh-pages` branch).
- Enable GitHub Pages in repository settings; your UI will be live.

