<?php
     use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
   	  
   
 function confirmationMail($user_id,$title){

      include_once('includes/class.Member.php');
        $objMember		= 	new Member();  
        $res    =   $objMember->getMEmberProfile($user_id);
        $member_NAme    =  $res['first_name'].$res['last_name'];    
    $resMembers =    $objMember->getAllMembers($user_id);
  //  print_r($resMembers);exit;
      require_once('vendor/phpmailer/phpmailer/src/Exception.php');
             require_once('vendor/phpmailer/phpmailer/src/PHPMailer.php');
             require_once('vendor/phpmailer/phpmailer/src/SMTP.php');
     
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host = 'mail.mcst-rmi.org';
            $mail->SMTPAuth = true;
            $mail->Username = 'no-reply@mcst-rmi.org';
            $mail->Password = 'Reubro@2023';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('no-reply@mcst-rmi.org', 'mcst');
            $mail->Subject = 'New Post Published by  MCST MEmber : '.$member_NAme ;
               $mail->isHTML(true);
            //===================================

            //batch mail
        foreach($resMembers as $k=>$v){
           
             $recipients[] = $v['email'];
             }
       //  print_r($recipients);
            $batchSize = 2; // Number of emails to send in each batch
       
// Batch sending loop
        for ($i = 0; $i < count($recipients); $i += $batchSize) {
            $batchRecipients = array_slice($recipients, $i, $batchSize);

            // Clear previous recipients and add new batch
            $mail->clearAddresses();
            foreach ($batchRecipients as $recipient) {
                $mail->addAddress($recipient, 'MCST');
            }

        try {
             $mail->Body = "<h2>New Post  Received  From".$member_NAme."</h2>
                  <p><strong>Title:</strong>".$title."</p>";
                    // Send the email batch
                    $mail->send();
                  //  echo "Batch sent to " . implode(', ', $batchRecipients) . "<br>";
                } catch (Exception $e) {
                    echo 'Error: ' . $mail->ErrorInfo;
                }

                // Wait a bit before sending the next batch (optional)
               // usleep(1000000); // Sleep for 1 second
            }



            //======================================

           
           // echo "reached";exit;
 }
?>