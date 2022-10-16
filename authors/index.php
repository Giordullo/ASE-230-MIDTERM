<?php
require "../csv_util.php";
require '../auth/auth.php';

session_start();

function getAuthors() 
{
    $authorArray = getCSVArray('../authors.csv');

    for($i=0; $i<count($authorArray); $i++)
    { 
?>
        <div  id="space" class="card mb-3 bg-dark text-light">
            <h3><?= $authorArray[$i][0] ?> <?= $authorArray[$i][1] ?></h3>
<?php
    if (is_logged())
    {
?>
            <a onclick="window.location.href='/authors/detail.php?author=<?=$i?>'" class="btn btn-primary" style="width: 15%">Details</a>
<?php
    }
?>
        </div>
<?php       
    }
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="../resources/css/index.css" />
        <title>Great Quotes</title>
    </head>
    <body>
        <div class="container">

            <div id="space" class="card mb-3 bg-dark text-light">
				<h1 class="display-4" style="text-align: center">AUTHORS</h1>
            </div>

            <?php getAuthors(); ?>
            <?php
            if (is_logged())
            {
            ?>
            <a onclick="window.location.href='create.php'" id="spacing_controls" class="btn btn-primary" style="width: 100%">Create Author</a>
            <?php
            }
            ?>
            <a onclick="window.location.href='../index.php'" id="spacing_controls" class="btn btn-primary" style="width: 100%">Back to Main Index</a>
        </div>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    </body>
</html>