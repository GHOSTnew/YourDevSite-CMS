<html>
    <head>
        <title>YourDevSite install</title>
        <style>
            .install
            {
                background:rgba(255,255,255,0.5);
                border-radius: 10px;
                border: 1px black solid;
                margin-left: 30%;
                margin-right: 30%;
                margin-top: 10%;
                margin-bottom: 20%;
                padding: 12px;
            }
            body
            {
                background-image:url('../images/back.png');
            }
        </style>
    </head>
    <body>
        <div class="install">
            <form method="post" action="step1.php">
                <h1>Step 1</h1>
                <label>Host mySQL</label> : <input type="text" name="SQLhost" id="SQLhost"><br/>
                <label>mySQL user</label> : <input type="text" name="SQLuser" id="SQLuser"><br/>
                <label>mySQL pass</label> : <input type="password" name="SQLpass" id="SQLpass"><br/>
                <label>mySQL database</label> : <input type="text" name="SQLdatabase" id="SQLdatabase"><br/>
                <input type="submit" value="suivant" />
            </form>
        </div>
    </body>
</html>
