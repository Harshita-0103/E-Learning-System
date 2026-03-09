<?php
include "db.php";

$queryList = [

1 => "SELECT * FROM students",
2 => "SELECT * FROM instructors",
3 => "SELECT * FROM courses",
4 => "SELECT * FROM enrollments",
5 => "SELECT * FROM video_lectures",
6 => "SELECT * FROM assessments",
7 => "SELECT * FROM study_materials",
8 => "SELECT * FROM certificates",

9 => "SELECT COUNT(*) AS total_students FROM students",
10 => "SELECT COUNT(*) AS total_courses FROM courses",

11 => "SELECT students.name, courses.title 
       FROM enrollments
       JOIN students ON enrollments.student_id = students.student_id
       JOIN courses ON enrollments.course_id = courses.course_id",

12 => "SELECT AVG(total_marks) AS average_marks FROM assessments",
13 => "SELECT MAX(total_marks) AS highest_marks FROM assessments",
14 => "SELECT MIN(total_marks) AS lowest_marks FROM assessments",

15 => "SELECT * FROM courses ORDER BY duration",
16 => "SELECT * FROM students ORDER BY name",

17 => "SELECT instructors.name, courses.title
       FROM instructors
       JOIN courses ON instructors.instructor_id = courses.instructor_id",

18 => "SELECT * FROM certificates WHERE issue_date > '2024-04-10'",
19 => "SELECT * FROM students WHERE name LIKE 'S%'",
20 => "SELECT * FROM courses WHERE duration='3 Months'",
21 => "SELECT * FROM students WHERE student_id > 10",
22 => "SELECT * FROM instructors WHERE specialization='AI'",
23 => "SELECT * FROM courses WHERE instructor_id=1",
24 => "SELECT * FROM enrollments WHERE enrollment_date > '2024-01-15'",
25 => "SELECT COUNT(*) FROM video_lectures",
26 => "SELECT COUNT(*) FROM study_materials",
27 => "SELECT * FROM assessments WHERE total_marks=100",
28 => "SELECT * FROM certificates WHERE course_id=5",
29 => "SELECT name,email FROM students",
30 => "SELECT title,duration FROM courses",

31 => "SELECT students.name, certificates.issue_date
       FROM students
       JOIN certificates ON students.student_id=certificates.student_id",

32 => "SELECT courses.title, COUNT(enrollments.student_id) AS total_enrollments
       FROM courses
       JOIN enrollments ON courses.course_id=enrollments.course_id
       GROUP BY courses.title",

33 => "SELECT * FROM students LIMIT 5",
34 => "SELECT * FROM courses LIMIT 5",
35 => "SELECT DISTINCT duration FROM courses",

36 => "SELECT * FROM students WHERE name LIKE '%a%'",
37 => "SELECT * FROM instructors ORDER BY name DESC",
38 => "SELECT * FROM courses ORDER BY title ASC",
39 => "SELECT SUM(total_marks) AS total_marks_sum FROM assessments",
40 => "SELECT * FROM enrollments ORDER BY enrollment_date DESC",

41 => "SELECT courses.title, instructors.specialization
       FROM courses
       JOIN instructors ON courses.instructor_id=instructors.instructor_id",

42 => "SELECT students.name, courses.title
       FROM students
       JOIN enrollments ON students.student_id=enrollments.student_id
       JOIN courses ON courses.course_id=enrollments.course_id
       WHERE courses.duration='3 Months'",

43 => "SELECT COUNT(*) FROM certificates",
44 => "SELECT * FROM video_lectures WHERE length='30 mins'",
45 => "SELECT * FROM study_materials WHERE format='PDF'",
46 => "SELECT * FROM assessments WHERE type='Quiz'",
47 => "SELECT * FROM students WHERE email LIKE '%gmail%'",
48 => "SELECT * FROM instructors WHERE name LIKE 'Dr.%'",
49 => "SELECT * FROM courses WHERE title LIKE '%Data%'",
50 => "SELECT NOW() AS currentTime"

];

$id = $_GET['id'];
if(isset($queryList[$id])){
$result = $conn->query($queryList[$id]);
if($id == 1){
    echo "<h2>Students Management</h2>";
}
    echo "<a href='dashboard.php'>Back</a><br><br>";
echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<tr>";
while ($field = $result->fetch_field()) {
        echo "<th>".$field->name."</th>";
    }
    echo "</tr>";
while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $data) {
            echo "<td>".$data."</td>";
        }
echo "</tr>";
}
echo "</table>";}
 else {
    echo "Invalid Query";
}
?>