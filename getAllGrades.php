<?php
  $serverName = "sql1.njit.edu";
  
  $dBName = 'ma895';
  
  //This creates a new connection
  $conn = new mysqli($serverName, $userName, $password,$dBName);
  
  //Checks to see if the connnection failed 
  if ($conn->connect_error){
    die("Connection failed: " . $conn->error);  
  }
  
  
  //,TestCases,TestOutputs
  $sql = "Select * from gradeTable";
  
  
  
  $thingToEcho;
  $thingToEcho->Exams= array();
             
  $result = mysqli_query($conn,$sql);
  
  while($row = mysqli_fetch_array($result)){                            
     $row_array['result'] = $row;
     array_push($thingToEcho->Exams,$row_array);   
  };
  
  $myJson = json_encode($thingToEcho,JSON_FORCE_OBJECT);
  echo $myJson;

  $conn->close();
  
?>