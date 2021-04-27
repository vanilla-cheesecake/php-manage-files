<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student Records</title>
    <style>
        body {
            font: 15px Arial, sans-serif;
        }

        table {
            width: 700px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            text-align: center;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
        }
    </style>
</head>

<body>
    <?php
    error_reporting(0);
    // DELETE OPERATION 
    if (isset($_POST['submit'])) {
        // GET VALUE FROM CHECKBOXES
        $student = $_POST['student'];
        // ENABLE MULTIPLE CHECKBOX SELECTION
        foreach ($student as $key => $Values) {
            // READ ALL STRING IN THE FILE FROM THE TEXT DATABASE 
            $contents = file_get_contents('students.txt');
            // REPLACE SELECTED VALUES
            $contents = str_replace($Values, '', $contents);
            // SAVE REPLACED FILES
            file_put_contents('students.txt', $contents);
        }
        echo "<script>alert(\"Student(s) successfully deleted from text file storage\");</script>";
    } else {
        error_reporting(0);
    }
    ?>
    <center>
        <h3>PHP MULTIPLE DELETE SELECTION USING FILES<br />
            <span>Textfile as a record storage</span>
        </h3>
        <h1>STUDENT RECORDS</h1>
        <form action="" method="POST" name="myform">
            <table id="table">
                <tr>
                    <th>Select</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Lastname</th>
                    <th>Email</th>
                </tr>
                <?php
                // OPEN THE TEXT FILE STORAGE
                $file = fopen('students.txt', 'r');
                // GET DATA FOR EACH LINE
                while ($line = fgets($file)) {
                    // Convert line into array
                    $array = explode("|", $line);
                    // Combine each index intro array
                    $studentInfo = implode($array, "|");
                    // Convert line into array 
                    $studentInfoArray = explode("|", $studentInfo);
                    // ASSIGN VALUES TO EACH VARIABLE
                    $studentID = $studentInfoArray[0];
                    $studentName = $studentInfoArray[1];
                    $studentLastName = $studentInfoArray[2];
                    $studentEmail = $studentInfoArray[3];
                    // DISPLAY EACH STUDENT DATA INTO THE TABLE
                    echo ("<tr> <td><input type=\"checkbox\" value=\"$studentID|$studentName|$studentLastName|$studentEmail\" name=\"student[]\" class=\"select\"></td>
                        <td>" . $studentID . "</td>
                        <td>" . $studentName . "</td>
                        <td>" . $studentLastName . "</td>
                        <td>" . $studentEmail . "</td>
                        </tr>");
                }
                // CLOSE THE FILE STORAGE
                fclose($file);
                ?>
            </table>
            <br>
            <input type="submit" name="submit" value="Delete Student">
        </form>
        <br>
    </center>
    <footer style="width: auto; text-align:center;">Jhen Duenas</footer>
</body>

</html>