<?php


		require("tmp/header.php");

		require_once("server.php");



		function clean_data($data){

	        $data=htmlspecialchars($data);

	        $data=trim($data);

	        $data=stripslashes($data);

	        return $data;

   	 	}


    //define validation error as empty 

	
        $err = "";

        $email = $password = "";

        if(isset($_POST[ "login" ])){


        	if(empty($email)){

                $error="Please enter your email address.";

            }

            elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){

                $error="Email address you entered is invalid";

            }

            
            elseif (empty($password)) {

                $error="Sorry.Please enter your password";

            }

           

            $email= $_POST['email'];

            $password = md5($_POST['password']);


            //call custLogin method in server.php
            $loginErr = $dbObject ->custLogin($email, $password);

            $err = $loginErr;

        }




	
?>
	
	<div class="container">

	<div class="row">

		<div class="col-lg-2">
		</div>

		<div class="col-lg-8">

			<?php

                        //check for redirect from orderSummary.php

                        if(isset($_SESSION['signup_to_login']))

                        {


                ?>
                            <div class="alert alert-info">

                                <?php

                                    //display alert here

                                    echo "<strong>".$_SESSION['signup_to_login']."<strong>";

                                ?>

                            </div>


                <?php

                        }

                ?>


                <h4 class="text-center">Log in here</h4>

                    <?php

                            //check for validation errors

                            if($err !==''){


                    ?>
                                <div class="alert alert-danger">

                                    <?php

                                        //display validation errors here

                                        echo "<strong>".$err."<strong>";

                                    ?>

                                </div>


                    <?php

                            }

                    ?>




			<form class='' action="login.php" method="POST" >


                <div class="form-group col-lg-8">

                	<label for="mail">Email Address:</label>

                    <input type="text" class="form-control" id="mail" name="email" value="<?php echo $email;?>">

                </div>



                <div class="form-group col-lg-8">

                	<label for="pw">Password:</label>

                    <input type="text" class="form-control" id="pw" name="password">

                </div>



                <div class="form-group col-lg-8">

                	<button type="submit" class="btn btn-default" name="card_pay" style="">Login</button>

            	</div> 

            </form>

        </div>

    </div>
    
</div>


<?php
	require_once("tmp/footer.php");
?>