# INSTALL.md — UI Bundle

## Quick Start (GitHub Pages)
1. Create a GitHub repo and push this bundle.
2. Place the 'docs' folder at repository root.
3. In GitHub repo settings -> Pages -> set source to 'main' branch and '/docs' folder.
4. Your UI will be available at https://USERNAME.github.io/REPO_NAME/

## Quick Start (Codespaces)
1. Open repository in GitHub Codespaces.
2. From terminal, serve the desired folder:
   - `python -m http.server --directory professional 8000`
3. Use Codespaces port preview to view the UI.

## Notes
- The UI uses Chart.js from CDN.
- The frontends simulate telemetry for demo. Connect to real backend by ensuring API endpoints exist at `/api/v1/...`.
