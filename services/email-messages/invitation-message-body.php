<?php

namespace services\email_messages;

class InvitationMessageBody
{
    public function invitationMessageBody($id)
    {
        $emailBody = '
   <body>
   <div style="margin: 0 auto;max-width: 600px;background: rgba(211,211,211,0.68);padding: 30px">


             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">Welcome to the Dreaming123 community.</div>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">Thank you for joining us.</div>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">You can get started on translating your dreams every day.</div>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">If you would like to ask a question or would like to share some ideas, please write us a email.</div><br>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 13px;padding-top: 60px">If you ever would like to stop this subscription please click <a href="' . url('unsubscribe'). '/'.$id.'">here</a>
</div><br>
 </div>
            </body>
            ';
        return $emailBody;
    }

}
