<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>Student CRUD Operation</title>
</head>
<body>
<h2>Student Record Form</h2>

<form method="post">
   Roll No: <input type="text" name="rollno"><br><br>
   Name: <input type="text" name="name"><br><br>
   Address: <input type="text" name="address"><br><br>
   
   <input type="submit" name="btn" value="Insert">
   <input type="submit" name="btn" value="Update">
   <input type="submit" name="btn" value="Delete">
   <input type="submit" name="btn" value="display">
</form>

<?php
// Step 1: Connect to database
$conn = mysqli_connect("localhost", "root", "", "studentdb");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Step 2: Read button click
if (isset($_POST['btn']))
{
    $roll = $_POST['rollno'];
    $name = $_POST['name'];
    $addr = $_POST['address'];
    $btn  = $_POST['btn'];

    // Step 3: Choose SQL query based on button
    if ($btn == "Insert") {
        $sql = "INSERT INTO student (rollno, name, address) VALUES ('$roll', '$name', '$addr')";
        $result = mysqli_query($conn, $sql);
    } 
    elseif ($btn == "Update") {
        $sql = "UPDATE student SET name='$name', address='$addr' WHERE rollno='$roll'";
        $result = mysqli_query($conn, $sql);
    } 
    elseif ($btn == "Delete") {
        $sql = "DELETE FROM student WHERE rollno='$roll'";
        $result = mysqli_query($conn, $sql);
    }
    elseif ($btn == "display")   // ✅ Display records
    {
        $sql = "SELECT * FROM student";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) 
        {
            echo "<h3>Student Records:</h3>";
            echo "<table border='1' cellpadding='5'>
                    <tr>
                        <th>Roll No</th>
                        <th>Name</th>
                        <th>Address</th>
                    </tr>";
            
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>".$row['rollno']."</td>
                        <td>".$row['name']."</td>
                        <td>".$row['address']."</td>
                      </tr>";
            }
            echo "</table>";
        } 
        else 
        {
            echo "<h3>No Records Found</h3>";
        }
        exit();
    }

    // Step 5: Show result message
    if ($result) {
        echo "<h3>Record $btn Successfully!</h3>";
    } else {
        echo "<h3>Error: " . mysqli_error($conn) . "</h3>";
    }
}
?>
</body>
</html>
