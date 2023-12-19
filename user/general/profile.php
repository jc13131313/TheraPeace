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

// Assuming you have a function to get user data based on user_id
$user_id = $_SESSION['user_id'];
$userData = getUserDataFromDatabase($pdo, $user_id);

// Extract user data
$firstname = $userData['firstname'];
$lastname = $userData['lastname'];
$email = $userData['email'];
$username = $userData['username']; // Added to display the current username

// Function to get user data from the database using PDO
function getUserDataFromDatabase($pdo, $user_id) {
    // Replace this query with your actual query to fetch user data
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = trim($_POST['new_username']);

    // Validate the new username (you can add more validation as needed)
    if (empty($newUsername)) {
        $usernameErrorMessage = 'Username cannot be empty.';
    } else {
        // Check if the new username is available
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :new_username AND id != :user_id");
        $stmt->bindParam(':new_username', $newUsername);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $usernameErrorMessage = 'Username is already taken. Please choose a different one.';
        } else {
            // Update the username in the database
            $stmt = $pdo->prepare("UPDATE users SET username = :new_username WHERE id = :user_id");
            $stmt->bindParam(':new_username', $newUsername);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();

            // Update the $userData variable with the new username
            $userData['username'] = $newUsername;

            // Set a success message for the modal
            $successMessage = 'Username updated successfully.';
        }
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


// Clear success message if requested
if (isset($_POST['clearSuccessMessage'])) {
    $successMessage = '';
    exit; // Stop further execution
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
    <title>General</title>
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
                        <i class="bi bi-person-circle"></i> <?php echo $firstname . ' ' . $lastname; ?> / Edit General
                        <p>Manage your account</p>
                    </div>
                    <form method="post" enctype="multipart/form-data" action="">
                        <label for="new_username" class="form-label"><b>Username</b></label>
                        <input type="text" id="new_username" name="new_username" class="form-control" value="<?php echo $username; ?>">
                        <label for="email" class="form-label"><b>Email</b></label>
                        <input type="email" id="email" name="email" class="form-control" value="<?php echo $email; ?>">
                        <button type="submit">Save Changes</button>
                    </form>
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

    <!-- Bootstrap Modal for Success Message -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo $successMessage; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Function to show success modal and clear success message
    function showSuccessModal() {
        var successMessage = "<?php echo $successMessage; ?>";
        if (successMessage !== "") {
            $('#successModal').modal('show');
        }
    }

    // Show success modal on page load
    $(document).ready(function(){
        showSuccessModal();
    });

    // Reload the page after modal is closed
    $('#successModal').on('hidden.bs.modal', function () {
        location.href = location.href.split("#")[0]; // Reload the page without anchor
    });
</script>



</body>
</html>
