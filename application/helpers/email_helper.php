<?php
function email_sender($subject, $msg, $to, $from="泡麻吉訊息通知<info@pawmaji.com>", $sCharset="utf-8")
{
    $sMailHeaderFmt = '=?' . $sCharset . '?b?%s?=';
    $headers = "MIME-Version: 1.0\r\n" . "Content-type: text/html; charset=$sCharset\r\n" . "From: $from\r\n" ."BCC: endless640c@gmail.com\r\n";
//    $subject = iconv('big5', $sCharset, $subject);
    $subject = sprintf($sMailHeaderFmt, base64_encode($subject));
    if(mail("$to", "$subject", "$msg", "$headers"))
        return true;
    else
        return false;
}

function get_reset_password_content($member_hash_id, $member_verify)
{
    $msg="
        ** 忘記密碼
        <p>
        * 請點選下列連結重新設定密碼。
        <p>
        ".base_url()."reminder/password/".$member_hash_id."/".$member_verify."
        <p>
        * 密碼重設連結有效期限為郵件傳送後30分鐘以內。
        <p>
        ----
        <p>
        Pawmaji
        <p>
        http://Pawmaji.com/
        <p>
        http://facebook.com/pawmaji
        <p>
        若有任何疑問，歡迎聯絡support@pawmaji.com";
    return $msg;
}
function send_test_article($to, $result)
{
    $subject = $result['article_title'];
    $body = $result['article_content'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://pawmaji.com/a/dist/php_mailer/index.php");
    curl_setopt($ch, CURLOPT_POST, true); // 啟用POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query( array( "action"=>"email", "email"=>$to, "subject"=>$subject,"body"=>$body) ));
    curl_exec($ch);
    curl_close($ch);
}

function send_email_article($task, $member, $service, $service_cart, $order, $cart, $result)
{

    $msg = $result['article_content'];

    $msg = str_replace('{name}',$member['member_name'],$msg);
    $msg = str_replace('{address}',$member['member_address'],$msg);
    if($order['order_create_stamp']!="")$msg = str_replace('{order_data}',$order['order_create_stamp'],$msg);
    if($order['order_paynow_OrderNo']!="")$msg = str_replace('{order_no}',substr($order['order_paynow_OrderNo'],-5),$msg);
    if($order['order_cart_total']!="")$msg = str_replace('{cart_total}',$order['order_cart_total'],$msg);
    if(count($cart)>0)$msg = str_replace('{order_cart}',build_table($cart),$msg); else $msg = str_replace('{order_cart}',"該訂單無產品",$msg);
    if(count($service_cart)>0)$msg = str_replace('{service_cart}',build_table($service_cart),$msg); else $msg = str_replace('{service_cart}',"該服務無產品",$msg);
    $msg = str_replace('{service_next_date}',$service['service_date_next'],$msg);

    $subject = $result['article_title'];

    $subject = str_replace('{name}',$member['member_name'],$subject);
    $subject = str_replace('{address}',$member['member_address'],$subject);
    if($order['order_create_stamp']!="")$subject = str_replace('{order_data}',$order['order_create_stamp'],$subject);
    if($order['order_paynow_OrderNo']!="")$subject = str_replace('{order_no}',substr($order['order_paynow_OrderNo'],-5),$subject);
    if($order['order_cart_total']!="")$subject = str_replace('{cart_total}',$order['order_cart_total'],$subject);
    $subject = str_replace('{service_next_date}',$service['service_date_next'],$subject);

    $to = $member['member_account'];

    if(email_sender($subject, $msg, $to))
    {
        $update_task['task_status'] = 1;
        $update_task['task_article_id'] = $result['article_id'];
        $update_task['task_id'] = $task['task_id'];

        return $update_task;

    }else{

        $update_task['task_status'] = 2;
        $update_task['task_article_id'] = $result['article_id'];
        $update_task['task_id'] = $task['task_id'];

        return $update_task;
    }
}

function build_table($array)
{
    $html = '<table style="font-size:12px;">';
    $width = array(0 => "40%", 1 =>"20%", 2=>"20%", 3=>"20%");
    $text_align = array(0 => "left", 1 => "center", 2 =>"center", 3=>"center", 4=>"center");
    $html .= '<tr>';
    $i = 0;
    foreach($array[0] as $key=>$value)
    {
        $html .= '<th style="
        text-shadow: 0 -1px 1px rgba(19, 28, 0, 0.35);
        border-color: #5a8200;
        background-color:#7db500;
        color:#ffffff ;width:'.$width[$i].';
        border:1px solid #cacaca;
        padding:3px;">' . $key . '</th>';
        $i++;
    }
    $html .= '</tr>';

    foreach( $array as $key=>$value){

        $html .= '<tr>';
        $i = 0;
        foreach($value as $key2=>$value2)
        {
                $html .= '<td style="border:1px solid #cacaca;padding:3px;text-align:'.$text_align[$i].';">' . $value2 . '</td>';
                $i++;
        }

        $html .= '</tr>';


    }
    // finish table and return it
    $html .= '</table>';

    $html = str_replace("package_price","單價",$html);
    $html = str_replace("product_name","產品名稱",$html);
    $html = str_replace("package_weight","重量(公克)",$html);
    $html = str_replace("cart_package_qty","數量",$html);

    return $html;

}