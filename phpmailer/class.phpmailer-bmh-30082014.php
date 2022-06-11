<?php
/* class.phpmailer-bmh.php
.---------------------------------------------------------------------------.
|  Software: PHPMailer-BMH (Bounce Mail Handler)                            |
|   Version: 5.0.0rc1                                                       |
|   Contact: codeworxtech@users.sourceforge.net                             |
|      Info: http://phpmailer.codeworxtech.com                              |
| ------------------------------------------------------------------------- |
|    Author: Andy Prevost andy.prevost@worxteam.com (admin)                 |
| Copyright (c) 2002-2009, Andy Prevost. All Rights Reserved.               |
| ------------------------------------------------------------------------- |
|   License: Distributed under the General Public License (GPL)             |
|            (http://www.gnu.org/licenses/gpl.html)                         |
| This program is distributed in the hope that it will be useful - WITHOUT  |
| ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or     |
| FITNESS FOR A PARTICULAR PURPOSE.                                         |
| -------00------------------------------------------------------------------ |
| This is a update of the original Bounce Mail Handler script               |
| http://sourceforge.net/projects/bmh/                                      |
| The script has been renamed from Bounce Mail Handler to PHPMailer-BMH     |
| ------------------------------------------------------------------------- |
| We offer a number of paid services:                                       |
| - Web Hosting on highly optimized fast and secure servers                 |
| - Technology Consulting                                                   |
| - Oursourcing (highly qualified programmers and graphic designers)        |
'---------------------------------------------------------------------------'
Last updated: January 21 2009 13:49 EST */

/**
 * PHPMailer-BMH (Bounce Mail Handler)
 *
 * PHPMailer-BMH is a PHP program to check your IMAP/POP3 inbox and
 * delete all 'hard' bounced emails. It features a callback function where
 * you can create a custom action. This provides you the ability to write
 * a script to match your database records and either set inactive or
 * delete records with email addresses that match the 'hard' bounce results.
 *
 * @package PHPMailer-BMH
 * @author Andy Prevost
 * @copyright 2008-2009, Andy Prevost
 * @license GPL licensed
 * @version 5.0.0rc1
 * @link http://sourceforge.net/projects/bmh
 *
 */

define('VERBOSE_QUIET',  0); // means no output at all
define('VERBOSE_SIMPLE', 1); // means only output simple report
define('VERBOSE_REPORT', 2); // means output a detail report
define('VERBOSE_DEBUG',  3); // means output detail report as well as debug info.

require_once('phpmailer-bmh_rules.php');

class BounceMailHandler {

  /////////////////////////////////////////////////
  // PROPERTIES, PUBLIC
  /////////////////////////////////////////////////

  /**
   * Holds Bounce Mail Handler version.
   * @var string
   */
  public $Version = "5.0.0rc1";

  /**
   * Mail server
   * @var string
   */
  public $mailhost = 'localhost';

  /**
   * The username of mailbox
   * @var string
   */
  public $mailbox_username;

  /**
   * The password needed to access mailbox
   * @var string
   */
  public $mailbox_password;

  /**
   * The last error msg
   * @var string
   */
  public $error_msg;

  /**
   * Maximum limit messages processed in one batch
   * @var int
   */
  public $max_messages = 3000;

  /**
   * Callback Action function name
   * the function that handles the bounce mail. Parameters:
   *   int     $msgnum        the message number returned by Bounce Mail Handler
   *   string  $bounce_type   the bounce type: 'antispam','autoreply','concurrent','content_reject','command_reject','internal_error','defer','delayed'        => array('remove'=>0,'bounce_type'=>'temporary'),'dns_loop','dns_unknown','full','inactive','latin_only','other','oversize','outofoffice','unknown','unrecognized','user_reject','warning'
   *   string  $email         the target email address
   *   string  $subject       the subject, ignore now
   *   string  $xheader       the XBounceHeader from the mail
   *   1 or 0  $remove        delete status, 0 is not deleted, 1 is deleted
   *   string  $rule_no       bounce mail detect rule no.
   *   string  $rule_cat      bounce mail detect rule category
   *   int     $totalFetched  total number of messages in the mailbox
   * @var string
   */
  public $action_function = 'callbackAction';

  /**
   * Internal variable
   * The resource handler for the opened mailbox (POP3/IMAP/NNTP/etc.)
   * @var object
   */
  public $_mailbox_link = false;

