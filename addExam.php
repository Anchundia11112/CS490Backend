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
      "examName": "CS 900 Final",
      "Open": "false",
      "questionID": [13, 63, 3,43],
      "gradeReleased": "false",
      "pointDistribution":[20,20,20,30]
  */
  
  
  //Insert ExamID and Exam NAME into Exam table
  $sqlExam = "INSERT into ExamTable(ExamName) VALUES ('$input->examName')";
  if ($conn->query($sqlExam) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
  
  $result = mysqli_query($conn, "SELECT MAX(ExamID) AS 'max' FROM ExamTable");
  $row = mysqli_fetch_assoc($result);
  $currID = $row['max'];
  
  
  //Inserting the Exam Content
  foreach($input->questionID as $value){
    $sqlContent = "INSERT into ExamContent(ExamID,QuestionID) VALUES ('$currID','$value')";
    if ($conn->query($sqlContent) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
  
  //Inserting the Exam Statuses
  $sqlStatus = "INSERT into ExamStatus(ExamID,isOpCLo,GradeReleased) VALUES ('$currID','$input->Open','$input->gradeReleased')";
  if ($conn->query($sqlStatus) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
 
  $conn->close();
  
?>
 