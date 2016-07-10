<?php
session_start();
// added in v4.0.0
require_once 'php/Facebook/autoload.php';
include('classes/User.php');
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
// init app with app id and secret
FacebookSession::setDefaultApplication( 'FACEBOOK-APP-ID','FACEBOOK-APP-SECRET' );
// login helper with redirect_uri
    if($_SESSION["m"] == 0)
    $helper = new FacebookRedirectLoginHelper('loginSubmit.php' );
    else
    $helper = new FacebookRedirectLoginHelper('loginSubmit.php' );
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) {

    $user = new User;

  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  
  $response = $request->execute();
  
  // get response
  $graphObject = $response->getGraphObject();
     	$fbid = $graphObject->getProperty('id');              // To Get Facebook ID
 	    $fbfullname = $graphObject->getProperty('name'); // To Get Facebook full name
        $fbfirstname = $graphObject->getProperty('first_name');
        $fblastname = $graphObject->getProperty('last_name');
	    $femail = $graphObject->getProperty('email');    // To Get Facebook email ID
        $fbgender = $graphObject->getProperty('gender');
        $fbbirthday = $graphObject->getProperty('birthday');
        $fbcounry = $graphObject->getProperty('location');
        echo "GET USER DETAILS<br>";
        echo $fbid."<br>";
        echo $fbfullname."<br>";
        echo $fbfirstname."<br>";
        echo $fblastname."<br>";
        echo $femail."<br>";
        echo $fbgender."<br>";
        //echo $fbbirthday."<br>";
        //echo $fbcountry."<br>";
        
	/* ---- Session Variables -----*/
    echo "STORE IN SESSION<br>";
	    $_SESSION['FBID'] = $fbid;      
        
        $exists = $user->checkIfExists($fbid);
        var_dump($exists);

        if($exists) {
            $user = $user->getUser($fbid, TRUE);
            if($user->countryID == 0) {
                echo "USER EXISTS BUT HASNT SET COUNTRY/DOB - REDIRECT TO USER INFO";
                header("Location: userinfo.php");
            }
            else {
                echo "USER EXISTS - REDIRECT TO DASHBOARD<br>";
                header("Location: page.php#dashboard");
            }
        }
        else {
            echo "USER DOESNT EXIST<br>";
            echo "INIT USER<br>";
            $user->init($fbid,$fbfullname,$fblastname);
            if($femail!="") {
                $user->email = $femail;
            }
            if($fbgender!="") {
                $user->gender = $fbgender;
            }
            echo "CREATE USER<br>";
            $user->createUser();
            echo "REDIRECT TO USERINFO<br>";
            header("Location: userinfo.php");
        }
             
        //$_SESSION['FULLNAME'] = $fbfullname;
	    // $_SESSION['EMAIL'] =  $femail;
        // $_SESSION['GENDER'] =  $fbgender;
        //$_SESSION['BIRTHDAY'] =  $fbbirthday;
        //$_SESSION['COUNTRY'] =  $fbcountry;
    /* ---- header location after session ----*/
  //header("Location: page.php#dashboard");
} else {
   echo "No Session set";
  $loginUrl = $helper->getLoginUrl();
 header("Location: ".$loginUrl);
}
?>