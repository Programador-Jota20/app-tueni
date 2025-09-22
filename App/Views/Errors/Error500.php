<!DOCTYPE html>
<html>
<head>
    <title>Error 500</title>
</head>
<body>
    <h1>Error 500</h1>
    <p>Ha ocurrido un error interno.</p>
    <pre><?= htmlspecialchars($errorMessage ?? '') ?></pre>
</body>
</html>