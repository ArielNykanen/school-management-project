<?php 

$sbl = new BLStudents();
  
$allStudentsArr = $sbl->get();
$allStudentNumbers = [];

foreach ($allStudentsArr as $student) {
  array_push($allStudentNumbers, $student->student_phone);
}

echo json_encode($allStudentNumbers);
?>
"{ "name":"John", "age":30, "car":null }"