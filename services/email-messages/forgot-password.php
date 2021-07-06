<?php

namespace services\email_messages;

class ForgotPasswordMessage
{
    public function invitationMessageBody(string $email, $password)
    {
        $emailBody = '
   <body>
   <div style="margin: 0 auto;max-width: 600px;background: rgba(211,211,211,0.68);padding: 30px">
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">Welcome. Here is your credentials to login:</div>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">Email: '. $email .'</div>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">Password: '. $password .'</div>
             <div style="padding-top: 30px;padding-bottom: 40px">
 <a href="'. url(''). '/login" style=" background-color: #6b9ce8;
  border: none;
  color: white;
  padding: 10px 27px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 18px;
  cursor: pointer;
  border-radius: 3px;margin-left: 5px">Login</a>
  </div>
</div><br>
 </div>
            </body>
            ';
        return $emailBody;
    }


    public function forgotPasswordMessage($token)
    {
        $emailBody = '
   <body>
   <div style="margin: 0 auto;max-width: 600px;background: rgba(211,211,211,0.68);padding: 30px">
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">Please click on the below button to reset your password</div>
             <div style="padding-top: 30px;padding-bottom: 40px">
 <a href="'. url(''). '/reset-password/'. $token. '" style=" background-color: #6b9ce8;
  border: none;
  color: white;
  padding: 10px 27px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 18px;
  cursor: pointer;
  border-radius: 3px;margin-left: 5px">RESET PASSWORD</a>
  </div>
</div><br>
 </div>
            </body>
            ';
        return $emailBody;
    }

}
