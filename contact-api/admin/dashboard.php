<?php

session_start();


// Login check

if (!isset($_SESSION["admin"])) {

    header("Location: login.php");

    exit();

}


// Database connection

$host = "localhost";

$username = "root";

$password = "";

$database = "contact_db";


$conn = new mysqli(

    $host,

    $username,

    $password,

    $database

);


// Database connection check

if ($conn->connect_error) {

    die(
        "Database connection failed: "
        . $conn->connect_error
    );

}


// Get all contact messages

$sql = "SELECT * FROM contacts
        ORDER BY id DESC";


$result = $conn->query($sql);


// Total messages

$totalMessages = $result->num_rows;

?>


<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0"
>

<title>Admin Dashboard</title>


<style>


/* ================= RESET ================= */


* {

    margin: 0;

    padding: 0;

    box-sizing: border-box;

}


/* ================= BODY ================= */


body {

    min-height: 100vh;

    background:

    radial-gradient(
        circle at top right,
        rgba(
            156,
            123,
            255,
            0.15
        ),
        transparent 35%
    ),

    #0C1020;

    color:

    #D7DAE5;

    font-family:

    Arial,
    sans-serif;

}


/* ================= HEADER ================= */


.header {

    position:

    sticky;

    top:

    0;

    z-index:

    100;

    display:

    flex;

    justify-content:

    space-between;

    align-items:

    center;

    padding:

    20px 7%;

    border-bottom:

    1px solid
    #262F4A;

    background:

    rgba(
        18,
        23,
        41,
        0.92
    );

    backdrop-filter:

    blur(15px);

}


.logo {

    display:

    flex;

    align-items:

    center;

    gap:

    10px;

    color:

    white;

    font-size:

    25px;

}


.logo-icon {

    display:

    flex;

    justify-content:

    center;

    align-items:

    center;

    width:

    42px;

    height:

    42px;

    border-radius:

    12px;

    background:

    linear-gradient(
        135deg,
        #9C7BFF,
        #6E52D9
    );

}


.logo span {

    color:

    #4FF3D6;

}


.logout {

    padding:

    11px 20px;

    border:

    1px solid
    #9C7BFF;

    border-radius:

    10px;

    color:

    white;

    text-decoration:

    none;

    background:

    #9C7BFF;

    font-weight:

    bold;

    transition:

    0.3s;

}


.logout:hover {

    transform:

    translateY(-2px);

    background:

    #8564E8;

    box-shadow:

    0 8px 25px
    rgba(
        156,
        123,
        255,
        0.35
    );

}


/* ================= MAIN ================= */


.container {

    width:

    90%;

    max-width:

    1250px;

    margin:

    auto;

    padding:

    60px 0;

}


/* ================= HERO ================= */


.top-section {

    display:

    flex;

    justify-content:

    space-between;

    align-items:

    center;

    gap:

    30px;

    flex-wrap:

    wrap;

}


.title {

    color:

    white;

    font-size:

    40px;

}


.title span {

    color:

    #9C7BFF;

}


.subtitle {

    margin-top:

    12px;

    color:

    #8B92AC;

    font-size:

    16px;

}


/* ================= STATS ================= */


.stats {

    margin-top:

    40px;

}


.stat-card {

    position:

    relative;

    overflow:

    hidden;

    width:

    300px;

    padding:

    28px;

    border:

    1px solid
    #262F4A;

    border-radius:

    20px;

    background:

    linear-gradient(
        145deg,
        #161C31,
        #101524
    );

    transition:

    0.3s;

}


.stat-card:hover {

    transform:

    translateY(-5px);

    border-color:

    #9C7BFF;

}


.stat-card::after {

    content:

    "";

    position:

    absolute;

    right:

    -35px;

    top:

    -35px;

    width:

    120px;

    height:

    120px;

    border-radius:

    50%;

    background:

    rgba(
        156,
        123,
        255,
        0.15
    );

}


.stat-label {

    color:

    #8B92AC;

    font-size:

    14px;

}


.stat-number {

    margin-top:

    12px;

    color:

    #4FF3D6;

    font-size:

    45px;

}


.stat-text {

    margin-top:

    5px;

    color:

    #8B92AC;

    font-size:

    13px;

}


/* ================= TABLE ================= */


.table-heading {

    display:

    flex;

    justify-content:

    space-between;

    align-items:

    center;

    margin-top:

    50px;

    margin-bottom:

    18px;

}


.table-heading h2 {

    color:

    white;

    font-size:

    23px;

}


.badge {

    padding:

    7px 12px;

    border-radius:

    30px;

    color:

    #4FF3D6;

    background:

    rgba(
        79,
        243,
        214,
        0.1
    );

    font-size:

    13px;

}


.table-box {

    overflow-x:

    auto;

    border:

    1px solid
    #262F4A;

    border-radius:

    20px;

    background:

    #121729;

    box-shadow:

    0 20px 50px
    rgba(
        0,
        0,
        0,
        0.2
    );

}


table {

    width:

    100%;

    min-width:

    1000px;

    border-collapse:

    collapse;

}


