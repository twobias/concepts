Concepts
========
A user-driven, collaborative concept database with tagging and the ability to create lists of the concepts.

Interface is currently in Danish only.

Dependencies not included here:
 * dbapi.php - a file that creates the database connection via $con = mysqli_connect($host, $user, $pass, $databaseName)
 * a database server that dbapi.php connects to. This project is written for use with MariaDB
  * the following sql tables:
    * concepts
    * concepttags
    * tags
    * users
    * revisions
