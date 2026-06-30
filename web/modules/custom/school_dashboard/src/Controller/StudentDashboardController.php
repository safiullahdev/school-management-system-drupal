<?php

namespace Drupal\school_dashboard\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;

class StudentDashboardController extends ControllerBase {

  public function dashboard() {
    $student = $this->getCurrentStudent();
    $assignment_count = $student ? $this->getAssignmentCount($student) : 0;
    $grade_count = $student ? $this->getGradeCount($student) : 0;
    $attendance_count = $student ? $this->getAttendanceCount($student) : 0;
    $application_count = $this->getApplicationCount();

    return [
      '#type' => 'markup',
      '#markup' => '
        <div class="student-dashboard">
          <h2>Student Dashboard</h2>
          <p>Welcome back. Use this dashboard to view your assignments, grades, attendance, and application information.</p>

          <div class="student-dashboard__metrics">
            <div class="student-dashboard__metric">
              <strong>' . $assignment_count . '</strong>
              <span>Assignments</span>
            </div>

            <div class="student-dashboard__metric">
              <strong>' . $grade_count . '</strong>
              <span>Grades</span>
            </div>

            <div class="student-dashboard__metric">
              <strong>' . $attendance_count . '</strong>
              <span>Attendance Records</span>
            </div>

            <div class="student-dashboard__metric">
              <strong>' . $application_count . '</strong>
              <span>Applications</span>
            </div>
          </div>
        </div>
      ',
    ];
  }

  private function getCurrentStudent(): ?NodeInterface {
    $uid = $this->currentUser()->id();

    $student_ids = $this->entityTypeManager()
      ->getStorage('node')
      ->getQuery()
      ->condition('type', 'student')
      ->condition('status', 1)
      ->condition('field_student_user', $uid)
      ->accessCheck(TRUE)
      ->range(0, 1)
      ->execute();

    if (empty($student_ids)) {
      return NULL;
    }

    return $this->entityTypeManager()
      ->getStorage('node')
      ->load(reset($student_ids));
  }

private function getAssignmentCount(NodeInterface $student): int {
  $class_ids = $this->entityTypeManager()
    ->getStorage('node')
    ->getQuery()
    ->condition('type', 'class')
    ->condition('status', 1)
    ->condition('field_class_students', $student->id())
    ->accessCheck(TRUE)
    ->execute();

  if (empty($class_ids)) {
    return 0;
  }

  return (int) $this->entityTypeManager()
    ->getStorage('node')
    ->getQuery()
    ->condition('type', 'assignment')
    ->condition('status', 1)
    ->condition('field_assignment_class', array_values($class_ids), 'IN')
    ->accessCheck(TRUE)
    ->count()
    ->execute();
}

  private function getGradeCount(NodeInterface $student): int {
    return (int) $this->entityTypeManager()
      ->getStorage('node')
      ->getQuery()
      ->condition('type', 'grades')
      ->condition('status', 1)
      ->condition('field_student', $student->id())
      ->accessCheck(TRUE)
      ->count()
      ->execute();
  }

  private function getAttendanceCount(NodeInterface $student): int {
    return (int) $this->entityTypeManager()
      ->getStorage('node')
      ->getQuery()
      ->condition('type', 'attendance')
      ->condition('status', 1)
      ->condition('field_attendance_student', $student->id())
      ->accessCheck(TRUE)
      ->count()
      ->execute();
  }

  private function getApplicationCount(): int {
    return (int) $this->entityTypeManager()
      ->getStorage('node')
      ->getQuery()
      ->condition('type', 'application')
      ->condition('uid', $this->currentUser()->id())
      ->accessCheck(TRUE)
      ->count()
      ->execute();
  }

}