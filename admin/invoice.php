<?php
include "connection.php";

$order_id = $_GET['order_id'] ?? 0;

if ($order_id == 0) {
    die("Invalid Order ID");
}

// fetch order details
$order_sql = "SELECT o.id, o.created_at, o.status, o.discount, 
                     u.name as customer_name, u.email, u.phone, u.address
              FROM orders o 
              JOIN users u ON o.user_id = u.id 
              WHERE o.id = $order_id";
$order_res = mysqli_query($db, $order_sql);
$order = mysqli_fetch_assoc($order_res);

// fetch order items
$item_sql = "SELECT oi.quantity, oi.price,
                    p.name as product_name, 
                    c.name as category_name
             FROM order_items oi
             JOIN products p ON oi.product_id = p.id
             JOIN category c ON p.cid = c.id
             WHERE oi.order_id = $order_id";
$item_res = mysqli_query($db, $item_sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Invoice #<?php echo $order_id; ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; font-size: 14px; }
        .header { display: flex; justify-content: space-between; align-items: center; }
        .company { text-align: left; }
        .invoice-title { font-size: 22px; font-weight: bold; }
        .details { margin-top: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #d8eff7ff; }
        .right { text-align: right; }
        .total-row td { font-weight: bold; }
    </style>
</head>
<body>
<div class="invoice-box">

    <div class="header">
        <div class="company">
            <h2>My Company Pvt Ltd</h2>
            <p>123 Business Street, Kochi, Kerala</p>
            <p>Email: info@mycompany.com | Phone: +91 9876543210</p>
        </div>
        <div>
            <h3 class="invoice-title">TAX INVOICE</h3>
            <p><strong>Invoice No:</strong> INV-<?php echo $order_id; ?></p>
            <p><strong>Date:</strong> <?php echo date("d/m/Y", strtotime($order['created_at'])); ?></p>
        </div>
    </div>

    <div class="details">
        <p><strong>Bill To:</strong> <?php echo $order['customer_name']; ?>, <?php echo $order['address']; ?> <br>
        Phone: <?php echo $order['phone']; ?>, Email: <?php echo $order['email']; ?></p>

        <p><strong>Ship To:</strong> <?php echo $order['customer_name']; ?>, <?php echo $order['address']; ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Category</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <!-- <th></th> -->
                <!-- <th>Tax</th> -->
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $total = 0; $i = 1; $totalTax = 0;
            while ($row = mysqli_fetch_assoc($item_res)) { 
                $subtotal = ($row['price'] * $row['quantity']);
                $tax = $row['tax'] ?? 0;
                $amount = $subtotal + $tax;

                $total += $subtotal;
                $totalTax += $tax;
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row['category_name']; ?></td>
                <td><?php echo $row['product_name']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
               
                <td class="right"><?php echo number_format($row['price'], 2); ?></td>
                <!-- <td class="right"><?php echo number_format($tax, 2); ?></td> -->
                
                <td class="right"><?php echo number_format($amount, 2); ?></td>
            </tr>
            <?php } ?>

            <tr class="total-row">
                <td colspan="5" class="right">Subtotal</td>
                <td class="right"><?php echo number_format($total, 2); ?></td>
            </tr>
            <!-- <tr class="total-row">
                <td colspan="6" class="right">Total Tax</td>
                <td class="right"><?php echo number_format($totalTax, 2); ?></td>
            </tr> -->
            <tr class="total-row">
                <td colspan="5" class="right">Discount</td>
                <td class="right">-<?php echo number_format($order['discount'], 2); ?></td>
            </tr>
            <tr class="total-row">
                <td colspan="5" class="right">Grand Total</td>
                <td class="right">
                    <?php echo number_format(($total + $totalTax - $order['discount']), 2); ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</body>
</html>
