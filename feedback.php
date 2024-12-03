<?php
include 'util/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $message = $_POST["message"];

    $stmt = $conn->prepare("INSERT INTO messages (username, message) VALUES (:username, :message)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':message', $message);
    
    if ($stmt->execute()) {
        echo "<script>alert('The message has been submitted successfully!');</script>";
    } else {
        echo "Error: Unable to submit message";
    }
}

$stmt = $conn->prepare("SELECT username, message FROM messages ORDER BY id DESC");
$stmt->execute();
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Grayscale - Start Bootstrap Theme</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="assets/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="assets/css/fonts.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="assets/css/styles.css" rel="stylesheet" />
        <style>
            .message-box {
            background-color: #ffffff;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            background-color: rgba(55,55,55,0.5);
            }
            .message-user {
            font-weight: bold;
            color: #007bff;
            }
            .message-content {
            margin-top: 5px;
            }
            .message-form textarea {
            border-radius: 10px;
            }
        </style>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php">InnovAI Solutions</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="index.php#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php#projects">Projects</a></li>
                        <li class="nav-item"><a class="nav-link" href="feedback.php">Feedback</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
                <div class="d-flex flex-column justify-content-center w-100 h-75 text-white">
                    <form action="#" method="POST">
                        <div class="d-flex">
                            <div class="w-75">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Nick Name</label>
                                    <input type="text" name="username" class="form-control message-box" id="username" required placeholder="Nick Name">
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control message-box" rows="3" name="message" id="message" placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="w-25 p-3 d-flex flex-column justify-content-end">
                                <button type="submit" class="btn btn-primary h-50 w-100">Submit</button>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <h3>Feedbacks</h3>
                    <div class="messages mt-4 h-50 overflow-auto">
                    <?php if (!empty($messages)): ?>
                        <?php foreach ($messages as $row): ?>
                            <div class="message-box">
                                <p class="message-user"><?php echo $row['username']; ?></p>
                                <p class="message-content"><?php echo $row['message']; ?></p>
                            </div>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <p>目前還沒有留言。</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Footer-->
        <footer class="footer bg-black small text-center text-white-50"><div class="container px-4 px-lg-5">Copyright &copy; Your Website 2023</div></footer>
        <!-- Bootstrap core JS-->
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="assets/js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="assets/js/sb-forms.js"></script>
        <script type="module">
            import Chatbot from "./assets/js/web.js"
            Chatbot.init({
                chatflowid: "8ff7f7d9-db44-4b64-960e-6d0b2bc36440",
                apiHost: "http://192.168.1.150:3000",
            })
        </script>
    </body>
</html>
