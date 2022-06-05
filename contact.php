<?php
if(!isset($_POST['submit']))
{
//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}

//setting the variables
$name = $_POST['name'];
$visitor_email = $_POST['email'];
$message = $_POST['message'];

//Validate first
if(empty($name)||empty($visitor_email)) 
{
    echo "Name and email are mandatory!";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}

//variables for the e-mail to client
$email_from = 'postman@linebyline.tech';//<== update the email address
$email_subject = "New message via your website contact form";
$email_body = "You have received a new message from the following website visitor (name): $name.\n\nThe visitor used the e-mail address: $visitor_email\n\nThe content of the message is: \n\n $message.";

//variables for the confirmation e-mail to website user
//$confirmation_email_subject = "We received your question!";
$confirmation_email_subject = "Obrigada pelo contato!";
//$confirmation_email_body = "We have received the following message from you via our contact form on our website pH-Controle de Qualidade: \n\n Your name: $name.\n\n Your e-mail: $visitor_email\n\n Your message: \n\n $message. \n\nWe will get in contact as soon as possible! If you would not receive an answer in the coming 2 weeks, don't hesitate to contact us via: raphaela@phcontroledequalidade.com. \n\n This is an automated e-mail. We haven't read your question yet. This is merely a confirmation of the recieval.";
$confirmation_email_body = "Nós recebemos a seguinte mensagem proveniente do seu contato no nosso website: \n\n Seu nome: $name.\n\n Seu e-mail: $visitor_email\n\n Sua mensagem: \n\n $message. \n\n Nossa equipe entrará em contato em breve. Caso precise de uma resposta urgente entre em contato direto via: raphaela@phcontroledequalidade.com. \n\n Essa mensagem é automática e nāo siguinifica que já lemos sua pergunta. Isso é apenas a confirmaçāo de recebimento da mesma.";

//e-mail of client
$to = "emile.plas@linebyline.tech";//<== update the email address
$headers = "From: $email_from \r\n";

//headers for confirmation
$confirmation_headers = "From: raphaela@phcontroledequalidade.com";

//Send the email!
mail($to,$email_subject,$email_body,$headers);
mail($visitor_email,$confirmation_email_subject,$confirmation_email_body,$confirmation_headers);

// if (mail($to,$email_subject,$email_body,$headers)) {
//   return "Message successfully sent!";
// } else {
//   return "Message delivery failed...";
// }


// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?> 