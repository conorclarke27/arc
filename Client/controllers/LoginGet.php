<?php return function($req, $res) {
 
 $req->sessionStart();
  $res->render('main', 'login', [
  'pageTitle' => 'User Login'
  
  ]);
  
} ?>

