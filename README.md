# Detect Screen Resolution

Simple tool that detects a user's screen and viewport resolution, device pixel ratio, and displays results. Uses client-side JavaScript to detect accurate values and optionally POSTs them to the server for logging or saving.

## Features
- Detect CSS viewport size (window.innerWidth/innerHeight)
- Detect physical screen size in CSS pixels (screen.width/height)
- Detect devicePixelRatio
- Shows examples and math for device pixels vs CSS pixels
- Optional server logging (file-based)

## Install
1. Create a new GitHub repo.
2. Copy files from this project into the repo.
3. Deploy to any PHP-enabled host (Apache, Nginx + PHP-FPM).

## Notes
- This is a privacy-sensitive tool. If you enable logging, ensure you have a privacy policy and do not store personal data.

## Live Demo Project
- [What Is My Screen Resolution](https://whatismyscreenresolution.info/)
