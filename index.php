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
            <option value="all">All Countries</option>
            <?php
            $result = $db->query("SELECT * FROM Countries");

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row['CountryCode'] . "'>" . $row['CountryName'] . "</option>";
            }
            ?>
        </select>

        <input type="submit">
    </form>

    <?php
    if($selectedCountry == "all") {
        // Display all images
        $result = $db->query("SELECT * FROM ImageDetails");

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<img src='./images/" . $row['FileName'] . "'>" . "</img>";
            }
    } else {
        // Here we will handle displaying the images associated with code

    }
    
    ?>
</body>

</html>