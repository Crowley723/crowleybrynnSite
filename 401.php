<!DOCTYPE html>
<html>
    <style>
        .img {
            width: 422px;/* 527w x 460h */
            height: 368px;
        }
        .header {
            font-size: 40px;
        }
        .container {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
            text-align: center;
            min-height: 80vh;
        }
        .bodytext {
            font-size: 20px;
            padding-left:20px;
            text-justify:inherit;
        }
    </style>
    <head>
        <title> 401: Unauthorized </title>
        <?php include "./header.php" ?>


        <div class="header">
            
        </div>
    </head>
    <body>
        <div class="container">
            <h1 class="header">Access Restricted</h1>
            <img class="img" src="/assets/vault.png" alt="Bank vault door">
            <div class="bodytext">
                <p>You lack the necessary clearance to access this page!</p>
                <p><a href="/">Here's the door</a></p>
            </div>
        </div>
    </body>
</html>
<script>
    function Previous() {
        window.history.go(-1);
    }
    window.onload = function(){
        setTimeout(function() { Previous(); }, 10000);
    }
</script>
