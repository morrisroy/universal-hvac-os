# Universal HVAC OS - Alerts System

This project is a demo HVAC monitoring dashboard with Active + Resolved alerts.

## Features
- Active alerts display with auto-severity detection (Error, Warning, Info)
- Resolve button to clear alerts
- Resolved alerts are stored forever in history

## Modes
### GitHub Pages (Static Mode)
- Alerts are loaded from JSON
- Resolving an alert is simulated (local only, not saved)
- Great for demo

### InfinityFree / PHP Hosting (Backend Mode)
- Real JSON updates with `resolve_alert.php`
- Resolved alerts are moved from `alerts.json` to `resolved.json`
- Permanent history stored

## Files
- `index.html` - Dashboard
- `style.css` - Styles
- `app.js` - Logic for fetching + resolving
- `alerts.json` - Active alerts
- `resolved.json` - History of resolved alerts
- `resolve_alert.php` - Backend handler (PHP only)
- `README.md` - Setup instructions

## Setup

### GitHub Pages
1. Push all files to your GitHub repo
2. Enable Pages in repo settings
3. Visit your published URL

### InfinityFree Hosting
1. Upload all files via File Manager or FTP
2. Alerts will be real-time and resolving works
