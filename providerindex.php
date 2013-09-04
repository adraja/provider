<?php

session_start();

use PFBC\Form;
use PFBC\Element;

include("PFBC/Form.php");
$form = new Form("login");
$form->configure(array("action" => "providerlogin.php", "method" => "get"));
$form->addElement(new Element\HTML("<img src='Nutriligence.png' height='160'>/><h3>Login to NufitScan Provider</h3><a href='Register.php' style='text-decoration:underline'>Contact to get access</a>"));
$form->addElement(new Element\Hidden("form", "login"));
$form->addElement(new Element\Email("Contact Email:", "contactemail", array(
	"required" => 1
)));
$form->addElement(new Element\Password("Password:", "password", array(
	"required" => 1
)));
$form->addElement(new Element\Checkbox("", "Remember", array(
	"1" => "Remember me"
)));
$form->addElement(new Element\Button("Login"));

$form->render();
?>
