<?php
session_start();
?>

<!Doctype html>
<html>

<head>
    
    <title>Consumer Review</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet/vendor_profilestyle.css">


</head>

<body>

<?php
    error_reporting(E_ERROR | E_PARSE);
    $message="";
    $messageErr="";
    $count = 0;
    $email = $_SESSION["email"];
    $productnameErr="";
    $productname="";

    
    $name = $_GET['name'];

    //echo $name;

   

          
         

        if ($_SERVER["REQUEST_METHOD"] =="POST" ) 
        {   
            if(empty($_POST['message'])) 
            {
                $messageErr = "Please Message";
            }
            else
            {
                $message = $_POST['message'];
                $count++;
            }

            if(empty($_POST['name'])) 
            {
                $productnameErr = "Error getting name";
            }
            else
            {
                $productname = $_POST['name'];
                $count++;
            }

           
        if ($count >= 1)
        {
            $host = "localhost";
            $user = "wt_projectuser";
            $pass = "123";
            $db = "wt_project";
        
            // Mysqli object-oriented
            $conn1 = new mysqli($host, $user, $pass, $db);
        
            if($conn1->connect_error) {
                echo "Database Connection Failed!";
                echo "<br>";
                echo $conn1->connect_error;
            }
            else {
                
               
        
                $stmt2 =  "INSERT INTO `product_review` (`product_name`,`consumer_email`, `review_message`) VALUES ('".$productname. "','".$email. "', '".$message. "')";
               
                $status = $conn1->query($stmt2);

                
                if($status)
                {

                    echo $productname;
                    header("Location: consumer_review_product.php");
                    //echo $email;

                    
                }
                else {
                    echo "Failed to Insert Data.";
                    echo "<br>";
                    $conn1->connect_error;
            }
        
            $conn1->close();
        }
        
      
       
        }

  
                
    }
                
            
           





?>







  <?php include("static_header.php")
    ?>
               <center> 
               <button onclick="location.href='consumer_home.php'"class="button"><b>Consumer Homepage</b></button>        
          <button onclick="location.href='consumer_product.php'"class="button"><b>Product</b></button>
          
          <a href="logout.php">  <button class="button"><b>Logout</b></button> </a>
                    <br>
          </center> 

<form name="jsForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return validate()" method="POST">

            <div class="container">
            <div class="row">
            <div class="col-1"></div>
            
            <div class="col-10">
            
                <div class="box">
                    <!-- <div class="abc">

                        

                    </div> -->
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                    <textarea id="message" name="message" rows="4" cols="50">
                    </textarea> 
                    
                    
                    

                    <br>

                    <input type="Hidden" name="name" value="<?php echo $name; ?>">
                    
                    <input type="submit" class="button" >
                    <p style="color:red"><?php echo $productnameErr; ?></p>
                    </form>

                    
                   </div>

           
            </div>

            <div class="col-1"></div>
            
        </div>
        <?php include 'static_footer.php'; ?>
        </div>




<script>
			    function validate() {
				var isValid = false;
				var message = document.forms["jsForm"]["message"].value;
				var message = trim.message();
				


				if(message == "" ) {
					document.getElementById("errorMsg").innerHTML = "<b>Please fill up the properly.</b>";
					document.getElementById("errorMsg").style.color = "red";
				}
				else {
					isValid = true;
				}

				return isValid;
			}
		</script>


</body>


</html>