<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" >
    <title>Добавление задач</title>
    <meta charset="UTF-8">
    <?php
    require __DIR__ . '/vendor/autoload.php';
    try {
        include 'inc/connectionCRM.php';

        function foo($list, $task)
        {
            foreach ($list as $item) {

                if (!$item['linked_leads_id'] && !$item['closest_task']) { // Проверяем, что у контакта точно нет ни сделки ни задачи
                    $task["text"] = $_POST['text'];             // Заполняем поле задачи
                    $task["complete_till"] = $_POST['date'];        // Заполняем поле задачи
                    $task["element_id"] = $item['id'];            // Заполняем поле задачи
                    $task["element_type"] = 1;                    // Заполняем поле задачи
                    $task->apiAdd();                              // Добавляем задачу
                }

            }
        }
        foo($listCon, $task);

    } catch (\AmoCRM\Exception $e) {
        printf('Error (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
    }
    ?>
</head>
<body>
<div class="container" >
    <h1>Задачи успешно добавлены!</h1>
    <button  type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Вернуться назад</button>
</div>

</body>
</html>
