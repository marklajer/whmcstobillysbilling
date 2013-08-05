whmcstobillysbilling
====================
<a href='http://www.pledgie.com/campaigns/21264'><img alt='Click here to lend your support to: whmcstobillysbilling and make a donation at www.pledgie.com !' src='http://www.pledgie.com/campaigns/21264.png?skin_name=chrome' border='0' /></a><br><br>
WHMCS to BillysBilling<br>
Base code by: Kim Vinberg - <a href="http://dicm.dk">http://dicm.dk</a>
<br>
<br>
<b>What this does:</b><br>
This script makes a connection from your WHMCS installation using the BillysBilling API (v1).<br>
You as site owner will be able to activate / deactivate some functions you want to use with this script.
<br>
<br>
<b>Functions:</b><br>
* "Create cliens automatically" : Creates the client in BillysBilling using the information available from WHMCS. <br>This is not a option if the function "Create invoice in BillysBilling" is active.<br>
* "Update clients automatically" : Updates client information when a client or admin edit the information. <br><br>

<b>Changelog (partial):</b><br>
Function: billysbilling_hook_UpdateInvoiceTotal() , removed in new version. Was used to allow creation of invoices from WHMCS admin, but this function added a new invoice in BillyBilling for every line in it andn the invoice numbers increase wrong. That was not fixable, because of the way WHMCS created this type of invoice (invoice is created before items have been added, creating blank imvoices in BillysBilling. Creating the invoice only when item is added is possible , but it will only work with 1 product each invoice OR the problem will continue.) Removed. 
<br><br>
<b>Installation:</b><br>
* Upload the files you recieved from the Zip file to: http://xxxxxxx.xxx/YOUR-WHMCS-DIR/modules/addons/<br>
If the Zip file does not contain a directory called "whmcstobillysbilling", then create the directoryin the above directory.<br>
* Go to your site (backend): http://xxxxxxx.xxx/YOUR-WHMCS-DIR/admin/configaddonmods.php<br>
* Activate the addon by clicking the "Activate" button.<br>
* <b>Click the "Configure" button and enter these informations:</b> <br>
BillysBilling API key (you can find this in your BillysBilling account)<br>
WHMCS admin username	(the username you login with)<br>
Now select some of the functions you want to activate.<br>
* Go to your BillysBilling account and find "ChartOfAccounts"<br>
* <b>Add a new account with these informations:</b><br>
Type: income<br>
Name: whmcs-sale<br>
Vat rate: no vat<br><br>
<b>Add a second account with these informations:</b><br>
Type: income<br>
Name: whmcs-sale-vat<br>
Vat rate: your vat rate<br>
