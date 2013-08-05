<?php
/**
 * Whmcs to BillysBilling Hooks
 *
 *
 * @package    whmcstobillysbilling
 * @author     Kim Vinberg <info@dicm.dk>
 * @copyright  Copyright (c) Kim Vinberg 2013
 * @license    http://dicm.dk
 * @version    $Id$
 * @link       http://dicm.dk/
 * @github	https://github.com/dicm/whmcstobillysbilling
 */


if (!defined("WHMCS"))
    die("This file cannot be accessed directly");





/* ALL SETTINGS FOR THE SCRIPT */

$q = @mysql_query("SELECT * FROM tbladdonmodules WHERE module = 'whmcstobillysbilling'");

while ($arr = mysql_fetch_array($q)) {
    $whmcstobillysbilling_settings[$arr['setting']] = $arr['value'];
} //$arr = mysql_fetch_array($q)

/* ALL SETTINGS FOR THE SCRIPT */

/**/

function localeId($localeId) {

$array = array("DK" => "da_DK");

if(isset($array[$localeId]) && $array[$localeId] != '') {
$localeId = $array[$localeId];
} else {
//fallback to en_US
$localeId = "en_US"; //english
}

return $localeId;

}

/* This file is used to match the countries from WHMCS in BillysBilling, so when adding or editing a client, his / hers country will be correct (this is important when buying and selling for VAT and balance in the correct accounts.
The country: 	"Curacao" have been set to NL.
 */
 function countryId($countryId) {
 
     global $whmcstobillysbilling_settings;
     
$array = array(
"AF" => "AF", //	Afghanistan	
"AX" => "AX",	//	Aland Islands	
"AL" => "AL",	//	Albania	
"DZ" => "DZ",	//	Algeria	
"AS" => "AS",	//	American Samoa	
"AD" => "AD",	//	Andorra	
"AO" => "AO",	//	Angola	
"AI" => "AI",	//	Anguilla	
"AQ" => "AQ",	//	Antarctica	
"AG" => "AG",	//	Antigua And Barbuda	
"AR" => "AR",	//	Argentina	
"AM" => "AM",	//	Armenia	
"AW" => "AW",	//	Aruba	
"AU" => "AU",	//	Australia	
"AT" => "AT",	//	Austria	
"AZ" => "AZ",	//	Azerbaijan	
"BS" => "BS",	//	Bahamas	
"BH" => "BH",	//	Bahrain	
"BD" => "BD",	//	Bangladesh	
"BB" => "BB",	//	Barbados	
"BY" => "BY",	//	Belarus	
"BE" => "BE",	//	Belgium	
"BZ" => "BZ",	//	Belize	
"BJ" => "BJ",	//	Benin	
"BM" => "BM",	//	Bermuda	
"BT" => "BT",	//	Bhutan	
"BO" => "BO",	//	Bolivia	
"BA" => "BA",	//	Bosnia And Herzegovina	
"BW" => "BW",	//	Botswana	
"BV" => "BV",	//	Bouvet Island	
"BR" => "BR",	//	Brazil	
"IO" => "IO",	//	British Indian Ocean Territory	
"BN" => "BN",	//	Brunei Darussalam	
"BG" => "BG",	//	Bulgaria	
"BF" => "BF",	//	Burkina Faso	
"BI" => "BI",	//	Burundi	
"KH" => "KH",	//	Cambodia	
"CM" => "CM",	//	Cameroon	
"CA" => "CA",	//	Canada	
"CV" => "CV",	//	Cape Verde	
"KY" => "KY",	//	Cayman Islands	
"CF" => "CF",	//	Central African Republic	
"TD" => "TD",	//	Chad	
"CL" => "CL",	//	Chile	
"CN" => "CN",	//	China	
"CX" => "CX",	//	Christmas Island	
"CC" => "CC",	//	Cocos (Keeling) Islands	
"CO" => "CO",	//	Colombia	
"KM" => "KM",	//	Comoros	
"CG" => "CG",	//	Congo	
"CD" => "CD",	//	Congo, Democratic Republic	
"CK" => "CK",	//	Cook Islands	
"CR" => "CR",	//	Costa Rica	
"CI" => "CI",	//	Cote D'Ivoire	
"HR" => "HR",	//	Croatia	
"CU" => "CU",	//	Cuba	
"CW" => "NL",	//	Curacao - ORIGINAL CW , but set to NL	
"CY" => "CY",	//	Cyprus	
"CZ" => "CZ",	//	Czech Republic	
"DK" => "DK",	//	Denmark	
"DJ" => "DJ",	//	Djibouti	
"DM" => "DM",	//	Dominica	
"DO" => "DO",	//	Dominican Republic	
"EC" => "EC",	//	Ecuador	
"EG" => "EG",	//	Egypt	
"SV" => "SV",	//	El Salvador	
"GQ" => "GQ",	//	Equatorial Guinea	
"ER" => "ER",	//	Eritrea	
"EE" => "EE",	//	Estonia	
"ET" => "ET",	//	Ethiopia	
"FK" => "FK",	//	Falkland Islands (Malvinas)	
"FO" => "FO",	//	Faroe Islands	
"FJ" => "FJ",	//	Fiji	
"FI" => "FI",	//	Finland	
"FR" => "FR",	//	France	
"GF" => "GF",	//	French Guiana	
"PF" => "PF",	//	French Polynesia	
"TF" => "TF",	//	French Southern Territories	
"GA" => "GA",	//	Gabon	
"GM" => "GM",	//	Gambia	
"GE" => "GE",	//	Georgia	
"DE" => "DE",	//	Germany	
"GH" => "GH",	//	Ghana	
"GI" => "GI",	//	Gibraltar	
"GR" => "GR",	//	Greece	
"GL" => "GL",	//	Greenland	
"GD" => "GD",	//	Grenada	
"GP" => "GP",	//	Guadeloupe	
"GU" => "GU",	//	Guam	
"GT" => "GT",	//	Guatemala	
"GG" => "GG",	//	Guernsey	
"GN" => "GN",	//	Guinea	
"GW" => "GW",	//	Guinea-Bissau	
"GY" => "GY",	//	Guyana	
"HT" => "HT",	//	Haiti	
"HM" => "HM",	//	Heard Island & Mcdonald Islands	
"VA" => "VA",	//	Holy See (Vatican City State)	
"HN" => "HN",	//	Honduras	
"HK" => "HK",	//	Hong Kong	
"HU" => "HU",	//	Hungary	
"IS" => "IS",	//	Iceland	
"IN" => "IN",	//	India	
"ID" => "ID",	//	Indonesia	
"IR" => "IR",	//	Iran, Islamic Republic Of	
"IQ" => "IQ",	//	Iraq	
"IE" => "IE",	//	Ireland	
"IM" => "IM",	//	Isle Of Man	
"IL" => "IL",	//	Israel	
"IT" => "IT",	//	Italy	
"JM" => "JM",	//	Jamaica	
"JP" => "JP",	//	Japan	
"JE" => "JE",	//	Jersey	
"JO" => "JO",	//	Jordan	
"KZ" => "KZ",	//	Kazakhstan	
"KE" => "KE",	//	Kenya	
"KI" => "KI",	//	Kiribati	
"KR" => "KR",	//	Korea	
"KW" => "KW",	//	Kuwait	
"KG" => "KG",	//	Kyrgyzstan	
"LA" => "LA",	//	Lao People's Democratic RepublicLV	
"LB" => "LB",	//	Lebanon	
"LS" => "LS",	//	Lesotho	
"LR" => "LR",	//	Liberia	
"LY" => "LY",	//	Libyan Arab Jamahiriya	
"LI" => "LI",	//	Liechtenstein	
"LT" => "LT",	//	Lithuania	
"LU" => "LU",	//	Luxembourg	
"MO" => "MO",	//	Macao	
"MK" => "MK",	//	Macedonia	
"MG" => "MG",	//	Madagascar	
"MW" => "MW",	//	Malawi	
"MY" => "MY",	//	Malaysia	
"MV" => "MV",	//	Maldives	
"ML" => "ML",	//	Mali	
"MT" => "MT",	//	Malta	
"MH" => "MH",	//	Marshall Islands	
"MQ" => "MQ",	//	Martinique	
"MR" => "MR",	//	Mauritania	
"MU" => "MU",	//	Mauritius	
"YT" => "YT",	//	Mayotte	
"MX" => "MX",	//	Mexico	
"FM" => "FM",	//	Micronesia, Federated States Of	
"MD" => "MD",	//	Moldova	
"MC" => "MC",	//	Monaco	
"MN" => "MN",	//	Mongolia	
"ME" => "ME",	//	Montenegro	
"MS" => "MS",	//	Montserrat	
"MA" => "MA",	//	Morocco	
"MZ" => "MZ",	//	Mozambique	
"MM" => "MM",	//	Myanmar	
"NA" => "NA",	//	Namibia	
"NR" => "NR",	//	Nauru	
"NP" => "NP",	//	Nepal	
"NL" => "NL",	//	Netherlands	
"AN" => "AN",	//	Netherlands Antilles	
"NC" => "NC",	//	New Caledonia	
"NZ" => "NZ",	//	New Zealand	
"NI" => "NI",	//	Nicaragua	
"NE" => "NE",	//	Niger	
"NG" => "NG",	//	Nigeria	
"NU" => "NU",	//	Niue	
"NF" => "NF",	//	Norfolk Island	
"MP" => "MP",	//	Northern Mariana Islands	
"NO" => "NO",	//	Norway	
"OM" => "OM",	//	Oman	
"PK" => "PK",	//	Pakistan	
"PW" => "PW",	//	Palau	
"PS" => "PS",	//	Palestinian Territory, Occupied	
"PA" => "PA",	//	Panama	
"PG" => "PG",	//	Papua New Guinea	
"PY" => "PY",	//	Paraguay	
"PE" => "PE",	//	Peru	
"PH" => "PH",	//	Philippines	
"PN" => "PN",	//	Pitcairn	
"PL" => "PL",	//	Poland	
"PT" => "PT",	//	Portugal	
"PR" => "PR",	//	Puerto Rico	
"QA" => "QA",	//	Qatar	
"RE" => "RE",	//	Reunion	
"RO" => "RO",	//	Romania	
"RU" => "RU",	//	Russian Federation	
"RW" => "RW",	//	Rwanda	
"BL" => "BL",	//	Saint Barthelemy	
"SH" => "SH",	//	Saint Helena	
"KN" => "KN",	//	Saint Kitts And Nevis	
"LC" => "LC",	//	Saint Lucia	
"MF" => "MF",	//	Saint Martin	
"PM" => "PM",	//	Saint Pierre And Miquelon	
"VC" => "VC",	//	Saint Vincent And Grenadines	
"WS" => "WS",	//	Samoa	
"SM" => "SM",	//	San Marino	
"ST" => "ST",	//	Sao Tome And Principe	
"SA" => "SA",	//	Saudi Arabia	
"SN" => "SN",	//	Senegal	
"RS" => "RS",	//	Serbia	
"SC" => "SC",	//	Seychelles	
"SL" => "SL",	//	Sierra Leone	
"SG" => "SG",	//	Singapore	
"SK" => "SK",	//	Slovakia	
"SI" => "SI",	//	Slovenia	
"SB" => "SB",	//	Solomon Islands	
"SO" => "SO",	//	Somalia	
"ZA" => "ZA",	//	South Africa	
"GS" => "GS",	//	South Georgia And Sandwich Isl.	
"ES" => "ES",	//	Spain	
"LK" => "LK",	//	Sri Lanka	
"SD" => "SD",	//	Sudan	
"SR" => "SR",	//	Suriname	
"SJ" => "SJ",	//	Svalbard And Jan Mayen	
"SZ" => "SZ",	//	Swaziland	
"SE" => "SE",	//	Sweden	
"CH" => "CH",	//	Switzerland	
"SY" => "SY",	//	Syrian Arab Republic	
"TW" => "TW",	//	Taiwan	
"TJ" => "TJ",	//	Tajikistan	
"TZ" => "TZ",	//	Tanzania	
"TH" => "TH",	//	Thailand	
"TL" => "TL",	//	Timor-Leste	
"TG" => "TG",	//	Togo	
"TK" => "TK",	//	Tokelau	
"TO" => "TO",	//	Tonga	
"TT" => "TT",	//	Trinidad And Tobago	
"TN" => "TN",	//	Tunisia	
"TR" => "TR",	//	Turkey	
"TM" => "TM",	//	Turkmenistan	
"TC" => "TC",	//	Turks And Caicos Islands	
"TV" => "TV",	//	Tuvalu	
"UG" => "UG",	//	Uganda	
"UA" => "UA",	//	Ukraine	
"AE" => "AE",	//	United Arab Emirates	
"GB" => "GB",	//	United Kingdom	
"US" => "US",	//	 selected=	
"UM" => "UM",	//	United States Outlying Islands	
"UY" => "UY",	//	Uruguay	
"UZ" => "UZ",	//	Uzbekistan	
"VU" => "VU",	//	Vanuatu	
"VE" => "VE",	//	Venezuela	
"VN" => "VN",	//	Viet Nam	
"VG" => "VG",	//	Virgin Islands, British	
"VI" => "VI",	//	Virgin Islands, U.S.	
"WF" => "WF",	//	Wallis And Futuna	
"EH" => "EH",	//	Western Sahara	
"YE" => "YE",	//	Yemen	
"ZM" => "ZM",	//	Zambia	
"ZW" => "ZW",	//	Zimbabwe	
);

if($array[$countryId] == '') {
$countryId = $whmcstobillysbilling_settings['option95'];
} else {
$countryId = $array[$countryId];
}

return $countryId;
}


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
        $country     = countryId($vars['country']);
        //$vars['country'];
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
                        "countryId" => countryId($vars['country']),
                        //$whmcstobillysbilling_settings['option95'],
                        "state" => $state,
                        "phone" => $phonenumber,
                        "fax" => "",
                        "currencyId" => $whmcstobillysbilling_settings['option97'],
                        "vatNo" => "",
                        "ean" => "",
                        "localeId" => localeId($vars['country']),
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
                        "countryId" => countryId($vars['country']),
                        "state" => $state,
                        "phone" => $phonenumber,
                        "fax" => "",
                        "currencyId" => $whmcstobillysbilling_settings['option97'],
                        "vatNo" => "",
                        "ean" => "",
                        "localeId" => localeId($vars['country']),
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
     
     
     
