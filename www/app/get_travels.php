<?php
include 'db.php';

$date = $_GET['date'] ?? '';

$sql = "SELECT c.full_name, r.name, t.departure_date, t.arrival_date 
        FROM Trips t
        JOIN Couriers c ON t.courier_id = c.Id
        JOIN Regions r ON t.region_id = r.ID";

if (!empty($date)) {
    $sql .= " WHERE t.departure_date = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$date]);
} else {
    $sql .= " ORDER BY t.id DESC LIMIT 10";
    $stmt = $pdo->query($sql);
}

$travels = $stmt->fetchAll();

foreach ($travels as $travel) {
    echo "<tr>
            <td>{$travel['full_name']}</td>
            <td>{$travel['name']}</td>
            <td>{$travel['departure_date']}</td>
            <td>{$travel['arrival_date']}</td>
          </tr>";
}
?>