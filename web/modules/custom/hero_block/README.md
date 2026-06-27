# Hero Block

Reusable Drupal Single Directory Component (SDC) module providing hero
components for landing pages.

## Features

-   Reusable SDC hero components
-   Full-width responsive layouts
-   Background image support
-   Primary, secondary, and tertiary CTAs
-   Controller, Block Content, or Node-driven data

## Current Component

-   `hero-overlay`

## Example

``` php
[
  '#type' => 'component',
  '#component' => 'hero_block:hero-overlay',
  '#props' => [
    'headline' => ['#markup' => 'School Management System'],
    'subheadline' => ['#markup' => 'Manage admissions, classes, grades, and attendance.'],
  ],
]
```

## Module Structure

``` text
hero_block/
├── assets/
├── components/
├── hero_block.info.yml
└── hero_block.libraries.yml
```
