<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#auth">Войти</a></li>
    <li><a data-toggle="tab" href="#regist">Регистрация</a></li>
    <li id="line"></li>
</ul>
<div class="tab-content">
    <div id="auth" class="tab-pane fade">
        <form class="auth_form">
            <div class="shiro_input">
                <input id="login-inp" class="input_field" type="text" name="login" placeholder="">
                <label class="input_label" for="login-inp">
                    <span class="input_label-content">E-mail</span>
                </label>
            </div>
            <div class="shiro_input">
                <input id="pass-inp" class="input_field" type="password" name="password" placeholder="">
                <label class="input_label" for="pass-inp">
                    <span class="input_label-content">Пароль</span>
                </label>
            </div>
            <p class="submit">
                <button type="submit" name="submit">Войти</button>
            </p>
        </form>
    </div>
    <div id="regist" class="tab-pane fade">
        <form class="registr_form">
            <div class="shiro_input">
                <input id="login-inp_1" class="input_field" type="text" name="login" placeholder="">
                <label class="input_label" for="login-inp_1">
                    <span class="input_label-content">E-mail</span>
                </label>
            </div>
            <div class="shiro_input">
                <input id="pass-inp_1" class="input_field" type="password" name="password" placeholder="">
                <label class="input_label" for="pass-inp_1">
                    <span class="input_label-content">Пароль</span>
                </label>
            </div>
            <div class="shiro_input">
                <input id="pass-inp_1" class="input_field" type="password" name="password" placeholder="">
                <label class="input_label" for="pass-inp_1">
                    <span class="input_label-content">Пароль</span>
                </label>
            </div>
            <div class="shiro_input">
                <input id="pass-inp_1" class="input_field" type="password" name="password" placeholder="">
                <label class="input_label" for="pass-inp_1">
                    <span class="input_label-content">Пароль</span>
                </label>
            </div>
            <p class="submit">
                <button type="submit" name="submit">Отправить</button>
            </p>
        </form>
    </div>
</div>
