<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// variables
$error_open = "<label class='error'>";
$error_close = "</label>";
$valid_form = TRUE;
$redirect = 'success.php';

$form_elements = array('name', 'phone', 'fax', 'email', 'comments');
$required = array('name', 'phone', 'email');

foreach ($required as $require)
{
    $error[$require] = '';
}

if (isset($_POST['submit']))
{
    // process form

    // get form data

    foreach ($form_elements as $element)
{
    $form[$element] = htmlspecialchars($_POST[$element]);
}
    // check form elements
    
    // check required fields
    if ($form['name'] == '')
    {
        $error['name'] = $error_open . "Please fill in all required fields" . $error_close;
        $valid_form = FALSE;
    }
    if ($form['email'] == '')
    {
        $error['email'] = $error_open . "Please fill in all required fields" . $error_close;
    }
    if ($form['phone'] == '')
    {
        $error['phone'] = $error_open . "Please fill in all required fields" . $error_close;
        $valid_form = FALSE;
    }

    // check formatting
    if ($error['phone'] == '' && !preg_match ('/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/', 
    $form['phone']))
    {
        $error['phone'] = $error_open . "Please enter a valid phone number" . $error_close;
        $valid_form = FALSE;
    }
    if ($error['email'] == '' && !preg_match ('/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/', 
    $form['email']))
    {
        $error['email'] = $error_open . "Please enter a valid email address" . $error_close;
        $valid_form = FALSE;
    }

    // check if form is valid

    if ($valid_form)
    {
        // redirect

        header("Location: " . $redirect);
    }
    else
    {
        include('form.php');
    }
}
else
{
    foreach ($form_elements as $element)
{
    $form[$element] = '';
}

    // display form
    include('form.php');
    
}

