<?php

namespace Drupal\portfolio_home\Controller;

use Drupal\Core\Controller\ControllerBase;

class PortfolioHomeController extends ControllerBase {

  /**
   * Builds the portfolio homepage content.
   */
  public function home(): array {
    return [
      '#theme' => 'portfolio_home',
      '#attached' => [
        'library' => [
          'portfolio_home/home',
        ],
      ],
    ];
  }

}