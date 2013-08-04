<?php
/**
 * Addon Module WHMCS To BillysBIlling Hooks
 *
 * This is a demo hook file for an addon module. Addon Modules can utilise all of the WHMCS
 * hooks in exactly the same way as a normal hook file would, and can contain multiple hooks.
 *
 * For more info, please refer to the hooks documentation @ http://docs.whmcs.com/Hooks
 *
 * @package    whmcstobillysbilling
 * @author     Kim Vinberg <info@dicm.dk>
 * @copyright  Copyright (c) Kim Vinberg 2013
 * @license    http://dicm.dk
 * @version    $Id$
 * @link       http://dicm.dk/
 */


if (!defined("WHMCS"))
    die("This file cannot be accessed directly");


/* ALL SETTINGS FOR THE SCRIPT */

$q = @mysql_query("SELECT * FROM tbladdonmodules WHERE module = 'whmcstobillysbilling'");

while ($arr = mysql_fetch_array($q)) {
    $whmcstobillysbilling_settings[$arr['setting']] = $arr['value'];
} //$arr = mysql_fetch_array($q)

/* ALL SETTINGS FOR THE SCRIPT */


/* LOG */
function whmcstobillysbilling_log($text, $file = 'whmcstobillysbilling_log.html')
{
    global $whmcstobillysbilling_settings;
    
    if ($whmcstobillysbilling_settings['option98'] == 'on') {
        if ($text != '') {
            $fh = fopen(__DIR__ . "/$file", 'a+') or die("Error in whmcstobillysbilling_log ");
            $data = "<br>".date('d-m-Y h:i:s') . " $text";
            fwrite($fh, $data);
            fclose($fh);
        } //$text != ''
    } //$whmcstobillysbilling_settings['option98'] == 'on'
    
    
}

/* LOG END */


if (!function_exists("curl_init")) {
    whmcstobillysbilling_log("Billy needs the CURL PHP extension.");
    throw new Exception("Billy needs the CURL PHP extension.");
} //!function_exists("curl_init")
if (!function_exists("json_decode")) {
    whmcstobillysbilling_log("Billy needs the JSON PHP extension.");
    throw new Exception("Billy needs the JSON PHP extension.");
} //!function_exists("json_decode")
require(dirname(__FILE__) . "/Billy/Client.php");
require(dirname(__FILE__) . "/Billy/Exception.php");
require(dirname(__FILE__) . "/Billy/Request.php");


/*
*
* GET CONTACT ID
* $email : Used to find the specific email adress in BillysBilling Contact
*
*/
function GetContactId($email, $firstname, $lastname)

{

    global $whmcstobillysbilling_settings;

    
      try {
            $client = new Billy_Client($whmcstobillysbilling_settings['option99']);
            $cmd    = $client->get("contacts?q=$firstname%20$lastname");
            
            whmcstobillysbilling_log(json_encode($cmd));
  
      
	 $keys = count($cmd->contacts);
    $end = 0;
    $contactId = 0;
    
    for ($i = 0; $i <= $keys; $i++) {

        if ($cmd->contacts[$i]->persons[0]->email == $email) {
        
            $contactId = $cmd->contacts[$i]->id;

        } else
            if ($end == 0) {
                $end = 0;
            }
    }

              }
                catch (Billy_Exception $e) { // Will be caught
                    whmcstobillysbilling_log($e->getJsonBody());
                    whmcstobillysbilling_log("Api data: " . json_encode($cmd));
                    whmcstobillysbilling_log("Options:" . json_encode($whmcstobillysbilling_settings));
                    whmcstobillysbilling_log("Post data:" . json_encode($_POST));
                    whmcstobillysbilling_log("Get data: " . json_encode($_GET));
                }
  

 return $contactId;

}