  /**
   * Test mode, if true will not delete messages
   * @var boolean
   */
  public $testmode = false;

  /**
   * Purge the unknown messages (or not)
   * @var boolean
   */
  public $purge_unprocessed = false;

  /**
   * Control the debug output, default is VERBOSE_SIMPLE
   * @var int
   */
  public $verbose = VERBOSE_SIMPLE;

  /**
   * control the failed DSN rules output
   * @var boolean
   */
  public $debug_dsn_rule = false;

  /**
   * control the failed BODY rules output
   * @var boolean
   */
  public $debug_body_rule = false;

  /**
   * Control the method to process the mail header
   * if set true, uses the imap_fetchstructure function
   * otherwise, detect message type directly from headers,
   * a bit faster than imap_fetchstructure function and take less resources.
   * however - the difference is negligible
   * @var boolean
   */
  public $use_fetchstructure = true;

  /**
   * If disable_delete is equal to true, it will disable the delete function
   * @var boolean
   */
  public $disable_delete = false;

  /*
   * Defines new line ending
   */
  public $bmh_newline = "<br />\n";

  /*
   * Defines port number, default is '143', other common choices are '110' (pop3), '993' (gmail)
   * @var integer
   */
  public $port = 143;

  /*
   * Defines service, default is 'imap', choice includes 'pop3'
   * @var string
   */
  public $service = 'imap';

  /*
   * Defines service option, default is 'notls', other choices are 'tls', 'ssl'
   * @var string
   */
  public $service_option = 'notls';

  /*
   * Mailbox type, default is 'INBOX', other choices are (Tasks, Spam, Replies, etc.)
   * @var string
   */
  public $boxname = INBOX;

  /*
   * Determines if soft bounces will be moved to another mailbox folder
   * @var boolean
   */
  public $moveSoft = false;

  /*
   * Mailbox folder to move soft bounces to, default is 'soft'
   * @var string
   */
  public $softMailbox = 'INBOX.soft';

  /*
   * Determines if hard bounces will be moved to another mailbox folder
   * NOTE: If true, this will disable delete and perform a move operation instead
   * @var boolean
   */
  public $moveHard = false;

  /*
   * Mailbox folder to move hard bounces to, default is 'hard'
   * @var string
   */
  public $hardMailbox = 'INBOX.hard';

  /*
   * Deletes messages globally prior to date in variable
   * NOTE: excludes any message folder that includes 'sent' in mailbox name
   * format is same as MySQL: 'yyyy-mm-dd'
   * if variable is blank, will not process global delete
   * @var string
   */
  public $deleteMsgDate = '';
  
// CR001 Starts  
  /* 
   * Subject to be checked for bounce back
   */
  public $subject = "";  
  
  /* 
   * Time after which mails to be checked for bounce back
   */
  public $mail_sent_time = 0;
  
  /* 
   * Total number of bounced mails for given $subject
   */
  public $bounced_mails = 0;
  
  /* 
   * All messages processed
   */
  public $all_mails_processed = 0;

  /* 
   * All messages processed
   */
  public $bounced_email_id = "";
  
// CR001 Ends  

  /////////////////////////////////////////////////
  // METHODS
  /////////////////////////////////////////////////

  /**
   * Output additional msg for debug
   * @param string $msg,  if not given, output the last error msg
   * @param string $verbose_level,  the output level of this message
   */
  function output($msg=false,$verbose_level=VERBOSE_SIMPLE) {
    if ($this->verbose >= $verbose_level) {
      if (empty($msg)) {
        echo $this->error_msg . $this->bmh_newline;
      } else {
        echo $msg . $this->bmh_newline;
      }
    }
  }

