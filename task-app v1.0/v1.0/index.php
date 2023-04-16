<?php

$servername = "localhost:127.0.0.1";
$username = "root";
$password = "";
$dbname = "task-app";


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$sql = "CREATE TABLE form_data (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  checkbox1 BOOLEAN,
  checkbox2 BOOLEAN,
  field1 VARCHAR(30) NOT NULL,
  field2 VARCHAR(30) NOT NULL,
  field3 VARCHAR(30) NOT NULL,
  field4 VARCHAR(30) NOT NULL,
  reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
  echo "Table created successfully";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}


if(isset($_POST['submit'])){
    $checkbox1 = isset($_POST['checkbox1']) ? 1 : 0;
    $checkbox2 = isset($_POST['checkbox2']) ? 1 : 0;
    $field1 = $_POST['field1'];
    $field2 = $_POST['field2'];
    $field3 = $_POST['field3'];
    $field4 = $_POST['field4'];
    
    $sql = "INSERT INTO form_data (checkbox1, checkbox2, field1, field2, field3, field4)
    VALUES ('$checkbox1', '$checkbox2', '$field1', '$field2', '$field3', '$field4')";
    
    if (mysqli_query($conn, $sql)) {
      echo "Form data submitted successfully";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}


?>
<!DOCTYPE html>
<html>
<head>
  <title>Form Data</title>
</head>
<body>
  <h1>Form Data</h1>
  <form method="post">
    Checkbox 1: <input type="checkbox" name="checkbox1"><br>
    Checkbox 2: <input type="checkbox" name="checkbox2"><br>
    Field 1: <input type="text" name="field1"><br>
    Field 2: <input type="text" name="field2"><br>
    Field 3: <input type="text" name="field3"><br>
    Field 4: <input type="text" name="field4"><br>
    <input type="submit" name="submit" value="Submit">
  </form>
  <br>
  <table>
    <tr>
      <th>Checkbox 1</th>
      <th>Checkbox 2</th>
      <th>Field 1</th>
      <th>Field 2</th>
      <th>Field 3</th>
      <th>Field 4</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
    <?php
      
      $sql = "SELECT *
       form_data";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
echo "<tr>";
echo "<td>" . $row['checkbox1'] . "</td>";
echo "<td>" . $row['checkbox2'] . "</td>";
echo "<td>" . $row['field1'] . "</td>";
echo "<td>" . $row['field2'] . "</td>";
echo "<td>" . $row['field3'] . "</td>";
echo "<td>" . $row['field4'] . "</td>";
echo "<td><a href='edit.php?id=" . $row['id'] . "'>Edit</a></td>";
echo "<td><a href='delete.php?id=" . $row['id'] . "'>Delete</a></td>";
echo "</tr>";
}
?>

  </table>
</body>
</html>
<?php

mysqli_close($conn);
?> 