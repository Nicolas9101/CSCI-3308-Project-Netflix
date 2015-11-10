<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="stylesheets/results.css" type="text/css" />
</head>
<body>
<?php
$host = "127.0.0.1";
$user = "root";                    
$pass = "";                                 
$db = "Netflix"; 

$aGenre = $_POST['genre'];
if(empty($aGenre))
{
     echo("You didn't select any genres.");
}
else
{
     $N = count($aGenre);
     
#     echo("You selected $N genres(s): ");
#     for($i=0; $i < $N; $i++)
#     {
#          echo($aGenre[$i] . " ");
#     }
}

//title trailer poster rating description
$conn = mysqli_connect($host, $user, $pass, $db) or die(mysql_error());

for($i=0; $i < $N; $i++)
{
     $sql = "SELECT filmID FROM films_genres WHERE genreID=$aGenre[$i]";
     $result = mysqli_query($conn, $sql);
     $num_films = $result->num_rows;
     $index = rand(0, $num_films-1);
     mysqli_data_seek($result, $index);
     $row = mysqli_fetch_assoc($result);
     $filmID = $row['filmID'];
     
     $sql = "SELECT name from genres WHERE genreID=$aGenre[$i]";
     $genre_name = mysqli_fetch_array(mysqli_query($conn, $sql));
     $genre = $genre_name[0];
     
     $sql = "SELECT * from films WHERE filmID=$filmID";
     $film_details = mysqli_query($conn, $sql);
     mysqli_data_seek($film_details, 0);
     $row = mysqli_fetch_assoc($film_details);
     $trailer = $row['trailer'];
     $poster = $row['poster'];
     $rating = $row['rating'];
     $description = $row['description'];
?>
     

    <h1><?php echo $genre ?></h1>
    <p><?php echo $trailer?></p>
    <p><?php echo $poster?></p>
    <p><?php echo $rating?></p>
    <p><?php echo $description?></p>


<?php
}
?>
</body>
</html>
