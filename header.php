<style>
    body {margin:0;font-family:Arial}
.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.active {
  background-color: #e83131;
  color: white;
}

.topnav .icon {
  display: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 17px;    
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}
.dropdown-submenu {
  position: relative;
}

.dropdown-submenu .dropdown-menu {
  top: 0;
  left: 100%;
  margin-top: -1px;
}

.topnav a:hover, .dropdown:hover .dropbtn {
  background-color: #555;
  color: white;
}

.dropdown-content a:hover {
  background-color: #ddd;
  color: black;
}

.dropdown:hover .dropdown-content {
  display: block;
}

@media screen and (max-width: 600px) {
  .topnav a:not(:first-child), .dropdown .dropbtn {
    display: none;
  }
  .topnav a.icon {
    float: right;
    display: block;
  }
}

@media screen and (max-width: 600px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
  .topnav.responsive .dropdown {float: none;}
  .topnav.responsive .dropdown-content {position: relative;}
  .topnav.responsive .dropdown .dropbtn {
    display: block;
    width: 100%;
    text-align: left;
  }
}

.buttonIndent {
 text-indent: 20px
}
</style>


<meta name="viewport" content="width=device-width, initial-scale=1">
<div class="topnav" id="myTopnav">
  <a href="/"<?php if($_SERVER['REQUEST_URI'] == "/index.php" or $_SERVER['REQUEST_URI'] == "/"){echo " class=\"active\"";} ?>>Dashboard</a>
  <div class="dropdown">
    <button class="dropbtn"<?php if(strpos($_SERVER['REQUEST_URI'], "/exteriorData.php") !== false || strpos($_SERVER['REQUEST_URI'], "/flowerData.php") !== false){echo " class=\"active\"";} ?>>View Table
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="/exteriorData.php"<?php if(strpos($_SERVER['REQUEST_URI'], "/exteriorData.php") !== false){echo " class=\"active\"";} ?>>ExteriorData</a>
      <a href="/flowerData.php"<?php if(strpos($_SERVER['REQUEST_URI'], "/flowerData.php") !== false){echo " class=\"active\"";} ?>>FlowerData</a>
    </div>
  </div>
  <a href="/downloadCSV.php"<?php if($_SERVER['REQUEST_URI'] == "/downloadCSV.php"){echo " class=\"active\"";} ?>>Download CSV</a>
  <div class="dropdown">
    <button class="dropbtn"<?php if(strpos($_SERVER['REQUEST_URI'], "/loadExteriorData.php") !== false || strpos($_SERVER['REQUEST_URI'], "/loadFlowerData.php") !== false){echo " class=\"active\"";} ?>>View Table Ajax
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-content">
        <a href="/ajax/loadExteriorData.php"<?php if(strpos($_SERVER['REQUEST_URI'], "/ajax/loadExteriorData.php") !== false){echo " class=\"active\"";} ?>>Exterior Data</a>
        <a href="/ajax/loadFlowerData.php"<?php if(strpos($_SERVER['REQUEST_URI'], "/ajax/loadFlowerData.php") !== false){echo " class=\"active\"";} ?>>Flower Data</a>
      </div>
  </div>
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="showHamburgerMenu()">&#9776;</a>
  <script>
    function showHamburgerMenu() {
      var x = document.getElementById("myTopnav");
      if (x.className === "topnav") {
        x.className += " responsive";
      } else {
        x.className = "topnav";
      }
    }
  </script>
</div>
