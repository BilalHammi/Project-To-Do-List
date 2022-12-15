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
$account_detail = $conectie->query("SELECT * FROM `dailygoals_accounts` WHERE id = '" . $_SESSION['UserLoggedIn'] . "'")->fetch();

if (isset($_POST['Logout'])) {
    header("Location: Login.php");
}

if (isset($_POST['AddGoal'])) {
    $class = "<section class='visible bg-slate-300 h-[30rem] w-[40rem] ml-[40rem] mt-10 pt-10 rounded-lg blur-none z-20'>";
    $dclass = "<div class='blur-sm z-10'>";
} else {
    $class = "<section class='hidden'>";
    $dclass = "<body class='none'>";
}

if (isset($_POST['submit'])) {
    $title = 'title';
    $description = 'description';

    $sql = "INSERT INTO `dailygoals_to_do` (`title`, `description`) VALUES (:title, :description)";

    $stmt = $conectie->prepare($sql);

    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);

    $stmt->execute();

    header("Refresh: 1; main_dailygoals.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <title>Main Page</title>
</head>

<body>
    <?php echo $dclass ?>
    <nav class="h-20 w-full bg-gray-400 ">
        <div class="flex justify-end">
            <div class="flex flex-row-reverse">
                <img src="img/gebruiker.png" class="h-14  w-14 rounded-full my-2 mr-5" alt="">
                <h3 class="font-bold text-2xl my-4 mr-5"><?php echo $account_detail['Name']; ?></h3>
                <form action="main_dailygoals.php" method="POST">
                    <input type="submit" class="font-bold bg-stone-600 rounded-lg px-2 py-2 my-4 mr-4" value="Logout" name="Logout">
                    <input type="submit" class="font-bold bg-stone-600 rounded-lg  px-2 py-2 mx-2 my-4 mr-4" value="Add Goal!" name="AddGoal">
                </form>
            </div>
        </div>
        <div class="absolute top-0 font-bold ml-1">
            <h4 class="mb-6">Completed 0/8</h4>
            <h4>Failed 0/8</h4>
        </div>
    </nav>
    </div>
    <?php echo $class ?>
    <div>
        <form method="POST" action="main_dailygoals.php" class="">
            <div class="flex flex-col font-bold text-xl max-w-lg">
                <button class="flex justify-end mr-10 mt-5 my-5">X</button>
                <input type="text" placeholder="Titel" name="title" class="ml-[9rem] rounded-lg py-2 pl-4 mr-9">
                <textarea class="ml-[9rem] my-5 rounded-lg mr-9 pl-4 max-h-40" name="description" placeholder="Description"></textarea>
                <input type="submit" placeholder="Send!" class="bg-stone-600 rounded-lg px-3 py-2 mx-2 ml-[7rem]" name="submit">
            </div>
        </form>
    </div>
    </section>
    </div>
</body>

</html>