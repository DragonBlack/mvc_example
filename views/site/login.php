<form action="/site/login" method="post" class="form form-horizontal">
    <div class="form-group">
        <label class="col-md-3 col-md-offset-3" for="formlogin_login">Login</label>
        <input type="text" name="LoginForm[login]" id="formlogin_login" class="form-control"/>
    </div>
    <div class="form-group">
        <label class="col-md-3 col-md-offset-3" for="formlogin_password">Password</label>
        <input type="password" name="LoginForm[password]" id="formlogin_password" class="form-control"/>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">Sing in</button>
    </div>
</form>