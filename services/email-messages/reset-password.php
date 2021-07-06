<?php

namespace services\email_messages;

class ResetPassword
{
    public function message($certificate,$password)
    {
        $emailBody = '
   <body>
   <div style="margin: 0 auto;max-width: 600px;background: rgba(211,211,211,0.68);padding: 30px">
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">Below is a new certificate password for your protected work.</div>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 20px">Work Title: '.$certificate->title.'</div>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">Reference no: '.$certificate->id.'</div>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px;padding-bottom: 30px">Password: '.$password.'</div>

 <a href="'. url(''). '/search-work" style=" background-color: #6b9ce8;
  border: none;
  color: white;
  padding: 10px 27px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 18px;
  cursor: pointer;
  border-radius: 3px;margin-left: 5px">VIEW CERTIFICATE</a>
  </div>
</div><br>
 </div>
            </body>
            ';
        return $emailBody;
    }

}
