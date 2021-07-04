<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <title>Добавление задач</title>
    <meta charset="UTF-8">
    <?php
    require __DIR__ . '/vendor/autoload.php';
    try {

$subdomain = 'badrutdinataev';                              // Поддомен в амо срм
$login = 'badrutdin_ataev@mail.ru';                         // Логин в амо срм
$apikey = 'c8f56554a584cab09f7112539a88cafaa2b0a1b7';       // api ключ

$amo = new \AmoCRM\Client($subdomain, $login, $apikey);

// получаем задачи и контакты
$contact = $amo->contact;
$task = $amo->task;
$lead = $amo->lead;

// получаем списки  сделок, задач и контактов
$listCon = $contact->apiList([]);
$listTask = $task->apiList([]);
$listLead = $lead->apiList([]);

echo '<pre>';
$ar = $amo->account->apiCurrent();
foreach ($ar as $aaarrr) {
    ?>
    <div style="border: 1px black solid"><?php print_r($aaarrr) ?></div>-->--><?php
    }
    echo '</pre>';

    function foo($list, $task) // Ф-я принимает в себя список и модель задачи
    {
        foreach ($list as $item) { // итерируем список

            if (!$item['linked_leads_id'] && !$item['closest_task']) { // Проверяем, что у контакта точно нет ни сделки ни задачи
                $task["text"] = 'Контакт без сделок';         // Заполняем поле задачи
                $task["complete_till"] = '08/04/2021';        // Заполняем поле задачи
                $task["element_id"] = $item['id'];            // Заполняем поле задачи
                $task["element_type"] = 1;                    // Заполняем поле задачи
                $task->apiAdd();                              // Добавляем задачу
            }

        }
    }

    foreach ($listCon as $li) {
        print_r($li);?><hr><?php

    }

    } catch (\AmoCRM\Exception $e) {
        printf('Error (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
    }
    ?>
</head>
<body>
<h1>Задачи успешно добавлены!</h1>
<button onclick="window.location.href=/*Путь на удобную страницу*/''">Вернуться назад</button>
</body>
</html>
