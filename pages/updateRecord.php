<!doctype html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>UpdateRecord</title>
        <link rel="stylesheet" type="text/css" href = "../css/stylesheet.css"/>
        <script src="../js/clubs.js" type="text/javascript"></script>
    </head>
    <body>
        <form method="post">
            <fieldset>
                <legend class="FormTitle">Enter information of a Club</legend>
                <table>
                    <tr>
                        <td class="form">Name of the Club to be updated: </td>
                        <td><input type="text" name="ClubName"/></td>
                    </tr>
                    <tr>
                        <td class="form">Description: <br/>(max 50 character)</td>
                        <td><input type="text" name="Description"/></td>
                    </tr>
                    <tr>
                        <td class="form">Rating: <br/>(0 - 100)</td>
                        <td><input type="range" name="Rating" min="0" max="100" value="0"/></td>
                    </tr>
                    <tr>
                        <td class="form">Leader's StudentID: <br/>(8 digit)</td>
                        <td><input type="number" name="Leader_StudentID" value="0"/></td>
                    </tr>
                </table>

                <br/>
                <br/>
                <input type="submit" name="Submit" class="button"/><a class="button" href="../index.html">Homepage</a>
            </fieldset>

        </form>
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "StudentClubDB";

            if (isset($_POST['Submit'])) {  //submit button
                $sql = "SELECT * FROM Club WHERE ClubName = :ClubName;
                    UPDATE Club SET Description = :Description, Rating = :Rating, Leader_StudentID = :Leader_StudentID WHERE ClubName = :ClubName;";
                try {
                    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
                    $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmnt = $conn->prepare($sql);
                    $stmnt-> bindParam(':ClubName', $_POST['ClubName']);
                    $stmnt-> bindParam(':Description', $_POST['Description']);
                    $stmnt-> bindParam(':Rating', $_POST['Rating']);
                    $stmnt-> bindParam(':Leader_StudentID', $_POST['Leader_StudentID']);
                    $stmnt-> execute();
                    echo "<br/><p class='noticeText goodText'>Data Updated if it existed</p>";
                } catch (PDOException $e) {
                    echo "<p class='noticeText badText' id='errorMessage'></p>";
                    echo '<script type="text/javascript">
                        document.getElementById("errorMessage").innerHTML = errorMessageCreator_other("' .$e->getMessage(). '");
                        </script>';
                }
                unset($conn);
            }
            
        ?>

    </body>
</html>