  /**
   * Open a mail box
   * @return boolean
   */
  function openMailbox() {
    // before starting the processing, let's check the delete flag and do global deletes if true
    if ( trim($this->deleteMsgDate) != '' ) {
      echo "processing global delete based on date of " . $this->deleteMsgDate . "<br />";
      $this->globalDelete($nameRaw);
    }
    // disable move operations if server is Gmail ... Gmail does not support mailbox creation
    if ( stristr($this->mailhost,'gmail') ) {
      $this->moveSoft = false;
      $this->moveHard = false;
    }
    $port = $this->port . '/' . $this->service . '/' . $this->service_option;
    //set_time_limit(6000);
    if (!$this->testmode) {
      $this->_mailbox_link = imap_open("{".$this->mailhost.":".$port."}" . $this->boxname,$this->mailbox_username,$this->mailbox_password,CL_EXPUNGE);
    } else {
      $this->_mailbox_link = imap_open("{".$this->mailhost.":".$port."}" . $this->boxname,$this->mailbox_username,$this->mailbox_password);
    }
    if (!$this->_mailbox_link) {
      $this->error_msg = 'Cannot create ' . $this->service . ' connection to ' . $this->mailhost . $this->bmh_newline . 'Error MSG: ' . imap_last_error(). $this->bmh_newline . imap_errors() . $this->bmh_newline . 'Details : ' . $this->mailbox_username . '|' . $this->mailbox_password;
      //$this->output();
      return false;
    } else {
      //$this->output('Connected to: ' . $this->mailhost . ' (' . $this->mailbox_username . ')');  CR001
      return true;
    }
  }

  /**
   * Open a mail box in local file system
   * @param string $file_path (The local mailbox file path)
   * @return boolean
   */
  function openLocal($file_path) {
    set_time_limit(6000);
    if (!$this->testmode) {
      $this->_mailbox_link = imap_open("$file_path",'','',CL_EXPUNGE);
    } else {
      $this->_mailbox_link = imap_open("$file_path",'','');
    }
    if (!$this->_mailbox_link) {
      $this->error_msg = 'Cannot open the mailbox file to ' . $file_path . $this->bmh_newline . 'Error MSG: ' . imap_last_error();
      $this->output();
      return false;
    } else {
      $this->output('Opened ' . $file_path);
      return true;
    }
  }

// CR001 Starts

	function getpart($mbox,$mid,$p,$partno) {
		// $partno = '1', '2', '2.1', '2.1.3', etc if multipart, 0 if not multipart
		global $htmlmsg,$plainmsg,$charset,$attachments;
	
		//echo $p->type . "<br>";
		// DECODE DATA
		$data = ($partno)?
			imap_fetchbody($mbox,$mid,$partno):  // multipart
			imap_body($mbox,$mid);  // not multipart
		// Any part may be encoded, even plain text messages, so check everything.
		if ($p->encoding==4)
			$data = quoted_printable_decode($data);
		elseif ($p->encoding==3)
			$data = base64_decode($data);
		// no need to decode 7-bit, 8-bit, or binary
	
		// PARAMETERS
		// get all parameters, like charset, filenames of attachments, etc.
		$params = array();
		if ($p->parameters)
			foreach ($p->parameters as $x)
				$params[ strtolower( $x->attribute ) ] = $x->value;
		if ($p->dparameters)
			foreach ($p->dparameters as $x)
				$params[ strtolower( $x->attribute ) ] = $x->value;
	
		// ATTACHMENT
		// Any part with a filename is an attachment,
		// so an attached text file (type 0) is not mistaken as the message.
		if ($params['filename'] || $params['name']) {
			// filename may be given as 'Filename' or 'Name' or both
			$filename = ($params['filename'])? $params['filename'] : $params['name'];
			// filename may be encoded, so see imap_mime_header_decode()
			$attachments[$filename] = $data;  // this is a problem if two files have same name
			
			$subject = strstr(trim($data),"Subject: ");
			if ($subject) {
				$this->subject = trim($this->subject);
				$subject = trim(substr($subject,9));
				if (strncmp($subject,$this->subject,strlen($this->subject)) == 0) {
					//echo "Matched" . $this->subject ."<br>";
					$this->bounced_email_id = strstr(trim($data),"To: ");
					$this->bounced_email_id = trim(substr($this->bounced_email_id,4));
					$this->bounced_email_id = trim(substr($this->bounced_email_id,0,strpos($this->bounced_email_id,"\n")-1));
					return true;
				}
			}
			if (!$subject) {
				$subject = strstr(trim($data),"The subject of the message is: ");
				if ($subject) {
					$this->subject = trim($this->subject);
					$subject = trim(substr($subject,31));
					if (strncmp($subject,$this->subject,strlen($this->subject)) == 0) {
						//echo "Matched" . $this->subject ."<br>";
						return true;
					}
				}
			}
		}
	
		// TEXT
		elseif ($p->type==0 && $data) {
			// Messages may be split in different parts because of inline attachments,
			// so append parts together with blank row.
			if (strtolower($p->subtype)=='plain')
				$plainmsg .= trim($data) ."\n\n";
			else
				$htmlmsg .= $data ."<br><br>";
			$charset = $params['charset'];  // assume all parts are same charset
			
			$subject = strstr(trim($data),"Subject: ");
			if ($subject) {
				$this->subject = trim($this->subject);
				$subject = trim(substr($subject,9));
				if (strncmp($subject,$this->subject,strlen($this->subject)) == 0) {
					//echo "Matched" . $this->subject ."<br>";
					$this->bounced_email_id = strstr(trim($data),"To: ");
					$this->bounced_email_id = trim(substr($this->bounced_email_id,4));
					$this->bounced_email_id = trim(substr($this->bounced_email_id,0,strpos($this->bounced_email_id,"\n")-1));
					return true;
				}
			}
			if (!$subject) {
				$subject = strstr(trim($data),"The subject of the message is: ");
				if ($subject) {
					$this->subject = trim($this->subject);
					$subject = trim(substr($subject,31));
					if (strncmp($subject,$this->subject,strlen($this->subject)) == 0) {
						//echo "Matched" . $this->subject ."<br>";
						return true;
					}
				}
			}
		}
	
		// EMBEDDED MESSAGE
		// Many bounce notifications embed the original message as type 2,
		// but AOL uses type 1 (multipart), which is not handled here.
		// There are no PHP functions to parse embedded messages,
		// so this just appends the raw source to the main message.
		elseif ($p->type==2 && $data) {
			$subject = strstr(trim($data),"Subject: ");
			if ($subject) {
				$this->subject = trim($this->subject);
				$subject = trim(substr($subject,9));
				if (strncmp($subject,$this->subject,strlen($this->subject)) == 0) {
					//echo "Matched" . $this->subject ."<br>";
					$this->bounced_email_id = strstr(trim($data),"To: ");
					$this->bounced_email_id = trim(substr($this->bounced_email_id,4));
					$this->bounced_email_id = trim(substr($this->bounced_email_id,0,strpos($this->bounced_email_id,"\n")-1));
					return true;
				}
			}
			// $plainmsg .= trim($data) ."\n\n";
		}
	
		// SUBPART RECURSION
		if ($p->parts) {
			foreach ($p->parts as $partno0=>$p2)
				if($this->getpart($mbox,$mid,$p2,$partno.'.'.($partno0+1))){ // 1.2, 1.2.1, etc.
					return true;
				}
		}
		return false;
	}

// CR001 Ends

