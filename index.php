<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way


// We are going to use session variables so we need to enable sessions
session_start();

// Use this function when you need to need an overview of these variables


// TODO: provide some products (you may overwrite the example)
$products = array (
    array('name' => 'nike_T-shirt', 'price' => 10),
    array('name' => 'nike_short', 'price' => 12),
    array('name' => 'nike_pants', 'price' => 20),
    array('name' => 'nike_jacket', 'price' => 25),
    array('name' => 'adidas_T-shirt', 'price' => 15),
    array('name' => 'adidas_short', 'price' => 17),
    array('name' => 'adidas_jacket', 'price' => 40)
    
);

$totalValue = 0;


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  

function validate()
{
    // This function will send a list of invalid fields back
    $street =""; 
    $email ="";
    $street_num =""; 
    $zipcode = "";

    $street_error =""; 
    $email_error =""; 
    $street_num_error =""; 
    $zipcode_error =""; 
    $products_error = "";

  
  $errors =array();


 if ($_POST == true) { //  if form submitted with post method
                                              // then do validation
    if (empty($_POST["email"])) {  // if empty ? 
      $email_error = "you must add your email";
      $errors[] = $email_error;
    } else {
      $email = test_input($_POST["email"]); // checck validation .. 
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid email format";
        $errors[] = $email_error;
      }
    }


    if (empty($_POST["street"])) {
      $street_error = "you must add your street name";
      $errors[] = $street_error;
    } else {
      $street = test_input($_POST["street"]);
      
    }

    if (empty($_POST["streetNumber"])) {
      $street_num_error = "you must add your street number";
      $errors[] = $street_num_error;
    } else {
      $street_num = test_input($_POST["streetNumber"]);
      
    }

    if (empty($_POST["zipcode"])) {
      $zipcode_error = "you must add your zipcode";
      $errors[] = $zipcode_error;
    } else {
      $zipcode = test_input($_POST["zipcode"]);
      
    }

    if (!isset($_POST["products"])) {
      $products_error = "in order to make order you must select at least one product";
      $errors[] = $products_error;
    }
  }

  return $errors;
}


    


function handleForm()
{
    // TODO: form related tasks (step 1)

    global $products, $totalValue;
    $orders = [];

  for($i = 0; $i < count($products); $i++) {
    if(isset($_POST["products"][$i])) {
      $orders[] = $products[$i]["name"];
      $totalValue += $products[$i]["price"];
    }
  }

    // Validation (step 2)
    $invalidFields = validate();

  if (!empty($invalidFields)) {
    // handle errors
    print_r("<h3 style='color:red ; textalign:center'>".implode($invalidFields) . "</h3>");
  }
  else {
    // handle successful 
    print_r("<h4 style=color:green;>".implode($orders) ."</h4>". 
    "<h3 style=color:green;> to your delivery address ". $_POST["street"] . "</h4>");

   

    $_COOKIE["totalValue"] += $totalValue;

    print_r("COOKIE: " . $_COOKIE["totalValue"]);
    print_r($totalValue);
  }
}
    


// TODO: replace this if by an actual check

$formSubmitted = isset($_POST["submit"]);
if ($formSubmitted) {
  // Store $_POST data in $_SESSION
  $_SESSION = $_POST;
  handleForm();
}

function whatIsHappening() {
    echo '<h5>$_GET</h5>';
    var_dump($_GET);
    echo '<h5>$_POST</h5>';
    var_dump($_POST);
    echo '<h5>$_COOKIE</h5>';
    var_dump($_COOKIE);
    echo '<h5>$_SESSION</h5>';
    var_dump($_SESSION);
}

whatIsHappening();

setcookie("totalValue", strval($totalValue));

require 'form-view.php';