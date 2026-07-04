<?php

namespace Drupal\school_dashboard\Controller;

use Drupal\Core\Controller\ControllerBase;

class SchoolAdminDashboardController extends ControllerBase {

  public function dashboard() {
    return [
      '#type' => 'markup',
      '#markup' => '
        <div class="school-admin-dashboard">
          <h2>School Admin Dashboard</h2>
          <p>Welcome back. Use this dashboard to review applications, approvals, students, classes, and school operations.</p>

          <div class="school-admin-dashboard__actions">
            <a class="button button--primary" href="/node/add/class">Create Class</a>
          </div>
        </div>
      ',
    ];
  }

}