<?php

namespace Drupal\school_dashboard\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Parent dashboard controller.
 */
class ParentDashboardController extends ControllerBase {

  /**
   * Parent dashboard page.
   */
  public function dashboard() {
      $uid = $this->currentUser()->id();

    $student_count = $this->getParentStudentCount();
    $application_count = $this->getParentApplicationCount();
    $attendance_count = $this->getParentAttendanceCount();
    $grade_count = $this->getParentGradeCount();

return [
  '#type' => 'markup',
  '#markup' => '
    <div class="parent-dashboard">
      <h2>Parent Dashboard</h2>
      <p>Welcome back. Use this dashboard to view your students, applications, attendance, assignments, and grades.</p>
<div>Debug UID: ' . $uid . '</div>
      <div class="dashboard-metrics">
        <div class="dashboard-metric">
          <div class="dashboard-metric__label">My Students</div>
          <div class="dashboard-metric__value">' . $student_count . '</div>
        </div>

        <div class="dashboard-metric">
          <div class="dashboard-metric__label">Applications</div>
          <div class="dashboard-metric__value">' . $application_count . '</div>
        </div>

        <div class="dashboard-metric">
          <div class="dashboard-metric__label">Attendance</div>
          <div class="dashboard-metric__value">' . $attendance_count . '</div>
        </div>

        <div class="dashboard-metric">
          <div class="dashboard-metric__label">Grades</div>
          <div class="dashboard-metric__value">' . $grade_count . '</div>
        </div>
      </div>
    </div>
  ',
  '#cache' => [
    'contexts' => ['user'],
  ],
];
  }

  /**
   * Count students linked to the current parent user.
   */
  private function getParentStudentCount(): int {
    $uid = $this->currentUser()->id();

    return (int) $this->entityTypeManager()
      ->getStorage('node')
      ->getQuery()
      ->condition('type', 'student')
      ->condition('status', 1)
      ->condition('field_student_parent_user', $uid)
      ->accessCheck(TRUE)
      ->count()
      ->execute();
  }

  /**
   * Count applications authored by the current parent user.
   */
  private function getParentApplicationCount(): int {
    $uid = $this->currentUser()->id();

    return (int) $this->entityTypeManager()
      ->getStorage('node')
      ->getQuery()
      ->condition('type', 'application')
    //   ->condition('status', 1)
      ->condition('uid', $uid)
      ->accessCheck(TRUE)
      ->count()
      ->execute();
  }

  /**
   * Count attendance records for students linked to the current parent user.
   */
  private function getParentAttendanceCount(): int {
    $student_ids = $this->getParentStudentIds();

    if (empty($student_ids)) {
      return 0;
    }

    return (int) $this->entityTypeManager()
      ->getStorage('node')
      ->getQuery()
      ->condition('type', 'attendance')
      ->condition('status', 1)
      ->condition('field_attendance_student', $student_ids, 'IN')
      ->accessCheck(TRUE)
      ->count()
      ->execute();
  }

  /**
   * Count grades for students linked to the current parent user.
   */
  private function getParentGradeCount(): int {
    $student_ids = $this->getParentStudentIds();

    if (empty($student_ids)) {
      return 0;
    }

    return (int) $this->entityTypeManager()
      ->getStorage('node')
      ->getQuery()
      ->condition('type', 'grades')
      ->condition('status', 1)
      ->condition('field_student', $student_ids, 'IN')
      ->accessCheck(TRUE)
      ->count()
      ->execute();
  }

  /**
   * Get student node IDs linked to the current parent user.
   */
  private function getParentStudentIds(): array {
    $uid = $this->currentUser()->id();

    $student_ids = $this->entityTypeManager()
      ->getStorage('node')
      ->getQuery()
      ->condition('type', 'student')
      ->condition('status', 1)
      ->condition('field_student_parent_user', $uid)
      ->accessCheck(TRUE)
      ->execute();

    return array_values($student_ids);
  }

}