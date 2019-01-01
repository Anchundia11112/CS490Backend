<?php
  $serverName = "sql1.njit.edu";
  
  $dBName = 'ma895';
  
  //This creates a new connection
  $conn = new mysqli($serverName, $userName, $password,$dBName);
  
  //Checks to see if the connnection failed 
  if ($conn->connect_error){
    die("Connection failed: " . $conn->error);  
  }
  
  $name = $_POST['user'];
  $password = $_POST['pass'];
  
  $hashedPassword = md5($password);
  
  /*
  $sql3 = "insert into StudentTable(UsernameS,PasswordS)  VALUES ('$name','$hashedPassword')";
  if ($conn->query($sql3) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  */
  $sql = "SELECT Username,Password FROM InstructorTable WHERE Username ='$name' AND Password = '$hashedPassword'";
  $sqlS = "SELECT UsernameS,PasswordS,StudentID FROM StudentTable WHERE UsernameS ='$name' AND PasswordS = '$hashedPassword'";



  
    
  //Checking to see if the Instructor exists in the database
  if($result = mysqli_query($conn,$sql) ){
    if(mysqli_num_rows($result) > 0){
      $teachTrue = '{"loginSucceeded": "true", "instructor": "true"}';            //Login Succeded and 
      echo($teachTrue);
    }
    else{
      $teachFalse = '{"loginSucceeded": "false", "instructor": "false"}'; //Not really needed
      //echo($teachFalse);
    } 
  }
  
  //Cecking to see if the student exists in the database    
   
  //"studentID":
  //row = 'mysqli_num_rows["StudentID"]'   USE THIS LATER  TONIGHT
   
  if($resultS = mysqli_query($conn,$sqlS)){
    if(mysqli_num_rows($resultS) > 0){   
      
      $row= mysqli_fetch_assoc($resultS);
      $stuTrue = '{"loginSucceeded": "true", "student": "true"';
      $stuTrue .= ', "studentID":';
      $stuTrue .= " " . $row["StudentID"]."}";
      echo($stuTrue);
      
      
    }
    else{
      $stuFalse = '{"loginSucceeded": "false", "student": "false"}';  //Not really needed
      //echo($stuFalse);
    }
  }
  
  if(mysqli_num_rows($result) == 0 && mysqli_num_rows($resultS) == 0) {    //When either one returns 0 we have no login avilable....
    $noLogin = '{loginSucceeded:"false"}';
    echo($noLogin);
  }
      
  
  $conn->close();

?>