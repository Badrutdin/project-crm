<?php
$subdomain = '';            // Поддомен в амо срм
$login = '';            // Логин в амо срм
$apikey = '';            // api ключ

$amo = new \AmoCRM\Client($subdomain, $login, $apikey);

// получаем сделки, задачи и контакты
$lead = $amo->lead;
$contact = $amo->contact;
$task = $amo->task;


// получаем списки  сделок, задач и контактов
$listLead = $lead->apiList([]);
$listCon = $contact->apiList([]);
$listTask = $task->apiList([]);

/*echo '<pre>';
$ar = $amo->account->apiCurrent();
foreach ($ar as $aaarrr) {
    */?><!--
    <div style="border: 1px black solid"><?php /*print_r($aaarrr) */?></div>--><?php
/*}
echo '</pre>';*/