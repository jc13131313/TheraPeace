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

$user_id = $_SESSION['user_id'];
$userData = getUserDataFromDatabase($pdo, $user_id);


function getUserDataFromDatabase($pdo, $user_id) {
    // Replace this query with your actual query to fetch user data
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
// Process the form submission for deleting the account
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
    <title>About</title>
    <style>
        .container p{
            font-size: 12px;
        }
    </style>
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
                <div class="content" style="padding: 20px;">
                <div class="name-title">
                        <b><h3>About Us</h3></b>
                        <div class="container" style="width: 100%; height:100%; border-top:solid 3px black; border-bottom:solid 3px black; padding:10px 40px 0 0;">
                            <p>TheraPeace is a mental health help finder website that helps people find mental health resources and support groups in their area. With a robust set of features, TheraPeace goes beyond the conventional, offering a comprehensive platform for mental well-being.</p>
                            <p>Our Community Forum serves as a digital sanctuary, fostering a supportive environment where individuals can share experiences, seek advice, and find solace in the understanding community. Here, users can connect with others facing similar challenges, creating a network of mutual support and empathy.</p>
                            <p>TheraPeace meticulously curates a wealth of mental health resources, meticulously listing local facilities, counseling centers, and therapists in San Fernando, Pampanga. Detailed information about these professionals and facilities is readily available, allowing users to make informed decisions about their mental health care.</p>
                            <p>The integrated GPS tracker elevates the user experience, providing real-time location services to identify mental health resources nearby. Whether you need immediate assistance or prefer a facility within your vicinity, our GPS technology guides you to the closest support options, ensuring timely access to the help you need.</p>
                            <p>TheraPeace isn't just a website; it's a lifeline, connecting individuals with the resources and communities vital for mental health support. By combining cutting-edge technology, community engagement, and detailed information, TheraPeace stands as a beacon of hope, empowering individuals on their journey to mental well-being in San Fernando, Pampanga.</p>
                        </div>
                        <p style="margin-top: 20px;">TheraPeace | 2023</p>
                        <p style="margin-top: -20px;">version 1.0</p>
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
</body>
</html>
