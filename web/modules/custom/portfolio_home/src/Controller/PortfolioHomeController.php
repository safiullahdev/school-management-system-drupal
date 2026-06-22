<?php

namespace Drupal\portfolio_home\Controller;

use Drupal\Core\Controller\ControllerBase;

class PortfolioHomeController extends ControllerBase {

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