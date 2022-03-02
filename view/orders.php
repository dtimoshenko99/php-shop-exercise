<?php
    session_start();
    //get id with GET and delete first occurence in session array        
    if(isset($_GET["delete"]))
    {
        foreach($_SESSION["cart"] as $keys => $values){
            if($values["id"] == $_GET["id"]){
                unset($_SESSION["cart"][$keys]);
                break;
            }
        }
        
    }

    if(empty($_SESSION["cart"])){
        header("Location: menu.php");
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
    <title>Orders</title>
</head>

<body>
    <a href="menu.php" type="button" class="btn btn-primary">Back</a>
    <div style=""></div>
    <br />
    <h3>Order Details</h3>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th id="center" width="10%">Item Name</th>
                <th id="center" width="10%">Price</th>
                <th id="center" width="5%">Delete</th>

            </tr>
            <?php

    if(!empty($_SESSION["cart"])){
        //initiate total var for bill
        $total = 0;
        //populate table with data from session variable
        foreach($_SESSION["cart"] as $keys => $values){
?>
            <tr>
                <td id="center"><?php echo $values["name"]; ?></td>
                <td id="center">£ <?php echo $values["price"]; ?></td>
                <td id="center"><a href="orders.php?delete&id=<?php echo $values["id"]; ?>"><span
                            class="btn btn-danger">Remove</span></a></td>
            </tr>
            <?php
            $total += $values["price"];
        }
?>

            <tr>
                <td align="right">Total</td>
                <td align="right">£ <?php echo number_format($total, 2); ?></td>
                <td></td>
            </tr>
            <?php
}
?>

        </table>
    </div>
    </div>
</body>

</html>