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
$profilePicture = $userData['profile_picture']; // Replace with the actual column name for the profile picture

// Function to get user data from the database using PDO
function getUserDataFromDatabase($pdo, $user_id) {
    // Replace this query with your actual query to fetch user data
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Process the form submission
$successMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // Handle other form fields (firstname, lastname, gender, location, etc.)
    if (isset($_POST['firstname'], $_POST['lastname'], $_POST['gender'], $_POST['location'])) {
        $newFirstname = $_POST['firstname'];
        $newLastname = $_POST['lastname'];
        $newGender = $_POST['gender'];
        $newLocation = $_POST['location'];

        // Update user profile information in the database
        $stmt = $pdo->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, gender = :gender, location = :location, profile_picture = :profile_picture WHERE id = :user_id");
        $stmt->bindParam(':firstname', $newFirstname);
        $stmt->bindParam(':lastname', $newLastname);
        $stmt->bindParam(':gender', $newGender);
        $stmt->bindParam(':location', $newLocation);
        $stmt->bindParam(':profile_picture', $profilePicture);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        // Set a success message for the modal
        if ($stmt->rowCount() > 0) {
            $successMessage = 'Profile updated successfully.';
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../css/edit-profile.css">
    <link rel="icon" href="../../pictures/logo-circle.png">
    <title>Edit Profile</title>
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
                        <i class="bi bi-person-circle"></i> <?php echo $firstname . ' ' . $lastname; ?> / Edit Profile
                        <p>Manage your account</p>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data" style="padding: 0 100px 0 100px;">
                        <div class="row">
                            <div class="col">
                                <label for="firstname" class="form-label"><b>First Name</b></label>
                                <input type="text" id="firstname" name="firstname" class="form-control" placeholder="First name" aria-label="First name" value="<?php echo $firstname; ?>">
                            </div>
                            <div class="col">
                                <label for="lastname" class="form-label"><b>Last Name</b></label>
                                <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Last name" aria-label="Last name" value="<?php echo $lastname; ?>">
                            </div>
                        </div>
                        <label for="gender" class="form-label"><b>Gender</b></label>
                        <select class="form-select" id="gender" name="gender" aria-label="Default select example" style="width: 100%; height:35px; font-size: 20px; margin-bottom:15px; border-radius:25px;">
                            <option selected>Choose...</option>
                            <option value="1" <?php echo ($userData['gender'] == 1) ? 'selected' : ''; ?>>Male</option>
                            <option value="2" <?php echo ($userData['gender'] == 2) ? 'selected' : ''; ?>>Female</option>
                            <option value="3" <?php echo ($userData['gender'] == 3) ? 'selected' : ''; ?>>Other</option>
                        </select>
                        <label for="location" class="form-label"><b>Location</b></label>
                        <input type="text" id="location" name="location" class="form-control" value="<?php echo $userData['location']; ?>">
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
        // Show success modal if success message is not empty
        $(document).ready(function(){
            if ("<?php echo $successMessage; ?>" !== "") {
                $('#successModal').modal('show');
            }
        });

        // Refresh the page after modal is closed
        $('#successModal').on('hidden.bs.modal', function () {
            location.reload();
        });
    </script>
</body>
</html>
