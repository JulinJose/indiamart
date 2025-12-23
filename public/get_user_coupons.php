<?php
// Set the content type to JSON since this API returns JSON responses
header("Content-Type: application/json");

// Include authentication file to verify the logged-in user
include "auth.php"; 

// Authenticate user and get user details
$user = authUser($db);
$user_id = $user['id'] ?? 0; // Extract the logged-in user's ID (if not found, default to 0)

// If no valid user is authenticated, block access
if ($user_id <= 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Unauthorized"
    ]);
    exit; // Stop script execution if user is not authorized
}

// SQL query to fetch all **active and valid coupons**
// - status = 1 → active coupons only
// - expiry_date IS NULL → coupon has no expiry date
// - expiry_date >= NOW() → coupon is still valid
// Results are ordered by latest coupons first
$sql = "
    SELECT id, code, discount_type, discount_value, expiry_date, created_at
    FROM coupons
    WHERE status = 'active'
      AND (expiry_date IS NULL OR expiry_date >= CURDATE())
      AND (
            restricted_to_user_id IS NULL
            OR restricted_to_user_id = $user_id
          )
    ORDER BY id DESC
";


// Execute the query
$res = mysqli_query($db, $sql);

// If query execution fails, return an error response
if (!$res) {
    echo json_encode([
        "status" => "error",
        "message" => "Database query failed"
    ]);
    exit;
}

// Initialize an empty array to store all fetched coupons
$coupons = [];

// Loop through each row (coupon) from the result
while ($row = mysqli_fetch_assoc($res)) {
    // Format each coupon's data into a clean array
    $coupons[] = [
        "id"              => (int)$row['id'],               // Unique coupon ID
        "code"            => $row['code'],                  // Coupon code (e.g., SAVE10)
        // "description"   => $row['description'],           // Uncomment if you store coupon descriptions
        "discount_type"   => $row['discount_type'],          // Type of discount: percentage or fixed
        "discount_value"  => (float)$row['discount_value'],  // Value of the discount (e.g., 10%)
        "expiry_date"     => $row['expiry_date'],            // Coupon expiration date
        "created_at"      => $row['created_at']              // When the coupon was created
    ];
}

// Prepare and send the final JSON response
// Includes the logged-in user's ID, total coupons, and list of coupons
echo json_encode([
    "status" => "success",
    "user_id" => $user_id,
    "total_coupons" => count($coupons), // Count of coupons found
    "coupons" => $coupons               // Actual coupon data
]);

exit; // End the script
?>
