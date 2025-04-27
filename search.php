<?php
include_once "connection.php";
require_once "includes/session_check.php";

// Require login to access search results
requireLogin();

$searchTerm = '';
$searchResults = [];
$searchPerformed = false;

// Process search parameters
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchPerformed = true;
    
    // Prepare the base query
    $sqlQuery = "SELECT * FROM properties WHERE 1=1";
    $searchParams = [];
    
    // Handle text search
    if (!empty($_POST['search'])) {
        $searchTerm = $_POST['search'];
        $sqlQuery .= " AND (property_title LIKE ? OR property_address LIKE ? OR property_details LIKE ?)";
        $searchParams[] = "%$searchTerm%";
        $searchParams[] = "%$searchTerm%";
        $searchParams[] = "%$searchTerm%";
    }
    
    // Handle delivery type filter
    if (!empty($_POST['delivery_type']) && $_POST['delivery_type'] !== 'Property Type') {
        $deliveryType = $_POST['delivery_type'];
        $sqlQuery .= " AND delivery_type = ?";
        $searchParams[] = $deliveryType;
    }
    
    // Handle price filter
    if (!empty($_POST['search_price']) && $_POST['search_price'] !== 'Price') {
        $priceFilter = $_POST['search_price'];
        
        switch($priceFilter) {
            case '1':
                $sqlQuery .= " AND price BETWEEN 5000 AND 50000";
                break;
            case '2':
                $sqlQuery .= " AND price BETWEEN 50001 AND 100000";
                break;
            case '3':
                $sqlQuery .= " AND price BETWEEN 100001 AND 200000";
                break;
            case '4':
                $sqlQuery .= " AND price > 200000";
                break;
        }
    }
    
    // Handle property type filter
    if (!empty($_POST['property_type']) && $_POST['property_type'] !== 'Property Type') {
        $propertyType = $_POST['property_type'];
        $sqlQuery .= " AND property_type = ?";
        $searchParams[] = $propertyType;
    }
    
    // Prepare and execute the statement
    $stmt = mysqli_prepare($conn, $sqlQuery);
    
    // Bind parameters if there are any
    if (!empty($searchParams)) {
        $types = str_repeat("s", count($searchParams));
        mysqli_stmt_bind_param($stmt, $types, ...$searchParams);
    }
    
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $searchResults[] = $row;
    }
    
    mysqli_stmt_close($stmt);
} else {
    // Default: Fetch all records when page first loads (GET request)
    $sqlQuery = "SELECT * FROM properties";
    $result = mysqli_query($conn, $sqlQuery);
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $searchResults[] = $row;
        }
        mysqli_free_result($result);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Search Properties - Real Estate Management System</title>
<?php include 'includes/header.php'; ?>

<div class="inside-banner">
  <div class="container">
    <h2 class="text-center">Search Properties</h2>
    <p class="text-center text-light">Find your perfect property with our advanced search tools</p>
  </div>
</div>

<div class="container">
<div class="properties-listing spacer">

<div class="row">
<div class="col-lg-3 col-sm-4 ">

  <div class="search-form"><h4><span class="glyphicon glyphicon-search"></span> Search for</h4>
  <form action="search.php" method="post" name="search">
    <input type="text" class="form-control" name="search" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Search of Properties">
    <div class="row">
      <div class="col-lg-5">
        <select name="delivery_type" class="form-control">
          <option value="">Select Type</option>
          <option value="Rent" <?php echo (isset($_POST['delivery_type']) && $_POST['delivery_type'] == 'Rent') ? 'selected' : ''; ?>>Rent</option>
          <option value="Sale" <?php echo (isset($_POST['delivery_type']) && $_POST['delivery_type'] == 'Sale') ? 'selected' : ''; ?>>Sale</option>
        </select>
      </div>
      <div class="col-lg-7">
        <select name="search_price" class="form-control">
          <option value="">Select Price Range</option>
          <option value="1" <?php echo (isset($_POST['search_price']) && $_POST['search_price'] == '1') ? 'selected' : ''; ?>>₹5,000 - ₹50,000</option>
          <option value="2" <?php echo (isset($_POST['search_price']) && $_POST['search_price'] == '2') ? 'selected' : ''; ?>>₹50,001 - ₹100,000</option>
          <option value="3" <?php echo (isset($_POST['search_price']) && $_POST['search_price'] == '3') ? 'selected' : ''; ?>>₹100,001 - ₹200,000</option>
          <option value="4" <?php echo (isset($_POST['search_price']) && $_POST['search_price'] == '4') ? 'selected' : ''; ?>>Above ₹200,000</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <select name="property_type" class="form-control">
          <option value="">Select Property Type</option>
          <option value="Apartment" <?php echo (isset($_POST['property_type']) && $_POST['property_type'] == 'Apartment') ? 'selected' : ''; ?>>Apartment</option>
          <option value="Villa" <?php echo (isset($_POST['property_type']) && $_POST['property_type'] == 'Villa') ? 'selected' : ''; ?>>Villa</option>
          <option value="House" <?php echo (isset($_POST['property_type']) && $_POST['property_type'] == 'House') ? 'selected' : ''; ?>>House</option>
          <option value="Penthouse" <?php echo (isset($_POST['property_type']) && $_POST['property_type'] == 'Penthouse') ? 'selected' : ''; ?>>Penthouse</option>
          <option value="Office" <?php echo (isset($_POST['property_type']) && $_POST['property_type'] == 'Office') ? 'selected' : ''; ?>>Office</option>
        </select>
      </div>
    </div>
    <button class="btn btn-primary">Find Now</button>
  </form>
  </div>

