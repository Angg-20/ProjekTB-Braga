<?php

session_start();

include "../../config/database.php";

$error = '';

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM kasir WHERE username = '$username'";
    $result = mysqli_query($db, $query);

    if ($result) {
        if (mysqli_num_rows($result) === 1) {
            $userData = mysqli_fetch_assoc($result);

            if ($password === $userData['password']) {
                $_SESSION['user'] = $userData['username'];
                $_SESSION['akses'] = $userData['akses'];

                header("Location: ../../index.php");
                exit();
            } else {
                $error = "Password salah. Silakan coba lagi.";
            }
        } else {
            $error = "Username tidak ditemukan.";
        }
    } else {
        $error = "Terjadi kesalahan. Silakan coba lagi.";
    }
}

mysqli_close($db);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Halaman Login</title>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .login {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        h2 {
            text-align: center;
        }

        input[type="text"],
        input[type="password"],
        button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>

</head>

<body>
    <div class="login">
        <h2>Login</h2>
        <form action="" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
            <?php if (!empty($error)) : ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>

</html>