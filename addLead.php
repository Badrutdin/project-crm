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
        $contacts = $amo->contact;
        $lead["name"] = $_POST['name'];
        $lead["price"] = $_POST['price'];
        $lead->apiAdd();

        foreach ($contacts as $contact) {
            if ($contact['id'] > 0){echo $contact['id'];}
        }



    } catch (\AmoCRM\Exception $e) {
        printf('Error (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
    }
    ?>
</head>
<body>
<div class="container" >
    <h1>Сделка успешно добавлена!</h1>
    <button  type="button" class="btn btn-secondary" onclick="window.location.href='index.php'">Вернуться назад</button>
</div>

</body>
</html>
