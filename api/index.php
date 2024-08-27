<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php Api</title>
    <link rel="stylesheet" href="../assets/styles.css" type="text/css">
</head>

<body>
    <div class="container">
        <h1>Php Api</h1>
        <div class="divbody">
            <h3>Auth - login</h3>
            <code>
                POST /auth
                <br>
                {
                <br>
                "username" :"", -> REQUERIDO
                <br>
                "password": "" -> REQUERIDO
                <br>
                }
            </code>
        </div>
        <div class="divbody">
            <h3>Tasks</h3>
            <code>
                GET /tasks
                <br>
                GET /tasks?page=$
                <br>
                GET /tasks?task_id=$
            </code>
            <code>
                POST /tasks
                <br>
                {
                <br>
                "title" : "", -> REQUERIDO
                <br>
                "description" : "", -> REQUERIDO
                <br>
                "optional" : "", -> OPCIONAL
                <br>
                "token" : "" -> REQUERIDO
                <br>
                }
            </code>
            <code>
                PUT /tasks
                <br>
                {
                "task_id": "" -> REQUERIDO
                <br>
                "title" : "", -> REQUERIDO
                <br>
                "description" : "", -> REQUERIDO
                <br>
                "optional" : "", -> OPCIONAL
                <br>
                "token" : "" -> REQUERIDO
                <br>
                }
            </code>
            <code>
                DELETE /tasks
                <br>
                {
                <br>
                "token" : "", -> REQUERIDO
                <br>
                "task_id" : "" -> REQUERIDO
                <br>
                }
            </code>
        </div>
    </div>
</body>

</html>


<!--
𝕬zzᥲzᥱᥣ / 𝕬zzᥲzᥱrᥙ
⠀⠀⠀⠀⠀⠀⢀⣤⣶⣶⣖⣦⣄⡀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⢀⣾⡟⣉⣽⣿⢿⡿⣿⣿⣆⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⢠⣿⣿⣿⡗⠋⠙⡿⣷⢌⣿⣿⠀⠀⠀⠀⠀⠀⠀
⣷⣄⣀⣿⣿⣿⣿⣷⣦⣤⣾⣿⣿⣿⡿⠀⠀⠀⠀⠀⠀⠀
⠈⠙⠛⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣧⡀⠀⢀⠀⠀⠀⠀
⠀⠀⠀⠸⣿⣿⣿⣿⣿⣿⣿⣿⣿⡟⠻⠿⠿⠋⠀⠀⠀⠀
⠀⠀⠀⠀⠹⣿⣿⣿⣿⣿⣿⣿⣿⡇⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠈⢿⣿⣿⣿⣿⣿⣿⣇⠀⠀⠀⠀⠀⠀⠀⡄
⠀⠀⠀⠀⠀⠀⠀⠙⢿⣿⣿⣿⣿⣿⣆⠀⠀⠀⠀⢀⡾⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⠻⣿⣿⣿⣿⣷⣶⣴⣾⠏⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠈⠉⠛⠛⠛⠋⠁⠀⠀⠀
-->