function billysbilling_hook_InvoiceCreated($vars)
{
	
	    
    global $whmcstobillysbilling_settings;
    $logText = "";
    
    
    if ($whmcstobillysbilling_settings['option3'] == 'on') {
    
    
   $userid = $vars['userid'];	
	$firstname = $vars['firstname'];	
	$lastname = $vars['lastname'];	
	$companyname = $vars['companyname'];
	$email = $vars['email'];
	$address1 = $vars['address1'];	
	$address2 = $vars['address2'];
	$city = $vars['city'];	
	$state = $vars['state'];	
	$postcode = $vars['postcode'];	
	$country = countryId($vars['country']);
	$phonenumber = $vars['phonenumber'];	
	$password = $vars['password'];
    
    
    
try {
 
	$adminuser = $whmcstobillysbilling_settings['option100'];
	$command = 'getinvoice';
	$values = array('invoiceid' => $vars['invoiceid']);	
	$results = localAPI($command, $values, $adminuser);
	$currencyId = "" . $whmcstobillysbilling_settings['option97'] . "";
	
	if($results['result'] == "success")
	{
	             
      $command_client = "getclientsdetails";	
		$values_client['clientid'] = $results['userid'];	
		$values_client['stats'] = false;	
		$values_client['responsetype'] = "xml";		
		$results_client = localAPI($command_client, $values_client, $adminuser);
				
		if($results_client['result'] == "success")
		{
					
			$email = $results_client['client']['email'];			
			$contactId = "" . GetContactId($email, $firstname, $lastname) . "";
			
		}  else {
                        $msg = "Results no success on client.";
                        whmcstobillysbilling_log($msg);      
             }           
                    
         if($contactId == 0)
			{
			whmcstobillysbilling_hook_ClientAdd($vars);
			}
			
		/*		
			foreach($results['items']['item'] AS $item => $line)
			{

		$description_exp = explode(" (", $line['description']);
			$description_exp1 = explode(" - ", $line['description']);
			$description = str_replace(":", "", $description_exp1['0']);
			$description_expanded = "" . $line['type'] . ": " . $description_exp['0'] . "";
				
			$accountId = "" . GetAccountId($apiKey, $settings['option3']) . "";
			$vatModelId = "" . GetvatModelId($apiKey, $settings['option4']) . "";
			$productamount = $line['amount'];
			$productamount = $productamount - ($productamount * $settings['option6'] / 100);
						
				if($productamount < 0)
				{
					$prices = array("currencyId" => $settings['option12'], "unitPrice" => 0);
				}
				else
				{
					$prices = array("currencyId" => $settings['option12'], "unitPrice" => $productamount);
				}
				
				$create = "1";
				
				$output = GetProductId($apiKey, $description, $line['amount'], $description, $accountId, $vatModelId, $prices, "1");

				if($output == '0' && $create == '1' || $output == '' && $create == '1')
				{

						$output1 = CreateProduct($apiKey, $description, $description, $accountId, $vatModelId, $prices);
	
					if($output1 == '') { 
					$productId = GetProductId($apiKey, $description, $line['amount'], $description, $accountId, $vatModelId, $prices, "0");
					} else {
					$productId =  $output1;
					}			

				}
				else
				{
					$productId = GetProductId($apiKey, $description, $line['amount'], $description, $accountId, $vatModelId, $prices, "0");						

				}
				
				
$linamount = $line['amount'];	
$linamount = $linamount - ($linamount * $settings['option6'] / 100);
$lines[] = array("productId" => $productId, "description" => $line['description'], "quantity" => "1", "unitPrice" => $linamount);
		
			
			} //END foreach
				
			$dueDate = $results['duedate'];
			$entryDate = $results['date'];
			$invoiceNo = $results['invoiceid'];	
			$type = "invoice";
			$output = CreateInvoice($apiKey, $contactId, $lines, $dueDate, $entryDate, $invoiceNo, $type, $currencyId);

			$invoiceId = $output->id;		
			$fileUrl = "" . $settings['option14'] . "dl.php?type=i&id=" . $results['invoiceid'] . "&viewpdf=0";		
			$data = pdfInvoice($results['invoiceid']);	
			$filename = "Invoice-" . $results['invoiceid'] . ".pdf";	
			$var = "" . CreateAttachment($apiKey, $invoiceId, $data, $filename) . "";
			
	*/
			           
              /*      $client = new Billy_Client($whmcstobillysbilling_settings['option99']);
                    $cmd    = $client->put("contacts/$contactId", array(
                        "name" => "$firstname $lastname",
                        "street" => $address1,
                        "zipcode" => $postcode,
                        "city" => $city,
                        "countryId" => countryId($vars['country']),
                        "state" => $state,
                        "phone" => $phonenumber,
                        "fax" => "",
                        "currencyId" => $whmcstobillysbilling_settings['option97'],
                        "vatNo" => "",
                        "ean" => "",
                        "localeId" => localeId($vars['country']),
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
                        $msg = "Invoice created.";
                        whmcstobillysbilling_log($msg);
                    } //$cmd->success == 'true'
                    else {
                        $msg = "Failed to add invoice.";
                        whmcstobillysbilling_log($msg);
                        whmcstobillysbilling_log("Api data: " . json_encode($cmd));
                        whmcstobillysbilling_log("Options:" . json_encode($whmcstobillysbilling_settings));
                        whmcstobillysbilling_log("Post data:" . json_encode($_POST));
                        whmcstobillysbilling_log("Get data: " . json_encode($_GET));
                    }*/
   	} //result fails.
   	  else {
                        $msg = "Results no success.";
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
                
                
    
    
    } //if option3 on

}
add_hook("InvoiceCreated", 1, "billysbilling_hook_InvoiceCreated");

     
     
        