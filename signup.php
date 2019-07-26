<?php


include('tmp/header.php');

include('server.php');


 function clean_data($data){

        $data=htmlspecialchars($data);

        $data=trim($data);

        $data=stripslashes($data);

        return $data;

    }


    //define validation error as empty 

    $error= $addMemberErr = "";


    //define vars

    $fname = $lname =$uname = $email = $website = $university = $course = $skills = $password="";



    if($_SERVER["REQUEST_METHOD"] == "POST") {


            $fname = $_POST['fname'];

            $lname = $_POST['lname'];

            $uname = $_POST['uname'];

            $email = $_POST['email'];

            $website = $_POST['website'];

            $university = $_POST['campus'];

            $course = $_POST['course'];

            $skills = $_POST['skills'];

            $password = $_POST['pw'];

            $passconf = $_POST['confirm_password'];


                //validate data
               
            		if(empty($fname)){

                        $error="Please enter your first name.";

                    }


                   elseif(empty($lname)){

                        $error="Please enter your last name.";

                    }

                    elseif(empty($uname)){

                        $error="Please choose a username.";

                    }

                     elseif(strlen($uname) < 5){

                        $error="Sorry. The username must be at least five characters";

                    }

                    elseif(empty($email)){

                        $error="Please enter your email address.";

                    }

                    elseif(empty($skills)){

                        $error="Please enter three top skills.";

                    }
                    
                    elseif (empty($password)) {

                        $error="Sorry.Please choose a password";

                    }

                    elseif(strlen($password) < 5){

                        $error="Password must be at least five characters";

                    }

                    elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){

                        $error="Email address you entered is invalid";

                    }

                    elseif (empty($passconf)) {

                        $error="Please confirm your password";

                    }

                    elseif($passconf != $password){

                        $error="Passwords do not match";

                    }
                  


                        //upload data if no errors found

                        if($error == ''){


                            $password=md5($password);
                            



                            $addMemberErr = $dbObject ->addMember($fname, $lname, $uname, $website, $university, $course, $skills, $password);

                            //redirect to login page ,pass a var telling user to login on login page



                            $_SESSION["signup_to_login"] = "You have been signed up. Now please Login to access your Booban Team account";



                            header("location:login.php");

                          


                        }
                       
    
    }


?>

<div class="container">


	<div class="row">


		<div class="col-lg-2">
		</div>



		<div class="col-lg-8" id="signup">



			<?php

                            //check for validation errors

                            if($error!=='' || $addMemberErr != ''){


                    ?>
                                <div class="alert alert-danger">

                                    <?php


                                    //display validation errors here

                                    echo "<strong>".$error."<strong>";

                                    echo "<strong>".$addMemberErr."<strong>";


                                    ?>

                                </div>
                    <?php

                            }

                    ?>





		    <form action="signup.php" method="post">

		
				<div class="form-group form-group-sm col-lg-6">

				    <label for="fname">First Name:</label>

				    <input type="text" name="fname" id="fname" class="form-control" value="<?php echo $fname;?>"> 

				 </div>


				<div class="form-group form-group-sm col-lg-6">

				    <label for="lname">Last Name:</label>

				    <input type="text" name="lname" id="lname" class="form-control" value="<?php echo $lname;?>">

				</div>


				<div class="form-group form-group-sm col-lg-4">

				    <label for="uname">Choose a Username</label>

				    <input type="text" name="uname" id="uname" class="form-control" value="<?php echo $uname;?>">

				</div>

				 
				<div class="form-group form-group-sm col-lg-8">

				    <label for="mail">Email Address:</label>

				    <input type="text" name="email" id="mail" class="form-control" value="<?php echo $email;?>">

				</div>


				<div class="form-group form-group-sm col-lg-6">

				    <label for="website">Website:</label>

				    <input type="text" name="website" id="website" class="form-control" value="<?php echo $website;?>">

				</div>


				<div class="form-group form-group-sm col-lg-6">

					<label for="campus">University/College</label>

					<input type="text" name="campus" id="campus" class="form-control" value="<?php echo $university;?>">

				</div>


				<div class="form-group form-group-sm col-lg-6">

					<label for="campus">Course</label>

					<input type="text" name="course" id="course" class="form-control" value="<?php echo $course;?>">

				</div>



				<div class="form-group form-group-sm col-lg-6">

					<label for="skill">Skills</label>

					<input type="text" name="skills" id="skill" class="form-control" placeholder="Enter your three top skills separated by a comma" value="<?php echo $skills;?>">

				</div>


				<div class="form-group col-lg-12">

					<label for="pw">Password</label>

			        <input type="text" id="pw" class="form-control" name="pw" >

			    </div>


				<div class="form-group col-lg-12">

					<label for="pconf">Confirm Password</label>

			        <input type = "text" id = "pconf" class = "form-control" name = "confirm_password" >

			    </div>  


			    <div class="form-group col-lg-12">

			        <button type="submit" class="btn btn-default signup-btn">Sign Up</button>

			    </div>


			</form>


		    <div class="text-center col-lg-12">Already have an account? <a href="#">Login here</a></div>

		</div>

	</div>
</div>
