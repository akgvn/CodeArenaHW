<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    </meta>
    <title>Register to Çankaya Code Arena</title>
</head>
<script language="javascript">
    function validate() {
        var str_pass = document.getElementById("pass").value;

        var atLeastOneNum = false;
        var atLeastOneUp = false;
        var atLeastOneLow = false;

        for (var i = 0; i < str_pass.length; i++) {
            /*
             * Ensure that the user has entered a value with 
             * at least one capital letter and one digit. 
             * Number of characters are also checked.
             */
            c = str_pass.charAt(i);

            if (c >= 0 && c <= 9) {
                // c is numeric.
                atLeastOneNum = true;
            }
            else {
                // Test for case only if the c isn't numeric.
                if (c == c.toUpperCase()) {
                    // c is upper case
                    atLeastOneUp = true;
                }
                if (c == c.toLowerCase()) {
                    // c is lower case
                    atLeastOneLow = true;
                }
            }
        }

        if (atLeastOneNum && atLeastOneUp && atLeastOneLow) {
            alert("Successful.");
            return true;
        } else {
            alert("Password needs at least one upper case letter and at least one number.");
            return false;
        }

    }
</script>

<body>
    <form action="register.php" method="post" onsubmit="return validate();">
        <fieldset>
            <legend>Your Details:</legend>
            <label>e-Mail: <input type="text" id="mail" name="mail" size="30" maxlength="100"></label><br /><br>
            <label>Username: <input type="text" id="user" name="user" size="30" maxlength="100"></label><br /><br>
            <label>Password:&nbsp&nbsp<input type="password" id="pass" name="pass" size="30"
                    maxlength="100"></label><br />
        </fieldset><br />
        <fieldset>
            <legend>Additional Information:</legend>
            <label> Your favorite programming language?
                <select name="proglangs">
                    <option value="cpp">C++</option>
                    <option value="java">Java</option>
                    <option value="cs">C#</option>
                    <option value="python">Python</option>
                    <option value="php">Php</option>
                </select>
            </label> <br> <br>
            <label> Favorite IDE? <br>
                <input type="radio" name="favide" value="devcpp"><label for="devcpp"> Dev-C++</label>
                <input type="radio" name="favide" value="eclipse"><label for="eclipse"> Eclipse</label>
                <input type="radio" name="favide" value="vim"><label for="vim"> Vim</label>
                <input type="radio" name="favide" value="visual_studio"><label for="visual_studio"> Visual Studio</label>
            </label>
        </fieldset>

        <input type="submit" value="Submit" />
    </form>
</body>

<?php

    if (array_key_exists("user", $_POST) && array_key_exists("favide", $_POST)) {
        echo "<br>";
        echo "Username: {$_POST["user"]}";
        echo "<br>";
        echo "Fav ide: {$_POST["favide"]}";

        require "db_connect.php";

        $query_str = "INSERT INTO users (username, password, email, favourite_ide, favourite_pl) VALUES ('" . $_POST["user"] . "','" . $_POST["pass"] . "','" . $_POST["mail"] . "','" . $_POST["favide"] . "','" . $_POST["proglangs"] . "')";
        
        if (mysqli_query($db, $query_str)) {
            echo "Registered new user.";
            header( 'Location: login.php' );
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($db);
        }
        
        mysqli_close($db);
    }

?>

</html>