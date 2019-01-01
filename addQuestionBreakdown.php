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
	"student Id": 89,
	"question Id": 7,
  "examId": 1,
	"grade": 18 	
 "reason":"used print instead of add"
}  
  */
  
  $sql = "INSERT INTO examQuestionBreakdownPoints(studentId,questionId,examID,grade,reason) VALUES ('$input->studentId','$input->questionId','$input->examId','$input->grade','$input->reason')";
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  } 
  

  $conn->close();
  
?>


 

 