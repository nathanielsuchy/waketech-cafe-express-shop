<?php
	$pageTitle = "Admin - Add Item";
	require_once('./include/config.php');
	require_once('./header.php');
?>

<?php
 if (!(isset($_SESSION["admin"]) && $_SESSION["admin"] == 1))
 {
 	 die("<h1>Request denied. User is not an administrator.</h1>");
 }

 if ($_SERVER['REQUEST_METHOD'] === 'POST')
 {
    $stmt = $conn->prepare("INSERT INTO Products (title, details, price, category, image)
    VALUES (:title, :details, :price, :category, :image)");

    $stmt->bindParam(':title', $_POST["title"]);
    $category = 1;
    switch ((int) $_POST["category"]) {
	    case 1:
		    $category = 1;
		    break;
        case 2:
		    $category = 2;
		    break;
        case 3:
		    $category = 3;
		    break;
	    default:
		    $category = 1;
		    break;
    }

    $catRef = &$category;
    $stmt->bindParam(':category', $catRef);

    $stmt->bindParam(':details', $_POST["details"]);

    $priceRef = &$_POST["price"];
    $stmt->bindParam(':price', $priceRef);

    $stmt->bindParam(':image', $_POST["image"]);

    $stmt->execute();

    header('Location: '.$baseUrl.'/products.php?id='.$_POST["category"]);
	die();
 }
?>

<div class="jumbotron">
	<h1 class="display-4"><?php echo $pageTitle; ?></h1>
    <form method="post">
        <div class="form-group">
            <strong>Title</strong><br>
            <input type="text" name="title" class="form-control" />
        </div>
        <div class="form-group">
            <strong>Details</strong><br>
            <textarea name="details" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <strong>Price</strong><br>
            <input type="number" name="price" class="form-control" step=".01" />
        </div>
        <div class="form-group">
            <strong>Category</strong><br>
            <select name="category" class="form-control">
                <option value="1" selected>Coffee Beans</option>
                <option value="2">Expresso</option>
                <option value="3">Creamers</option>
            </select>
        </div>
        <div class="form-group">
            <strong>Image URL</strong> (Enter the full URL to an image)<br>
            <input type="text" name="image" class="form-control" />
        </div>
        <input type="submit" class="btn btn-primary" />
    </form>
</div>

<?php
	require_once('./footer.php');
?>