<?php

namespace Drupal\school_dashboard\Controller;

use Drupal\Core\Controller\ControllerBase;

class TeacherDashboardController extends ControllerBase {

  public function dashboard() {
    return [
      '#type' => 'markup',
      '#markup' => '
        <div class="teacher-dashboard">
          <h2>Teacher Dashboard</h2>
          <p>Welcome back. Use this dashboard to view your classes, students, assignments, grades, and attendance information.</p>
        </div>
      ',
    ];
  }

}