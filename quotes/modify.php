<?php
require '../csv_util.php';
require '../auth/auth.php';

session_start();

if (!is_logged())
	header('Location: ../index.php');

if (isset($_POST['author']) && isset($_POST['quote']) && empty($_POST['record'])) 
{
    $authorsArray = getCSVArray('../authors.csv');
    displayHTML($_POST['quote'], $_POST['author'], $authorsArray);
}
else if (isset($_POST['record'])) 
{
    modifyRecord('../quotes.csv', $_POST['author'], $_POST['quote'], $_POST['record']);
    header("Location: /index.php");
}
?>

<?php
function displayHTML($quote, $authorIndex, $authorsArray) 
{
?>
     <!doctype html>
     <html lang="en">
     <head>
         <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
         <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
         <link rel="stylesheet" href="../resources/css/index.css" />
         <title>Great Quotes - Modify Quote</title>
     </head>
     <body>
     <div class="container text-center">
     <div  id="space" class="card mb-3 bg-dark text-light">
            <div class="container">
                <form action="modify.php" method="post">
                    <h5>Modify Quote</h5>
                    <?php echo "Author: " . $authorsArray[$_POST['author']][0] . " " . $authorsArray[$_POST['author']][1]; ?>
                    <form name="post" action="/quotes/modify.php">
                        <div class="form-group">
                            <input type="text" name="record" value="<?=$_POST['quote']?>">
                            <input type="hidden" name="author" value="<?=$_POST['author']?>" />
                            <input type="hidden" name="quote" value="<?=$_POST['quote']?>" />
                            <input type="submit" name="ModifyQuote" class="btn btn-primary" value="Modify Quote">
                        </div>
                    </form>

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
<?php
}
