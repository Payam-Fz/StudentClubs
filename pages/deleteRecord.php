<!doctype html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>DeleteRecord</title>
        <link rel="stylesheet" type="text/css" href = "../css/stylesheet.css"/>
        <script src="../js/clubs.js" type="text/javascript"></script>
    </head>
    <body>
        <form method="post">
            <fieldset>
                <legend class="FormTitle">Enter name of Club to delete</legend>
                <br/>
                <label>Club Name: </label><input type="text" name="ClubName"/>
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
                $sql = "DELETE FROM Club WHERE ClubName = :ClubName;";
                try {
                    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
                    $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmnt = $conn->prepare($sql);
                    $stmnt-> bindParam(':ClubName', $_POST['ClubName']);
                    $stmnt-> execute();
                    echo "<p class='noticeText goodText'>Data Deleted if it existed</p>";
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