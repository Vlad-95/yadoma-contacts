<?php
include_once 'bitrix.php';
include_once 'common.php';

$next_url = '/index.html';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $config = include('.config.php');

    function get_user_choice($select_name) {
        $user_choice = 'Не определились';
        if (!empty($_POST[$select_name]) && is_array($_POST[$select_name])) {
            $user_choice = implode(', ', $_POST[$select_name]);
        }

        return array($user_choice);
    }

    session_start();

    $name = $_POST['name'];
    $tel_data = array(array(
        "VALUE" => $_POST['tel'],
        "VALUE_TYPE" => "WORK",
    ));
    $email_data = array(array(
        "VALUE" => $_POST['email'],
        "VALUE_TYPE" => "WORK",
    ));

    $desired_apartment_sizes_data = get_user_choice('desired_apartment_sizes');
    $desired_buy_method_data = get_user_choice('desired_buy_method');

    $fields = array(
        'TITLE' => $config['bitrix_title'],
        'SOURCE_ID' => $config['bitrix_source_id'],
        'NAME' => $name,
        'PHONE' => $tel_data,
        'EMAIL' => $email_data,
        'UF_CRM_1583621792' => $desired_apartment_sizes_data,
        'UF_CRM_1588446114' => $desired_buy_method_data,
        'UTM_SOURCE' => $_POST['utm_source'],
        'UTM_MEDIUM' => $_POST['utm_medium'],
        'UTM_CAMPAIGN' => $_POST['utm_campaign'],
        'UTM_CONTENT' => $_POST['utm_content'],
        'UTM_TERM' => $_POST['utm_term'],
    );

    $query_data = array(
        'fields' => $fields,
        'params' => array("REGISTER_SONET_EVENT" => "Y"),
    );

    $result = make_bitrix_request('crm.lead.add', $query_data);

    if (array_key_exists('error', $result)) {
        log_to_file("Ошибка при сохранении лида: " . $result['error_description']);
    }

    $next_url = '/thanks.html';
}

header('Location: ' . $next_url);
die();
?>
