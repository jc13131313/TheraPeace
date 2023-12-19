<?php
session_start();

// Include the database connection file
include '../../database/database.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header('location: ../../index.php');
    exit();
}

// Fetch user information from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    // If user not found, redirect to the login page
    header('location: ../../index.php');
    exit();
}

$firstname = $user['firstname'];
$lastname = $user['lastname'];

// Process the form submission for changing the password
$successMessage = $errorMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];

    // Validate old password
    if (password_verify($oldPassword, $user['password'])) {
        // Hash and update the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the password in the database
        $updateQuery = "UPDATE users SET password = ? WHERE id = ?";
        $updateStmt = $pdo->prepare($updateQuery);
        $updateStmt->execute([$hashedPassword, $user_id]);

        // Optionally, you can check if the update was successful
        if ($updateStmt->rowCount() > 0) {
            $successMessage = 'Password updated successfully.';
        } else {
            $errorMessage = 'Failed to update the password. Please try again.';
        }
    } else {
        $errorMessage = 'Invalid old password.';
    }
}

// Function to delete all comments of a user
function deleteComments($pdo, $user_id) {
    $stmt = $pdo->prepare("DELETE FROM comments WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
}

// Function to delete all posts of a user
function deletePosts($pdo, $user_id) {
    $stmt = $pdo->prepare("DELETE FROM posts WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
}

// Process the form submission for deleting the account
$deleteErrorMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_account'])) {
    $deletePassword = $_POST['delete_password'];

    // Check if the entered password is correct
    if (password_verify($deletePassword, $userData['password'])) {
        // Delete all comments and posts associated with the user
        deleteComments($pdo, $user_id);
        deletePosts($pdo, $user_id);

        // Delete the account
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        // Redirect to the logout page after successful deletion
        header('location: ../../logout.php');
        exit();
    } else {
        $deleteErrorMessage = 'Incorrect password. Please try again.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../css/profile-style.css">
    <link rel="icon" href="../../pictures/logo-circle.png">
    <title>Password</title>
</head>
<body>
    <div class="circle"></div>
    <div class="top-design"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <!-- Sticky navbar at the top of the container -->
                <nav class="navbar navbar-expand-md" style="background: none;">
                    <a class="navbar-brand" href="../../user/home.php" style="color: black;"><i class="bi bi-backspace"></i>Back</a>
                </nav>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-3 sidebar">
                <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="../general/profile.php">
                            General
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../general/edit-profile.php">
                            Edit Profile
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../general/password.php">
                            Password
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../general/about.php">
                            About
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../logout.php">
                            Log Out
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="modal" data-target="#deleteAccountModal" style="color: red; border-top:solid 3px #E6E5E5;">
                            Delete Account
                        </a>
                    </li>
                </ul>
                </div>
            </div>

            <div class="col-md-9 px-md-0">
                <div class="content">
                    <div class="name-title">
                        <i class="bi bi-person-circle"></i> <?php echo $firstname . ' ' . $lastname; ?> / Edit Password
                        <p>Manage your account</p>
                    </div>
                    <form method="post" action="">
                        <!-- Your form fields here -->
                        <div class="form-group">
                            <label for="old_password" class="form-label"><b>Old Password</b></label>
                            <input type="password" id="old_password" name="old_password" class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <label for="new_password" class="form-label"><b>New Password</b></label>
                            <input type="password" id="new_password" name="new_password" class="form-control" value="">
                        </div>

                        <button type="submit">Save Changes</button>
                    </form>

                    <!-- Display success or error message if any -->
                    <?php if ($successMessage): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $successMessage; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($errorMessage): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $errorMessage; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteAccountModal" tabindex="-1" role="dialog" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAccountModalLabel">Delete Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete your account?</p>
                <form method="post" action="">
                    <label for="delete_password" class="form-label"><b>Password</b></label>
                    <input type="password" id="delete_password" name="delete_password" class="form-control" required>
                    <p class="text-danger"><?php echo $deleteErrorMessage; ?></p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" name="delete_account" style="position: absolute; left:0; width:30%;">Delete Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <script>

        // Show/hide password functionality
        function togglePassword(inputId, toggleId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(toggleId);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            }
        }
    </script>
</body>
</html>
