<?php

namespace Drupal\school_dashboard\Controller;

use Drupal\Core\Controller\ControllerBase;

class RegistrarDashboardController extends ControllerBase {

  public function dashboard() {
    return [
      '#type' => 'markup',
      '#markup' => '
        <div class="registrar-dashboard">
          <p>Welcome back. Use this dashboard to review applications, enrollment queues, and student registration information.</p>
        </div>
      ',
    ];
  }

}