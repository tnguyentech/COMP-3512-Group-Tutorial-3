<!DOCTYPE html>

<?php 
// Group Members: Tony Nguyen, Chris Eberle



$db = new PDO("sqlite:./travel.db");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$result = $db->query("SELECT * FROM Countries");

$options = [];


echo '<select> <option value="all">All Countries</option>';

while ($row = $result->fetch()) {
    echo "<option value={$row['CountryCode']}>" . $row['CountryName'] . "</option>";
}

echo "</select>";



?>

<html>

<body>
    <form method="GET">
        <select>
            <? php
            ?>
        </select>
    </form>
</body>

</html>