<?php

use services\CSVModal;

try{
    // return $_SERVER['DOCUMENT_ROOT']."\wordpress\wp-load.php";
    set_time_limit(360000);
    $csvModal = new CSVModal();
    \Excel::import($csvModal, request()->file('file'));
    $dataList = $csvModal->getData();

    $newList = [];
    foreach ($dataList as $data) {

        // $user = get_user_by( 'login', $data['user'] );
        // return $user;
        $password = $data['password'];
        $new_password = $this->randomPassword(24,1,"lower_case,upper_case,special_symbols")[0];


        // if(empty($user_id)){
        //     $json = array('code'=>'0','msg'=>'Please enter user id');
        //     echo json_encode($json);
        //     exit;
        // }
        // if(empty($password)){
        //     $json = array('code'=>'0','msg'=>'Please enter old password');
        //     echo json_encode($json);
        //     exit;
        // }
        // if(empty($new_password)){
        //     $json = array('code'=>'0','msg'=>'Please enter new password');
        //     echo json_encode($json);
        //     exit;
        // }
        // $hash = $user->data->user_pass;
        // $code = 500; $status = false;
        // if (wp_check_password( $password, $hash ) ){
        //     $msg = 'Password updated successfully';
        //     $code = 200; $status = true;
        //     wp_set_password($new_password , $user_id);
        // }else{
        //     $msg = 'Current password does not match.';
        // }






        array_push($newList, [$data['domain'], $data['user'],$new_password , true]);
    }

   // output headers so that the file is downloaded rather than displayed
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename='.time().'-wordpress-passwords.csv');

    // create a file pointer connected to the output stream
    $output = fopen('php://output', 'w');

    // output the column headings
    fputcsv($output, array('doamin', 'user', 'password', 'status'));
    foreach($newList as $list){
        fputcsv($output, $list);
    }
    // session()->flash('msg', 'Passwords Changed Successfully. New File');
    // return redirect()->back();
} catch (\Exception $exception) {
    return redirect()->back()->withErrors([$exception->getMessage()]);
}




function randomPassword($length,$count, $characters){
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

?>
