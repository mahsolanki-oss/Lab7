<?php
$title = "View Records";
require_once './includes/header.php';
require_once './db/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $delete_id = mysqli_real_escape_string($conn, $delete_id);

    $delete_sql = "DELETE FROM client_info WHERE client_id = '$delete_id'";
    mysqli_query($conn, $delete_sql);
}

$sql = "SELECT * FROM client_info";
$result = mysqli_query($conn, $sql);
?>

<div class="container mt-5">
    <h2>Client Records</h2>

    <form method="post" action="viewrecords.php">
        <label>Enter Client ID to Delete</label>
        <input type="text" name="delete_id" required>
        <button type="submit">Delete Record</button>
    </form>

    <br><br>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Address</th>
            <th>City</th>
            <th>Province</th>
            <th>Postal Code</th>
        </tr>

        <?php
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['client_id'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['city'] . "</td>";
                echo "<td>" . $row['province'] . "</td>";
                echo "<td>" . $row['postalcode'] . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</div>

<?php require_once './includes/footer.php'; ?>