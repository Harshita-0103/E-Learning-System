<?php
include "db.php";

$table = $_GET['table'] ?? '';

$allowedTables = [
    "students","instructors","courses",
    "enrollments","video_lectures",
    "assessments","study_materials","certificates"
];

if(!in_array($table,$allowedTables)){
    die("Invalid Table");
}

/* PRIMARY KEY DETECT */
$pkResult = $conn->query("SHOW KEYS FROM $table WHERE Key_name='PRIMARY'");
$pkRow = $pkResult->fetch_assoc();
$primaryKey = $pkRow['Column_name'];

/* DELETE */
if(isset($_GET['delete'])){
    $deleteId = $_GET['delete'];
    $conn->query("DELETE FROM $table WHERE $primaryKey=$deleteId");
    header("Location: manage.php?table=$table");
    exit();
}

/* EDIT FETCH */
$editData = null;
if(isset($_GET['edit'])){
    $editId = $_GET['edit'];
    $editResult = $conn->query("SELECT * FROM $table WHERE $primaryKey=$editId");
    $editData = $editResult->fetch_assoc();
}

/* UPDATE */
if(isset($_POST['update'])){
    $updateId = $_POST['update_id'];
    $updates = [];

    $colResult = $conn->query("SHOW COLUMNS FROM $table");
    while($col = $colResult->fetch_assoc()){
        if($col['Field'] != $primaryKey){
            $field = $col['Field'];
            $updates[] = "$field='".$_POST[$field]."'";
        }
    }

    $sql = "UPDATE $table SET ".implode(",",$updates)." WHERE $primaryKey=$updateId";
    $conn->query($sql);

    header("Location: manage.php?table=$table");
    exit();
}

/* ADD */
if(isset($_POST['add'])){
    $columns = [];
    $values = [];

    $colResult = $conn->query("SHOW COLUMNS FROM $table");
    while($col = $colResult->fetch_assoc()){
        if($col['Field'] != $primaryKey){
            $field = $col['Field'];
            $columns[] = $field;
            $values[] = "'".$_POST[$field]."'";
        }
    }

    $sql = "INSERT INTO $table(".implode(",",$columns).")
            VALUES(".implode(",",$values).")";

    $conn->query($sql);
    header("Location: manage.php?table=$table");
    exit();
}

/* SEARCH */
$search = $_GET['search'] ?? '';
$sql = "SELECT * FROM $table";

if($search){
    $conditions = [];
    $colResult = $conn->query("SHOW COLUMNS FROM $table");
    while($col = $colResult->fetch_assoc()){
        $conditions[] = $col['Field']." LIKE '%$search%'";
    }
    $sql .= " WHERE ".implode(" OR ",$conditions);
}

$result = $conn->query($sql);

echo "<h2>Manage ".ucfirst($table)."</h2>";
echo "<a href='dashboard.php'>Back</a><br><br>";

/* FORM */
echo "<form method='post'>";

$colResult = $conn->query("SHOW COLUMNS FROM $table");
while($col = $colResult->fetch_assoc()){
    if($col['Field'] != $primaryKey){
        $field = $col['Field'];
        $value = $editData[$field] ?? '';
        echo "<input name='$field' placeholder='$field' value='$value' required> ";
    }
}

if($editData){
    echo "<input type='hidden' name='update_id' value='".$editData[$primaryKey]."'>";
    echo "<button name='update'>Update</button>";
} else {
    echo "<button name='add'>Add</button>";
}

echo "</form><br>";

/* SEARCH FORM */
echo "<form method='get'>";
echo "<input type='hidden' name='table' value='$table'>";
echo "<input name='search' placeholder='Search'>";
echo "<button>Search</button>";
echo "</form><br>";

/* TABLE */
echo "<table border='1' cellpadding='8'>";
echo "<tr>";
echo "<th>S.No</th>";

$colResult = $conn->query("SHOW COLUMNS FROM $table");
while($col = $colResult->fetch_assoc()){
    echo "<th>".$col['Field']."</th>";
}
echo "<th>Action</th></tr>";
/* DELETE */
if(isset($_GET['delete'])){
    $deleteId = intval($_GET['delete']);

    // delete selected row
    $conn->query("DELETE FROM $table WHERE $primaryKey = $deleteId");

    // renumber only if table is students
    if($table == "students"){
        $conn->query("SET @num := 0");
        $conn->query("UPDATE students SET student_id = @num := (@num+1)");
        $conn->query("ALTER TABLE students AUTO_INCREMENT = 1");
    }

    header("Location: manage.php?table=$table");
    exit();
}
/* DELETE */
if(isset($_GET['delete'])){
    $deleteId = intval($_GET['delete']);

    // delete selected row
    $conn->query("DELETE FROM $table WHERE $primaryKey = $deleteId");

    // renumber only if table is students
    if($table == "students"){
        $conn->query("SET @num := 0");
        $conn->query("UPDATE students SET student_id = @num := (@num+1)");
        $conn->query("ALTER TABLE students AUTO_INCREMENT = 1");
    }

    header("Location: manage.php?table=$table");
    exit();
}
$count = 1;
while($row = $result->fetch_assoc()){
    echo "<tr>";
    foreach($row as $value){
        echo "<td>$value</td>";
        echo "<td>".$count."</td>";
$count++;
    }

    echo "<td>
    <a href='manage.php?table=$table&edit=".$row[$primaryKey]."'>Edit</a> |
    <a href='manage.php?table=$table&delete=".$row[$primaryKey]."'>Delete</a>
    </td>";

    echo "</tr>";
}

echo "</table>";
