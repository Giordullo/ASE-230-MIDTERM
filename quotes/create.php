<?php
require '../csv_util.php';
require '../auth/auth.php';

session_start();

if (!is_logged())
	header('Location: ../index.php');

$authorsArray = getCSVArray('../authors.csv');

if (isset($_POST['author']) && isset($_POST['record'])) 
{
    addCSVRecord('../quotes.csv', $_POST['author'],  $_POST['record']);
    header("Location: /quotes/index.php");
}

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../resources/css/index.css" />
        <title>Great Quotes - Create Quote</title>
    </head>
    <body>
        <div class="container text-center">
            <div  id="space" class="card mb-3 bg-dark text-light">
                <div class="container">
                <form action="/quotes/create.php" method="post">
                    <h5>Select Author</h5>
                    <div class="form-group">
                        <select class="form-control" name="author">
                            <?php
                            for($i=0; $i<count($authorsArray); $i++) 
                            {
                            ?>
                                <option value="<?php echo $i;?>"><?php echo $authorsArray[$i][0] . ' ' . $authorsArray[$i][1];?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="record">
                        <button class="btn btn-primary" type="submit">Submit Quote</button>
                    </div>
                </form>
                <a onclick="window.location.href='/quotes/index.php'" id="spacing_controls" class="btn btn-primary" style="width: 100%">Back to index</a>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>