  /**
   * Process the messages in a mailbox
   * @param string $max       (maximum limit messages processed in one batch, if not given uses the property $max_messages
   * @return boolean
   */
  // CR001 Starts
  // function processMailbox($max=false) {  
  function processMailbox($start=1,$max=false) {
  // CR001 Ends  
    if ( empty($this->action_function) || !function_exists($this->action_function) ) {
      $this->error_msg = 'Action function not found!';
      $this->output();
      return false;
    }

    if ( $this->moveHard && ( $this->disable_delete === false ) ) {
      $this->disable_delete = true;
    }

    if (!empty($max)) {
      $this->max_messages=$max;
    }

    // initialize counters
    $c_total       = imap_num_msg($this->_mailbox_link);
	// CR001 Starts
    $c_fetched     = $c_total - $start + 1;
	// CR001 Ends
    $c_processed   = 0;
    $c_unprocessed = 0;
    $c_deleted     = 0;
    $c_moved       = 0;
    $c_skipped     = 0;	 // CR001
	if ($this->testmode) {
		$this->output( 'Total: ' . $c_total . ' messages ');
	}
    // proccess maximum number of messages
    if ($c_fetched > $this->max_messages) {
      $c_fetched = $this->max_messages;
      // $this->output( 'Processing first ' . $c_fetched . ' messages ' );		CR001
    }
	// CR001 Starts
	else {
		$this->all_mails_processed = 1;
	}
	// CR001 Ends

    if ($this->testmode) {
      $this->output( 'Running in test mode, not deleting messages from mailbox<br />' );
    } else {
      if ($this->disable_delete) {
        if ( $this->moveHard ) {
          // $this->output( 'Running in move mode<br />' );
        } else {
          $this->output( 'Running in disable_delete mode, not deleting messages from mailbox<br />' );
        }
      } else {
        $this->output( 'Processed messages will be deleted from mailbox<br />' );
      }
    }
	// CR001 Starts
    //for($x=1; $x <= $c_fetched; $x++) {	
    for($x=$start; $x <= $c_fetched + $start - 1; $x++) {
	// CR001 Ends	
      /*
      $this->output( $x . ":",VERBOSE_REPORT);
      if ($x % 10 == 0) {
        $this->output( '.',VERBOSE_SIMPLE);
      }
      */
      // fetch the messages one at a time
      if ($this->use_fetchstructure) {
		  
		// CR001 Starts
		
		$mail_sent_unix_time = strtotime($this->mail_sent_time);
		//echo $mail_sent_unix_time;
		
	    $header      = imap_header($this->_mailbox_link,$x);
	    $mail_recv_time     = strip_tags($header->udate);
		if ($this->testmode) {
			echo "Subject : " . strip_tags($header->subject) . "<br>";
			echo "date : " . strip_tags($header->date) . "<br>";
			echo "Date : " . strip_tags($header->Date) . "<br>";
			echo "MailDate : " . strip_tags($header->MailDate) . "<br>";
			echo "udate : " . strip_tags($header->udate) . "||" . date("Y-m-d H:i:s",strip_tags($header->udate)) . "<br>";
			echo "Sent time : " . $this->mail_sent_time . "||" . $mail_sent_unix_time . "||" . date("Y-m-d H:i:s",$mail_sent_unix_time) . "<br>";
			echo "Diff : " . (strip_tags($header->udate) - $mail_sent_unix_time + 19800) . "<br>";
		}
		
		if ($mail_recv_time + 19800 < $mail_sent_unix_time - 3600) {
			if ($this->testmode) {
				echo "Skipping since old mail<br>";
			}
			$c_skipped++;
			continue;
		}
		
		// CR001 Ends
		
        $structure = imap_fetchstructure($this->_mailbox_link,$x);
		
		// CR001 Starts
		
		if (!$structure->parts)  // not multipart
			$to_be_processed = $this->getpart($this->_mailbox_link,$x,$structure,0);  // no part-number, so pass 0
		else {  // multipart: iterate through each part
			foreach ($structure->parts as $partno0=>$p) {
				$to_be_processed = $this->getpart($this->_mailbox_link,$x,$p,$partno0+1);
				if ($to_be_processed) break;
			}
		}
		
		if (!$to_be_processed) {
			if ($this->testmode) {
				echo "Skipping since no subject match<br><br>";
			}
			$c_skipped++;
			continue;
		}
		// CR001 Ends
		
        if ($structure->type == 1 && $structure->ifsubtype && $structure->subtype == 'REPORT' && $structure->ifparameters && $this->isParameter($structure->parameters, 'REPORT-TYPE','delivery-status')) {
          $processed = $this->processBounce($x,'DSN',$c_total);
        } else { // not standard DSN msg
          $this->output( 'Msg #' .  $x . ' is not a standard DSN message',VERBOSE_REPORT);
          if ($this->debug_body_rule) {
            $this->output( "  Content-Type : {$match[1]}",VERBOSE_DEBUG);
          }
          $processed = $this->processBounce($x,'BODY',$c_total);
        }
      } else {
        $header = imap_fetchheader($this->_mailbox_link,$x);
        // Could be multi-line, if the new line begins with SPACE or HTAB
        if (preg_match ("/Content-Type:((?:[^\n]|\n[\t ])+)(?:\n[^\t ]|$)/is",$header,$match)) {
          if (preg_match("/multipart\/report/is",$match[1]) && preg_match("/report-type=[\"']?delivery-status[\"']?/is",$match[1])) {
            // standard DSN msg
            $processed = $this->processBounce($x,'DSN',$c_total);
          } else { // not standard DSN msg
            $this->output( 'Msg #' .  $x . ' is not a standard DSN message',VERBOSE_REPORT);
            if ($this->debug_body_rule) {
              $this->output( "  Content-Type : {$match[1]}",VERBOSE_DEBUG);
            }
            $processed = $this->processBounce($x,'BODY',$c_total);
          }
        } else { // didn't get content-type header
          $this->output( 'Msg #' .  $x . ' is not a well-formatted MIME mail, missing Content-Type',VERBOSE_REPORT);
          if ($this->debug_body_rule) {
            $this->output( '  Headers: ' . $this->bmh_newline . $header . $this->bmh_newline,VERBOSE_DEBUG);
          }
          $processed = $this->processBounce($x,'BODY',$c_total);
        }
      }

      $deleteFlag[$x] = false;
      $moveFlag[$x]   = false;
      if ($processed) {
        $c_processed++;
		if ($this->testmode) {
			echo "Bounced mail id : " . $this->bounced_email_id . "<br>";
		}
        if ( ($this->testmode === false) && ($this->disable_delete === false) ) {
          // delete the bounce if not in test mode and not in disable_delete mode
          @imap_delete($this->_mailbox_link,$x);
          $deleteFlag[$x] = true;
          $c_deleted++;
        } elseif ( $this->moveHard ) {
          // check if the move directory exists, if not create it
          $this->mailbox_exist($this->hardMailbox);
          // move the message
          @imap_mail_move($this->_mailbox_link, $x, $this->hardMailbox);
          $moveFlag[$x] = true;
          $c_moved++;
        } elseif ( $this->moveSoft ) {
          // check if the move directory exists, if not create it
          $this->mailbox_exist($this->softMailbox);
          // move the message
          @imap_mail_move($this->_mailbox_link, $x, $this->softMailbox);
          $moveFlag[$x] = true;
          $c_moved++;
        }
      } else { // not processed
        $c_unprocessed++;
        if ( !$this->testmode && !$this->disable_delete && $this->purge_unprocessed ) {
          // delete this bounce if not in test mode, not in disable_delete mode, and the flag BOUNCE_PURGE_UNPROCESSED is set
          @imap_delete($this->_mailbox_link,$x);
          $deleteFlag[$x] = true;
          $c_deleted++;
        }
      }
      flush();
    }
    //$this->output( $this->bmh_newline . 'Closing mailbox, and purging messages' );  CR001
    imap_close($this->_mailbox_link);
	 // CR001 Starts
    if ($this->testmode) {
		$this->output( 'Read: ' . $c_fetched . ' messages');
		$this->output( $c_processed . ' action taken' );
		$this->output( $c_unprocessed . ' no action taken' );
		$this->output( $c_deleted . ' messages deleted' );
		$this->output( $c_moved . ' messages moved' );
		$this->output( $c_skipped . ' messages skipped' );
	}
	
    //return true;
	
	return $c_processed;
	// CR001 Ends 
  }

