<?php return function($req, $res) {
 require('./lib/FormUtils.php');
require_once('lib/Socket.php');
$form_was_posted = [];

//$form_was_posted = $req->body('username') !== NULL;


$name = FormUtils::getPostString($req->body('name'));
$age =  FormUtils::getPostInt($req->body('age'));
$gender = FormUtils::getPostString($req->body('gender'));
$email = FormUtils::getPostEmail($req->body('email'));
$password = FormUtils::getPostString($req->body('password1'));
$college = FormUtils::getPostString($req->body('college'));
$description = FormUtils::getPostString($req->body('description'));
$userType = FormUtils::getPostString($req->body('userType'));
$passwordhash = password_hash($password['value'],PASSWORD_BCRYPT,['cost' => 12]);
//need to do location id, car e.t.c for drivers

function getAddFormErrorMessages($name, $age,$gender,$email,$password,$college, $description,$userType) 
 {

    $form_error_messages = [];
    if(!($req->body('password1') === $req->body('password2')))
    {
        $form_error_messages['password'] = 'Password and confirm password must match';
    }

    $regex = "/(?=^.{8,}$)(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])(?=.*[\W])^.*/";
    //input must be like preg_match below
    if(!preg_match($regex, $password['value'])) 
    {
        $form_error_messages['password'] = 'Invalid Password must be at least 8 characters, include a lower case, an upper case, a number and a special character';
    }
    


    if (!$name['is_valid']) {
        $form_error_messages['name'] = 'Valid name is required';
    }

    if (!$age['is_valid']) {
        $form_error_messages['age'] = 'Valid age is required';
    }

    if (!$gender['is_valid']) {
        $form_error_messages['gender'] = 'Gender required';
    }

    if (!$email['is_valid']) {
        $form_error_messages['email'] = 'Valid email is required';
    }
    if (!$password['is_valid']) {
        $form_error_messages['password'] = "A valid password is required";
    }
    if (!$college['is_valid']) {
        $form_error_messages['college'] = "A valid college is required";
    }
    if (!$description['is_valid']) {
        $form_error_messages['password'] = "A valid description is required";
    }
    if (!$userType['is_valid']) {
        $form_error_messages['userType'] = "A valid user type is required";
    }


    return $form_error_messages;
}



 

 $form_error_messages = $form_was_posted ? getAddFormErrorMessages($name, $age,$gender,$email,$password,$college, $description,$userType) : [];

# Display form
if (!$form_was_posted || count($form_error_messages) > 0) 
{

    $res->render('main', 'register', [
        'pageTitle' => 'Register',
        'form_error_messages' =>$form_error_messages
    ]);
}
else
    {
        
        //$name, $age,$gender,$email,$password,$college, $description,$userType
        //$send = "{\"request\": \"createUser\," "\"name\":\"" . $name . "\", \"gender\":\"" . $gender . "\", \"email\":\"" . $email . "\", \"password\":\"" . $passwordhash . "\", \"college\":\"" . $college . "\", \"description\":\"" . $description . "\", \"user_type\":\"" . $userType . "\"}".PHP_EOL; 
         //write the string to the socket
         $send = "{\"request\":\"createUser\", \"name\":\"" . $name['value'] . "\", \"password\":\"" . $passwordhash . "\"}".PHP_EOL;

         // send to server to validate whether the user exists and has correct passsword
         // have a find one by username that returns a User Object,
         // then use User methods to get password and username and ID
         // validate the password
     
         // if all ok redirect to home
         // else render the login page again with an error message
     
         $read = socketRequest($send, $socket); 
         
        $res->redirect('/home');
    }
}
?>
