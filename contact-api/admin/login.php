<?php

session_start();

$error = "";

if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    // Simple admin login
    $adminUsername = "Uttam";
    $adminPassword = "748876";

    if (
        $username === $adminUsername &&
        $password === $adminPassword
    ) {

        $_SESSION["admin"] = true;

        header(
            "Location: dashboard.php"
        );

        exit();

    } else {

        $error =
        "Invalid username or password!";

    }

}

?>


<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0"
>

<title>Admin Login</title>


<style>

* {

    margin: 0;

    padding: 0;

    box-sizing: border-box;

}


body {

    min-height: 100vh;

    display: flex;

    justify-content: center;

    align-items: center;

    background:

    #0C1020;

    color:

    #D7DAE5;

    font-family:

    Arial,
    sans-serif;

}


.login-box {

    width:

    100%;

    max-width:

    420px;

    padding:

    40px;

    border:

    1px solid
    #262F4A;

    border-radius:

    22px;

    background:

    #121729;

    box-shadow:

    0 20px 60px
    rgba(
    0,
    0,
    0,
    0.4
    );

}


h1 {

    text-align:

    center;

    color:

    white;

    margin-bottom:

    10px;

}


.subtitle {

    text-align:

    center;

    color:

    #8B92AC;

    margin-bottom:

    30px;

}


label {

    display:

    block;

    margin-bottom:

    8px;

    color:

    #D7DAE5;

}


input {

    width:

    100%;

    padding:

    14px;

    margin-bottom:

    20px;

    border:

    1px solid
    #262F4A;

    border-radius:

    8px;

    outline:

    none;

    background:

    #0C1020;

    color:

    white;

}


input:focus {

    border-color:

    #9C7BFF;

}


button {

    width:

    100%;

    padding:

    14px;

    border:

    none;

    border-radius:

    8px;

    cursor:

    pointer;

    background:

    #9C7BFF;

    color:

    white;

    font-size:

    16px;

    font-weight:

    bold;

}


button:hover {

    background:

    #8564E8;

}


.error {

    margin-bottom:

    18px;

    padding:

    12px;

    border-radius:

    8px;

    color:

    #ff8d8d;

    background:

    rgba(
    255,
    70,
    70,
    0.1
    );

}


</style>

</head>


<body>


<div class="login-box">


<h1>

Admin Login

</h1>


<p class="subtitle">

Login to view contact messages

</p>


<?php

if ($error != "") {

?>

<div class="error">

<?php

echo $error;

?>

</div>

<?php

}

?>


<form method="POST">


<label>

Username

</label>


<input
type="text"
name="username"
placeholder="Enter username"
required
>


<label>

Password

</label>


<input
type="password"
name="password"
placeholder="Enter password"
required
>


<button
type="submit"
name="login"
>

Login →

</button>


</form>


</div>


</body>

</html>