</div>

<div class="col-lg-9 col-sm-8">
<div class="sortby clearfix">
<div class="pull-left result">Showing: <?php echo count($searchResults); ?> result(s)</div>
</div>
<div class="row">

<?php
if (!empty($searchResults)) {
    foreach ($searchResults as $row) {
?>
     <!-- Property Card Start -->
     <div class="col-lg-4 col-sm-6">
      <div class="property-card-wrapper">
        <div class="properties fade-in">
          <div class="image-holder">
            <img src="<?php echo $row['property_img']; ?>" class="img-responsive" alt="<?php echo $row['property_title']; ?>">
          </div>
          <div class="property-info">
            <h4><a href="property-detail.php?id=<?php echo $row['property_id']; ?>"><?php echo $row['property_title']; ?></a></h4>
            <?php if(!empty($row['property_address'])): ?>
            <p class="location"><i class="fas fa-map-marker-alt"></i> <?php echo $row['property_address']; ?></p>
            <?php endif; ?>
            <p class="price"><i class="fas fa-tag"></i> ₹<?php echo number_format($row['price']); ?></p>
            <div class="listing-detail">
              <div>
                <span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room"><i class="fas fa-bed"></i></span>
                <div><?php echo $row['bed_room']; ?></div>
              </div>
              <div>
                <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room"><i class="fas fa-couch"></i></span>
                <div><?php echo $row['liv_room']; ?></div>
              </div>
              <div>
                <span data-toggle="tooltip" data-placement="bottom" data-original-title="Parking"><i class="fas fa-car"></i></span>
                <div><?php echo $row['parking']; ?></div>
              </div>
              <div>
                <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen"><i class="fas fa-utensils"></i></span>
                <div><?php echo $row['kitchen']; ?></div>
              </div>
            </div>
            <div class="btn-container">
              <a class="btn btn-primary" href="property-detail.php?id=<?php echo $row['property_id']; ?>"><i class="fas fa-info-circle"></i> View Details</a>
            </div>
          </div>
          <?php
            $propertyTypeLabel = "";
            if(stripos($row['property_title'], "apartment") !== false) {
                $propertyTypeLabel = "Apartment";
            } elseif(stripos($row['property_title'], "villa") !== false) {
                $propertyTypeLabel = "Villa";
            } elseif(stripos($row['property_title'], "house") !== false) {
                $propertyTypeLabel = "House";
            } elseif(stripos($row['property_title'], "penthouse") !== false) {
                $propertyTypeLabel = "Penthouse";
            } elseif(stripos($row['property_title'], "office") !== false) {
                $propertyTypeLabel = "Office";
            }
            
            if(!empty($propertyTypeLabel)) {
                echo '<div class="property-label">' . $propertyTypeLabel . '</div>';
            }
          ?>
        </div>
      </div>
    </div>
    <!-- Property Card End -->
<?php
    }
} else {
?>
    <div class="col-lg-12">
        <div class="alert alert-info">
            No properties found matching your search criteria. Please try different keywords or filters.
        </div>
    </div>
<?php
}
?>

</div><!-- End of property row -->
</div><!-- End of col-lg-9 -->
</div><!-- End of row -->
</div>
</div>
</div>

<?php include 'includes/footer.php'; ?>

<?php include 'includes/login-modal.php'; ?>

<!-- Enable tooltips -->
<script>
$(document).ready(function(){
  // Enable tooltips for property feature icons
  $('[data-toggle="tooltip"]').tooltip();
});
</script>

</body>
</html>
