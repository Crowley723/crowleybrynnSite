<?php header("/") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Merry Christmas</title>
    <style>
main {
    background: linear-gradient(to bottom, #2d91c2 0%, #1e528e 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: "Pacifico", cursive;
    height: 100vh;
    padding: 20px;
    text-align: center;
}
.body-text{
    z-index: 1;
    text-align: center;
}
.body-text * {
color: white;
}
body{
    margin: 0;
}
@keyframes fall {
    0% {
    opacity: 0;
    }
    50% {
    opacity: 1;
    }
    100% {
    top: 100vh;
    opacity: 1;
    }
}

@keyframes sway {
    0% {
    margin-left: 0;
    }
    25% {
    margin-left: 50px;
    }
    50% {
    margin-left: -50px;
    }
    75% {
    margin-left: 50px;
    }
    100% {
    margin-left: 0;
    }
}

#snow-container {  
    height: 100vh;
    overflow: hidden;
    position: absolute;
    top: 0;
    transition: opacity 500ms;
    width: 100%;
    z-index: 0;
}

.snow {
    animation: fall ease-in infinite, sway ease-in-out infinite;
    color: skyblue;
    position: absolute;
    z-index: 0;
}
.to-do{
    display: none;
}
.unhide-button{
    margin: 4vh;
    color:white;
    background-color: green;
    box-shadow: 0px 4px 8px rgba(0,0,0,0.4);
    border: none;
    text-decoration: none;
    padding: 8px 16px;
    transition: 200ms;
}
.unhide-button:hover{
    background-color: red;
}
.redirect-button{
    margin: 4vh;
    color:white;
    background-color: red;
    box-shadow: 0px 4px 8px rgba(0,0,0,0.4);
    border: none;
    text-decoration: none;
    padding: 8px 16px;
    transition: 200ms;
}
.redirect-button:hover{
    background-color: green;
}
@font-face {
    font-family: "Pinyon Script";
    src: url(/fonts/PinyonScript-Regular.ttf);
}
#merry-christmas{
    font-family: "Pinyon Script";
}


</style>
    
</head>
<main>
    <div class="body-text">
        <h1 id="merry-christmas">Merry Christmas</h1>
        <button onclick="revealText()" class="unhide-button" id="unhide-button">Click me!</button>
        <div class="to-do" id="to-do">
            <p>Enable NFC on your phone, then tap the card to the back of your phone.<br>
                You will be able to come back here, but keep these things in mind.
                <ul>
                    <li>Add your email.</li>
                    <li>Change your password.</li>
                    <li>Configure and Enable 2 Factor Authentication</li>
                </ul>
            </p>
                <a href="https://cloud.pmcrowley.com" class="redirect-button" target="_blank">Click me!</a><br>
                <button onclick="reveal2ndText()"class="unhide-button" id="unhide-button2">Confused?</button>
               <p id="to-do2" style="display: none">
                I built a server for you to use. It has 3.6TB of storage for you to do with what you will. <br>
                Its accessable through <a href="https://cloud.pmcrowley.com">https://cloud.pmcrowley.com</a><br>
                If you would like, I have the ability to host other services on it, such as a password manager or website etc.
               </p> 
            
        </div>
            

       
    </div>
<div id="snow-container"></div>
</main>
<script>
function revealText(){
    const text = document.getElementById("to-do");
    const button = document.getElementById("unhide-button");
    button.style.display = 'none';
    text.style.display = 'block';
}
function reveal2ndText(){
    const text = document.getElementById("to-do2");
    const button = document.getElementById("unhide-button");
    button.style.display = 'none';
    text.style.display = 'block';
}
const snowContainer = document.getElementById("snow-container");
const snowContent = ['&#10052', '&#10053', '&#10054']
const random = (num) => {
    return Math.floor(Math.random() * num);
}
const getRandomStyles = () => {
    const top = random(100);
    const left = random(100);
    const dur = random(10) + 10;
    const size = random(25) + 25;
    return `
    top: -${top}%;
    left: ${left}%;
    font-size: ${size}px;
    animation-duration: ${dur}s;
    `;
}
const createSnow = (num) => {
    for (var i = num; i > 0; i--) {
    var snow = document.createElement("div");
    snow.className = "snow";
    snow.style.cssText = getRandomStyles();
    snow.innerHTML = snowContent[random(2)]
    snowContainer.append(snow);
    }
}
window.addEventListener("load", () => {
    createSnow(75)
});


</script>
</html>