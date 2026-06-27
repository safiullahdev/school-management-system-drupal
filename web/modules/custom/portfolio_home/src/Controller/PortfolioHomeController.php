<?php

namespace Drupal\portfolio_home\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;

class PortfolioHomeController extends ControllerBase {


  /**
    * Returns the dashboard URL for the current user's role.
    */
  protected function getDashboardUrl(): Url {
    $roles = $this->currentUser()->getRoles();

    if (in_array('administrator', $roles, TRUE) || in_array('admin', $roles, TRUE)) {
      return Url::fromUserInput('/school-admin-dashboard');
    }

    if (in_array('registrar', $roles, TRUE)) {
      return Url::fromUserInput('/registrar/applications');
    }

    if (in_array('teacher', $roles, TRUE)) {
      return Url::fromUserInput('/teacher-dashboard');
    }

    if (in_array('student', $roles, TRUE)) {
      return Url::fromUserInput('/student/applications');
    }

    if (in_array('parent', $roles, TRUE)) {
      return Url::fromUserInput('/parent-attendance');
    }

    return Url::fromRoute('user.page');
  }

  public function home(): array {

    $module_path = \Drupal::service('extension.path.resolver')
      ->getPath('module', 'hero_block');

    $hero_bg = '/' . $module_path . '/assets/imgs/school-hero-bg.png';

    $props = [
      'background_image' => $hero_bg,

      'eyebrow' => [
        '#markup' => 'Drupal Portfolio Project',
      ],

      'headline' => [
        '#markup' => 'Welcome to<br>School Management System',
      ],

      'subheadline' => [
        '#markup' => 'Manage admissions, classes, assignments, grades, attendance, and more in one secure school portal.',
      ],

      'cta_tertiary' => [
        '#type' => 'link',
        '#title' => 'View Source Code',
        '#url' => Url::fromUri('https://github.com/safiullahdev/school-management-system-drupal'),
        '#attributes' => [
          'target' => '_blank',
          'rel' => 'noopener',
        ],
      ],
    ];

    if ($this->currentUser()->isAuthenticated()) {

    $props['cta_primary'] = Link::fromTextAndUrl(
      'Go to Dashboard',
      $this->getDashboardUrl()
    )->toRenderable();

    }
    else {

      $props['cta_primary'] = Link::fromTextAndUrl(
        'Create Parent Account',
        Url::fromRoute('user.register')
      )->toRenderable();

      $props['cta_secondary'] = Link::fromTextAndUrl(
        'Login',
        Url::fromRoute('user.login')
      )->toRenderable();

    }

    return [
      '#theme' => 'portfolio_home',

      '#hero' => [
        '#type' => 'component',
        '#component' => 'hero_block:hero-overlay',
        '#props' => $props,
        // '#attached' => [
        //   'library' => [
        //     'hero_block/hero-overlay',
        //   ],
        // ],
      ],

      '#attached' => [
        'library' => [
          'portfolio_home/home',
        ],
      ],
    ];

  }

}