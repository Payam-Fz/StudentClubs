<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>ResultTable</title>
        <link rel="stylesheet" type="text/css" href = "../css/ViewTable.css"/>
        <script src="../js/clubs.js" type="text/javascript"></script>
    </head>
    <body>
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "StudentClubDB";

            try {
                $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
                $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo '<p class="error">Could not connect to server: '. $e->getMessage().'</p>';
            }

            if (isset($_POST['SelectAll'])) {  //select all button
                $sql = "SELECT * FROM Club;";
                try {
                    $stmnt = $conn->prepare($sql);
                    $stmnt-> execute();
                    $row = $stmnt-> fetch();
                    if ($row) {
                        echo "<table id='ViewTable'><tr><th>Club Name</th> <th>Description</th> <th>Rating</th> <th>Leader's StudentID</th></tr>";
                        while ($row) {
                            echo '<tr><td>' .$row['ClubName']. '</td><td>' .$row['Description']. '</td><td>' .$row['Rating']. '</td><td>' .$row['Leader_StudentID']. '</td></tr>';
                            $row = $stmnt-> fetch();
                        };
                        echo '</table>';
                    } else {
                        echo "<p class='noticeText badText'>Table is empty</p>";
                    }
                } catch (PDOException $e) {
                    echo "<p class='noticeText badText' id='errorMessage'></p>";
                    echo '<script type="text/javascript">
                        document.getElementById("errorMessage").innerHTML = errorMessageCreator_other("' .$e->getMessage(). '");
                        </script>';
                }
            } else if (isset($_POST['SelectName'])){    //select by name
                $sql = "SELECT * FROM Club WHERE ClubName = :ClubName;";
                try {
                    $stmnt = $conn->prepare($sql);
                    $stmnt-> bindParam(':ClubName', $_POST['ClubName']);
                    $stmnt-> execute();
                    $row = $stmnt-> fetch();
                    if ($row) {
                        echo "<table id='ViewTable'><tr><th>Club Name</th> <th>Description</th> <th>Rating</th> <th>Leader's StudentID</th></tr>";
                        echo '<tr><td>' .$row['ClubName']. '</td><td>' .$row['Description']. '</td><td>' .$row['Rating']. '</td><td>' .$row['Leader_StudentID']. '</td></tr>';
                        echo '</table>';
                    } else {
                        echo "<p class='noticeText badText'>Such club doesn't exist in database.</p>";
                    }
                } catch (PDOException $e) {
                    echo "<p class='noticeText badText' id='errorMessage'></p>";
                    echo '<script type="text/javascript">
                        document.getElementById("errorMessage").innerHTML = errorMessageCreator_other("' .$e->getMessage(). '");
                        </script>';
                }
            } else if (isset($_POST['SelectLID'])){    //select by leader ID
                $sql = "SELECT * FROM Club WHERE Leader_StudentID = :Leader_StudentID;";
                try {
                    $stmnt = $conn->prepare($sql);
                    $stmnt-> bindParam(':Leader_StudentID', $_POST['Leader_StudentID']);
                    $stmnt-> execute();
                    $row = $stmnt-> fetch();
                    if ($row) {
                        echo "<table id='ViewTable'><tr><th>Club Name</th> <th>Description</th> <th>Rating</th> <th>Leader's StudentID</th></tr>";
                        while ($row) {
                            echo '<tr><td>' .$row['ClubName']. '</td><td>' .$row['Description']. '</td><td>' .$row['Rating']. '</td><td>' .$row['Leader_StudentID']. '</td></tr>';
                            $row = $stmnt-> fetch();
                        }
                        echo '</table>';
                    } else {
                        echo "<p class='noticeText badText'>Such club doesn't exist in database.</p>";
                    }
                } catch (PDOException $e) {
                    echo "<p class='noticeText badText' id='errorMessage'></p>";
                    echo '<script type="text/javascript">
                        document.getElementById("errorMessage").innerHTML = errorMessageCreator_other("' .$e->getMessage(). '");
                        </script>';
                }
            } else if (isset($_POST['SelectRating'])){    //select by rating
                $sql = "SELECT * FROM Club WHERE Rating>=:Min_Rate AND Rating<=:Max_Rate;";
                try {
                    $stmnt = $conn->prepare($sql);
                    $stmnt-> bindParam(':Min_Rate', $_POST['Min_Rate']);
                    $stmnt-> bindParam(':Max_Rate', $_POST['Max_Rate']);
                    $stmnt-> execute();
                    $row = $stmnt-> fetch();
                    if ($row) {
                        echo "<table id='ViewTable'><tr><th>Club Name</th> <th>Description</th> <th>Rating</th> <th>Leader's StudentID</th></tr>";
                        while ($row) {
                            echo '<tr><td>' .$row['ClubName']. '</td><td>' .$row['Description']. '</td><td>' .$row['Rating']. '</td><td>' .$row['Leader_StudentID']. '</td></tr>';
                            $row = $stmnt-> fetch();
                        }
                        echo '</table>';
                    } else {
                        echo "<p class='noticeText badText'>Such club doesn't exist in database.</p>";
                    }
                } catch (PDOException $e) {
                    echo "<p class='noticeText badText' id='errorMessage'></p>";
                    echo '<script type="text/javascript">
                        document.getElementById("errorMessage").innerHTML = errorMessageCreator_other("' .$e->getMessage(). '");
                        </script>';
                }
            } else if (isset($_POST['SelectRelevance'])){    //select by relevance
                $sql = "SELECT * FROM Club WHERE Description LIKE '%" . $_POST['DescriptionWord'] . "%'";
                try {
                    $stmnt = $conn->prepare($sql);
                    $stmnt-> execute();
                    $row = $stmnt-> fetch();
                    if ($row) {
                        echo "<table id='ViewTable'><tr><th>Club Name</th> <th>Description</th> <th>Rating</th> <th>Leader's StudentID</th></tr>";
                        while ($row) {
                            echo '<tr><td>' .$row['ClubName']. '</td><td>' .$row['Description']. '</td><td>' .$row['Rating']. '</td><td>' .$row['Leader_StudentID']. '</td></tr>';
                            $row = $stmnt-> fetch();
                        }
                        echo '</table>';
                    } else {
                        echo "<p class='noticeText badText'>Such club doesn't exist in database.</p>";
                    }
                } catch (PDOException $e) {
                    echo "<p class='noticeText badText' id='errorMessage'></p>";
                    echo '<script type="text/javascript">
                        document.getElementById("errorMessage").innerHTML = errorMessageCreator_other("' .$e->getMessage(). '");
                        </script>';
                }
            }

            unset($conn);

        ?>
    </body>
</html>