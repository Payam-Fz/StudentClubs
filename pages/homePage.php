<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title>Homepage</title>
        <link rel="stylesheet" type="text/css" href = "../css/stylesheet.css"/>
        <script src="../js/clubs.js" type="text/javascript"></script>
    </head>
    <body style="background:ivory">
        <header>
            <img id="clubImage"src="../img/club.png">
            <br/>
            <br/>
            <h4>(Create, Manipulate, Drop and View table of Clubs)</h4>
        </header>
        <main>
            <fieldset>
                <legend class="FormTitle">Preparation</legend>
                <form method="post">
                    <table>
                        <tr>
                            <td class="title">Server connection: </td>
                            <td><input type="submit" name="TestServerConnection" class="button" value="Test Connection" style="width:180px"/></td>
                            <td id="server_status" class="status"></td>
                        </tr>
                        <tr>
                            <td class="title">Database: </td>
                            <td>
                                <input type="submit" name="CreateDB" class="button goodButton" value="create"/>
                                <input type="submit" name="DeleteDB" class="button badButton" value="delete"/>
                            </td>
                            <td id="database_status" class="status"></td>
                        </tr>
                        <tr>
                            <td class="title">Table: </td>
                            <td>
                                <input type="submit" name="CreateTable" class="button goodButton" value="create"/>
                                <input type="submit" name="DeleteTable" class="button badButton" value="delete"/>
                            </td>
                            <td id="table_status" class="status"></td>
                        </tr>

                    </table>
                </form>
            </fieldset>
            <fieldset>
                <legend class="FormTitle">Manipulation</legend>
                <table style="margin-left: auto; margin-right: auto;">
                    <tr>
                        <td><button class="button manipulationButton" onclick="document.location='insertRecord.php'">Insert Data</button></td>
                        <td><button class="button manipulationButton" onclick="document.location='deleteRecord.php'">Delete Data</button></td>
                        <td><button class="button manipulationButton" onclick="document.location='updateRecord.php'">Update Data</button></td>
                        <td><button class="button manipulationButton" onclick="document.location='selectRecord.html'">View Data</button></td>
                    </tr>
                </table>
            </fieldset>
        </main>
        <footer>
            <span>Copyright &copy; <script>document.write(new Date().getFullYear());</script>, Payam Forouzandeh</span>
            <span style="float:right; text-align:right;">Title image from: www.pinclipart.com</span>
        </footer>


        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "StudentClubDB";
        
        try {
            $conn = new PDO("mysql:host=$servername", $username, $password);
            $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo '<p class="error">Could not connect to server: '. $e->getMessage().'</p>';
        }
        
        if (isset($_POST['TestServerConnection'])) {  //server connection test button
            try {
                $conn = new PDO("mysql:host=$servername", $username, $password);
                $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo '<script type = "text/javascript">
                    document.getElementById("server_status").innerHTML = "Connected";
                    document.getElementById("server_status").style.color = "green";
                    </script>';
            } catch (PDOException $e) {
                echo '<script type = "text/javascript">
                    document.getElementById("server_status").innerHTML = "Disconnected";
                    document.getElementById("server_status").style.color = "red";
                    </script>';
                echo '<p class="noticeText bad">Could not connect to server: '. $e->getMessage().'</p>';
            }
        } else if (isset($_POST['CreateDB'])){  //create database button
            $sql = "CREATE DATABASE StudentClubDB;";
            $dbname = "StudentClubDB";
            try {
                $conn-> exec($sql);
                echo '<script type="text/javascript">
                    document.getElementById("database_status").innerHTML = "Database Created ";
                    document.getElementById("database_status").style.color = "green";
                    </script>';
            } catch (PDOException $e) {
                echo '<script type="text/javascript">
                    document.getElementById("database_status").innerHTML = errorMessageCreator_HomePage("' .$e->getMessage(). '");
                    document.getElementById("database_status").style.color = "red";
                    </script>';
            }
        } else if (isset($_POST['DeleteDB'])){  //delete database button
            $sql = "DROP DATABASE StudentClubDB;";
            try {
                $conn-> exec($sql);
                echo '<script type="text/javascript">
                    document.getElementById("database_status").innerHTML = " Database Deleted";
                    document.getElementById("database_status").style.color = "green";
                    </script>';
            } catch (PDOException $e) {
                echo '<script type="text/javascript">
                    document.getElementById("database_status").innerHTML = errorMessageCreator_HomePage("' .$e->getMessage(). '");
                    document.getElementById("database_status").style.color = "red";
                    </script>';
            }
        } else if (isset($_POST['CreateTable'])){  //create table button
            $sql = "CREATE TABLE ".$dbname.".Club (
                ClubName VARCHAR (10) PRIMARY KEY,
                Description VARCHAR (50),
                Rating NUMERIC (3) DEFAULT 0 CHECK (Rating>=0 AND Rating<=100),
                Leader_StudentID NUMERIC (8)
            );";  
            try {
                $conn-> exec($sql);
                echo '<script type="text/javascript">
                    document.getElementById("table_status").innerHTML = "Table Created ";
                    document.getElementById("table_status").style.color = "green";
                    </script>';
            } catch (PDOException $e) {
                echo '<script type="text/javascript">
                    document.getElementById("table_status").innerHTML = errorMessageCreator_HomePage("' .$e->getMessage(). '");
                    document.getElementById("table_status").style.color = "red";
                    </script>';
            }
        } else if (isset($_POST['DeleteTable'])){  //delete table button
            $sql = "DROP TABLE ".$dbname.".Club;";   
            try {
                $conn-> exec($sql);
                echo '<script type="text/javascript">
                    document.getElementById("table_status").innerHTML = " Table Deleted";
                    document.getElementById("table_status").style.color = "green";
                    </script>';
            } catch (PDOException $e) {
                echo '<script type="text/javascript">
                    document.getElementById("table_status").innerHTML = errorMessageCreator_HomePage("' .$e->getMessage(). '");
                    document.getElementById("table_status").style.color = "red";
                    </script>';
            }
        }

        unset($conn);

        ?>


    </body>
</html>