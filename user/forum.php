<?php
session_start();
require_once '../database/database.php';

// Function to calculate the time elapsed
function getTimeElapsedString($datetime) {
    $timestamp = strtotime($datetime);
    $formattedTime = date('F j, Y \a\t g:i a', $timestamp);
    return $formattedTime;
}




// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
}

// Handle post submission and other actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit_post'])) {
        // Handle post submission logic
        $title = htmlspecialchars($_POST['title']); // Sanitize input
        $content = htmlspecialchars($_POST['content']); // Sanitize input
        $user_id = $_SESSION['user_id'];

        // Validate inputs (add more validation as needed)
        if (!empty($title) && !empty($content)) {
            $query = $pdo->prepare('INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)');
            $query->execute([$user_id, $title, $content]);
            // Redirect or handle success as needed
            
        } else {
            // Handle validation errors
        }
    } elseif (isset($_POST['submit_comment'])) {
        // Handle comment submission logic
        $commentContent = htmlspecialchars($_POST['comment']); // Sanitize input
        $postId = $_POST['post_id'];
        $user_id = $_SESSION['user_id'];

        // Validate inputs (add more validation as needed)
        if (!empty($commentContent) && !empty($postId)) {
            $commentQuery = $pdo->prepare('INSERT INTO comments (post_id, user_id, content) VALUES (?, ?, ?)');
            $commentQuery->execute([$postId, $user_id, $commentContent]);
            // Redirect or handle success as needed
        } else {
            // Handle validation errors
        }
    } elseif (isset($_POST['delete_post'])) {
        // Handle post deletion logic
        $postId = $_POST['post_id'];
        deletePost($pdo, $postId);
    } elseif (isset($_POST['delete_comment'])) {
        // Handle comment deletion logic
        $commentId = $_POST['comment_id'];
        deleteComment($pdo, $commentId);
    }
}

// Fetch posts
$query = $pdo->query('SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY created_at DESC');
$posts = $query->fetchAll(PDO::FETCH_ASSOC);

function deletePost($pdo, $postId)
{
    try {
        // Delete associated comments
        $deleteCommentsQuery = $pdo->prepare('DELETE FROM comments WHERE post_id = ?');
        $deleteCommentsQuery->execute([$postId]);

        // Delete associated replies
        $deleteRepliesQuery = $pdo->prepare('DELETE FROM replies WHERE post_id = ?');
        $deleteRepliesQuery->execute([$postId]);

        // Finally, delete the post
        $deletePostQuery = $pdo->prepare('DELETE FROM posts WHERE id = ?');
        $deletePostQuery->execute([$postId]);

        header('Location: forum.php');
    } catch (PDOException $e) {
        echo 'Error deleting post: ' . $e->getMessage();
    }
}

function deleteComment($pdo, $commentId)
{
    try {
        $deleteQuery = $pdo->prepare('DELETE FROM comments WHERE id = ?');
        $deleteQuery->execute([$commentId]);
        // Additional logic as needed
        header('Location: forum.php');
        exit();
    } catch (PDOException $e) {
        // Handle the error, e.g., log it or display an error message
        echo 'Error deleting comment: ' . $e->getMessage();
    }
}


if (isset($_POST['submit_reply'])) {
    $postId = $_POST['post_id'];
    $parentCommentId = $_POST['parent_comment_id'];
    $replyContent = htmlspecialchars($_POST['reply']); // Sanitize input
    $user_id = $_SESSION['user_id'];

    // Validate inputs (add more validation as needed)
    if (!empty($postId) && !empty($parentCommentId) && !empty($replyContent)) {
        // Prepare and execute the query to insert the reply into the 'replies' table
        $replyQuery = $pdo->prepare('INSERT INTO replies (post_id, parent_comment_id, user_id, content) VALUES (?, ?, ?, ?)');
        $replyQuery->execute([$postId, $parentCommentId, $user_id, $replyContent]);

        header('Location: forum.php');
        exit();
    } else {
        $_SESSION['error_message'] = 'Invalid reply. Please check your input.';
        header('Location: forum.php');
        exit();
    }
}

function deleteReply($pdo, $replyId)
{
    try {
        $deleteQuery = $pdo->prepare('DELETE FROM replies WHERE id = ?');
        $deleteQuery->execute([$replyId]);

        // Log success
        error_log('Reply deleted successfully. ID: ' . $replyId);

        // Additional logic as needed
        header('Location: forum.php');
        exit();
    } catch (PDOException $e) {
        // Log the error
        error_log('Error deleting reply (ID ' . $replyId . '): ' . $e->getMessage());

        // Output the error for debugging purposes
        echo 'Error deleting reply: ' . $e->getMessage();
    }
}

