<?php

	return [
		'something_went' => 'Something went wrong please try later.',

		// Login Form
		'login_form' => [
			'name' => [
				'required' => "Please enter the name.",
				'minlength' => "Your display name must be at least 8 characters long.",
				'maxlength' => "Your display name must not exceed 255 characters."
			],
			'email' => [
				'required' => 'Please enter the email.',
				'email' => 'Please enter a valid email.',
			],
			'password' => [
				'required' => 'Please enter the password.',
				'minlength' => 'Your password must be at least 8 characters long.'
			],
			'confirm_password' => [
				'equalTo' => "The confirm password must match the password field.",
			],
			'role' => [
				'required' => "Please select a role.",
			]
		]
	];
	
?>