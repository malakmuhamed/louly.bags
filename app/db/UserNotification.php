<?php
require_once('Observer.php');

class UserNotification implements Observer {
    public function update($orderId, $newOrderState) {
        // Store the notification in the database or any other storage mechanism.
        $notificationMessage = "Order $orderId state updated to $newOrderState";

        // For simplicity, we'll use sessions to store the notification temporarily.
        session_start();
        $_SESSION['notification'] = $notificationMessage;
    }
}

?>