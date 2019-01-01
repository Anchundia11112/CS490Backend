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
  
  /*
  {
  "grade": "100",
  "ExamID": "23",
  "studentID": "66"  
  }
*/
  
  $sql = "Insert into gradeTable(ExamID,StudentID,Grade) VALUES ('$input->examId','$input->studentId','$input->grade')";
  if ($conn->query($sql) === TRUE) {
       echo "Records Inserted\n";
  } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
    }
  
  $conn->close();
  
?>
