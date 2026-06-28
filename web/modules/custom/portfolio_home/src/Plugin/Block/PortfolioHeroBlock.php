<?php

namespace Drupal\portfolio_home\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;

/**
 * Provides a Portfolio Home Hero block.
 *
 * @Block(
 *   id = "portfolio_home_hero",
 *   admin_label = @Translation("Portfolio Home Hero"),
 *   category = @Translation("Portfolio")
 * )
 */
class PortfolioHeroBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    return [
      '#type' => 'component',
      '#component' => 'hero_block:hero-overlay',
      '#props' => [
        'background_image' => '/modules/custom/hero_block/assets/imgs/school-hero-bg.png',
        'eyebrow' => 'Drupal Portfolio Project',
        'headline' => 'Welcome to School Management System',
        'subheadline' => 'Manage admissions, classes, assignments, grades, attendance, and more in one secure school portal.',
        'cta_primary' => [
          '#type' => 'link',
          '#title' => 'Create Parent Account',
          '#url' => \Drupal\Core\Url::fromUserInput('/user/register'),
        ],
        'cta_secondary' => [
          '#type' => 'link',
          '#title' => 'Login',
          '#url' => \Drupal\Core\Url::fromUserInput('/user/login'),
        ],
        'cta_tertiary' => [
          '#type' => 'link',
          '#title' => 'View Source Code',
          '#url' => \Drupal\Core\Url::fromUri('https://github.com/safiullahdev/school-management-system-drupal'),
          '#attributes' => [
            'target' => '_blank',
            'rel' => 'noopener',
          ],
        ],
      ],
    ];
  }

}