/*

ADD CLIENT

*/
function whmcstobillysbilling_hook_ClientAdd($vars)
{
    
    global $whmcstobillysbilling_settings;
    $logText = "";
    
    
    if ($whmcstobillysbilling_settings['option1'] == 'on') {
        
        $userid      = $vars['userid'];
        $firstname   = $vars['firstname'];
        $lastname    = $vars['lastname'];
        $companyname = $vars['companyname'];
        $email       = $vars['email'];
        $address1    = $vars['address1'];
        $address2    = $vars['address2'];
        $city        = $vars['city'];
        $state       = $vars['state'];
        $postcode    = $vars['postcode'];
        $country     = $vars['country'];
        $phonenumber = $vars['phonenumber'];
        
        
        $logText .= "";
        
        try {
            $client = new Billy_Client($whmcstobillysbilling_settings['option99']);
            $cmd    = $client->get("contacts?q=$firstname%20$lastname");
            
            whmcstobillysbilling_log(json_encode($cmd));
            
            
            $keys = count($cmd->contacts);
            $end  = 0;
            for ($i = 0; $i <= $keys; $i++) {
                if ($cmd->contacts[$i]->persons[0]->email == $email) {
                    $end = 1;
                } //$cmd->contacts[$i]->persons[0]->email == $email
                else {
                    if ($end == 0) {
                        $end = 0;
                    } //$end == 0
                }
            } //$i = 0; $i <= $keys; $i++
            
            
            if ($end == 0) { //No users found with this name, then we can create it.
                
                //Create user	
                
                try {
                    
                    $client = new Billy_Client($whmcstobillysbilling_settings['option99']);
                    $cmd    = $client->post("contacts", array(
                        "name" => "$firstname $lastname",
                        "street" => $address1,
                        "zipcode" => $postcode,
                        "city" => $city,
                        "countryId" => $whmcstobillysbilling_settings['option95'],
                        "state" => $state,
                        "phone" => $phonenumber,
                        "fax" => "",
                        "currencyId" => $whmcstobillysbilling_settings['option97'],
                        "vatNo" => "",
                        "ean" => "",
                        "localeId" => $whmcstobillysbilling_settings['option96'],
                        "reminderSchemeId" => "",
                        "externalId" => "",
                        "persons" => array(
                            array(
                                "name" => "$firstname $lastname",
                                "email" => $email,
                                "phone" => $phonenumber
                            )
                        )
                    ));
                    
                    
                    if ($cmd->success == 'true') {
                        $msg = "Create user '$firstname $lastname' in BillysBilling.";
                        whmcstobillysbilling_log($msg);
                    } //$cmd->success == 'true'
                    else {
                        $msg = "Could't create user in BillysBilling. User with the name '$firstname $lastname' allready exists or other error, check log above. ";
                        whmcstobillysbilling_log($msg);
                        whmcstobillysbilling_log("Api data: " . json_encode($cmd));
                        whmcstobillysbilling_log("Options:" . json_encode($whmcstobillysbilling_settings));
                        whmcstobillysbilling_log("Post data:" . json_encode($_POST));
                        whmcstobillysbilling_log("Get data: " . json_encode($_GET));
                    }
                    
                }
                catch (Billy_Exception $e) { // Will be caught
                    whmcstobillysbilling_log($e->getJsonBody());
                    whmcstobillysbilling_log("Api data: " . json_encode($cmd));
                    whmcstobillysbilling_log("Options:" . json_encode($whmcstobillysbilling_settings));
                    whmcstobillysbilling_log("Post data:" . json_encode($_POST));
                    whmcstobillysbilling_log("Get data: " . json_encode($_GET));
                }
                
                
                
            } //$end == 0
            else {
                
                $msg = "Could't create user in BillysBilling. User with the name '$firstname $lastname' allready exists. ";
                whmcstobillysbilling_log($msg);
                
            }
            
            
            
        }
        catch (Billy_Exception $e) { // Will be caught
            whmcstobillysbilling_log($e->getJsonBody());
            whmcstobillysbilling_log("Options:" . json_encode($whmcstobillysbilling_settings));
            whmcstobillysbilling_log("Post data:" . json_encode($_POST));
            whmcstobillysbilling_log("Get data: " . json_encode($_GET));
        }
        
    } //end if option1
    
}
add_hook("ClientAdd", 1, "whmcstobillysbilling_hook_ClientAdd");








/*

UPDATE CLIENT

*/
function whmcstobillysbilling_hook_ClientEdit($vars)
{
    
    global $whmcstobillysbilling_settings;
    $logText = "";
    
    
    if ($whmcstobillysbilling_settings['option2'] == 'on') {
       
  	$userid = $vars['userid'];	
	$contactId = GetContactId($vars['olddata']['email'], $vars['olddata']['firstname'], $vars['olddata']['lastname']);
	
	$firstname = $vars['firstname'];
	$lastname = $vars['lastname'];
	$companyname = $vars['olddata']['companyname'];	
	$email = $vars['email'];
	$address1 = $vars['address1'];
	$address2 = $vars['address2'];
	$city = $vars['city'];	
	$state = $vars['state'];	
	$postcode = $vars['postcode'];
	$country = $vars['country'];
	$phonenumber = $vars['phonenumber'];
	$persons = array("name" => "$name", "email" => $email, "phone" => $phone);
	

try {
                    
                    
                    
                    $client = new Billy_Client($whmcstobillysbilling_settings['option99']);
                    $cmd    = $client->put("contacts/$contactId", array(
                        "name" => "$firstname $lastname",
                        "street" => $address1,
                        "zipcode" => $postcode,
                        "city" => $city,
                        "countryId" => $whmcstobillysbilling_settings['option95'],
                        "state" => $state,
                        "phone" => $phonenumber,
                        "fax" => "",
                        "currencyId" => $whmcstobillysbilling_settings['option97'],
                        "vatNo" => "",
                        "ean" => "",
                        "localeId" => $whmcstobillysbilling_settings['option96'],
                        "reminderSchemeId" => "",
                        "externalId" => "",
                        "persons" => array(
                            array(
                                "name" => "$firstname $lastname",
                                "email" => $email,
                                "phone" => $phonenumber
                            )
                        )
                    ));
                    
                    if ($cmd->success == 'true') {
                        $msg = "User '$firstname $lastname' updated in BillysBilling.";
                        whmcstobillysbilling_log($msg);
                    } //$cmd->success == 'true'
                    else {
                        $msg = "Could't update user in BillysBilling. User with the name '$firstname $lastname' and contactId: $contacId has errors. Check the log. ";
                        whmcstobillysbilling_log($msg);
                        whmcstobillysbilling_log("Api data: " . json_encode($cmd));
                        whmcstobillysbilling_log("Options:" . json_encode($whmcstobillysbilling_settings));
                        whmcstobillysbilling_log("Post data:" . json_encode($_POST));
                        whmcstobillysbilling_log("Get data: " . json_encode($_GET));
                    }
                    
                }
                catch (Billy_Exception $e) { // Will be caught
                    whmcstobillysbilling_log($e->getJsonBody());
                    whmcstobillysbilling_log("Api data: " . json_encode($cmd));
                    whmcstobillysbilling_log("Options:" . json_encode($whmcstobillysbilling_settings));
                    whmcstobillysbilling_log("Post data:" . json_encode($_POST));
                    whmcstobillysbilling_log("Get data: " . json_encode($_GET));
                }
                
                


	}
	
}
add_hook("ClientEdit", 1, "whmcstobillysbilling_hook_ClientEdit");
     
     
     
     
     
     
        