th {

    padding:

    19px;

    text-align:

    left;

    color:

    #4FF3D6;

    background:

    #171D32;

    font-size:

    13px;

    text-transform:

    uppercase;

    letter-spacing:

    1px;

}


td {

    padding:

    20px 19px;

    border-top:

    1px solid
    #262F4A;

    color:

    #D7DAE5;

}


tbody tr {

    transition:

    0.25s;

}


tbody tr:hover {

    background:

    rgba(
        156,
        123,
        255,
        0.07
    );

}


.id {

    color:

    #8B92AC;

}


.name {

    color:

    white;

    font-weight:

    bold;

}


.email {

    color:

    #9C7BFF;

    text-decoration:

    none;

}


.email:hover {

    color:

    #4FF3D6;

}


.message {

    max-width:

    350px;

    color:

    #8B92AC;

    line-height:

    1.6;

}


.date {

    color:

    #8B92AC;

    font-size:

    13px;

}


/* ================= DELETE BUTTON ================= */


.delete-btn {

    display:

    inline-block;

    padding:

    9px 14px;

    border:

    1px solid
    rgba(
        255,
        80,
        80,
        0.45
    );

    border-radius:

    8px;

    color:

    #ff8a8a;

    background:

    rgba(
        255,
        70,
        70,
        0.10
    );

    text-decoration:

    none;

    font-size:

    13px;

    font-weight:

    bold;

    transition:

    0.3s;

}


.delete-btn:hover {

    color:

    white;

    background:

    #e84d4d;

    transform:

    translateY(-2px);

}


/* ================= EMPTY ================= */


.empty {

    padding:

    70px 25px;

    text-align:

    center;

}


.empty-icon {

    font-size:

    50px;

}


.empty h3 {

    margin-top:

    15px;

    color:

    white;

}


.empty p {

    margin-top:

    8px;

    color:

    #8B92AC;

}


/* ================= MOBILE ================= */


@media (

max-width:

700px

) {


.header {

    padding:

    16px 5%;

}


.logo {

    font-size:

    19px;

}


.logout {

    padding:

    9px 13px;

    font-size:

    13px;

}


.container {

    width:

    92%;

    padding:

    40px 0;

}


.title {

    font-size:

    31px;

}


.stat-card {

    width:

    100%;

}


}


</style>

</head>


<body>


<!-- HEADER -->


<header class="header">


<h2 class="logo">


<span class="logo-icon">

⚡

</span>


Admin<span>Panel</span>


</h2>


<a
href="logout.php"
class="logout"
>

Logout →

</a>


</header>


<!-- MAIN -->


<main class="container">


<div class="top-section">


<div>


<h1 class="title">

Welcome to your

<span>

Dashboard

</span>

</h1>


<p class="subtitle">

Manage and view all contact messages
from your portfolio website.

</p>


</div>


</div>


<!-- TOTAL MESSAGES -->


<div class="stats">


<div class="stat-card">


<p class="stat-label">

TOTAL CONTACT MESSAGES

</p>


<h2 class="stat-number">

<?php

echo $totalMessages;

?>

</h2>


<p class="stat-text">

Messages received from your website

</p>


</div>


</div>


<!-- TABLE TITLE -->


<div class="table-heading">


<h2>

Recent Messages

</h2>


<span class="badge">


<?php

echo $totalMessages;

?>


Messages


</span>


</div>


<!-- TABLE -->


<div class="table-box">


<?php

if ($totalMessages > 0) {

?>


<table>


<thead>


<tr>


<th>ID</th>

<th>Name</th>

<th>Email</th>

<th>Message</th>

<th>Received</th>

<th>Action</th>


</tr>


</thead>


<tbody>


<?php

while (

$row = $result->fetch_assoc()

) {

?>


<tr>


<td class="id">

#

<?php

echo $row["id"];

?>

</td>


<td class="name">


<?php

echo htmlspecialchars(

$row["name"]

);

?>


</td>


<td>


<a
class="email"
href="mailto:<?php

echo htmlspecialchars(

$row["email"]

);

?>"
>


<?php

echo htmlspecialchars(

$row["email"]

);

?>


</a>


</td>


<td class="message">


<?php

echo htmlspecialchars(

$row["message"]

);

?>


</td>


<td class="date">


<?php

echo date(

"d M Y",

strtotime(

$row["created_at"]

)

);

?>


<br>


<?php

echo date(

"h:i A",

strtotime(

$row["created_at"]

)

);

?>


</td>


<!-- DELETE BUTTON -->


<td>


<a
href="delete.php?id=<?php

echo $row["id"];

?>"
class="delete-btn"
onclick="return confirm('Are you sure you want to delete this message?')"
>

Delete

</a>


</td>


</tr>


<?php

}

?>


</tbody>


</table>


<?php

} else {

?>


<div class="empty">


<div class="empty-icon">

📭

</div>


<h3>

No Messages Yet

</h3>


<p>

Contact form messages will appear here.

</p>


</div>


<?php

}

?>


</div>


</main>


</body>

</html>


<?php

$conn->close();

?>