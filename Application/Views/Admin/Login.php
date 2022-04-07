
<h1>This page admin</h1>
<form action="/mvc-php/admin/login" method="post">
    <p>Логин</p>
    <input type="text" name="login">
    <p>Пароль</p>
    <input type="password" name="password">
    <button type="submit">Вход</button>
</form>

<?= $_SESSION['message'] ?>