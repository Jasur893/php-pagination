<?php
include "script.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>php and mysql pagination</title>
</head>

<?php
if(isset($_GET['page-nr'])){
    $id = $_GET['page-nr'];
} else {
    $id = 1;
}

?>

<body id="<?php echo $id ?>">

    <!-- Displaying the rows   -->
    <div class="content">
    <?php
        while($row = $result->fetch_assoc()){
            ?>
                <p>
                    <?php echo $row['id'] ?> - <?php echo $row['product_name'] ?>
                </p>
            <?php
        }
    ?>
    </div>

    <!-- Displaying the page info text   -->
    <?php
        if(!isset($_GET['page-nr'])){
            $page = 1;

        } else{
            $page = $_GET['page-nr'];
        }
    ?>

    <div class="page-info">
        Showing <?php echo $page ?> of <?php echo $pages ?> pages
    </div>

    <!-- Displaying the pagination buttons   -->
    <div class="pagination">
        <!-- Go to the first page  -->
        <a href="?page-nr=1">First</a>

        <!--  Go to the previous page      -->
        <?php
        if(isset($_GET['page-nr']) && $_GET['page-nr'] > 1){
        ?>
            <a href="?page-nr=<?php echo $_GET['page-nr'] - 1 ?>">Previous</a>
        <?php
        } else {
            ?>
            <a href="">Previous</a>
            <?php
        }
        ?>

        <!--  Output the page numbers      -->
        <div class="page-numbers">
            <?php
                for($counter = 1; $counter <= $pages; $counter++){
                    ?>
                    <a href="?page-nr=<?php echo $counter ?>"><?php echo $counter ?></a>
                    <?php
                }
            ?>
        </div>

        <!-- Go to the next page       -->
        <?php
            if(!isset($_GET['page-nr'])){
                ?>
                    <a href="?page-nr=2">Next</a>
                <?php
            } else{
                if($_GET['page-nr'] >= $pages){
                ?>
                    <a href="">Next</a>
                <?php
                } else {
                    ?>
                    <a href="?page-nr=<?php echo $_GET['page-nr'] + 1 ?>">Next</a>
                    <?php
                }
            }
        ?>


        <!--  Go to the last page      -->
        <a href="?page-nr=<?php echo $pages ?>">Last</a>

    </div>

    <script>
        let links = document.querySelectorAll('.page-numbers > a');
        let bodyId = parseInt(document.body.id) - 1;
        links[bodyId].classList.add("active");

    </script>

</body>
</html>
