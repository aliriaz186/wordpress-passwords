<?php

namespace services\email_messages;

class UnsubscribeMessage
{
    public function unsubscribeMessageBody()
    {
        $emailBody = '
   <body>
   <div style="margin: 0 auto;max-width: 600px;background: rgba(211,211,211,0.68);padding: 30px">


             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">Sad to see you go!</div>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">You are unsubscribed.</div>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">Your card will be no longer charged.</div><br>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">Thank you</div>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">Dreaming123</div>
</div><br>
 </div>
            </body>
            ';
        return $emailBody;
    }

}
