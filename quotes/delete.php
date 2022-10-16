<?php
require "../csv_util.php";
require '../auth/auth.php';

session_start();

if (!is_logged())
	header('Location: ../index.php');

if (isset($_POST['author']) && isset($_POST['quote']) && empty($_POST['confirm'])) 
{
    displayHTML($_POST['author'], $_POST['quote']);
}
else if (isset($_POST['confirm']))
{
    EmptyCSVQuote('../quotes.csv', $_POST['author'], $_POST['quote']);
    header("Location: /quotes/index.php");
}

function displayHTML($author, $quote)
{
    $authorsArray = getCSVArray('../authors.csv');
    $quotesArray = getCSVArray('../quotes.csv');

?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../resources/css/index.css" />
        <title>Great Quotes - Delete Quote</title>
    </head>
    <body>
        <div class="container text-center">
            <div  id="space" class="card mb-3 bg-dark text-light">
                <div class="container">
                    <form method="post" action="/quotes/delete.php">
                        <p><?='Author: ' . $authorsArray[$author][0]  . ' ' . $authorsArray[$author][1]?></p>
                        <h5><?=$quote?></h5>
                        <input type="hidden" value="<?=$quote?>" name="quote"/>
                        <input type="hidden" value="<?=$author?>" name="author"/>
                        <input type="hidden" value="1" name="confirm"/>
                        <button type="submit" class="btn btn-primary" name="Delete">Confirm Delete</button>
                    </form>
                    <p></p>
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
