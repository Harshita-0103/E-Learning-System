<!DOCTYPE html>
<html>
<head>
<title>Online Education System</title>
<link rel="stylesheet" href="/online_project/style.css">
</head>
<body>
<div class="container"></div>
<h1>Online Education</h1>
<div class="buttons-grid">
<a class="query-btn" href="manage.php?table=students">Manage Students</a>
<a class="query-btn" href="manage.php?table=instructors">Manage Instructors</a>
<a class="query-btn" href="manage.php?table=courses">Manage Courses</a>
<a class="query-btn" href="manage.php?table=enrollments">Manage Enrollments</a>
<a class="query-btn" href="manage.php?table=video_lectures">Manage Video Lectures</a>
<a class="query-btn" href="manage.php?table=assessments">Manage Assessments</a>
<a class="query-btn" href="manage.php?table=study_materials">Manage Study Materials</a>
<a class="query-btn" href="manage.php?table=certificates">Manage Certificates</a>
</div>
<?php
$queryNames = [

1 => "Display All Students",
2 => "Display All Instructors",
3 => "Display All Courses",
4 => "Display All Enrollments",
5 => "Display All Video Lectures",
6 => "Display All Assessments",
7 => "Display All Study Materials",
8 => "Display All Certificates",

9 => "Count Total Students",
10 => "Count Total Courses",

11 => "List Students With Their Courses",
12 => "Calculate Average Assessment Marks",
13 => "Find Highest Assessment Marks",
14 => "Find Lowest Assessment Marks",

15 => "Sort Courses By Duration",
16 => "Sort Students Alphabetically",

17 => "List Instructor With Their Courses",
18 => "Show Certificates Issued After April 10",
19 => "Show Students Starting With S",
20 => "Show 3 Months Duration Courses",

21 => "Students With ID Greater Than 10",
22 => "Instructors Specialized In AI",
23 => "Courses By Instructor 1",
24 => "Enrollments After Jan 15",
25 => "Count Video Lectures",
26 => "Count Study Materials",
27 => "Assessments With 100 Marks",
28 => "Certificates For Course 5",
29 => "Show Student Names And Emails",
30 => "Show Course Titles And Duration",

31 => "Students With Certificate Dates",
32 => "Count Enrollments Per Course",
33 => "Display First 5 Students",
34 => "Display First 5 Courses",
35 => "Show Distinct Course Durations",

36 => "Students Containing Letter A",
37 => "Instructors In Descending Order",
38 => "Courses In Alphabetical Order",
39 => "Total Sum Of Assessment Marks",
40 => "Latest Enrollments First",

41 => "Course Titles With Instructor Specialization",
42 => "Students Enrolled In 3 Months Courses",
43 => "Total Certificates Count",
44 => "Video Lectures Of 30 Minutes",
45 => "Study Materials In PDF Format",
46 => "Quiz Type Assessments",
47 => "Students With Gmail Accounts",
48 => "All Doctor Instructors",
49 => "Courses Containing Data",
50 => "Show Current Time"
];

foreach($queryNames as $id => $name){
    echo "<a href='queries.php?id=$id'><button>$name</button></a>";
}
?>
</body>
</html>