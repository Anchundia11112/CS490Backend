<?php
  $serverName = "sql1.njit.edu";
 
  $dBName = 'ma895';
  
  //This creates a new connection
  $conn = new mysqli($serverName, $userName, $password,$dBName);
  
  //Checks to see if the connnection failed 
  if ($conn->connect_error){
    die("Connection failed: " . $conn->error);  
  }

 $inputJSON = file_get_contents('php://input');
 $input= json_decode( $inputJSON ); 
  
  $sql = "select Grade as 'theGrade' from gradeTable where ExamID  = '$input->examId' and StudentID = '$input->studentId'";
  
  $sql_result = mysqli_query($conn, $sql);
    
  $row = mysqli_fetch_assoc($sql_result);
  $grade = $row['theGrade'];
  if ($row) {
    echo $grade;
  }  
  
  $conn->close();
  
?>


 
  