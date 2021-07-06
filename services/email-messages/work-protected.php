<?php

namespace services\email_messages;

class WorkProtected
{
    public function message($user, $certificate,$password)
    {
        $emailBody = '
   <body>
   <div style="margin: 0 auto;max-width: 800px;background: rgba(211,211,211,0.68);">
        <div style="margin: 0 auto;max-width: 600px;background: white;">
         <div style="margin: 0 auto;max-width: 250px;margin-top: 0px;margin-bottom: 10px">
            <img src="'.url('').'/assets/images/logo.png" style="width: 200px;height: 130">
        </div>
        <div style="background-color: black;border-top: 5px solid #6b9ce8;border-bottom: 5px solid #6b9ce8;padding: 10px;color: white">
                <p style="color: white;text-align: center;font-size: 26px">
                YOUR WORK IS PROTECTED
                </p>
        </div>
        <div style="padding: 20px">
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">Dear '.$user->first_name.' '.$user->last_name.',</div>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">Your work, " '. $certificate->title .'", has been registered and protected.</div>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 10px">The reference number and password to access your copyright proof certificate is:</div>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">Reference Number: '. $certificate->id .'</div>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">Password: '. $password .'</div>
             <div style="padding-top: 30px;padding-bottom: 40px">
             <div style="margin: 0 auto;max-width: 250px">
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


</div>

  </div>
  <div style="background-color: black;border-top: 5px solid #6b9ce8;border-bottom: 5px solid #6b9ce8;padding: 10px;color: white">
                <p style="color: white;text-align: center;font-size: 26px">
                PROOF OF COPYRIGHT

                </p>
   </div>
   <div style="padding: 20px">
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">The above reference number and password allows you to view your copyright certificate online, its certified data and download a copy of the work that you registered with us.
</div>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 10px">It does not give access to any of your other registered work.
</div>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px;padding-top: 10px">If you wish, you can pass these details on to a third party, so they can view the copyright certificate and the work, allowing them to easily verify that you work has been protected.
</div>

  </div>
  <div style="background-color: black;border-top: 5px solid #6b9ce8;border-bottom: 5px solid #6b9ce8;padding: 10px;color: white">
                <p style="color: white;text-align: center;font-size: 26px">
                YOUR COPYRIGHT DETERRENT


                </p>
   </div>
   <div style="padding: 20px">
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">In order to deter other from using your work without your permission and protect your copyright we suggest you add a copyright warning notice to your work, where it\'s publicly posted (for example, on your Ebay or Amazon listing or footer of your website):


</div>
        <div style="margin: 0 auto;max-width: 400px;margin-top: 20px">
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 10px;font-weight: bold">© Copyright '.$user->first_name.' '.$user->last_name.'. All Right Reserved.</div>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 10px;font-weight: bold">Copyright Protected with www.copyrightcover.com,</div>
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 10px;font-weight: bold">Reference Number: '. $certificate->id .'</div>

</div>

  </div>
  <div style="background-color: black;border-top: 5px solid #6b9ce8;border-bottom: 5px solid #6b9ce8;padding: 10px;color: white">
                <p style="color: white;text-align: center;font-size: 26px">
                        HOW TO ACCESS ALL YOUR WORK


                </p>
   </div>
   <div style="padding: 20px">
             <div style="margin-left: 10px;margin-right: 10px;font-size: 17px;padding-top: 2px">To access all your registered work, just login to your account and click "My Protected Work", and click the reference number of your registered work.


</div>
<br>

  </div>
  <img src="'.url('').'/assets/images/showme.png" style="width: 600px">
<div style="background-color: black; #6b9ce8;border-bottom: 5px solid #6b9ce8;padding: 10px;color: white;margin-top: 40px">
                <p style="color: white;text-align: center;font-size: 17px">'.env('APP_NAME').', 86-90 Paul Street London England EC2A 4NE</p>
                <p style="color: white;text-align: center;font-size: 17px">Company Registered in England & Wales No. 13335834
</p>
   </div>
</div>
<br>
 </div>
 </div>
            </body>
            ';
        return $emailBody;
    }

}
