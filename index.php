<?php
require __DIR__ . '/vendor/autoload.php';


try {
    include 'inc/connectionCRM.php'; // Подключаем файл подключающий к CRM с объявленными переменными


    // функция показывающая ID, имена и текст задачи
    //принимает в себя аргумент $list - список которые нужно отобразить
    //$i - служит для нумерации, по умолчанию = 1


    function showContacts($list, $i = 1)
    {
        foreach ($list as $item) {
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php print_r($item['id']); ?></td>
                <td><?php print_r($item['name']); ?></td>
                <td><?php if (!$item['linked_leads_id']) {echo '❌';} else {echo '✅';}; ?></td>
                <td><?php if (!$item['closest_task']) {echo '❌';} else {echo '✅';}; ?></td>
            </tr>
            <?php $i++;
        };
    }

    function showTasks($list, $i = 1)
    {
        foreach ($list as $item) {
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php print_r($item['id']); ?></td>
                <td><?php print_r($item['text']); ?></td>
            </tr>
            <?php $i++;
        };
    }

    function showLeads($list, $i = 1)
    {
        foreach ($list as $item) {
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php print_r($item['id']); ?></td>
                <td><?php print_r($item['name']); ?></td>
                <td><?php print_r($item['price']); ?></td>
            </tr>
            <?php $i++;
        };
    }


    function addOptionsForSelect($list) {
        foreach ($list as $item) {
            ?>
            <option type="text" name="id" id="id" value=<?php echo $item['id'];?> ><?php echo $item['name'];?></option><?php
        }
    }

} catch (\AmoCRM\Exception $e) {
    printf('Error (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Вывод списков</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="row">
    <div class="col-4">
        <h1>Контакты</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Имя контакта</th>
                <th scope="col">Есть ли сделки</th>
                <th scope="col">Есть ли задачи</th>
            </tr>
            </thead>
            <tbody>
            <?php showContacts($listCon); ?>
            </tbody>
        </table>
    </div>
    <div class="col-4">
        <h1>Задачи</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Задача</th>
            </tr>
            </thead>
            <tbody>
            <?php showTasks($listTask); ?>
            </tbody>
        </table>

    </div>
    <div class="col-4">
        <h1>Сделки</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Название сделки</th>
                <th scope="col">Бюджет</th>
            </tr>
            </thead>
            <tbody>
            <?php showLeads($listLead); ?>
            </tbody>
        </table>

    </div>
</div>
<div class="form-control container" style="margin-top: 40px; ">
    <form action="/addTaskForConWithoutLeads.php" method="post">
        <h3>Заполнить задачи для контактов без сделок</h3>
        <label for="text">Название задачи</label>
        <input type="text" name="text" id="text" value="Контакт без сделок" >
        <label for="date">Дата</label>
        <input type="date" name="date" id="date" >
        <button type="submit" class="btn btn-primary">
            Заполнить
        </button>
    </form>
</div>

<div class="form-control container" style="margin-top: 40px; ">
    <form action="/addContact.php" method="post">
        <h3>Добавить контакт</h3>
        <label for="name">Имя контакта</label>
        <input type="text" name="name" id="name">
        <button type="submit" class="btn btn-primary">
            Добавить
        </button>
    </form>
</div>

<div class="form-control container" style="margin-top: 40px; ">
    <form id="addTask" action="/addTask.php" method="post">
        <h3>Добавить задачу</h3>
        <label for="text">Название задачи</label>
        <input type="text" name="text" id="text" >
        <label for="date">Дата</label>
        <input type="date" name="date" id="date" placeholder="установите дату">
        <select form="addTask" type="text" name="id" id="id" >
            <?php addOptionsForSelect($listCon) ?>
        </select>
        <button type="submit" class="btn btn-primary">
            Добавить
        </button>
    </form>
</div>

<div class="form-control container" style="margin-top: 40px; ">
    <form id="addLead" action="/addLead.php" method="post">
        <h3>Добавить сделку</h3>
        <label for="name">Название сделки</label>
        <input type="text" name="name" id="name" >
        <label for="rice">Бюджет</label>
        <input type="number" name="price" id="price" >
        <select form="addLead" type="text" name="id" id="id" >
            <?php addOptionsForSelect($listCon) ?>
        </select>
        <button type="submit" class="btn btn-primary">
            Добавить
        </button>
    </form>
</div>


</body>
</html>
