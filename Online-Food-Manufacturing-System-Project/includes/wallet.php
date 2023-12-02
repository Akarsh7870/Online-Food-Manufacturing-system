<?php
session_start(); // Make sure session_start() is called before accessing $_SESSION

// Check if 'user_id' is set in the session
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Fetch wallet data
    $sql = mysqli_query($con, "SELECT * FROM wallet WHERE customer_id = $user_id");

    while ($row1 = mysqli_fetch_array($sql)) {
        $wallet_id = $row1['id'];

        // Fetch wallet details using the obtained wallet_id
        $sql_wallet_details = mysqli_query($con, "SELECT * FROM wallet_details WHERE wallet_id = $wallet_id");

        while ($row2 = mysqli_fetch_array($sql_wallet_details)) {
            $balance = $row2['balance'];

            // Now you can use $balance as needed
        }
    }
} else {
    // Handle the case when 'user_id' is not set in the session
    // You might want to redirect the user to the login page or handle it appropriately
    echo "User ID not set in session.";
}
?>
