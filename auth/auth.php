<?php

// add parameters
function signup()
{
// add the body of the function based on the guidelines of signup.php

// use the following guidelines to create the function in auth.php
// instead of using "die", return a message that can be printed in the HTML page
if(count($_POST)>0)
{
	// check if the fields are empty
	if(!isset($_POST['email']))
		die('please enter your email');
	if(!isset($_POST['password'])) 
		die('please enter your password');

	// check if the email is valid
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
		die('Your email is invalid');

	// check if password length is between 8 and 16 characters
	if(strlen($_POST['password']) < 8) 
		die('Please enter a password >=8 characters');

	// check if the password contains at least 2 special characters
	if (!preg_match('/[\'^£$%&*!()}{@#~?><>,|=_+¬-]/', $_POST['password']))
		die('Please enter atleast 2 special characters in your password');

	// check if the file containing banned users exists
	if (!file_exists("../data/banned.csv.php"))
	{
		$myfile = fopen("../data/banned.csv.php", "w");
		fwrite($myfile, "<?php die() ?>");
		fclose($myfile);	
	}

	// check if the email has not been banned
	$bannedArray = getCSVArray("../data/banned.csv.php");

	foreach ($bannedArray as $banned)
	{
		if ($_POST['email'] == $banned[0])
			die('This email has been banned');
	}

	// check if the file containing users exists
	if (!file_exists("../data/users.csv.php"))
	{
		$myfile = fopen("../data/users.csv.php", "w");
		fwrite($myfile, "<?php die() ?>");
		fclose($myfile);	
	}

	// check if the email is in the database already
	$usersArray = getCSVArray("../data/users.csv.php");

	foreach ($usersArray as $user)
	{
		if ($_POST['email'] == $user[0])
			die('This email is already in use');
	}

	// encrypt password
	$passwordHash = hash("sha256", $_POST['password']);

	// save the user in the database 
	$userObj = [$_POST['email'], $passwordHash];

	addCSVRecord("../data/users.csv.php", -1, $userObj);

	// show them a success message and redirect them to the sign in page
	header('Location: ../auth/signin.php');
}
	
}

// add parameters
function signin()
{
	// add the body of the function based on the guidelines of signin.php

	// use the following guidelines to create the function in auth.php
	//instead of using "die", return a message that can be printed in the HTML page
	if(count($_POST)>0)
	{
		// 1. check if email and password have been submitted
		if(!isset($_POST['email']))
			die('please enter your email');
		if(!isset($_POST['password'])) 
			die('please enter your password');

		// 2. check if the email is well formatted
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
			die('Your email is invalid');

		// 3. check if the password is well formatted
		// check if password length is between 8 and 16 characters
		if(strlen($_POST['password']) < 8) 
			die('Please enter a password >=8 characters');

		// check if the password contains at least 2 special characters
		if (!preg_match('/[\'^£$%&*!()}{@#~?><>,|=_+¬-]/', $_POST['password']))
			die('Please enter atleast 2 special characters in your password');

		// 4. check if the file containing banned users exists
		if (!file_exists("../data/banned.csv.php"))
		{
			$myfile = fopen("../data/banned.csv.php", "w");
			fwrite($myfile, "<?php die() ?>");
			fclose($myfile);	
		}

		// 5. check if the email has not been banned
		$bannedArray = getCSVArray("../data/banned.csv.php");

		foreach ($bannedArray as $banned)
		{
			if ($_POST['email'] == $banned[0])
				die('This email has been banned');
		}

		// 6. check if the file containing users exists
		if (!file_exists("../data/users.csv.php"))
		{
			$myfile = fopen("../data/users.csv.php", "w");
			fwrite($myfile, "<?php die() ?>");
			fclose($myfile);	
		}

		// 7. check if the email is registered
		$usersArray = getCSVArray("../data/users.csv.php");
		$registered = false;
		$registeredIndex = -1;

		$i = 0;
		foreach ($usersArray as $user)
		{
			if ($_POST['email'] == $user[0])
			{
				$registered = true;
				$registeredIndex = $i;
			}
			$i++;
		}

		if (!$registered)
			die('This email is not registered to an account');

		// 8. check if the password is correct
		if ($usersArray[$registeredIndex][1] != hash("sha256", $_POST['password']))
			die('Password is incorrect');

		// 9. store session information
		$_SESSION['logged'] = true;

		// 10. redirect the user to the members_page.php page
		header('Location: ../index.php');	
	}	
}

function signout()
{
	// add the body of the function based on the guidelines of signout.php
	$_SESSION['logged'] = false;
	session_destroy();
	header('Location: ../index.php');	
}

function is_logged()
{
	if (!isset($_SESSION['logged']))
		$_SESSION['logged'] = false;

	return $_SESSION['logged'];
}