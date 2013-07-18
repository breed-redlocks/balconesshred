<?php

class Contact {
	function Contact() {
		$this->debug = false;
		
		require_once("Database.php");
		$this->database = new Database();
		require_once("FormField.php");
		$this->formField = new FormField();
		require_once("EmailSMTP.php");
		require_once("Email.php");
		
		// initialize spamflags
		$this->spamflags = array();

		$this->invalidFields = array();
		$this->invalidFieldNames = array();
		
		//$this->notificationRecipient = "tyler@balconesresources.com";
		$this->notificationRecipient = "jack@70kft.com";
		$this->debugRecipient        = "jack@stratospherecreative.com";
		
		$this->notificationSubject = "A Web Form Was Submitted";
		$this->fromEmail = "website@balconesshred.com";
		$this->fromName  = "Balcones Shred Web Site";
		
		$this->smtpAuth  = false;
		$this->smtpDebug = false;
		
		$this->smtpHost  = 'mail.balconesshred.com';
		$this->smtpUser  = 'brinc\website@balconesshred.com';
		//$this->smtpUser  = 'website@balconesshred.com';
		//$this->smtpUser  = 'brinc\website';
		$this->smtpPass  = 'asgo356_9';
		
		$this->thankyou = "/thankyou.php";

		$this->defineFields();
		$this->checkSubmission();
		$this->defineQuoteForm();
	}
	
	function checkSubmission() {
		if ($this->debug) {
			echo "Contact->checkSubmission(): ";
		}
		if ($_POST['quote'] == "submitted") {
			if ($this->debug) {
				echo "submitted!<br>\n";
			}
			$this->submitted = true;
			$this->validate();
		} else {
			if ($this->debug) {
				echo "not submitted<br>\n";
			}
			$this->submitted = false;
		}
	}
	
	function validate() {
		// validate a phone number
		if( preg_match("/^([1]-)?[0-9]{3}[0-9]{3}[0-9]{4}$/i", $_POST['phone']) ) {
			$this->sendEmail();
			$this->storeData();
		} elseif( preg_match("/^([1]-)?[0-9]{3}-[0-9]{3}-[0-9]{4}$/i", $_POST['phone']) ) {
			$this->sendEmail();
			$this->storeData();
		} else {
			//echo "Please enter a valid 10 digit phone number";
			echo '<script type="text/javascript">
						alert("Please enter a valid 10 digit phone number");
				</script>';
		}

		
				
		
	}
	
	function process() {
		if ($this->debug) {
			echo "Contact->process()<br>\n";
		}
		$notification = new Email();
		
		$notification->isSMTP();
		$notification->Subject   = $this->notificationSubject;
		$notification->SMTPDebug = $this->smtpDebug;
		$notification->SMTPAuth  = $this->smtpAuth;
		if ($this->smtpAuth) {
			$notification->Host      = $this->smtpHost;
			$notification->Username  = $this->smtpUser;
			$notification->Password  = $this->smtpPass;
		}
		$notification->From      = $this->fromEmail;
		$notification->FromName  = $this->fromName;
		
		$notification->Body      = implode("\n", $this->notificationItems);
		
		// define IP address of this request
		$ip = $this->database->prepVariable($_SERVER['REMOTE_ADDR']);
		
		// look up geographic info by IP
		//require_once("GeoIPCity.php");
		//$pathToData = dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/data";
		//$gi = geoip_open("$pathToData/GeoLiteCity.dat", GEOIP_STANDARD);
		//$giRecord = geoip_record_by_addr($gi, $ip);
		//$georegion = $giRecord->region;
		
		// begin query construction
		$query  = "INSERT INTO `contact` ";
		$query .= "SET ";
		$query .= implode(", ", $this->queryItems);
		
		// append IP address to query
		$query .= ", `ip` = '$ip'";
		
		// append geographic region (state) to query
		$safegeoregion = $this->database->prepVariable($georegion);
		$query .= ", `georegion` = '$safegeoregion'";
		
		// define spam flags
		if (($georegion != "TX") && ($georegion != "ID"))  {
			$this->spamflags[] = "isNotTX";
		}
		$spamflags = implode(", ", $this->spamflags);
		$query .= ", `spamflags` = '$spamflags'";
		
		$this->database->getResults($query);
		
		if ($this->debug) {
			echo implode("<br>\n", $this->notificationItems);
			$notification->AddAddress($this->debugRecipient);
			$notification->Send();
			echo "<br>\n";
			echo "Query: $query<br>\n";
			if ($spamflags == "") {
				echo "Notification would have been sent to: " . $this->notificationRecipient . "<br>\n";
			} else {
				echo "Notification would NOT have been sent because spamflags is set to $spamflags.<br>\n";
			}
			echo "Redirect to: " . $this->thankyou . "<br>\n";
			/*
			echo "----- GeoIP Output Record for $ip -----";
			echo "<pre style=\"text-align: left\">";
			print_r($giRecord);
			echo $giRecord->country_code . " " . $giRecord->country_code3 . " " . $giRecord->country_name . "\n";
			echo $giRecord->region . " " . $GEOIP_REGION_NAME[$giRecord->country_code][$giRecord->region] . "\n";
			echo $giRecord->city . "\n";
			echo $giRecord->postal_code . "\n";
			echo $giRecord->latitude . "\n";
			echo $giRecord->longitude . "\n";
			echo $giRecord->metro_code . "\n";
			echo $giRecord->area_code . "\n";
			*/
			echo "</pre>";
		} else {
			$notification->AddAddress($this->notificationRecipient);
			if ($spamflags == "") {
				$notification->Send();
			}
			header("location: {$this->thankyou}");
		}
	}
	
