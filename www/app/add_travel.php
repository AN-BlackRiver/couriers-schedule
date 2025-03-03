<?php
include 'db.php';


if (!isset($_POST['courier_id'], $_POST['region_id'], $_POST['departure_date'])) {
    die("Заполните все поля!");
}

$courier_id = $_POST['courier_id'];
$region_id = $_POST['region_id'];
$departure_date = $_POST['departure_date'];

$stmt = $pdo->prepare("
    SELECT COUNT(*) 
    FROM Trips 
    WHERE courier_id = ? 
      AND region_id = ? 
      AND arrival_date >= ?
");
$stmt->execute([$courier_id, $region_id, $departure_date]);

$active_trips_count = $stmt->fetchColumn();

if ($active_trips_count > 0) {
    die("Ошибка: Курьер уже находится в поездке в этот регион.");
}

$stmt = $pdo->prepare("SELECT travel_days FROM Regions WHERE ID = ?");
$stmt->execute([$region_id]);
   
$travel_time = $stmt->fetchColumn();

$arrival_date = date('Y-m-d', strtotime($departure_date . " + $travel_time days"));


$stmt = $pdo->prepare("INSERT INTO Trips (courier_id, region_id, departure_date, arrival_date) VALUES (?, ?, ?, ?)");
if (!$stmt->execute([$courier_id, $region_id, $departure_date, $arrival_date])) {
    die("Ошибка при добавлении поездки.");
}

echo "Поездка добавлена успешно!";
?>