  /**
   * Function to determine if a particular value is found in a imap_fetchstructure key
   * @param array  $currParameters (imap_fetstructure parameters)
   * @param string $varKey         (imap_fetstructure key)
   * @param string $varValue       (value to check for)
   * @return boolean
   */
  function isParameter($currParameters, $varKey, $varValue) {
    foreach ($currParameters as $key => $value) {
      if ( $key == $varKey ) {
        if ( $value == $varValue ) {
          return true;
        }
      }
    }
    return false;
  }

  /**
   * Function to process each individual message
   * @param int    $pos            (message number)
   * @param string $type           (DNS or BODY type)
   * @param string $totalFetched   (total number of messages in mailbox)
   * @return boolean
   */
  function processBounce($pos,$type,$totalFetched) {
    $header      = imap_header($this->_mailbox_link,$pos);
    $subject     = strip_tags($header->subject);
	
    if ($type == 'DSN') {
      // first part of DSN (Delivery Status Notification), human-readable explanation
      $dsn_msg = imap_fetchbody($this->_mailbox_link,$pos,"1");
      $dsn_msg_structure = imap_bodystruct($this->_mailbox_link,$pos,"1");

      if ( $dsn_msg_structure->encoding == 4 ) {
        $dsn_msg = quoted_printable_decode($dsn_msg);
      } elseif ( $dsn_msg_structure->encoding == 3 ) {
        $dsn_msg = base64_decode($dsn_msg);
      }

      // second part of DSN (Delivery Status Notification), delivery-status
      $dsn_report = imap_fetchbody($this->_mailbox_link,$pos,"2");

      // process bounces by rules
      $result = bmhDSNRules($dsn_msg,$dsn_report,$this->debug_dsn_rule);
    } elseif ($type == 'BODY') {		
      $structure = imap_fetchstructure($this->_mailbox_link,$pos);
      switch ($structure->type) {
        case 0: // Content-type = text
        case 1: // Content-type = multipart
          $body = imap_fetchbody($this->_mailbox_link,$pos,"1");
          // Detect encoding and decode - only base64
          if ( $structure->parts[0]->encoding == 4 ) {
            $body = quoted_printable_decode($body);
          } elseif ( $structure->parts[0]->encoding == 3 ) {
            $body = base64_decode($body);
          }
		  //echo $body;
          $result = bmhBodyRules($body,$structure,$this->debug_body_rule);
          break;
        case 2: // Content-type = message
          $body = imap_body($this->_mailbox_link,$pos);
          if ( $structure->encoding == 4 ) {
            $body = quoted_printable_decode($body);
          } elseif ( $structure->encoding == 3 ) {
            $body = base64_decode($body);
          }
          $body=substr($body,0,1000);
          $result = bmhBodyRules($body,$structure,$this->debug_body_rule);
          break;
        default: // unsupport Content-type
          $this->output( 'Msg #' . $pos . ' is unsupported Content-Type:' . $structure->type,VERBOSE_REPORT);
          return false;
      }
    } else { // internal error
      $this->error_msg = 'Internal Error: unknown type';
      return false;
    }
    $email       = $result['email'];
    $bounce_type = $result['bounce_type'];
    if ( $this->moveHard && $result['remove'] == 1 ) {
      $remove      = 'moved (hard)';
    } elseif ( $this->moveSoft && $result['remove'] == 1 ) {
      $remove      = 'moved (soft)';
    } elseif ( $this->disable_delete ) {
      $remove      = 0;
    } else {
      $remove      = $result['remove'];
    }
    $rule_no     = $result['rule_no'];
    $rule_cat    = $result['rule_cat'];
    $xheader     = false;

    if ($rule_no == '0000') { // internal error      return false;
      // code below will use the Callback function, but return no value
      if ( trim($email) == '' ) {
        $email = $header->fromaddress;
      }
      $params = array($pos,$bounce_type,$email,$subject,$xheader,$remove,$rule_no,$rule_cat,$totalFetched);
      // call_user_func_array($this->action_function,$params);	CR001
    } else { // match rule, do bounce action
      if ($this->testmode) {
        $this->output('Match: ' . $rule_no . ':' . $rule_cat . '; ' . $bounce_type . '; ' . $email);
        return true;
      } else {
        $params = array($pos,$bounce_type,$email,$subject,$xheader,$remove,$rule_no,$rule_cat,$totalFetched);
        // return call_user_func_array($this->action_function,$params);	CR001
		return true;	//CR001
      }
    }
  }

