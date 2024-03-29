<?php
include_once 'config/database.php';
include_once 'objects/product.php';
include_once 'objects/category.php';

$database = new Database();
$db = $database->getConnection();
// add connection to objects
$product = new Product($db);
$category = new Category($db);
// page headers
$page_title = "Add Stock";
include_once "layout_header.php";

echo "<div class='right-button-margin'>";
  echo "<a href='index.php' class='btn btn-primary pull-right'>View Stock</a>";
echo "</div>";

?>

<?php

if ($_POST) {
  // set product property values
  $product->name=$_POST['name'];
  $product->price=$_POST['price'];
  $product->description=$_POST['description'];
  $product->category_id=$_POST['category_id'];
  // create the product
  if ($product->create()) {
    echo "<div class='alert alert-success'>Product was created.</div>";
  } else {
    echo "<div class='alert alert-danger'>Unable to create product.</div>";
  }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  <table class='table table-hover table-responsive table-bordered'>

    <tr>
      <td>Name</td>
      <td><input type='text' name='name' class='form-control' /></td>
    </tr>

    <tr>
      <td>Price</td>
      <td><input type='text' name='price' class='form-control' /></td>
    </tr>

    <tr>
      <td>Description</td>
      <td><textarea name='description' class='form-control'></textarea></td>
    </tr>

    <tr>
      <td>Category</td>
      <td>
        <?php
        // read product categories from the database
        $stmt = $category->read();
        // add in a select drop-down
        echo "<select class='form-control' name='category_id'>";
        echo "<option>Select category...</option>";

        while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)) {
          extract($row_category);
          echo "<option value='{$id}'>{$name}</option>";
        }

        echo "</select>";
        ?>
      </td>
    </tr>

    <tr>
      <td></td>
      <td>
        <button type="submit" class="btn btn-success">Create</button>
      </td>
    </tr>

  </table>
</form>
<?php

// footer
include_once "layout_footer.php";
?>
