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
    $ctas = [];

    if (\Drupal::currentUser()->isAnonymous()) {
      $ctas['cta_primary'] = [
        '#type' => 'link',
        '#title' => $this->t('Create Parent Account'),
        '#url' => Url::fromUserInput('/user/register'),
      ];

      $ctas['cta_secondary'] = [
        '#type' => 'link',
        '#title' => $this->t('Login'),
        '#url' => Url::fromUserInput('/user/login'),
      ];
    }
    else {
      $ctas['cta_primary'] = [
        '#type' => 'link',
        '#title' => $this->t('Go to Dashboard'),
        '#url' => $this->getDashboardUrl(),
      ];
    }

    $ctas['cta_tertiary'] = [
      '#type' => 'link',
      '#title' => $this->t('View Source Code'),
      '#url' => Url::fromUri('https://github.com/safiullahdev/school-management-system-drupal'),
      '#attributes' => [
        'target' => '_blank',
        'rel' => 'noopener',
      ],
    ];

    return [
      '#type' => 'component',
      '#component' => 'hero_block:hero-overlay',
      '#props' => [
        'background_image' => '/modules/custom/hero_block/assets/imgs/school-hero-bg.png',
        'eyebrow' => 'Drupal Portfolio Project',
        'headline' => 'Welcome to School Management System',
        'subheadline' => 'Manage admissions, classes, assignments, grades, attendance, and more in one secure school portal.',
      ] + $ctas,
      '#cache' => [
        'contexts' => ['user.roles'],
      ],
    ];
  }

    /**
    * Returns the dashboard URL for the current user's role.
    */
protected function getDashboardUrl(): Url {
  $roles = \Drupal::currentUser()->getRoles();

  if (in_array('administrator', $roles, TRUE) || in_array('admin', $roles, TRUE)) {
    return Url::fromUserInput('/school-admin-dashboard');
  }

  if (in_array('registrar', $roles, TRUE)) {
    return Url::fromUserInput('/registrar-dashboard');
  }

  if (in_array('teacher', $roles, TRUE)) {
    return Url::fromUserInput('/teacher-dashboard');
  }

  if (in_array('student', $roles, TRUE)) {
    return Url::fromUserInput('/student-dashboard');
  }

  if (in_array('parent', $roles, TRUE)) {
    return Url::fromUserInput('/parent-dashboard');
  }

  return Url::fromRoute('user.page');
}

}