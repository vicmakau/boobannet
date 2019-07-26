<?php

$dbObject = boobanDb::initialise( 'localhost', 'root', '', 'booban' );




class boobanDb{


    private static $instance = false;


    private $connection;



    private function __construct($dbhost, $dbuser, $dbpass, $dbname){

        $this->connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    }



    public static function initialise($dbhost, $dbuser, $dbpass, $dbname){

        if( !self::$instance ) self::$instance = new boobanDb( $dbhost, $dbuser, $dbpass, $dbname );

        return self::$instance;

    }


    function addMember($fname, $lname, $uname, $email, $website, $university, $course, $skills, $password){


		$addMemberErr = "";


		$insertMember="INSERT INTO 

                    members_tbl(fname, lname, uname, email, website, campus, course, skills, password)

                    VALUES
                            
                ('$fname', '$lname', '$uname', '$email', '$website', '$university', '$course', '$skills', '$password')";


        $run = $this ->connection ->query($insertMember);



        if(!$run) {

        	$addMemberErr = "Error Uploading cust data";

        }


        return $addMemberErr;


	}




    function memberLogin($email, $password){


        $err = "";


        $login="SELECT email,password FROM members_tbl WHERE email='$email' AND password='$password'";


        $run_login = $this ->connection ->query($login);



        $check_login = $run_login ->num_rows;



            if($check_login == 0){


                    $err= "Invalid credentials.Try again";


            }


            elseif($check_login == 1){


                $_SESSION["member_email"] = $email;

                    //check if  page is redirecting from orderSummary.php


                        header("location:member/index.php");

                        
            }

        

             return $err;

        }


}

?>



