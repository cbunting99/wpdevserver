<!--
custom-theme/README.md

Documentation for the custom WordPress theme used in the development server environment
- Custom theme for WordPress Development Server
- Automatic installation and activation during setup
- Developer-friendly interface with quick access to admin tools

Theme Details:
- Theme Name: WP Dev Server
- Version: 1.0.0
- Author: Chris Bunting

Author: Chris Bunting
Created: 2025-08-07
Last Modified: 2025-08-07
Version: 1.0.0

Copyright (c) 2025 Chris Bunting. All rights reserved.
-->

# Custom WordPress Theme

This directory contains the custom WordPress theme that is automatically installed and activated during the WordPress development server setup.

## Theme Information

- **Theme Name**: WP Dev Server
- **Description**: Custom theme for WordPress Development Server environment. Provides a clean, developer-friendly interface with quick access to admin and development tools.
- **Version**: 1.0.0
- **Author**: Chris Bunting

## How It Works

1. The theme files are copied into the Docker image during the build process
2. During WordPress installation, the theme is copied to the WordPress themes directory
3. The theme is automatically activated as the default theme

## Files Included

- `style.css` - Theme stylesheet and metadata
- `index.php` - Main template file
- `header.php` - Header template
- `footer.php` - Footer template
- `functions.php` - Theme functions and customizations
- `template-functions.php` - Additional template functions
- `template-tags.php` - Custom template tags
- `customizer.php` - Theme customizer settings

## Customization

To modify the theme:
1. Edit the files in this directory (`custom-theme/wpdevserver/`)
2. Rebuild the Docker image: `docker-compose build`
3. Restart the container: `docker-compose up`

The changes will be automatically copied and activated during the next WordPress setup.
