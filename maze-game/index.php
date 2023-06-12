<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location:login_register.php');
}
include 'config.php';

?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="UTF-8" />
    <title>Canvas Maze Game</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <section>
        <div id="wrapper" style="margin-left:auto; margin-right:auto;">
            <h1 id="heading" style="background-color: #a59e9a; text-decoration-style: solid; color: #F8F8F8; width: 40%; margin-top: 0px; margin-bottom: 10px">
                Lost Path</h1>
            <div id="maze">
                <p style="text-align: center;margin-bottom: 10px">Find the way out of Maze in 30 seconds!</p>

                <div id="c" style="margin-left:auto; margin-right:auto;margin-bottom: 10px;text-align: center;width: 10%;font-size: large">
                </div>

                <canvas id="canvas" width="523" height="523" style="margin-left:auto; margin-right:auto">
                    This text is displayed if your browser does not support HTML5 Canvas.
                </canvas>
                <div id="timerel" style="margin-left:auto; margin-right:auto;margin-top:0px;text-align: center;width: 15%;font-size: large"></div>

            </div>
            <?php
            if (isset($_POST['submitmv'])) {
                $moves = $_POST['moves'];
                $id = $_SESSION['id'];
                $time = $_POST['timesave'];
                if ($moves == 0) {
                    echo "<script>alert('You have not played the game yet!')</script>";
                } elseif ($time == 30) {
                }else {
                    $query = "INSERT INTO `score`(`user_id`, `moves`,`time`) VALUES ('$id','$moves','$time')";
                    $result = mysqli_query($conn, $query);
                    if ($result) {
                        echo "<script>alert('Your moves have been saved!')</script>";
                    }
                }
                $_POST['submitmv'] = null;
                $_POST['moves'] = 0;
                $_POST['timesave'] = 0;
            }
            ?>
            <!-- The Modal -->
            <div id="myModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="close">&times;</span>
                        <h2 class="gamehead"></h2>
                    </div>
                    <div class="modal-footer">
                        <h2 id="demo" onmouseover="" style="cursor:pointer;">Play Again?</h2>
                        <!-- Submit move button -->
                        <form action="index.php" method="post">
                            <input type="hidden" id="movesInput" name="moves" value="">
                            <input type="hidden" id="timesave" name="timesave" value="">
                            <p class="submit"></p>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!--canvas id="c" width="2048" height="2048" style="margin-left:auto; margin-right:auto"></canvas-->
        <!-- logout -->
        <div style="text-align: center;margin-bottom: 10px;">
            <a href="logout.php" style="text-decoration: none; color: black">Logout</a>
        </div>
        <!-- Leaderboard section -->
        <!-- Based on the number of moves -->
        
<!-- CREATE VIEW
    leaderboard AS
        SELECT
            maze_user.username,
            score.moves,
            score.time
        FROM
            maze_user
        INNER JOIN score ON score.user_id = maze_user.id
        ORDER BY
            score.moves ASC,
            score.time ASC; -->

        <div style="text-align: center;margin-bottom: 10px;">
            <h2>Leaderboard</h2>
            <table style="margin-left:auto; margin-right:auto">
                <tr>
                    <th>Username</th>
                    <th>Moves</th>
                    <th>Time</th>
                </tr>
                <?php
                $query = "SELECT * FROM leaderboard";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['moves'] . "</td>";
                    echo "<td>" . $row['time'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
        <script type="text/javascript" src="script.js"></script>

    </section>
</body>

</html>