  /**
   * Function to check if a mailbox exists
   * - if not found, it will create it
   * @param string  $mailbox        (the mailbox name, must be in 'INBOX.checkmailbox' format)
   * @param boolean $create         (whether or not to create the checkmailbox if not found, defaults to true)
   * @return boolean
   */
  function mailbox_exist($mailbox,$create=true) {
    if ( trim($mailbox) == '' || !strstr($mailbox,'INBOX.') ) {
      // this is a critical error with either the mailbox name blank or an invalid mailbox name
      // need to stop processing and exit at this point
      echo "Invalid mailbox name for move operation. Cannot continue.<br />\n";
      echo "TIP: the mailbox you want to move the message to must include 'INBOX.' at the start.<br />\n";
      exit();
    }
    $port = $this->port . '/' . $this->service . '/' . $this->service_option;
    $mbox = imap_open('{'.$this->mailhost.":".$port.'}',$this->mailbox_username,$this->mailbox_password,OP_HALFOPEN);
    $list = imap_getmailboxes($mbox,'{'.$this->mailhost.":".$port.'}',"*");
    $mailboxFound = false;
    if (is_array($list)) {
      foreach ($list as $key => $val) {
        // get the mailbox name only
        $nameArr = split('}',imap_utf7_decode($val->name));
        $nameRaw = $nameArr[count($nameArr)-1];
        if ( $mailbox == $nameRaw ) {
		    $mailboxFound = true;
        }
      }
      if ( ($mailboxFound === false) && $create ) {
        @imap_createmailbox($mbox, imap_utf7_encode('{'.$this->mailhost.":".$port.'}' . $mailbox));
        imap_close($mbox);
        return true;
      } else {
        imap_close($mbox);
        return false;
      }
    } else {
      imap_close($mbox);
      return false;
    }
  }

// CR001 Starts

