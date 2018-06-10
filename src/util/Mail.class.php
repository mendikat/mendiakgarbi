<?php

namespace AmfFam\MendiakGarbi\Util;

require_once __DIR__.'/../vendor/phpmailer/PHPMailer.php';
require_once __DIR__.'/../vendor/phpmailer/SMTP.php';
require_once __DIR__.'/../vendor/phpmailer/POP3.php';
require_once __DIR__.'/../vendor/phpmailer/Exception.php';

use \PHPMailer\PHPMailer\PHPMailer as PHPMailer;

/**
 *	 Provide a class for send email messages
 *
 */
class Mail {

    /**
     * @var PHPMailer                   The PHP Mailer agent
     */
    protected $_mailer;
    
    /**
     * @var string                      The error
     */
	protected $_error;

   	/**
     * Object contructor
	 *
     * @return void
     */
	public function __construct() {

        $this->_mailer=new PHPMailer;
        $this->_mailer->Mailer= 'smtp';
        $this->_mailer->Host=MAIL_HOST;
        $this->_mailer->SMTPAuth= TRUE;
	    $this->_mailer->Username=MAIL_USER;
  		$this->_mailer->Password=MAIL_PASSWORD;
        $this->_mailer->Timeout=MAIL_TIMEOUT;
		$this->_mailer->From=MAIL_MAIL;
        $this->_mailer->FromName=MAIL_NAME;
		$this->_mailer->CharSet = 'utf-8';

    }
	
	/**
	 *	Get last error
	 *
	 *	@return string
	 */
	public function get_error():string {
		
		return $this->_error;
		
	}

    /**
     * Add adresses to mail
	 *
     * @param  mixed  $recipient 				A recipient or array of recipients
	 *
     * @return void
     */
	public function add_recipient( $recipient):void {

		// If the recipient is an array, add each recipient...
        // otherwise just add the one
		if (is_array( $recipient))
		{
			foreach ( $recipient as $to) {
				$this->_mailer->AddAddress( $to);
			}
		} else {
			$this->_mailer->AddAddress( $recipient);
		}
	}

    /**
     * Add carbon copy recipient
	 *
     * @param  mixed  $recipient			 	A recipient or array of recipients
     *
	 * @return void
     */
	public function add_cc( $cc):void {
		// If the carbon copy recipient is an array,
        // add each recipient... otherwise just add the one
		if (isset ( $cc))
		{
			if (is_array( $cc)) {
				foreach ( $cc as $to) {
					$this->_mailer->AddCC( $to);
				}
			} else {
				$this->_mailer->AddCC( $cc);
			}
		}
	}

   	/**
     * Add blind carbon copy recipient
	 *
     * @param  mixed  $recipient				A recipient or array of recipients
     *
	 * @return void
     */
	public function add_bcc( $bcc):void {
		// If the blind carbon copy recipient is an aray,
        // add each recipient... otherwise just add the one
		if (isset ($bcc))
		{
			if ( is_array( $bcc)) {
				foreach ($bcc as $to) {
					$this->_mailer->AddBCC( $to);
				}
			} else {
				$this->_mailer->AddBCC( $bcc);
			}
		}
	}

	/**
     * Set the mail subject
	 *
     * @param  string $subject
     *
	 * @return void
     */
    public function set_subject( string $subject):void {

    	$this->_mailer->Subject= utf8_encode( $subject);
    }

    /**
     * Set the mail message
	 *
     * @param  string $message
     *
	 * @return void
     */
    public function set_message( string $message):void {

    	$this->_mailer->Body= $message;
		$this->_mailer->AltBody=strip_tags( $message);
    }

    /**
     * Add attachment to mail
	 *
     * @param  string $attachment 		 File to add ( string or array )
	 * @param  string $filename			 The filename
     *
	 * @return void
     */
	public function add_attachment( string $attachment, string $filename){
		$this->_mailer->AddAttachment( $attachment, $filename);
	}
	
	/**
	 *	Set if the mail is in HTML format
	 *
	 *	@param	 bool	$value
	 *
	 *	@return	 void
	 */
	public function is_HTML( bool $value):void {
		
		$this->_mailer->IsHTML( $value); 
	
	}

    /**
     * Send the mail
	 *
	 * @param	bool 	verify_SSL    if TRUE verify the SSL Certificate	
	 *								  	if server use a SSL certificate, it  must be valid
	 *								  	else set verify_SSL parameter to FALSE
	 *
     * @return bool					  TRUE if message send successfully
     *
	 */
    public function send( bool $verify_SSL = FALSE ):bool {
		
		//  Verify the SSL Certificate
		
		if ( ! $verify_SSL ) {
		
			$this->_mailer->SMTPOptions = array(
				'ssl' => [
					'verify_peer' => FALSE,
					'verify_peer_name' => FALSE,
					'allow_self_signed' => TRUE
				]
			);
		
		}
		
		// Send the mail
     	
		if ( $this->_mailer->send() )
			return TRUE;
		else {
			$this->_error = $this->_mailer->ErrorInfo;
			return FALSE;
		}
    }

}

?>