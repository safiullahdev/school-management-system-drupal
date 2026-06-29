<?php

namespace Drupal\school_dashboard\Controller;

use Drupal\Core\Controller\ControllerBase;

class StudentDashboardController extends ControllerBase {

  public function dashboard() {
    return [
      '#type' => 'markup',
      '#markup' => '
        <div class="student-dashboard">
          <h2>Student Dashboard</h2>
          <p>Welcome back. Use this dashboard to view your assignments, grades, attendance, and application information.</p>
        </div>
      ',
    ];
  }

}