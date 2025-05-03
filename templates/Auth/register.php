<form method="post">
    <input type="text" name="name" placeholder="Имя" required>
    <input type="text" name="surname" placeholder="Фамилия" required>
    <input type="number" name="age" placeholder="Возраст" required>
    <input type="date" name="birthday" placeholder="ДР.ММ.ГГ" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="number" name="phone" placeholder="+7000000000" required>
    <input type="password" name="password" placeholder="Пароль" required>
    <input type="password" name="confirm_password" placeholder="Пароль" required>
    <button type="submit">Зарегистрироваться</button>
</form>
<script>
document.querySelector('input[name="birthday"]').addEventListener('change', function() {
    const birthday = new Date(this.value);
    const today = new Date();
    
    // Рассчитываем возраст
    let age = today.getFullYear() - birthday.getFullYear();
    const monthDiff = today.getMonth() - birthday.getMonth();
    const dayDiff = today.getDate() - birthday.getDate();
    if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
        age--;
    }
    
    document.querySelector('input[name="age"]').value = Math.max(age, 0);
});
</script>
