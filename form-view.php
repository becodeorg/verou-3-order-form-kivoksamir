   
<?php // This file is mostly containing things for your view / html ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <title>OutLet</title>
</head>
<body>
<div class="container">
    <h1>Place your order</h1>

 

    <form method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo $_SESSION["email"] ?? ""; ?>"/>
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control" value="<?php echo $_SESSION["street"] ?? $_POST["street"] ?? ""; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="streetNumber">Street number:</label>
                    <input type="text" id="streetNumber" name="streetNumber" class="form-control" value="<?php echo $_SESSION["streetNumber"] ?? $_POST["streetNumber"] ?? ""; ?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control" value="<?php echo $_SESSION["city"] ?? $_POST["city"] ?? ""; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode:</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control" value="<?php echo $_SESSION["zipcode"] ?? $_POST["zipcode"] ?? ""; ?>">
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Products</legend>
            <?php foreach ($products as $i => $product): ?>
                <label>
					<?php // <?= is equal to <?php echo ?>
                    <input type="checkbox" value="1" name="products[<?php echo $i ?>]" <?php if(isset($_SESSION['products'][$i])) echo "checked='checked' "; ?>  /> <?php echo $product['name'] ?> -
                    &euro; <?= number_format($product['price'], 2) ?></label><br />
            <?php endforeach; ?>
        </fieldset>

        <button type="submit" name="submit" class="btn btn-primary">Order!</button>
    </form>

    <footer>total Price is :<?php echo $totalValue;?></footer>
</div>

<style>
    footer {
        text-align: center;
    }
</style>
</body>
</html>