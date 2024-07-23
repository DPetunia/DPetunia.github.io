<!DOCTYPE html>
<html>
    <head>
        <title>MADRASAH AN-NUR - LOGIN</title>
        <link rel="stylesheet" type="text/css" href="css/styles1.css">
        <link rel="icon" href="../src/logo.png">
        <style>
            body{
                background-color: #90DCF4;
            }
            .buttondashbord:hover{
                background-color: #70aabc;
            }
            .navbar a:hover{
                background-color: #70aabc;
            }
            /* CSS styles for login table container */
            .table-login {
                margin-top: 20px; /* Adjust margin as needed */
                width: 300px; /* Set width to desired size */
                padding: 20px;
                border: 1px solid #ccc; /* Add border for visibility */
                border-radius: 8px; /* Rounded corners */
                box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Shadow for a lifted effect */
                background-color: #f9f9f9; /* Light background color */
                font-family:Calibri;
            }

            /* Center content inside the table */
            .table-login table {
                width: 100%;
                font-family:Calibri;
            }

            /* Center text within table cells */
            .table-login td {
                text-align: center;
                font-family:Calibri;
            }

            /* Style for the login button */
            .table-login .resultButton {
                padding: 10px 20px;
                background-color: #007bff;
                color: white;
                border: none;
                cursor: pointer;
                border-radius: 4px;
                font-family:Calibri;
            }

            .table-login .resultButton:hover {
                background-color: #0056b3; 
            }

            /* Style for input fields */
            .table-login input[type="text"],
            .table-login input[type="password"] {
                width: 100%;
                padding: 10px;
                margin: 5px 0;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                font-family:Calibri;
            }

            /* Style for heading */
            .table-login h1 {
                font-size: 24px;
                color: #333;
                margin-bottom: 10px;
                font-family:Comic Sans MS;
            }
    </style>
    </head>
    <body>
        <?php
            include('db/conection.php');
            include('db/addacc.php');
        ?>
        <div class="navbar">
            <img src="../src/logo.png">
            <br><br>
            <a href="../index.html" class="rightnav">HOME</a>
        </div>
        <center>
        <br><br><br><br>
        <div class="table-login">
            <form name="form" method="post" action="login.php">
                <table id="indextable">
                    <tr>
                        <td>
                            <br>
                            <center>
                                <h1>
                                    LOGIN
                                </h1>
                            </center>
                            <br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <center><input type="text" name="id" required placeholder="User ID"></center>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <center><input type="password" name="password" required placeholder="Password"></center>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <center><button type="submit" class="resultButton">LOGIN</button></center>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        </center>
    </body>
</html>