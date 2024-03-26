<?php
    include 'connection_establishment.php';



    // URL of the HTML file
    $url = "http://localhost/website/faculty.html";

    // Get the HTTP headers of the URL
    $headers = get_headers($url);

    // Extract the status code
    $status = substr($headers[0], 9, 3);

    // Output the status code
    // echo "Status code: $status";


    
    // Retrieve form data
    $FACULTY_ID = $_POST["FACULTY_ID"];
    $FACULTY_NAME = $_POST["FACULTY_NAME"];
    $FACULTY_DEPARTMENT = $_POST["FACULTY_DEPARTMENT"];
    $FACULTY_EMAIL = $_POST["FACULTY_EMAIL"];
    $FACULTY_PASSWORD = $_POST["FACULTY_PASSWORD"];
    $FACULTY_ROLE = $_POST["FACULTY_ROLE"];
    $FACULTY_ROLE_DESCRIPTION = $_POST["FACULTY_ROLE_DESCRIPTION"];
   

    function create_faculty_table(){

        // SQL query to create table in database
        $create_faculty = "CREATE TABLE IF NOT EXISTS FACULTY_REGISTER 
        (FACULTY_ID INT(6) NOT NULL PRIMARY KEY, 
        FACULTY_NAME VARCHAR(20) NOT NULL,
        FACULTY_DEPARTMENT VARCHAR(20) NOT NULL,
        FACULTY_EMAIL VARCHAR(25) NOT NULL UNIQUE,
        FACULTY_PASSWORD VARCHAR(10),
        FACULTY_ROLE VARCHAR(20),
        FACULTY_ROLE_DESCRIPTION VARCHAR(20))";
        if ($GLOBALS["conn"]->query($create_faculty) === TRUE) {
            echo "Table created successfully <br>";
        } else {
            echo "Error: " .$GLOBALS["conn"]->error;
        }

    }

    function insert_faculty($FACULTY_ID,$FACULTY_NAME,$FACULTY_DEPARTMENT,$FACULTY_EMAIL,$FACULTY_PASSWORD,$FACULTY_ROLE,$FACULTY_ROLE_DESCRIPTION){
        // SQL query to insert data into the database
        $insert_sql = "INSERT INTO FACULTY_REGISTER (FACULTY_ID, FACULTY_NAME, FACULTY_DEPARTMENT, FACULTY_EMAIL, FACULTY_PASSWORD, FACULTY_ROLE, FACULTY_ROLE_DESCRIPTION)
            VALUES ('$FACULTY_ID', '$FACULTY_NAME', '$FACULTY_DEPARTMENT', '$FACULTY_EMAIL', '$FACULTY_PASSWORD', '$FACULTY_ROLE','$FACULTY_ROLE_DESCRIPTION')";
        try{
            if ($GLOBALS["conn"]->query($insert_sql) === TRUE) {
                echo "Record inserted successfully";
            }

        }
        catch(mysqli_sql_exception){
            echo "Error: " .$GLOBALS["conn"]->error;
            
        }
    }

    function update_faculty($FACULTY_ID,$FACULTY_NAME,$FACULTY_DEPARTMENT,$FACULTY_EMAIL,$FACULTY_PASSWORD,$FACULTY_ROLE,$FACULTY_ROLE_DESCRIPTION){
        // SQL query to insert data into the database
        $update_sql = "UPDATE FACULTY_REGISTER SET 
        FACULTY_ID = $FACULTY_ID, 
        FACULTY_NAME = $FACULTY_NAME, 
        FACULTY_DEPARTMENT = $FACULTY_DEPARTMENT, 
        FACULTY_EMAIL = $FACULTY_EMAIL,
        FACULTY_PASSWORD = $FACULTY_PASSWORD,
        FACULTY_ROLE = $FACULTY_ROLE, 
        FACULTY_ROLE_DESCRIPTION = $FACULTY_ROLE_DESCRIPTION
        WHERE FACULTY_ID = $FACULTY_ID";
        try{
            if ($GLOBALS["conn"]->query($update_sql) === TRUE) {
                echo "Record inserted successfully";
            }

        }
        catch(mysqli_sql_exception){
            echo "Error: " .$GLOBALS["conn"]->error;
            
        }
    }

    function delete_faculty($FACULTY_ID,$FACULTY_NAME){
        // SQL query to insert data into the database
        $delete_sql = "DELETE FROM FACULTY_REGISTER WHERE FACULTY_ID = %s AND FACULTY_NAME = %s)
            VALUES ('$FACULTY_ID', '$FACULTY_NAME')";
        try{
            if ($GLOBALS["conn"]->query($delete_sql) === TRUE) {
                echo "Record inserted successfully";
            }

        }
        catch(mysqli_sql_exception){
            echo "Error: " .$GLOBALS["conn"]->error;
            
        }
    }

        
create_faculty_table();
if($status == 200){
    insert_faculty($FACULTY_ID,$FACULTY_NAME,$FACULTY_DEPARTMENT,$FACULTY_EMAIL,$FACULTY_PASSWORD,$FACULTY_ROLE,$FACULTY_ROLE_DESCRIPTION);
}
else{
    echo "Server error";
}


?>