
    <div class="center">
        <div class="center-authorisation">
<form method="post">
                <p>Адрес почты:</p>
                <input class="center-authorisation-fields" type="email" name="email" placeholder="adress@domain.zone">
                <p>Пароль: <a class="center-authorisation-links" id="visible" href="#">Посмотреть пароль</a>
                <a class="center-authorisation-links" id="unvisible" href="#">Скрыть пароль</a></p>
                <input class="center-authorisation-fields" type="password"id="password" name="password" placeholder="*****">
                                <script >
                    let visible = document.getElementById('visible');
                    let unvisible = document.getElementById('unvisible');
                    unvisible.style.display='none';
function view(){
    let field =  document.getElementById('password');
    field.setAttribute('type', 'text');
    visible.style.display='none';
    unvisible.style.display='inline';
    
}
function hide(){
    let field =  document.getElementById('password');
    field.setAttribute('type', 'password');
    visible.style.display='inline';
    unvisible.style.display='none';
    
}
visible.addEventListener('click', view)
unvisible.addEventListener('click', hide)
                </script>
                <a href="/register">Зарегестрироваться</a></p>
                <input class="center-authorisation-button" type="submit" value="Войти">
                <p><a class="center-authorisation-links" href="/recovery">Забыли пароль? Сменить?</a>

            </form>
            </div>
            <div class="center-welcome">
<h1>Добро пожаловать!</h1>

<p>Социальная сеть – универсальное средство коммуникации и поиска людей.</p>

<span>С помощью социальной сети:</span>
<ul><li>

Воссоединяйтесь с теми, с кем вы учились, работали или проводили свободное время.
</li><li>
Познакомьтесь ближе с окружающими вас людьми и расширьте круг общения.
</li><li>
Сохраняйте связь с дорогими вам людьми, где бы вы ни находились.
</li></ul>
    

</div>
