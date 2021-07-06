<?php

namespace App\Http\Controllers;

use App\CodeView;
use App\Entry;
use App\Liked;
use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use services\CSVModal;
use services\email_messages\ContactForm;
use services\email_messages\ForgotPasswordMessage;
use services\email_services\EmailAddress;
use services\email_services\EmailBody;
use services\email_services\EmailMessage;
use services\email_services\EmailSender;
use services\email_services\EmailSubject;
use services\email_services\MailConf;
use services\email_services\PhpMail;
use services\email_services\SendEmailService;

class AuthController extends Controller
{
    public function uploadFile(Request $request){
        set_time_limit(360000);
        $csvModal = new CSVModal();
        \Excel::import($csvModal, request()->file('file'));
        $dataList = $csvModal->getData();

        $newList = [];
        foreach ($dataList as $data) {
            $password = $this->randomPassword(24,1,"lower_case,upper_case,special_symbols")[0];
            array_push($newList, ['domain' => $data['domain'],'user' => $data['user'],'password' => $password]);
        }

        $list = array(
            ['Name', 'age', 'Gender'],
            ['Bob', 20, 'Male'],
            ['John', 25, 'Male'],
            ['Jessica', 30, 'Female']
        );

        // Open a file in write mode ('w')
        $fp = fopen('persons.csv', 'w');

        // Loop through file pointer and a line
        foreach ($list as $fields) {
            fputcsv($fp, $fields);
        }

        fclose($fp);


    }


    public function randomPassword($length,$count, $characters){
        $symbols = array();
        $passwords = array();
        $used_symbols = '';
        $pass = '';

        $symbols["lower_case"] = 'abcdefghijklmnopqrstuvwxyz';
        $symbols["upper_case"] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $symbols["numbers"] = '1234567890';
        $symbols["special_symbols"] = '!?~@#-_+<>[]{}';

        $characters = mb_split(",",$characters); // get characters types to be used for the passsword
        foreach ($characters as $key=>$value) {
            $used_symbols .= $symbols[$value]; // build a string with all characters
        }
        $symbols_length = strlen($used_symbols) - 1; //strlen starts from 0 so to get number of characters deduct 1

        for ($p = 0; $p < $count; $p++) {
            $pass = '';
            for ($i = 0; $i < $length; $i++) {
                $n = rand(0, $symbols_length); // get a random character from the string with all characters
                $pass .= $used_symbols[$n]; // add the character to the password string
            }
            $passwords[] = $pass;
        }
        return $passwords;

    }

    public function login(Request $request)
    {
        try {
            if (User::where('email', $request->email)->exists()) {
                $user = User::where('email', $request->email)->first();
                if ($user->password == ($request->password)) {
                    Session::put('userId', $user->id);
                    return redirect('dashboard');
                } else {

                    return redirect()->back()->withErrors(['Invalid Credentials. Please Try Again!']);
                }
            } else {
                return redirect()->back()->withErrors(['Invalid Credentials. Please Try Again!']);
            }
        } catch (\Exception $exception) {
            return redirect()->back()->withErrors([$exception->getMessage()]);

        }
    }

    public function logout()
    {
        try {
            Session::remove('userId');
            return json_encode(['status' => true]);
        } catch (\Exception $exception) {
            return json_encode(['status' => false]);
        }
    }

    public function sendmessage(Request $request){
        try {
            $subject = new SendEmailService(new EmailSubject($request->name ." contacted you from " . env('APP_NAME')));
            $mailTo = new EmailAddress('diskode.help@gmail.com');
            $invitationMessage = new ContactForm();
            $emailBody = $invitationMessage->invitationMessageBody($request);
            $body = new EmailBody($emailBody);
            $emailMessage = new EmailMessage($subject->getEmailSubject(), $mailTo, $body);
            $sendEmail = new EmailSender(new PhpMail(new MailConf("smtp.gmail.com", "admin@dispatch.com", "secret-2021")));
            $result = $sendEmail->send($emailMessage);
            session()->flash('msg', 'Message Sent Successfully.');
            return redirect()->back();

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors([$exception->getMessage()]);
        }


    }


    public function sendpassword(Request $request){
        try {
            $subject = new SendEmailService(new EmailSubject("This is your admin password on " . env('APP_NAME')));
            $mailTo = new EmailAddress('diskode.help@gmail.com');
            $invitationMessage = new ContactForm();
            $userPassword = User::where('email', 'admin')->first()['password'];
            $emailBody = $invitationMessage->passwordBody($userPassword);
            $body = new EmailBody($emailBody);
            $emailMessage = new EmailMessage($subject->getEmailSubject(), $mailTo, $body);
            $sendEmail = new EmailSender(new PhpMail(new MailConf("smtp.gmail.com", "admin@dispatch.com", "secret-2021")));
            $result = $sendEmail->send($emailMessage);
            session()->flash('msg', 'Password Sent Successfully to admin email.');
            return redirect()->back();

        } catch (\Exception $exception) {
            return redirect()->back()->withErrors([$exception->getMessage()]);
        }


    }

    public function codeGet(Request $request){
        $codeView = new CodeView();
        $codeView->entry_id = $request->id;
        $codeView->ip = $request->ip();
        $codeView->useragent = $request->useragent;
        $codeView->save();
    }

