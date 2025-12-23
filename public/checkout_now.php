<?php
header("Content-Type: application/json");

/*
  This API returns ONLY public merchant key
  Do NOT expose secret/salt here
*/

$merchantKey = "T206030"; // Merchant Code (Public)

echo json_encode([
    "status" => "success",
    "key" => $merchantKey
]);

exit;
?>