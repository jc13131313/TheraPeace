
<?php

session_start();

include '../database/database.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header('location: ../index.php');
    exit();
}

include '../database/database.php';
include '../admin/users.php';

$userCrud = new User($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "deleteUser") {
    if (isset($_POST["userId"])) {
        $userId = $_POST["userId"];
        $userCrud->deleteUser($userId);
        echo "User deleted successfully.";
        exit; // Stop further execution after handling the AJAX request
    } else {
        echo "Invalid request: Missing user ID.";
        exit; // Stop further execution after handling the AJAX request
    }
}

$users = $userCrud->getAllUsers();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
    .table-wrapper{
    margin: 10px 70px 70px;
    box-shadow: 0px 35px 50px rgba( 0, 0, 0, 0.2 );
}

.fl-table {
    border-radius: 5px;
    font-size: 15px;
    font-weight: normal;
    border: none;
    border-collapse: collapse;
    width: 100%;
    max-width: 100%;
    white-space: nowrap;
    background-color: white;
}

.fl-table td, .fl-table th {
    text-align: center;
    padding: 8px;
}

.fl-table td {
    border-right: 1px solid #f8f8f8;
    font-size: 15px;
}

.fl-table thead th {
    color: #ffffff;
    background: #A1E9A6;
}


.fl-table thead th:nth-child(odd) {
    color: #ffffff;
    background: #324960;
}

.fl-table tr:nth-child(even) {
    background: #F8F8F8;
}

/* Responsive */

@media (max-width: 767px) {
    .fl-table {
        display: block;
        width: 100%;
    }
    .table-wrapper:before{
        content: "Scroll horizontally >";
        display: block;
        text-align: right;
        font-size: 11px;
        color: white;
        padding: 0 0 10px;
    }
    .fl-table thead, .fl-table tbody, .fl-table thead th {
        display: block;
    }
    .fl-table thead th:last-child{
        border-bottom: none;
    }
    .fl-table thead {
        float: left;
    }
    .fl-table tbody {
        width: auto;
        position: relative;
        overflow-x: auto;
    }
    .fl-table td, .fl-table th {
        padding: 20px .625em .625em .625em;
        height: 60px;
        vertical-align: middle;
        box-sizing: border-box;
        overflow-x: hidden;
        overflow-y: auto;
        width: 120px;
        font-size: 13px;
        text-overflow: ellipsis;
    }
    .fl-table thead th {
        text-align: left;
        border-bottom: 1px solid #f7f7f9;
    }
    .fl-table tbody tr {
        display: table-cell;
    }
    .fl-table tbody tr:nth-child(odd) {
        background: none;
    }
    .fl-table tr:nth-child(even) {
        background: transparent;
    }
    .fl-table tr td:nth-child(odd) {
        background: #F8F8F8;
        border-right: 1px solid #E6E4E4;
    }
    .fl-table tr td:nth-child(even) {
        border-right: 1px solid #E6E4E4;
    }
    .fl-table tbody td {
        display: block;
        text-align: center;
    }
}

button {
    cursor: pointer;
    border: 0;
}

    </style>
</head>

<body>
    <div class="menu-wrapper">
        <div class="sidebar-header">
            <div class="sideBar">
                <div><img src="../pictures/logo-picture.png" /></div>
                <ul>
                <a href="../admin/dashboard.php"><li class="sidebar-item" data-content="dashboard"><i class="fas fa-chart-bar"></i><label>Dashboard</label></li></a>
                <a href="../admin/admin-profile.php"><li class="sidebar-item selected" data-content="adminprofile"><i class="fas fa-user"></i><label>Admin Profile</label></li></a>
                </ul> <span class="cross-icon"><i class="fas fa-times"></i></span>
                <link rel="icon" href="../pictures/logo-circle.png">
            </div>
            <div class="backdrop"></div>
            <div class="content">
                <header>
                    <div class="menu-button" id='desktop'>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <div class="menu-button" id='mobile'>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <div class="dropdown">
                    <i class="bi bi-person-circle" style="font-size: 40px;"></i>
                    <div class="dropdown-content">
                    <a href="../logout.php" style="color: black;"><i class="bi bi-box-arrow-right" style="margin-right: 5px;"></i>Log Out</a> 
                 </div>
                </div>
                </header>
                <div class="content-data">
                    <div id="Admin-Profile-content">
                    <h2>ADMIN PROFILE</h2>

                    <?php
                // Check if there are users
                if ($users) {
                    echo "<div class='table-wrapper'>";
                    echo "<table class='fl-table'>";
                    echo "<thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    </thead>";
                    echo "<tbody>";
                    // Output data of each row
                    foreach ($users as $user) {
                        echo "<tr id='userRow_" . $user["id"] . "'>";
                        echo "<td>" . $user["id"] . "</td>";
                        echo "<td>" . $user["username"] . "</td>";
                        echo "<td>" . $user["firstname"] . "</td>";
                        echo "<td>" . $user["lastname"] . "</td>";
                        echo "<td>" . $user["email"] . "</td>";
                        echo "<td><button onclick='deleteUser(" . $user["id"] . ")'><i class='fa-solid fa-trash-can' style='color: #ff0000;'></i></button></td>";
                        echo "</tr>";
                    }
                    echo "<tbody>";
                    echo "</table>";
                    echo "</div>";
                } else {
                    echo "No users found.";
                }
                ?>
              
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/admin-page.js"></script>
    <script>
                    function deleteUser(userId) {
                        if (window.confirm("Are you sure you want to delete this user?")) {
                            $.ajax({
                                type: 'POST',
                                url: 'admin-profile.php',
                                data: { action: 'deleteUser', userId: userId },
                                dataType: 'text',
                                success: function (response) {
                                    alert(response);
                                    $('#userRow_' + userId).remove();
                                },
                                error: function (xhr, status, error) {
                                    console.error("Error deleting user: ", error);
                                }
                            });
                        }
                    }
                </script>

</body>

</html>