  /**
   * Function to check if a mailbox exists
   * - if not found, it will create it
   * @param string  $mailbox        (the mailbox name, must be in 'INBOX.checkmailbox' format)
   * @param boolean $create         (whether or not to create the checkmailbox if not found, defaults to true)
   * @return boolean
   */
  function number_of_messages($mailbox,$create=true) {
    if ( trim($mailbox) == '' || !strstr($mailbox,'INBOX.') ) {
      echo "Invalid mailbox name for number_of_messages operation. Cannot continue.<br />\n";
      echo "TIP: the mailbox you want to get number_of_messages must include 'INBOX.' at the start.<br />\n";
      exit();
    }
    $port = $this->port . '/' . $this->service . '/' . $this->service_option;
    $mbox = imap_open('{'.$this->mailhost.":".$port.'}',$this->mailbox_username,$this->mailbox_password,OP_HALFOPEN);
    $list = imap_getmailboxes($mbox,'{'.$this->mailhost.":".$port.'}',"*");
    $mailboxFound = false;
    if (is_array($list)) {
      foreach ($list as $key => $val) {
        // get the mailbox name only
        $nameArr = split('}',imap_utf7_decode($val->name));
        $nameRaw = $nameArr[count($nameArr)-1];
        if ( $mailbox == $nameRaw ) {
		    $mailboxFound = true;

			$hard_mbox = imap_open("{".$this->mailhost.":".$port."}" . $mailbox,$this->mailbox_username,$this->mailbox_password);
			
			if (!$hard_mbox) {
			  $this->error_msg = 'Cannot create ' . $this->service . ' connection to ' . $this->mailhost . $this->bmh_newline . 'Error MSG: ' . print_r(imap_errors()) . $this->bmh_newline . 'Details : ' . $mailbox . '|' . $this->mailbox_username . '|' . $this->mailbox_password;
			  $this->output();
			}
			
			$this->bounced_mails = imap_num_msg($hard_mbox);
			imap_close($hard_mbox);
		  
        }
      }
      if ( ($mailboxFound === false) && $create ) {
        @imap_createmailbox($mbox, imap_utf7_encode('{'.$this->mailhost.":".$port.'}' . $mailbox));
        imap_close($mbox);
        return true;
      } else {
        imap_close($mbox);
        return false;
      }
    } else {
      imap_close($mbox);
      return false;
    }
  }


// CR001 Ends

