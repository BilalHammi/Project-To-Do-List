<?php
$servername = "localhost";
$username = "bit_academy";
$password = "bit_academy";
try {
    $conectie = new PDO("mysql:host=$servername;dbname=dailygoals", $username, $password);

    $conectie->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
};

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $password1 = $_POST['password'];
    $password2 = $_POST['password2'];
    if ($password1 === $password2) {

        $sql = "INSERT INTO  `dailygoals_accounts`  (`Name`, `Password`) VALUES 
        (:name, :password)";

        $stmt = $conectie->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':password', $password1);

        $stmt->execute();

        header("Refresh: 1; url=Login.php");
    } else {
        echo  "<h1 class='ml-[47rem] text-2xl font-bold'>Passwords dont match each other!</h1>";
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

<body class="ColorBG h-screen overflow-hidden">
    <div class="">
        <div class="fixed">
            <img src="img/To-do-list-removebg-preview.png" alt="" class="ml-[42rem]">
            <?php
            ?>
        </div>
        <div class="bg-zinc-400 absolute top-60 w-[30rem] h-[30rem] ml-[31rem] mt-10  rounded-l-lg">
            <h1 class="ml-[3rem] mt-32 text-2xl font-bold">Welcome to the register page!</h1>
            <p class="ml-[2rem] my-5 font-bold">Make a account to have full access to our website!</p>
        </div>
        <div class="bg-red-400 absolute top-60 w-[26rem] h-[30rem] ml-[60rem] mt-10 rounded-r-lg">
            <form action="register.php" class="flex flex-col" method="POST">
                <input type="text" placeholder="Username" name="name" class="rounded-full py-4 px-2 my-3 mt-12 max-w-[15rem]  bg-500-grey ml-20 font-bold" required>
                <input type="password" placeholder="Password" id="passwordText" name="password" class="rounded-full py-4 px-2 my-3 max-w-[15rem]  bg-500-grey  ml-20 font-bold" required>
                <input type="password" placeholder="Confirm Password" name="password2" id="passwordTextConfirm" class="rounded-full py-4 px-2 my-3 max-w-[15rem]  bg-500-grey  ml-20 font-bold" required>
                <input type="submit" id="submit" name="submit" class="rounded-full py-4 px-2 my-3 max-w-[12rem] bg-neutral-500 ml-[6rem]">
                <div class="mb-96 ml-8 pt-2">
                    <input type="checkbox" id="see" name="see" class="ml-[7rem]" onclick="seeing()"> see password
                    <p class="pt-4 ml-[5rem]">Got a account. Click <a href="Login.php" class="text-blue-300 underline">here!</a></p>
                </div>
            </form>
        </div>
    </div>
    <script>
        function seeing() {
            var x = document.getElementById("passwordText");
            var y = document.getElementById("passwordTextConfirm");
            if (x.type === "password" && y.type === "password") {
                x.type = "text";
                y.type = "text"
            } else {
                x.type = "password";
                y.type = "password";
            }
        }
    </script>
</body>

</html>