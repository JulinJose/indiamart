<?php
header("Content-Type: application/json");

include_once __DIR__ . "/auth.php";

$user = authUser($db);
$user_id = (int)$user['id'];

if ($user_id <= 0) {
    echo json_encode(["status" => "error", "message" => "Unauthorized"]);
    exit;
}

/* -------------------------------------------------
   STEP 1: Fetch Cart Items
------------------------------------------------- */

$sql = "SELECT 
            c.id AS cart_id,
            p.id AS product_id,
            p.name,
            p.new_price,
            p.img,
            c.quantity,
            (p.new_price * c.quantity) AS subtotal,
            w.t1 AS weight_name
        FROM cart c
        JOIN products p ON c.product_id = p.id
        LEFT JOIN weight w ON p.wid = w.id
        WHERE c.user_id = $user_id";

$res = mysqli_query($db, $sql);

$cart  = [];
$total = 0;

while ($row = mysqli_fetch_assoc($res)) {

    $subtotal = (float)$row['subtotal'];
    $total += $subtotal;

    $cart[] = [
        "cart_id"    => (int)$row['cart_id'],
        "product_id" => (int)$row['product_id'],
        "name"       => $row['name'],
        "price"      => (float)$row['new_price'],
        "quantity"   => (int)$row['quantity'],
        "subtotal"   => $subtotal,
        "weight"     => $row['weight_name'] ?? null,
        "image"      => "https://design-pods.com/indiamart/admin/assets/images/products/" . $row['img']
    ];
}

if (count($cart) === 0) {
    echo json_encode([
        "status" => "success",
        "order_id" => null,
        "cart" => [],
        "total" => 0
    ]);
    exit;
}

/* -------------------------------------------------
   STEP 2: Get or Create Pending Order
------------------------------------------------- */

$order_id = null;

// Check existing pending order
$orderRes = mysqli_query(
    $db,
    "SELECT id 
     FROM orders 
     WHERE user_id = $user_id 
     AND status = 'pending_payment'
     ORDER BY id DESC 
     LIMIT 1"
);

if ($orderRes && mysqli_num_rows($orderRes) > 0) {
    $orderRow = mysqli_fetch_assoc($orderRes);
    $order_id = (int)$orderRow['id'];
} else {

    // Create new pending order
    mysqli_query($db, "
        INSERT INTO orders (
            user_id,
            total_amount,
            final_amount,
            status,
            created_at
        ) VALUES (
            $user_id,
            $total,
            $total,
            'pending_payment',
            NOW()
        )
    ");

    $order_id = mysqli_insert_id($db);
}

/* -------------------------------------------------
   STEP 3: Return Response
------------------------------------------------- */

echo json_encode([
    "status"   => "success",
    "order_id" => $order_id,
    "cart"     => $cart,
    "total"    => $total
]);

exit;
