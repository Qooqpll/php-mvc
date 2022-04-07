
<form action="/mvc-php/admin/register" method="post">
    <p>Имя пользователя</p>
    <input type="text" name="username">
    <p>Ввидете ваше имя</p>
    <input type="text" name="first_name">
    <p>Введите вашу фамилию</p>
    <input type="text" name="last_name">
    <p>Введите ваш email</p>
    <input type="text" name="email">
    <p>Пароль</p>
    <input type="password" name="password">
    <p>Подтвердите пароль</p>
    <input type="password" name="confirm_password">
    <button type="submit">Регистрация</button>
</form>

<?= $_SESSION['message'] ?>
