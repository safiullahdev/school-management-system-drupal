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

        <div class="dashboard-card">
        <h3>My Applications</h3>
        <p>Create or view your admission application.</p>
        <a href="/node/add/application">Create Application</a><br>
        <a href="/student/applications">View My Applications</a>
        </div>

      <div class="dashboard-card">
        <h3>My Profile</h3>
        <p>View your student profile.</p>
        <a href="/user">My Account</a>
      </div>

    </div>
  ',
];
  }

}