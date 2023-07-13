<!DOCTYPE html>
<html>
    <style>
        .img {
            width: 444px;
            height: 296px;
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
        <title> 404: Not Found </title>
        <?php include "./header.php" ?>


        <div class="header">
            
        </div>
    </head>
    <body>
        <div class="container">
            <h1 class="header">Page Not Found!</h1>
            <!--img class="img" src="/assets/cookie.jpg" alt="A free cookie!"//-->
            <img class="img" src="/assets/xqc-spin.gif" alt="Spinny">
            
        
            <div class="bodytext">
                <p>You managed to reach a place with nothing!</p>
                <p>So heres a cookie and a <a href="/">redirect.</a>.</p>
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