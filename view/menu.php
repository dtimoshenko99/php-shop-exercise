<?php
    session_start();
    //initialize variable
    if(empty($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }

//add item data into session variable
if(isset($_POST["add_item"])){
    if(isset($_SESSION["cart"]))
    {
        $count = count($_SESSION["cart"]);
        $items = array(
            'id' => $_GET["id"],
            'name' => $_POST["i_name"],
            'price' => $_POST["i_price"]
        );
        $_SESSION["cart"][$count] = $items;
    } else
    {

        //add data into array
        $items = array(
            'id' => $_GET["id"],
            'name' => $_POST["name"],
            'price' => $_POST["price"]
        );
        //insert data stored in array into session variable
        $_SESSION["cart"][0] = $items;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>Menu</title>
</head>

<body>

    <?php 

//get data from json file
$jsonfile = file_get_contents("../drinks.json");
$data = json_decode($jsonfile, true);
$drinks = $data['drinks'];

?>

    <div class="container">
        <div class="row">
            <h1 id="menu_title">Menu</h1>
        </div>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4" id="cart">
                <a href="orders.php" id="cart_text">
                    <h5>
                        Cart
                        <?php
                    if(isset($_SESSION['cart'])){
                        $count = count($_SESSION['cart']);
                        echo "<span id=\"cart_count\">$count</span>";
                    } else {
                        echo "<span id=\"cart_count\">0</span>";
                    }
                    ?>
                    </h5>
                </a>
            </div>

            <?php
for ($i = 0; $i < sizeof($drinks); $i++) {
    ?>
            <div class="col-sm-4">
                <form method="post" action="menu.php?action=add&id=<?php echo $drinks[$i][id]; ?>">
                    <div class="card">
                        <div class="card-header">
                            <?php echo $drinks[$i][name]; ?>
                            <input type="hidden" name="i_name" value="<?php echo $drinks[$i][name]; ?>" />
                        </div>
                        <div class="card-body">
                            <img class="card-image" src="<?php echo $drinks[$i][image]; ?>">
                            <br />
                            <?php echo $drinks[$i][description]; ?>
                            <br />
                            <br />
                        </div>
                        <div class="card-footer">
                            <p>Price: £<?php echo $drinks[$i][price]; ?></p>
                            <input type="hidden" name="i_price" value="<?php echo $drinks[$i][price]; ?>" />
                            <input type="submit" class="btn btn-success" name="add_item" value="Add to cart" />
                        </div>
                    </div>
                </form>
            </div>
            <?php
}
            ?>
        </div>
    </div>
</body>

</html>