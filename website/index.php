<!-- <?php


    // Retrieve form data using $_POST
    
    $staffId = $_POST["staffId"];
    $staffName = $_POST["staffName"];
    $DepartmentName = $_POST["DepartmentName"];
    $year = $_POST["year"];
    $subjectName = $_POST["subjectName"];
    $hours = $_POST["hours"];
    

    file_put_contents('data.txt', print_r($_POST, true));
    
    // echo 'data submitted';
?> -->


<?php
    
    // Retrieve form data
    $staffId = $_POST["staffId"];
    $staffName = $_POST["staffName"];
    $DepartmentName = $_POST["DepartmentName"];
    $year = $_POST["year"];
    $subjectName = $_POST["subjectName"];
    $hours = $_POST["hours"];
    include 'connection_establishment.php';

    // SQL query to create table in database
    $create_faculty = "CREATE TABLE IF NOT EXISTS FACULTY_REGISTER 
                        (FACULTY_ID INT(6) NOT NULL PRIMARY KEY, 
                        FACULTY_NAME VARCHAR(20) NOT NULL,
                        FACULTY_DEPARTMENT VARCHAR(20) NOT NULL,
                        YEAR VARCHAR(25) NOT NULL,
                        SUBJECT_NAME VARCHAR(10),
                        HOUR VARCHAR(20))";

    if ($conn->query($create_faculty) === TRUE) {
        echo "Table created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // SQL query to insert data into the database
    $insert_sql = "INSERT INTO FACULTY_REGISTER (FACULTY_ID, FACULTY_NAME, FACULTY_DEPARTMENT, YEAR, SUBJECT_NAME, HOUR)
    VALUES ('$staffId', '$staffName', '$DepartmentName', '$year', '$subjectName', '$hours')";

    if ($conn->query($insert_sql) === TRUE) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
        // Close connection
        $conn->close();
        
?>