  /**
   * Function to delete messages in a mailbox, based on date
   * NOTE: this is global ... will affect all mailboxes except any that have 'sent' in the mailbox name
   * @param string  $mailbox        (the mailbox name)
   * @return boolean
   */
  function globalDelete() {
    $dateArr = split('-', $this->deleteMsgDate); // date format is yyyy-mm-dd
    $delDate = mktime(0, 0, 0, $dateArr[1], $dateArr[2], $dateArr[0]);

    $port  = $this->port . '/' . $this->service . '/' . $this->service_option;
    $mboxt = imap_open('{'.$this->mailhost.":".$port.'}',$this->mailbox_username,$this->mailbox_password,OP_HALFOPEN);
    $list  = imap_getmailboxes($mboxt,'{'.$this->mailhost.":".$port.'}',"*");
    $mailboxFound = false;
    if (is_array($list)) {
      foreach ($list as $key => $val) {
        // get the mailbox name only
        $nameArr = split('}',imap_utf7_decode($val->name));
        $nameRaw = $nameArr[count($nameArr)-1];
        if ( !stristr($nameRaw,'sent') ) {
          $mboxd = imap_open('{'.$this->mailhost.":".$port.'}'.$nameRaw,$this->mailbox_username,$this->mailbox_password,CL_EXPUNGE);
          $messages = imap_sort($mboxd, SORTDATE, 0);
          $i = 0;
          $check = imap_mailboxmsginfo($mboxd);
          foreach ($messages as $message) {
            $header = imap_header($mboxd, $message);
            $fdate  = date("F j, Y", $header->udate);
            // purge if prior to global delete date
            if ( $header->udate < $delDate ) {
              imap_delete($mboxd, $message);
            }
            $i++;
          }
          imap_expunge($mboxd);
          imap_close($mboxd);
        }
      }
    }
    return;
  }

}

?>
