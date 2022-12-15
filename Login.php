<?php
session_start();
$servername = "localhost";
$username = "bit_academy";
$password = "bit_academy";
try {
    $conectie = new PDO("mysql:host=$servername;dbname=dailygoals", $username, $password);

    $conectie->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
};
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password1 = $_POST['password'];

    $sql = $conectie->query("SELECT * FROM dailygoals_accounts WHERE name = '$username' AND password = '$password1'")->fetch();
    if ($sql) {
        $_SESSION['UserLoggedIn'] = $sql['id'];
        header("Location: main_dailygoals.php");
    } else {
        echo "<h1 class='ml-[47rem] text-2xl font-bold'>Invalid Username/Password, check again!</h1>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
    <style>
        .ColorBG {
            background: linear-gradient(-45deg, black, grey, white);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            height: 100vh;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        #submit:hover {
            background-color: green;
            border: 2px solid black;
        }
    </style>
</head>

<body class="overflow-hidden">
    <div class="ColorBG">
        <div class="flex justify-center mr-96">
            <h1 class="z-10 absolute inset-y-2/4 text-5xl font-bold">What to do?</h1>
        </div>
        <div class="absolute right-0 bg-gray-400 h-full w-[28rem] z-0">
            <img src="img/To-do-list-removebg-preview.png" alt="">
            <div class="flex justify-center mb-10">
                <form action="Login.php" class="flex flex-col" method="POST">
                    <input type="text" placeholder="Username" name="username" class="rounded-full py-4 px-2 my-3 max-w-[15rem]  bg-500-grey ml-20 font-bold" required>
                    <input type="password" placeholder="Password" name="password" id="passwordText" class="rounded-full py-4 px-2 my-3 max-w-[15rem]  bg-500-grey  ml-20 font-bold" required>
                    <input type="submit" id="submit" value="submit" name="submit" class="rounded-full py-4 px-2 my-3 max-w-[12rem] bg-neutral-500 ml-[6rem]">
                    <div class="mb-96 ml-8 pt-2">
                        <input type="checkbox" id="see" name="see" class="ml-[6.5rem]" onclick="seeing()"> see password
                        <p class="pt-4 ml-8">Don't have a account? Click <a href="register.php" class="text-blue-300 underline">here!</a></p>
                    </div>
                </form>
            </div>
        </div>
        <script>
            function seeing() {
                var x = document.getElementById("passwordText");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>
</body>

</html>