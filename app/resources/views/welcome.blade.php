<!DOCTYPE html>
<html>
<head>
    <title>Formulário de Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="/login">
        @csrf <!-- Isso é usado para proteger contra ataques CSRF -->
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <input type="submit" value="Entrar">
        <br><br>

    </form>
            <a href="/auth/github/redirect">Login with github</a><br>

</body>
</html>

