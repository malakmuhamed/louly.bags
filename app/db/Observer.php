<?php
interface Observer {
    public function update($orderId, $newOrderState);
}
?>