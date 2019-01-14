﻿<?php
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $site = $_POST['site'];
    $soc_vk = $_POST['social_links_1'];
    $soc_fb = $_POST['social_links_2'];
    $soc_inta = $_POST['social_links_3'];
    $photo = $_POST['file'];


    $name = htmlspecialchars($name);
    $phone = htmlspecialchars($phone);
    $email = htmlspecialchars($email);
    $site = htmlspecialchars($site);
    $soc_vk = htmlspecialchars($soc_vk);
    $soc_fb = htmlspecialchars($soc_fb);
    $soc_inta = htmlspecialchars($soc_inta);
    $photo = '';

    $name = urldecode($name);
    $phone = urldecode($phone);
    $email = urldecode($email);
    $site = urldecode($site);
    $soc_vk = urldecode($soc_vk);
    $soc_fb = urldecode($soc_fb);
    $soc_inta = urldecode($soc_inta);

    $name = trim($name);
    $phone = trim($phone);
    $email = trim($email);
    $site = trim($site);
    $soc_vk = trim($soc_vk);
    $soc_fb = trim($soc_fb);
    $soc_inta = trim($soc_inta);
    $data = trim($type);
    $data = '<table class="table table-bordered">
            <thead>
                <tr>
                    <td class="text-left">Название</td>
                    <td class="text-left">Данные пользователя</td>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-left">Имя Фамилия</td>
                <td class="text-left">'.$name.'</td>
            </tr>
            <tr>
                <td class="text-left">Телефон</td>
                <td class="text-left">'.$phone.'</td>
            </tr>
            <tr>
                <td class="text-left">E-mail</td>
                <td class="text-left">'.$email.'</td>
            </tr>
            <tr>
                <td class="text-left">Сайт</td>
                <td class="text-left">'.$site.'</td>
            </tr>
            <tr>
                <td class="text-left">Vk</td>
                <td class="text-left">'.$soc_vk.'</td>
            </tr>
            <tr>
                <td class="text-left">FB</td>
                <td class="text-left">'.$soc_fb.'</td>
            </tr>
            <tr>
                <td class="text-left">Intsgram</td>
                <td class="text-left">'.$soc_inta.'</td>
            </tr>
            </tbody>
        </table>';

    if (!empty($_FILES['file']['tmp_name'])) {
        $path = $_FILES['file']['name'];
        if (copy($_FILES['file']['tmp_name'], $path)) $photo = $path;
    }

    $headers_1  = "Content-type: text/html; charset=UTF-8 \r\n";
    $headers_1 .= "From: noreply@iqural.ru \r\n";

    if(empty($photo)) {
        $result = mail("milan7da@yandex.ru" , "Регистрация нового участника\n", $data,  $headers_1 );
        var_dump($result);
    } else send_mail("milan7da@yandex.ru", "Регистрация нового участника\n", $data, $photo);

  function send_mail($to, $thm, $html, $path){
    $fp = fopen($path,"r");

    if (!$fp)
    {
      print "Файл $path не может быть прочитан";
      exit();
    }
    $file = fread($fp, filesize($path));
    fclose($fp);
    $boundary = "--".md5(uniqid(time())); // генерируем разделитель
    $headers .= "MIME-Version: 1.0\n";
    $headers .="Content-Type: multipart/mixed; boundary=\"$boundary\"\n";
    $headers .= "From: noreply@iqural.ru \r\n";
    $multipart .= "--$boundary\n";
    $kod = 'UTF-8';
    $multipart .= "Content-Type: text/html; charset=$kod\n";
    $multipart .= "Content-Transfer-Encoding: Quot-Printed\n\n";
    $multipart .= "$html\n\n";

    $message_part = "--$boundary\n";
    $message_part .= "Content-Type: application/octet-stream\n";
    $message_part .= "Content-Transfer-Encoding: base64\n";
    $message_part .= "Content-Disposition: attachment; filename = \"".$path."\"\n\n";
    $message_part .= chunk_split(base64_encode($file))."\n";
    $multipart .= $message_part."--$boundary--\n";

    if(!mail($to, $thm, $multipart, $headers))
    {
      echo "К сожалению, письмо не отправлено";
      exit();
    }
  }

?>