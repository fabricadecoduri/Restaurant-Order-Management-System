<?php 
if (!$conn) {
    die("Conexiune eșuată: " . mysqli_connect_error());
}

$itemModalSql = "SELECT * FROM `orders`";
$itemModalResult = mysqli_query($conn, $itemModalSql);

if ($itemModalResult && mysqli_num_rows($itemModalResult) > 0) {
    while ($itemModalRow = mysqli_fetch_assoc($itemModalResult)) {
        $orderid = $itemModalRow['orderId'] ?? 0;
        $userid = $itemModalRow['userId'] ?? '';
        $orderStatus = $itemModalRow['orderStatus'] ?? 0;
?>
<!-- Modal -->
<div class="modal fade" id="orderStatus<?php echo htmlspecialchars($orderid); ?>" tabindex="-1" role="dialog" aria-labelledby="orderStatus<?php echo htmlspecialchars($orderid); ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(111 202 203);">
        <h5 class="modal-title" id="orderStatus<?php echo htmlspecialchars($orderid); ?>">Order Status and Delivery Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="partials/_orderManage.php" method="post" style="border-bottom: 2px solid #dee2e6;">
            <div class="text-left my-2">    
                <b><label for="name">Order Status</label></b>
                <div class="row mx-2">
                <input class="form-control col-md-3" id="status" name="status" value="<?php echo htmlspecialchars($orderStatus); ?>" type="number" min="0" max="6" required>    
                <button type="button" class="btn btn-secondary ml-1" data-container="body" data-toggle="popover" title="User Types" data-placement="bottom" data-html="true" data-content="0=Order Placed.<br> 1=Order Confirmed.<br> 2=Preparing your Order.<br> 3=Your order is on the way!<br> 4=Order Delivered.<br> 5=Order Denied.<br> 6=Order Cancelled.">
                    <i class="fas fa-info"></i>
                </button>
                </div>
            </div>
            <input type="hidden" id="orderId" name="orderId" value="<?php echo htmlspecialchars($orderid); ?>">
            <button type="submit" class="btn btn-success mb-2" name="updateStatus">Update</button>
        </form>
        
        <?php 
            $deliveryDetailSql = "SELECT * FROM `deliverydetails` WHERE `orderId`= " . (int)$orderid;
            $deliveryDetailResult = mysqli_query($conn, $deliveryDetailSql);

            if ($deliveryDetailResult && mysqli_num_rows($deliveryDetailResult) > 0) {
                $deliveryDetailRow = mysqli_fetch_assoc($deliveryDetailResult);
                $trackId = $deliveryDetailRow['id'] ?? '';
                $deliveryBoyPhoneNo = $deliveryDetailRow['deliveryBoyPhoneNo'] ?? '';
                $deliveryTime = $deliveryDetailRow['deliveryTime'] ?? '';
        ?>
            <form action="partials/_orderManage.php" method="post">
                <div class="text-left my-2 row">
                    <div class="form-group col-md-6">
                        <b><label for="phone">Phone No</label></b>
                        <input class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($deliveryBoyPhoneNo); ?>" type="tel" required pattern="[0-9]{10}">
                    </div>
                    <div class="form-group col-md-6">
                        <b><label for="catId">Estimate Time(minute)</label></b>
                        <input class="form-control" id="time" name="time" value="<?php echo htmlspecialchars($deliveryTime); ?>" type="number" min="1" max="120" required>
                    </div>
                </div>
                <input type="hidden" id="trackId" name="trackId" value="<?php echo htmlspecialchars($trackId); ?>">
                <input type="hidden" id="orderId" name="orderId" value="<?php echo htmlspecialchars($orderid); ?>">
                <button type="submit" class="btn btn-success" name="updateDeliveryDetails">Update</button>
            </form>
        <?php } ?>
        <?php if ($orderStatus > 4) { ?>
            <form action="partials/_orderManage.php" method="post" class="mt-3">
                <input type="hidden" name="orderId" value="<?php echo htmlspecialchars($orderid); ?>">
                <button type="submit" class="btn btn-danger" name="deleteOrder">Delete Order</button>
            </form>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<?php
    }
}
?>
<style>
    .popover {
        top: -77px !important;
    }
</style>
<script>
    $(function () {
        $('[data-toggle="popover"]').popover();
    });
</script>
