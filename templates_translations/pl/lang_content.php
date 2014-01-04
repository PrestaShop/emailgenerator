<?php

global $_LANGMAIL;
$_LANGMAIL = array();

$_LANGMAIL[''] = 'Content-Type: text/plain; charset=UTF-8\nMIME-Version: 1.0\nContent-Transfer-Encoding: 8bit\n';
$_LANGMAIL['Hi {firstname} {lastname},'] = 'Witaj {firstname} {lastname},';
$_LANGMAIL['Order {order_name}'] = 'Zamówienie {order_name}';
$_LANGMAIL['You can review your order and download your invoice from the <a href=\"{history_url}\">\"Order history\"</a> section of your customer account by clicking <a href=\"{my_account_url}\">\"My account\"</a> on our shop.'] = 'W sekcji <a href=\"{my_account_url}\">Moje konto</a> <strong>/ Moje zamówienia / Historia zamówień </strong>- możesz <<a href=\"{history_url}\">sprawdzić</a> swoje zamówienie i pobrać fakturę.';
$_LANGMAIL['Customer e-mail address:'] = 'Adres e-mail:';
$_LANGMAIL['Order ID:'] = 'Referencje zamówienia:';
$_LANGMAIL['You can now place orders on our shop:'] = 'Możesz już składać zamówienia w sklepie:';
$_LANGMAIL['Message:'] = 'Wiadomość:';
$_LANGMAIL['A new order has been generated on your behalf.'] = 'Zostało wygenerowane dla Ciebie nowe zlecenie.';
$_LANGMAIL['Please go on <a href=\"{order_link}\">{order_link}</a> to finalize the payment.'] = 'Przejdź do <a href=\"{order_link}\">{order_link}</a> aby sfinalizować płatność.';
$_LANGMAIL['Your message has been sent successfully.'] = 'Twoja wiadomość została prawidłowo wysłana.';
$_LANGMAIL['Always keep your account details safe.'] = 'Przechowuj dane Twojego konta w bezpiecznym miejscu.';
$_LANGMAIL['Never disclose your login details to anyone.'] = 'Nie ujawniaj nikomu swojego hasła.';
$_LANGMAIL['Change your password regularly.'] = 'Regularnie zmieniaj swoje hasło.';
$_LANGMAIL['Should you suspect someone is using your account illegally, please notify us immediately.'] = 'Jeśli bedziesz mieć podejrzenia, że ktoś używa twojego konta nielegalnie, prosimy powiadomić nas o tym natychmiast.';


return $_LANGMAIL;
