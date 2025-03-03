<?php 
include 'app/db.php'; 
//include 'app/add_travel.php';

$stmt = $pdo->query("SELECT * FROM couriers");
$couriers = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->query("SELECT * FROM Regions");
$regions = $stmt->fetchAll(PDO::FETCH_ASSOC);
                

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Расписание курьеров</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Добавить поездку</h2>
    <form id="addTravelForm">
        <div class="form-group">
            <label for="courier">Курьер:</label>
            <select class="form-control" id="courier" name="courier_id">
                <option selected disabled>Выберите курьера</option>
                <?php
                foreach ($couriers as $courier) {
                    echo "<option value='{$courier['id']}'>{$courier['full_name']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="region">Регион:</label>
            <select class="form-control" id="region" name="region_id">
            <option selected disabled>Выберите регион</option>
                <?php
                foreach ($regions as $region) {
                    echo "<option value='{$region['id']}'>{$region['name']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="departure_date">Дата отправления:</label>
            <input type="date" class="form-control" id="departure_date" name="departure_date">
        </div>
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>

    <h2 class="mt-5">Последние поездки</h2>
    <input type="date" id="filterDate" class="form-control">
    <table class="table" id="travelsTable">
        <thead>
            <tr>
                <th>Курьер</th>
                <th>Регион</th>
                <th>Дата отправления</th>
                <th>Дата прибытия</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
$(document).ready(function() {
    function loadTravels(date = '') {
        $.ajax({
            url: 'app/get_travels.php',
            type: 'GET',
            data: {date: date},
            success: function(response) {
                $('#travelsTable tbody').html(response);
            }
        });
    }

    $('#addTravelForm').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        url: 'app/add_travel.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            alert(response);
            loadTravels();
            $('#addTravelForm')[0].reset();
        },
       /*  error: function(xhr, status, error) {
            alert("error);
        } */
    });
});

    $('#filterDate').on('change', function() {
        loadTravels(this.value);
    });

    loadTravels();
});
</script>
</body>
</html>