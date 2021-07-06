<?php

namespace services\email_messages;

class JobCreationMessage
{
    public function creationMessage($email, $fname, $lname)
    {
        $emailBody = '
   <body>
   <div style="margin: 0 auto;max-width: 600px;background: rgba(211,211,211,0.68);padding: 30px">
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">A new user just registered!</div>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">User Name: '. $fname .' '.$lname.'</div>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">User Email: '. $email .'</div>
             <div style="padding-top: 30px;padding-bottom: 40px">
 <a href="http://www.admin.copyrightcover.com/" style=" background-color: #6b9ce8;
  border: none;
  color: white;
  padding: 10px 27px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 18px;
  cursor: pointer;
  border-radius: 3px;margin-left: 5px">Login to Admin panel</a>
  </div>
</div><br>
 </div>
            </body>
            ';
        return $emailBody;
    }

}