// Check if delete_reply action is triggered
if (isset($_POST['delete_reply'])) {
    $replyId = $_POST['reply_id'];
    deleteReply($pdo, $replyId);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="icon" href="../pictures/logo-circle.png">
    <style>
body{
    line-height: 1.6;
    height: 100%;
    width: 100%;
    margin: 0;
    padding: 0;
    font-family:Arial, Helvetica, sans-serif;
    overflow: hidden;
}

.container {
    max-width: 800px;
    padding: 20px;
    background-color: #13103C;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    overflow-y: scroll;
    height: 80vh;
}

input{
    border-radius: 20px;
}

form {
    margin-bottom: 20px;
}

.post {
    margin-bottom: 20px;
    padding: 10px;
    background-color: #EBEAEA;
    border: 1px solid #ddd;
    border-radius: 10px;
}

.comment {
    margin-top: 10px;
    padding: 10px;
    background-color: #D6D6D6;
    border: 1px solid darkgray;
    border-radius: 10px;
}

.reply{
    background-color: #CBCBCB;
    padding: 10px;
    margin-top: 10px;
    border-radius: 10px;
    border: 1px solid #DDDDDD;
}


section{
    width: 100%;
    display: flex;
}

.post-container{
    height: 350px;
    background-color: gray;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

.post-container h3{
background-color: #13103C;
color: white;
text-align: center;
padding: 10px;
}

.post-container button{
    background-color: #13103C;
    color: white;
    padding: 10px 25px 10px 25px;
    border-radius: 10px;
}

.post-container label{
    color: white;
}

::-webkit-scrollbar-track {
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
	background-color: #F5F5F5;
	border-radius: 10px;
}

::-webkit-scrollbar {
	width: 15px;
	background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb {
  border: 3px solid #13103C;
	border-radius: 10px;
	background-color: #FFF;
	background-image: -webkit-gradient(linear,
									   40% 0%,
									   75% 84%,
									   from(#7EE383),
									   to(#A1E9A6),
									   color-stop(.6,#7EE383))
}

 
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <img src="../pictures/logo-picture.png" alt="" class="navbar-brand">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul class="navbar-nav me-auto mb-5 mb-lg-0 offset-4">
              <li class="nav-item">
                <a class="nav-link" href="../user/home.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../user/forum.php">Community</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../user/about-us.php">About Us</a>
              </li>
            </ul>
          
          </div>
          <div class="navbar-nav">
          <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
              <a class="right-btn" href="../user/general/profile.php"><i class="bi bi-person-circle"></i></a>
          </div>
              <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="background: none; color: gray; border:0;"><i class="fa-solid fa-bars fa-2xl"></i></button>


            <div class="pos-f-t">
              <div class="collapse" id="navbarToggleExternalContent">
                <div class="bg-dark p-4">
                  <h4 class="text-white">Collapsed content</h4>
                  <span class="text-muted">Toggleable via the navbar brand.</span>
                </div>
              </div>
            </div>
        </div>
      </nav>

      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
          <img src="../pictures/logo-picture.png" alt="" style="height: 80px; margin-left: 50px;">
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
        <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="../user/general/profile.php" style="color: #333;">
                            General
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../user/help-center/Help-Center.php" style="color: #333;">
                            Help
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../user/help-center/Privacy-Policy.php" style="color: #333;">
                        See Privacy Policy<i class="bi bi-arrow-up-right-square"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../user/help-center/Terms-of-Service.php" style="color: #333;">
                        See Terms of Service<i class="bi bi-arrow-up-right-square"></i>
                        </a>
                    </li>
                </ul>

                <ul class="nav flex-column" style="position: absolute; bottom:0;">
                <li class="nav-item">
                        <a class="nav-link" href="../logout.php" style="color: #333;">
                            Log Out
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../user/general/profile.php" style="color: red; border-top:solid 3px #E6E5E5; width: 100%;">
                            Delete Account
                        </a>
                    </li>
                </ul>
  </div>
</div>


<div class="whole-forum" style="width: 100%; height: 100vh; overflow:hidden; padding: 100px;">
<div class="row">
<div class="col-lg-8">
    <div class="container">
        <img src="../pictures/logo-circle.png" style="height: 40px;" alt=""><h2 style="color: white;">Welcome to the Forum, <?= isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest'; ?>!</h2>


        <!-- Display posts -->
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <div class="post-info">
                    <h3><?= htmlspecialchars($post['username']); ?></h3>
                    <p><?= getTimeElapsedString($post['created_at']); ?></p>
                </div>
                <h4><?= htmlspecialchars($post['title']); ?></h4>
                <p><?= htmlspecialchars($post['content']); ?></p>

                <!-- Check if the logged-in user is the creator of the post -->
                <?php if ($post['user_id'] === $_SESSION['user_id']): ?>
                    <!-- If yes, show the delete button -->
                    <button style="border: 0; background:0;" onclick="showConfirmationModal('post', <?= $post['id']; ?>)"><i class="fa-solid fa-trash-can" style="color: #ff0000;"></i></button>
                <?php else: ?>
                    <!-- If not, show the report button -->
                    <button onclick="showReportModal('post', <?= $post['id']; ?>)">Report</button>
                <?php endif; ?>

                <!-- Comment form for each post -->
                <form action="forum.php" method="post">
                    <input type="hidden" name="post_id" value="<?= $post['id']; ?>">
                    <label for="comment">Add a comment:</label><br>
                    <textarea name="comment" rows="1" required></textarea>
                    <button type="submit" name="submit_comment">Comment</button>
                </form>

              <!-- Display comments for each post -->
<?php
$commentQuery = $pdo->prepare('SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE comments.post_id = ? ORDER BY comments.created_at');
$commentQuery->execute([$post['id']]);
$comments = $commentQuery->fetchAll(PDO::FETCH_ASSOC);
foreach ($comments as $comment): ?>
    <div class="comment">
        <div class="comment-info">
            <p><?= htmlspecialchars($comment['username']); ?></p>
            <p><?= getTimeElapsedString($comment['created_at']); ?></p>
        </div>
        <p><?= htmlspecialchars($comment['content']); ?></p>

        <!-- Check if the logged-in user is the creator of the comment -->
        <?php if ($comment['user_id'] === $_SESSION['user_id']): ?>
            <!-- If yes, show the delete button -->
            <button style="border: 0; background:0;" onclick="showConfirmationModal('comment', <?= $comment['id']; ?>)"><i class="fa-solid fa-trash-can" style="color: #ff0000;"></i></button>
        <?php else: ?>
            <!-- If not, show the report button -->
            <button onclick="showReportModal('comment', <?= $comment['id']; ?>)">Report</button>
        <?php endif; ?>

        <!-- Reply form for comments -->
        <form action="forum.php" method="post" class="reply-form" id="reply-form-<?= $comment['id']; ?>">
            <input type="hidden" name="post_id" value="<?= $post['id']; ?>">
            <input type="hidden" name="parent_comment_id" value="<?= $comment['id']; ?>">
            <label for="reply-content-<?= $comment['id']; ?>">Reply:</label><br>
            <textarea name="reply" id="reply-content-<?= $comment['id']; ?>" rows="1" required></textarea>
            <button type="submit" name="submit_reply">Reply</button>
        </form>

        <!-- Display replies for each comment -->
        <?php
                $replyQuery = $pdo->prepare('SELECT replies.*, users.username, comments.content AS parent_content FROM replies JOIN users ON replies.user_id = users.id JOIN comments ON replies.parent_comment_id = comments.id WHERE replies.parent_comment_id = ? ORDER BY replies.created_at');
                $replyQuery->execute([$comment['id']]);
                $replies = $replyQuery->fetchAll(PDO::FETCH_ASSOC);

                foreach ($replies as $reply): ?>
                    <div class="reply">
                        <div class="reply-info">
                            <p><?= htmlspecialchars($reply['username']); ?></p>
                            <p><?= getTimeElapsedString($reply['created_at']); ?></p>
                        </div>
                        <p><strong>Reply to:</strong> <?= htmlspecialchars($comment['username']); ?></p>
                        <p><?= htmlspecialchars($reply['content']); ?></p>
                
                        <!-- Check if the logged-in user is the creator of the reply -->
                        <?php if ($reply['user_id'] === $_SESSION['user_id']): ?>
                            <!-- If yes, show the delete button -->
                            <button style="border: 0; background:0;" onclick="showConfirmationModal('reply', <?= $reply['id']; ?>)"><i class="fa-solid fa-trash-can" style="color: #ff0000;"></i></button>
                        <?php else: ?>
                            <!-- If not, show the report button -->
                            <button onclick="showReportModal('reply', <?= $reply['id']; ?>)">Report</button>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="col-lg-4">
    <div class="post-container">
        <h3>Add a new thread</h3>
    <form action="forum.php" method="post">
            <label for="title">Title:</label>
            <input type="text" style="width: 100%;" name="title" required>
            <label for="content">Content:</label><br>
            <textarea name="content" style="width: 100%;" rows="4" required></textarea>
            <button type="submit" name="submit_post">Post</button>
        </form>
    </div>
    </div>
</div>
</div>

<!-- Modal for reporting -->
<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Select a reason for reporting:</p>
                <form id="reportForm">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="reportReason" id="spam" value="spam">
                        <label class="form-check-label" for="spam">
                            Spam
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="reportReason" id="violence" value="violence">
                        <label class="form-check-label" for="violence">
                            Violence
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="reportReason" id="harassment" value="harassment">
                        <label class="form-check-label" for="harassment">
                            Harassment
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="reportReason" id="selfHarm" value="selfHarm">
                        <label class="form-check-label" for="selfHarm">
                            Self-harm
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="reportReason" id="nudity" value="nudity">
                        <label class="form-check-label" for="nudity">
                            Nudity
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="reportReason" id="other" value="other">
                        <label class="form-check-label" for="other">
                            Other
                        </label>
                        <div id="otherDetails" style="display: none;">
                            <label for="otherReason">Specify the reason:</label>
                            <input type="text" class="form-control" id="otherReason" name="otherReason">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="confirmReport()">Report</button>
            </div>
        </div>
    </div>
</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Function to show the report modal
        function showReportModal(type, id) {
            // You can implement your modal display logic here
            console.log(`Report ${type} with ID ${id}`);

            // Display a simple confirmation dialog
            const isConfirmed = confirm(`Do you want to report this ${type}?`);

            // Check if the user confirmed
            if (isConfirmed) {
                // Call the appropriate reporting function
                if (type === 'post') {
                    reportPost(id);
                } else if (type === 'comment') {
                    reportComment(id);
                }
            }
        }

        // Function to handle reporting posts
        function reportPost(postId) {
            // You can implement your reporting logic here
            console.log(`Report Post with ID ${postId}`);
            // Add your code to handle the reporting process for posts
        }

        // Function to handle reporting comments
        function reportComment(commentId) {
            // You can implement your reporting logic here
            console.log(`Report Comment with ID ${commentId}`);
            // Add your code to handle the reporting process for comments
        }

        // Function to show the confirmation modal
        function showConfirmationModal(type, id) {
            // You can implement your modal display logic here
            console.log(`Confirmation ${type} with ID ${id}`);

            // Display a simple confirmation modal
            const modal = document.createElement('div');
            modal.innerHTML = `
                <div style=" flex-direction: column; align-items: center; border-radius: 20px; background-color: #13103C; padding:20px; boder: 5px solid #201B64">
                    <p style="color:white;">Are you sure you want to delete this ${type}?</p>
                    <button onclick="confirmDelete('${type}', ${id})" style="background-color: #7EE383; border-radius: 10px;">Yes</button>
                    <button onclick="cancelDelete()" style="background-color: red; border-radius: 10px;">No</button>
                </div>
            `;
            modal.style.position = 'fixed';
            modal.style.top = '50%';
            modal.style.left = '50%';
            modal.style.transform = 'translate(-50%, -50%)';
            modal.style.padding = '0';
            modal.style.background = 'none';
            modal.style.zIndex = '1000';
            modal.id = 'confirmation-modal';
            document.body.appendChild(modal);
        }

        // Function to handle confirming deletion
        function confirmDelete(type, id) {
            // Close the modal
            const modal = document.getElementById('confirmation-modal');
            if (modal) {
                modal.parentNode.removeChild(modal);

                // Call the appropriate deletion function using AJAX
                if (type === 'post') {
                    deletePostAJAX(id);
                } else if (type === 'comment') {
                    deleteCommentAJAX(id);
                }
            }
        }
        function deletePostAJAX(postId) {
        // Make an AJAX request to delete the post
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'forum.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            // Handle the response or update the UI as needed
            console.log('Post deleted successfully');
            location.reload();
        };
        xhr.send(`delete_post=1&post_id=${postId}`);
    }

    // Function to handle AJAX deletion of a comment
    function deleteCommentAJAX(commentId) {
        // Make an AJAX request to delete the comment
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'forum.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            // Handle the response or update the UI as needed
            console.log('Comment deleted successfully');
            location.reload();
        };
        xhr.send(`delete_comment=1&comment_id=${commentId}`);
    }

        // Function to handle canceling deletion
        function cancelDelete() {
            // Close the modal
            const modal = document.getElementById('confirmation-modal');
            if (modal) {
                modal.parentNode.removeChild(modal);
            }
        }

        // Function to show the reply form
        function showReplyForm(commentId) {
            const replyForm = document.getElementById(`reply-form-${commentId}`);
            if (replyForm) {
                replyForm.style.display = 'block';
            }
        }

        // Function to show the reply form
        function showReplyForm(commentId) {
            const replyForm = document.getElementById(`reply-form-${commentId}`);
            if (replyForm) {
                replyForm.style.display = 'block';
            }
        }

        function submitReply(commentId) {
    // Get the reply content from the textarea
    const replyContent = document.getElementById(`reply-content-${commentId}`).value;

    // Make an AJAX request to submit the reply
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'forum.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        // Handle the response or update the UI as needed
        console.log('Reply submitted successfully');
        location.reload(); // Reload the page after a reply is submitted
    };
    xhr.send(`submit_reply=1&comment_id=${commentId}&reply=${encodeURIComponent(replyContent)}`);
}

// Function to handle confirming deletion of a reply
function confirmDeleteReply(replyId) {
    console.log('Reply ID to delete:', replyId);

    // Close the modal
    const modal = document.getElementById('confirmation-modal');
    modal.parentNode.removeChild(modal);

    // Call the function to delete the reply using AJAX
    deleteReplyAJAX(replyId);
}

if (typeof delete_reply !== 'undefined') {
    $replyId = $_POST['reply_id'];
    deleteReply($pdo, $replyId);
}
// Function to handle AJAX deletion of a reply
function deleteReplyAJAX(replyId) {
    // Make an AJAX request to delete the reply
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'forum.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        // Handle the response or update the UI as needed
        if (xhr.status === 200) {
            console.log('Reply deleted successfully');
            location.reload();
        } else {
            console.error('Error deleting reply:', xhr.responseText);
        }
    };
    xhr.send(`delete_reply=1&reply_id=${replyId}`);
}

// Function to show the report modal
function showReportModal(type, id) {

        // Reset the form when the modal is shown
        document.getElementById('reportForm').reset();

        // Display the Bootstrap modal
        $('#reportModal').modal('show');
    }

    // Function to handle confirming the report
    function confirmReport() {
        let reasonValue;
        // Validate the form before submitting
        if (validateReportForm()) {
            // Send AJAX request to report_handler.php
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'report_handler.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                // Handle the response or update the UI as needed
                console.log('Report confirmed with reason:', reasonValue);
                // Optionally, you can include the otherReason in your reporting function
                // Close the modal
                $('#reportModal').modal('hide');
            };

            const formData = new FormData();
            formData.append('report', 1);
            formData.append('reportType', 'post'); // Change this according to your needs
            formData.append('reportedItemId', 123); // Replace with the actual ID
            formData.append('reportReason', reasonValue);
            formData.append('otherReason', otherReasonInput.value.trim());

            xhr.send(formData);
        }
    }

    // Function to validate the report form
    function validateReportForm() {
        const reportReason = document.querySelector('input[name="reportReason"]:checked');
        const otherReasonInput = document.getElementById('otherReason');

        if (!reportReason) {
            alert('Please select a reason for reporting.');
            return false;
        }

        const reasonValue = reportReason.value;

        if (reasonValue === 'other' && otherReasonInput.value.trim() === '') {
            alert('Please specify the reason for reporting.');
            return false;
        }

        return true;
    }

// Function to handle reporting posts
function reportPost(postId) {
    // Make an AJAX request to report the post
    // Add your code to handle the reporting process for posts
    console.log(`Report Post with ID ${postId}`);
}

// Function to handle reporting comments
function reportComment(commentId) {
    // Make an AJAX request to report the comment
    // Add your code to handle the reporting process for comments
    console.log(`Report Comment with ID ${commentId}`);
}


    </script>

</body>

</html>
