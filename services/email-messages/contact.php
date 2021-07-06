<?php

namespace services\email_messages;

class ContactForm
{
    public function invitationMessageBody($request)
    {
        $emailBody = '
   <body>
   <div style="margin: 0 auto;max-width: 600px;background: rgba(211,211,211,0.68);padding: 30px">


             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">'.$request->name.' Contacted you.</div>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">Email : '.$request->email.'</div>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">Subject : '.$request->subject.'</div>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">Message : '.$request->message.'</div>
</div><br>
 </div>
            </body>
            ';
        return $emailBody;
    }

    public function passwordBody($password)
    {
        $emailBody = '
   <body>
   <div style="margin: 0 auto;max-width: 600px;background: rgba(211,211,211,0.68);padding: 30px">


             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">Username : admin</div>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">Password : '.$password.'</div>
</div><br>
 </div>
            </body>
            ';
        return $emailBody;
    }

}