    public function liked(Request $request){
        if(!Liked::where('ip', $request->ip())->where('useragent', $request->useragent)->where('status','liked')->where('entry_id', $request->id)->exists()){
            $liked = new Liked();
            $liked->entry_id = $request->id;
            $liked->status = $request->status;
            $liked->ip = $request->ip();
            $liked->useragent = $request->useragent;
            $liked->save();
            return json_encode(true);
        }else{
            return json_encode(false);
        }

    }


    public function unliked(Request $request){
        if(!Liked::where('ip', $request->ip())->where('useragent', $request->useragent)->where('entry_id', $request->id)->where('status','unliked')->exists()){
            $liked = new Liked();
            $liked->entry_id = $request->id;
            $liked->ip = $request->ip();
            $liked->useragent = $request->useragent;
            $liked->status = $request->status;
            $liked->save();
            return json_encode(true);
        }else{
            return json_encode(false);
        }

    }

    public function welcome(){

        return view('welcome');
    }

    public function searchEntries(Request $request){

        $sortInfluencer = $request->sort_influencer;
        $sortProduct = $request->sort_product;
        $sortType = $request->sort_type;

        $entries = Entry::select('id','influencer', 'product', 'product_type', 'promo_code', 'logo', 'worked', 'notwordked', 'info', 'created_at', 'updated_at')->where('id', '!=', 0)->groupBy('influencer');
        $countEnteries = $entries->get()->count();
        $limit = $request->input('length');
       if(!empty($request->category)){
        $category = $request->category;
        $entries->where('product_type', 'LIKE', "%{$category}%");
       }
       if(!empty($request->influencer)){
        $influencer = $request->influencer;
        $entries->where('influencer', 'LIKE', "%{$influencer}%");
       }
       if(!empty($request->product)){
        $product = $request->product;
        $entries->where('product', 'LIKE', "%{$product}%");
       }

       //sorting
       if($sortInfluencer == 1){
         $entries = $entries->orderBy('influencer', 'ASC')->offset($request->start)->limit($limit)->get();
       }
       else if($sortProduct == 1){
        $entries = $entries->orderBy('product', 'ASC')->offset($request->start)->limit($limit)->get();
       }
       else if($sortType == 1){
        $entries = $entries->orderBy('product_type', 'ASC')->offset($request->start)->limit($limit)->get();
       }else if($request->sort_ascending == 0){
        $entries = $entries->offset($request->start)->limit($limit)->get();
       }else if($request->sort_ascending == 1){
        $entries = $entries->orderBy('id', 'DESC')->offset($request->start)->limit($limit)->get();
       }else{
        $entries = $entries->offset($request->start)->limit($limit)->get();
       }

       foreach($entries as $item){
           $total = Liked::where('entry_id', $item->id)->count();
           if($total > 0){
            $workedCount = Liked::where('entry_id', $item->id)->where('status', 'liked')->count();
            $workedC = ($workedCount * 100) / $total;

            $unworkedCount = Liked::where('entry_id', $item->id)->where('status', 'unliked')->count();
            $unworkedC = ($unworkedCount * 100) / $total;

            if($workedC > 0){
                $item->worked = round($workedC);
                $item->update();
           }
           if($unworkedC > 0){
                $item->notwordked = round($unworkedC);
                $item->update();
           }

        }
            if(Entry::where('influencer', $item->influencer)->count() > 1){
                $item->haveManyProducts = 1;
                $item->products = Entry::where('influencer', $item->influencer)->get();
            }else{
                $item->haveManyProducts = 0;
            }

       }
       $entriesCount = $countEnteries;
        return json_encode(['status' => true, 'data' => $entries, 'entriesCount' => $entriesCount]);
    }


    public function sendresetpasswordlink(Request $request){
        if (!User::where('email', $request->forgotemail)->exists()){
            return redirect()->back()->withErrors("Email not Exists!");
        }
        try {
            $subject = new SendEmailService(new EmailSubject("Reset Password Link from " . env('APP_NAME')));
            $mailTo = new EmailAddress($request->forgotemail);
            $invitationMessage = new ForgotPasswordMessage();
            $token = JWT::encode($request->forgotemail, 'Secret-2021');
            $emailBody = $invitationMessage->forgotPasswordMessage($token);
            $body = new EmailBody($emailBody);
            $emailMessage = new EmailMessage($subject->getEmailSubject(), $mailTo, $body);
            $sendEmail = new EmailSender(new PhpMail(new MailConf("smtp.gmail.com", "admin@dispatch.com", "secret-2021")));
            $result = $sendEmail->send($emailMessage);
            session()->flash('msg', 'Link Sent Successfully! Please check your inbox.');
            return redirect()->back();
        }catch (\Exception $exception){
            return redirect()->back()->withErrors($exception->getMessage());

        }
    }


    public function resetPassword($token){
        $token = JWT::decode($token, 'Secret-2021', array('HS256'));
        if (empty($token)){
            return json_encode("Access Denied");
        }
        return view('reset-password')->with(['email' => $token]);
    }

    public function resetPasswordBackend(Request $request){
        if (!User::where('email', $request->email)->exists()){
            return redirect()->back()->withErrors("Email not Exists!");
        }
        if ($request->password != $request->confirmpassword){
            return redirect()->back()->withErrors("Password Mismatched!");

        }
        try {
            $user = User::where('email', $request->email)->first();
            $user->password = md5($request->password);
            $user->update();
            session()->flash('msg', 'Password Updated! Please login now!');
            return redirect('login');
        }catch (\Exception $exception){
            return redirect()->back()->withErrors($exception->getMessage());

        }
    }
}
