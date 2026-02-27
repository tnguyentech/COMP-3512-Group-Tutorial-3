<!DOCTYPE html>

<?php 
// Group Members: Tony Nguyen, Chris Eberle

//db setup
$db = new PDO("sqlite:./travel.db");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// selected country
$selectedCountry = "all";
// Update the selectedCountry
if (isset($_GET['country'])) {
    $selectedCountry = $_GET['country'];
}
?>

<html>

<body>
    <form method="GET">
        <label>Select Country:</label>

        <select name="country">
            <option value="all" <?= ($selectedCountry === "all") ? "selected" : "" ?>>All Countries</option>
            <?php
            $result = $db->query("SELECT * FROM Countries");

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $code = htmlspecialchars($row['CountryCode']);
                $name = htmlspecialchars($row['CountryName']);
                $isSelected = ($selectedCountry === $row['CountryCode']) ? "selected" : "";
                echo "<option value='$code' $isSelected>$name</option>";
            }
            ?>
        </select>

        <input type="submit">
    </form>

    <?php
    if($selectedCountry === "all") {
        // Display all images
        $result = $db->query("SELECT * FROM ImageDetails");

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $file = htmlspecialchars($row['FileName']);
                $title = htmlspecialchars($row['Title']);
                echo "<img src='./images/$file' alt='$title' style='width:200px; margin:8px;'>";
            }
    } 
    else {
         // Display only images for the selected country
    $stmt = $db->prepare(
        "SELECT ImageID, Title, FileName
        FROM ImageDetails
        WHERE CountryCode = :cc
        ORDER BY ImageID"
    );
    $stmt->execute([":cc" => $selectedCountry]);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $file = htmlspecialchars($row['FileName']);
        $title = htmlspecialchars($row['Title']);
        echo "<img src='./images/$file' alt='$title' style='width:200px; margin:8px;'>";
        }
    }
    
    ?>
</body>

</html>