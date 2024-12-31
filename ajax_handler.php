<?php
include 'db.php';
include 'session.php';

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'signup':
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $password);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Signup successful']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
            }
            break;

        case 'login':
            $email = $_POST['email'];
            $password = $_POST['password'];

            $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($id, $username, $hashed_password);

            if ($stmt->fetch() && password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                echo json_encode(['status' => 'success', 'message' => 'Login successful']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid credentials']);
            }
            break;

        case 'logout':
            session_destroy();
            echo json_encode(['status' => 'success', 'message' => 'Logged out']);
            break;

        case 'createPost':
            $title = $_POST['title'];
            $text = $_POST['text'];
            $user_id = getUserID();

            $stmt = $conn->prepare("INSERT INTO posts (user_id, title, text) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $user_id, $title, $text);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Post created']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
            }
            break;

        case 'fetchPosts':
            $user_id = getUserID();
            $stmt = $conn->prepare("SELECT id, title, text FROM posts WHERE user_id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            $posts = [];
            while ($row = $result->fetch_assoc()) {
                $posts[] = $row;
            }
            echo json_encode($posts);
            break;

        case 'deletePost':
            $post_id = $_POST['id'];
            $user_id = getUserID();

            $stmt = $conn->prepare("DELETE FROM posts WHERE id = ? AND user_id = ?");
            $stmt->bind_param("ii", $post_id, $user_id);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Post deleted']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
            }
            break;
    }
}
?>
