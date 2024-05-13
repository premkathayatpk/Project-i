<?php require 'header.php'; 
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
?>

<!-- Cards -->
<div class="card">
    <div>
        <div class="numbers">1,504</div>
        <div class="cardName">Total Sales</div>
    </div>
    <div class="iconBx">
        <ion-icon name="eye-outline"></ion-icon>
    </div>
</div>

<div class="card">
    <div>
        <div class="numbers">80</div>
        <div class="cardName">Daily Sales</div>
    </div>
    <div class="iconBx">
        <ion-icon name="cart-outline"></ion-icon>
    </div>
</div>

<div class="card">
    <div>
        <div class="numbers">23</div>
        <div class="cardName">New Order</div>
    </div>
    <div class="iconBx">
        <ion-icon name="chatbubbles-outline"></ion-icon>
    </div>
</div>

<div class="card">
    <div>
        <div class="numbers">$7,842</div>
        <div class="cardName">Earning</div>
    </div>
    <div class="iconBx">
        <ion-icon name="cash-outline"></ion-icon>
    </div>
</div>

