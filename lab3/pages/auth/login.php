<?php

session_start();
require '../../jwt_helper.php';

if (isset($_SESSION['jwt']) && decodeJWT($_SESSION['jwt'])) {
    header("Location: ../../index.php");
    exit;
}
?>

<div>
    <h2>Login</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div style="color: red">
            <?php
            echo htmlspecialchars($_SESSION['error']);
            unset($_SESSION['error']);
            ?>
        </div>
    <?php endif; ?>

    <form action="../../handlers/auth/login_handler.php" method="POST">
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <button type="submit">Login</button>
        <p>
            <a href="register.php">Don't have an account? Register here</a>
        </p>
    </form>
</div>