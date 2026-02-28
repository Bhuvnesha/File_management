<form method="post" action="<?= site_url('login') ?>">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

<?php if(session()->getFlashdata('error')): ?>
    <p><?= session()->getFlashdata('error') ?></p>
<?php endif; ?>