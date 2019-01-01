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
  
  echo($input->open);
  
  //UPDATEING TABLE FOR GRADE RELEASED//

  $sql = "UPDATE ExamStatus SET GradeReleased='$input->gradeReleased' WHERE ExamID = '$input->examId'";
    
  if ($conn->query($sql) === TRUE) {
       echo "Records Updated\n";
  } else {  
         echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
 ?>