	function getHTMLQuoteForm() {
		return $this->quoteForm;
	}
	
	function defineQuoteForm() {
		$this->quoteForm  = "<form id=\"quote\" method=\"post\" action=\"\">\n";
		foreach ($this->fields as $field) {
			$this->quoteForm .= $this->getHTMLField($field);
		}
		$this->quoteForm .= "* indicates required fields<br>\n";
		$this->quoteForm .= "<input type=\"hidden\" name=\"quote\" value=\"submitted\">\n";
		$this->quoteForm .= "<input class=\"submit\" type=\"image\" ";
		$this->quoteForm .= "src=\"/rsrc/common/submit.gif\" value=\"Submit\">\n";
		$this->quoteForm .= "</form>\n";
	}
		
	function getHTMLField($which) {
		$var  = $which['var'];
		$name = $which['name'];
		$reqd = $which['reqd'];
		
		$isInvalid = in_array($which, $this->invalidFields);
		
		$reqdText = "";
		if ($reqd) {
			$reqdText = " *";
		}
		
		$valueText = "";
		$value = "";
		$classText = " class=\"text\"";
		if ($this->submitted) {
			if (isset($_POST[$var])) {
				$value = $_POST[$var];
				$valueText = " value=\"" . $_POST[$var] . "\"";
			}
			if ($isInvalid) {
				$classText = " class=\"invalidtext\"";
			}
		}
		
		$theHTML  = "";
		$theHTML .= "$name$reqdText<br>\n";
		if ($var == "details") {
			$theHTML .= "<textarea$classText rows=\"3\" name=\"$var\">$value</textarea><br>\n";
		} else {
			$theHTML .= "<input type=\"text\"$classText name=\"$var\"$valueText><br>\n";
		}
		
		return $theHTML;
	}
	
	function defineFields() {
		$this->fields[] = array(
			'var'  => "company",
			'name' => "Company",
			'reqd' => true,
		);
		$this->fields[] = array(
			'var'  => "zipcode",
			'name' => "ZIP Code",
			'reqd' => true,
		);
		$this->fields[] = array(
			'var'  => "contactname",
			'name' => "Contact Name",
			'reqd' => true,
		);
		$this->fields[] = array(
			'var'  => "phone",
			'name' => "Phone Number",
			'reqd' => true,
		);
		$this->fields[] = array(
			'var'  => "email",
			'name' => "Email",
			'reqd' => true,
		);
		$this->fields[] = array(
			'var'  => "details",
			'name' => "Details",
			'reqd' => false,
		);
	}
	
	function sendEmail() {
	
		$company 		= $_POST['company'];
		$zipcode 		= $_POST['zipcode'];
		$name 			= $_POST['contactname'];
		$phone 			= $_POST['phone'];
		$email 			= $_POST['email'];
		$details 		= $_POST['details'];
		
		if ($phone == "123456") {
			
		} elseif ($phone == "4085551234") {
		
		} else {
	
		if ($this->debug) {
			$emailSubject 	= 'TEST - Contact Inquiry from Balcones Resources';
			$mailto 		= 'jack@70kft.com';
		} else {
			$emailSubject 	= 'Contact Inquiry from Balcones Shred';
			//$mailto 		= 'tyler@balconesresources.com,jack@70kft.com';
			$mailto 		= 'tyler@balconesresources.com,bgetter@balconesresources.com,courtney@balconesresources.com,jack@70kft.com';
			//$mailto			= 'jack@70kft.com';
		}
		// tyler@balconesresources.com,

		// FORMAT EMAIL

		$body = 'You have received a contact request from Balcones Shred.
				<br><hr><br>
				Name: '.$name.' <br>
				Company Name: '.$company.' <br>
				Email: '.$email.' <br>
				Phone: '.$phone.' <br>
				Zip Code: '.$zipcode.' <br>
				Question: '.$details.' <br>';

			$headers = "From: $email\r\n";
			$headers .= "Content-type: text/html\r\n";
			$success = mail($mailto, $emailSubject, $body, $headers);

		if ($this->debug) {
			echo "Thank You Page = http://www.balconesshred.com/thankyou.html";
		} else {
			header ("location: http://www.balconesshred.com/thankyou.html");	
		}
		} // END PHONE VALIDATION
	}
	function storeData(){
	
		if ($this->debug) {
			echo "<pre> POST ";
			print_r ($_POST);
			echo "</pre>";
		}
		
		if ($_POST['phone'] == "123456") {
			
		} else {
		
		$items 	= '';
		$values = '';
		
		$i=0;
		
		
		if ($this->debug) {
			echo "<pre>";
			print_r ($values);
			echo "</pre>";
		}
		
		$data = implode(",", $_POST);
	
		// begin query construction
		$query  = "INSERT INTO `contact` ";
		//$query .= "SET ";
		$query .= "(company, zipcode, contactname, phone, email, details) ";
		$query .= 'values ("'.$_POST['company'].'","'.$_POST['zipcode'].'","'.$_POST['contactname'].'","'.$_POST['phone'].'","'.$_POST['email'].'","'.$_POST['details'].'")';
		
		echo $query;
	
		$this->database->getResults($query);
		
		} // END Phone Validation
	}

}

?>