<?php
	$pageTitle = "Admin - Edit Item";
	require_once('./include/config.php');
	require_once('./header.php');
?>

<?php
 if (!(isset($_SESSION["admin"]) && $_SESSION["admin"] == 1))
 {
 	 die("<h1>Request denied. User is not an administrator.</h1>");
 }

  if ($_SERVER['REQUEST_METHOD'] === 'GET')
  {
    $stmt = $conn->prepare("SELECT * FROM Products WHERE id=:productId LIMIT 1");
	$stmt->bindParam(':productId', $_GET["id"]);
    $stmt->execute();
	$result = $stmt->fetchAll()[0];
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST')
 {
    $stmt = $conn->prepare("UPDATE Products SET title=:title, details=:details, price=:price, category=:category, image=:image WHERE id=:productId");

    $stmt->bindParam(':productId', $_POST["productId"]);

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

    header('Location: '.$baseUrl.'/product.php?id='.$_POST["category"]);
	die();
 }

?>

<div class="jumbotron">
	<h1 class="display-4"><?php echo $pageTitle; ?></h1>
    <form method="post">
        <div class="form-group">
            <strong>Title</strong><br>
            <input type="text" name="title" value="<?php echo htmlspecialchars($result["title"]); ?>" class="form-control" />
        </div>
        <div class="form-group">
            <strong>Details</strong><br>
            <textarea name="details" class="form-control"><?php echo htmlspecialchars($result["details"]); ?></textarea>
        </div>
        <div class="form-group">
            <strong>Price</strong><br>
            <input type="number" name="price" class="form-control" value="<?php echo htmlspecialchars($result["price"]); ?>" step=".01" />
        </div>
        <div class="form-group">
            <strong>Category</strong><br>
            <select name="category" class="form-control">
                <option value="1" <?php if($result["category"] == 1){echo "selected"; } ?>>Coffee Beans</option>
                <option value="2" <?php if($result["category"] == 2){echo "selected"; } ?>>Expresso</option>
                <option value="3" <?php if($result["category"] == 3){echo "selected"; } ?>>Creamers</option>
            </select>
        </div>
        <div class="form-group">
            <strong>Image URL</strong> (Enter the full URL to an image)<br>
            <input type="text" name="image" value="<?php echo htmlspecialchars($result["image"]); ?>" class="form-control" />
        </div>
        <input type="hidden" name="productId" value="<?php echo htmlspecialchars($_GET['id']); ?>">
        <input type="submit" class="btn btn-primary" />
    </form>
</div>

<?php
	require_once('./footer.php');
?>