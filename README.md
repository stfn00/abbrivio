
# WordPress Advanced Starter Theme - 🎨 Abbrivio

[![Project Status: Active.](https://www.repostatus.org/badges/latest/active.svg)](https://www.repostatus.org/#active)  [![code style: prettier](https://img.shields.io/badge/code_style-prettier-ff69b4.svg?style=flat-square)](https://github.com/prettier/prettier)

A WordPress Starter Theme for Advanced Development.



## Maintainer

| Name                                          | Github Username |
| --------------------------------------------- | --------------- |
| [Stefano Iachetta](https://www.stfn-dev.com/) | @stfn00         |



## Features

**Development Workflow**
- Module bundler with Webpack 4
- JavaScript compilation with Babel
- JavaScript Linting with ESLint
- Autoprefixer for CSS
- Custom PostCSS configuration
- Custom ESLint configuration
- Custom Babel configuration
- Compatibility with main Browser
- Minification
- PHP Singleton Trait for Classes
- Loading PHP Classes with custom Autoloader
- Templating with basic WP template parts

**Theme Options**
- Manage site Logos
- Support for Google Analytics
- Support for Facebook Pixel
- Support for Mobile status bar Style
- Disable automatic scroll restoration
- Manage Posts per page parameter for each Archive
- Admin panel Customization
- Disable all Updates for non Admin
- Remove trash actions in Head
- Remove Emoji support
- Disable REST API
- Disable xmlrpc.php
- Remove Dashboard Widgets for non Admin
- Remove Thumbnail sizes
- Disable PDF Previews
- Remove Profile color scheme for non Admin
- Remove Admin bar for non Admin
- Restrict Media access for non Admin and Editor
- Remove default Thumb sizes

**Theme Templates and Functionality**
- Front page
- Posts page
- Archive page
- Tag page
- 404 page
- Lazy Loading support for all images of the website
- Sliders and Carousels
- Font Awesome
- Ability to show the Author box for each Post in Admin by checking Custom Meta box
- Custom Search form
- Custom Widgets
- Custom Sidebar
- Block Style Variations
- Custom Gutenberg Blocks
- Registering and Editing Custom Menus
- Pagination
- Translation
- Style WP Admin pages
- Style WP Admin Login page
- Style Gutenberg and TinyMCE Editors



## Usage

Clone or download the theme [abbrivio](https://github.com/stfn00/abbrivio) in your WordPress themes directory and activate it.



## Theme Setup

Create pages called "Home" and "Blog" and set them from `Appearance > Customizer > Homepage Settings` or in `Settings > Reading`.



## Development

**Install**
Clone the repo in your WP theme folder and run
```bash
cd abbrivio/assets
```
```bash
npm install
```

**During development**
```bash
npm run dev
```
Run precommit from assets directory before pushing the code for development/contribution.
```bash
npm run precommit
```

**Production**
```bash
npm run prod
```

**Linting & Formatting**
The following command will fix most errors and show and remaining ones which cannot be fixed automatically.
```bash
npm run lint:fix
```

### Fixing Errors

```bash
Error: Node Sass does not yet support your current environment
```

**Solution:**
```bash
cd assets
```
```bash
npm rebuild node-sass
```



## Credits

This theme uses
- [Webpack](https://webpack.js.org/)
- [Babel](https://babeljs.io/)
- [ESLint](https://eslint.org/)
- [autoprefixer](https://github.com/postcss/autoprefixer)
- [postcss](https://github.com/postcss/postcss)
- [Bootstrap 5](https://getbootstrap.com/docs/5.0/getting-started/introduction/)
- [vanilla-lazyload](https://github.com/verlok/vanilla-lazyload)
- [slick](https://github.com/kenwheeler/slick)
- [Font Awesome](https://fontawesome.com/)
- [WP Options page](https://github.com/jeremyHixon/RationalOptionPages)



# Changelog

All notable changes to this project will be documented below.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.1] - 2021-02-07

### Added

- Internationalization support

### Changed

- Improved the style of the theme options page when there is an update nag

### Removed

- Removed `ABBRIVIO_THEME_SLUG` PHP constant and replaced all instances
