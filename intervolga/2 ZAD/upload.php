
<!DOCTYPE html>
<html>
<head>
    <title>Загрузка CSV</title>
</head>
<body>
<h1>Загрузить CSV файла</h1>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="csvfile">Выберите CSV файл:</label>
    <input type="file" name="csvfile" id="csvfile"><br><br>
    <input type="submit" value="Upload">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Проверяем, был ли загружен файл
    if (isset($_FILES['csvfile']) && $_FILES['csvfile']['error'] == UPLOAD_ERR_OK) {
        // Открываем файл CSV
        if (($handle = fopen($_FILES['csvfile']['tmp_name'], "r")) !== FALSE) {
            $i = 0;
            // Читаем CSV-файл построчно и записываем содержимое каждой строки в отдельный файл
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                // Получаем имя файла и содержимое из строки
                $filename = $data[0];
                $content = $data[1];
                // Создаем папку для загрузки, если ее еще нет
                if (!file_exists('upload')) {
                    mkdir('upload');
                }
                // Создаем файл с соответствующим именем и содержимым
                file_put_contents("upload/".($i+1).$filename, $content);
                $i++;
            }
            fclose($handle);
            echo "<p>CSV-файл успешно загружен! </p>";
        } else {
            echo "<p>Ошибка при открытии CSV-файла</p>";
        }
    } else {
        echo "<p>Ошибка при загрузке CSV-файла!</p>";
    }
}
?>
</body>
</html>