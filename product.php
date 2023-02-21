<?php include_once('./private/initialize.php'); ?>
<?php


use MyApp\classes\Book;
use MyApp\classes\DVD;
use MyApp\classes\Furniture;

$errors = validate_inputs();

if(isset($_POST['submit']) && empty($errors)){
  $result = '';
  $args = [];
  $args['sku'] = $_POST['sku'] ?? NULL;
  $args['name'] = $_POST['name'] ?? NULL;
  $args['price'] = $_POST['price'] ?? NULL;
  $args['weight_kg'] = $_POST['weight_kg'] ?? NULL;
  $args['size'] = $_POST['size'] ?? NULL;
  $args['width'] = $_POST['width'] ?? NULL;
  $args['length'] = $_POST['length'] ?? NULL;
  $args['height'] = $_POST['height'] ?? NULL;

  if ($_POST['weight_kg'] != NULL) {
    $book = new Book($args);
    $result = $book->save();
    
  }

  if ($_POST['size'] != NULL) {
    $dvd = new DVD($args);
    $result = $dvd->save();
  }

  if ($_POST['width'] != NULL && $_POST['length'] != NULL && $_POST['height'] != NULL) {
    $furniture = new Furniture($args);
    $result = $furniture->save(); 
  }

  if ($result === true) {
    header('Location: index.php');
    exit;
  } else {
  
  }
}

?>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Miki Arsov">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Product App - Miki</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css" />

        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
    </head>
<!-- Have different page title for each page -->
<?php $page_title = 'Product Add'; ?>
<body>
  <header>
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="product.php">ADD PRODUCT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">PRODUCT LIST</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://careers.scandiweb.com/jobs/2124223-web-developer">ABOUT</a>
                    </li>
                </ul>
            </div>
        </nav>
  </header>
  <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 padding">
                        <form action="" method="POST" id="product_form" enctype="multipart/form-data">
                                      <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h1 style="float:left;padding:5px;">Add Product</h1>
                        <div style="float:right; padding:15px;">
                         <button type="submit" name="submit" id="submit" class="btn btn-space btn-primary">Save</button>
                         <button type="reset" onclick="history.back()" class="btn btn-space btn-secondary">Cancel</button>
                        </div>
                    </div>
                </div>
                <hr style="height: 1px;color: black;background-color: black;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <label for="sku">SKU</label>
                                        <input type="text" class="form-control" id="sku" value="<?= $_POST['sku'] ?? '';  ?>" name="sku" placeholder="Please, submit required data." required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" value="<?= $_POST['name'] ?? '';  ?>" name="name" placeholder="Please, submit required data." required>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 ">
                                        <label for="price">Price ($)</label>
                                        <input type="number" class="form-control" id="price" value="<?= $_POST['price'] ?? '';  ?>" name="price" placeholder="Please, submit required data." required >
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 ">
                                        <label for="productType">Type Switcher</label>
                                        <select id='productType' name="typeSwitcher" class="form-control" placeholder="Choose type of Product">
                                            <option value="dvd" id='DVD' <?= get_selected_type('dvd'); ?>>DVD</option>
                                            <option value="book" id='Book' <?= get_selected_type('book'); ?>>Book </option>
                                            <option value="furniture" id='Furniture' <?= get_selected_type('furniture'); ?>>Furniture</option>
                                        </select>
                                        <br>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 ">
                                        <div id="size-container">
                                            <div class="form-group">
                                                <label class="control-label" for="size">Size:</label>
                                                <input class="form-control" id="size" name="size" type="text"  value="<?= $_POST['size'] ?? ''; ?>" placeholder="Please, provide size">
                                                <p>“Please provide size in MB format”, when type: DVD is selected.</p>
                                            </div>
                                        </div>
                                        <div id="weight-container">
                                            <div class="form-group">
                                            <label class="control-label" for="weight">Weight</label>
                                                <input class="form-control" id="weight" name="weight_kg"  value="<?= $_POST['weight_kg'] ?? ''; ?>"  type="text" placeholder="Please, provide weight">
                                                <p>“Please provide size in KG format”, when type: BOOK is selected.</p>
                                            </div>
                                        </div>
                                        <div id="dimensions-container">
                                        <label for="height">Height (CM)</label>
                                        <input type="text" name='height' id='height' placeholder='0' maxlength='5' value="<?= $_POST['height'] ?? ''; ?>">
                                        <label for="width">Width (CM)</label>
                                        <input type="text" name='width' id='width' placeholder='0' maxlength='5' value="<?= $_POST['width'] ?? ''; ?>">
                                        <label for="length">Length (CM)</label>
                                        <input type="text" name='length' id='length' placeholder='0' maxlength='5' value="<?= $_POST['length'] ?? ''; ?>">
                                            <p>“Please provide dimensions in HxWxL format”, when type: Furniture is selected.</p>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </form>
                        <div class="col-lg-6 col-md-12 col-sm-12 ">
                        <?= $errors ;?>
                        </div>
                </div>
            </div>
        </div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"
  integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
  crossorigin="anonymous"></script>
<script src='./script.js'></script>
</body>
</html>