<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student Info</title>
    <style>
        table {
            width: 500px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            text-align: left;
            border-collapse: collapse;

        }

        th,
        td {
            padding: 10px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>

    </script>

</head>

<body>

    <script>
        function deleteRow() {
            document.querySelectorAll('#table .select:checked').forEach(e => {
                e.parentNode.parentNode.remove()
            });
        }
    </script>

    <?php
    error_reporting(0);

    if (isset($_POST['submit'])) {
        $student = $_POST['student'];
        foreach ($student as $key => $Values) {
            $contents = file_get_contents('students.txt');
            $contents = str_replace($Values, '', $contents);
            file_put_contents('students.txt', $contents);
        }
        echo "<script>alert();</script>";
    } else {
        error_reporting(0);
    }

    ?>


    <center>
        <h1>STUDENT INFORMATION</h1>
        <h3>MULTIPLE DELETE SELECTION USING FILES</h3>
        <form action="" method="POST" name="myform">
            <table id="table">
                <tr>
                    <th>Select</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
                <?php
                // OPEN FILE STORAGE
                $file = fopen('students.txt', 'r');
                // GET DATA FOR EACH LINE
                while ($line = fgets($file)) {
                    // Convert line into array
                    $array = explode("|", $line);
                    // Combine each index intro array
                    $studentInfo = implode($array, "|");
                    // Convert line into array 
                    $studentInfoArray = explode("|", $studentInfo);
                    $studentID = $studentInfoArray[0];
                    $studentName = $studentInfoArray[1];
                    $studentEmail = $studentInfoArray[2];

                    // DISPLAY EACH STUDENT DATA INTO THE TABLE
                    echo ("<tr> <td><input type=\"checkbox\" value=\"$studentID|$studentName|$studentEmail\" name=\"student[]\" class=\"select\"></td>
                        <td>" . $studentID . "</td>
                        <td>" . $studentName . "</td>
                        <td>" . $studentEmail . "</td>
                        </tr>");
                }


                // CLOSE THE FILE STORAGE
                fclose($file);
                ?>
            </table>
            <input type="submit" name="submit" value="submit">
        </form>
        <br>
    </center>
</body>

</html>