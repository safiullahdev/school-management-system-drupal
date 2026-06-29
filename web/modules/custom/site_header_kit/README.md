# Site Header Kit

Reusable Drupal module for a responsive brand header.

Current scope for this project:

- Brand header row
- Site logo
- Site name
- Main menu
- Responsive menu toggle

Top bar, phone, email, social links, and CTA buttons are intentionally not included in this phase.

## What This Module Provides

### Block Content Type

The module installs one custom block type:

- `brand_header_row`

Fields:

- `field_logo`
- `field_brand_menu`
- `field_brand_header_layout`

## Component Structure

```text
site_header_kit/
├── components/
│   └── brand-header/
│       ├── brand-header.component.yml
│       ├── brand-header.twig
│       ├── brand-header.css
│       └── brand-header.js
├── css/
│   ├── base/
│   │   └── shk-variables.css
│   └── responsive-menu.css
├── js/
│   └── responsive-menu.js
├── config/install/
├── site_header_kit.info.yml
├── site_header_kit.libraries.yml
└── site_header_kit.module
```

## How It Works

The `brand_header_row` block is rendered through the `brand-header` Single Directory Component.

The component displays:

- Theme logo
- Site name
- Selected Drupal menu
- Mobile menu toggle

The module uses `.shk-*` classes for component styling. The active theme may still provide layout utilities such as `.mosafi-container`.

## Installation

Enable the module:

```bash
ddev drush en site_header_kit -y
ddev drush cr
```

Export configuration:

```bash
ddev drush cex -y
```

## Usage

1. Go to **Content → Blocks → Add content block**.
2. Choose **Brand Header Row**.
3. Select the menu to display.
4. Save the block.
5. Go to **Structure → Block layout**.
6. Place the block in the theme header region.
7. Clear cache.

## Libraries

The component attaches its CSS through SDC `libraryOverrides`.

The responsive menu JavaScript is provided by:

```yaml
responsive_menu:
  js:
    js/responsive-menu.js: {}
  dependencies:
    - core/drupal
    - core/once
```

## Current Story Scope

For SMD-215:

- Keep the module focused on the brand header only.
- Do not include top bar functionality.
- Do not include phone, email, social media, or CTA fields.
- Do not include unused layout variants.
- Keep the header mobile-first and theme-friendly.

## Future Enhancements

Possible future stories:

- Add optional top bar component.
- Add account/login menu support.
- Add sticky header behavior.
- Add configurable CTA button.
- Add additional header layouts.
- Refactor theme-specific container assumptions.