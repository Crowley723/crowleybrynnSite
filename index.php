<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <?php include "./header.php" ?>
    <style>
      .dot {
        height: 100px;
        width: 100px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
      }
    </style>
  </head>
  <body>
  <div style="padding-left:16px">
    <h2>Nothing Yet!</h2>
    <p></p>
    <p>I have however, FINALLY setup an SSL certificate. Only took me 4 hours..<br><br>
       I am in the process of adding real time AQI data to this page.
       Eventually the goal is to have pretty looking graphics along with the ability to look at raw data vs the AQ Index. Also being able to choose between PM2.5, PM10, and Ozone.<br>
    </p>


  </div>
  <?php
    $servername = "localhost";
    // REPLACE with your Database name
    $dbname = "sensorData";
    // REPLACE with Database user
    $username = getenv('SQLUSER');
    // REPLACE with Database user password
    $password = getenv('SQLPASS');

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
      $sql = "SELECT `Temperature(C)`, `Pressure(bar)`, `Humidity(%)`, `PM1`, `PM2.5`, `PM10`, `Timestamp` FROM Exterior ORDER BY `Timestamp` DESC LIMIT 1";
      if ($result = $conn->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            $row_Temperature = $row["Temperature(C)"];
            $row_Pressure = $row["Pressure(bar)"]; 
            $row_Humidity = $row["Humidity(%)"]; 
            $row_PM01 = $row["PM1"];
            $row_PM25 = $row["PM2.5"];
            $row_PM10 = $row["PM10"];
            $row_reading_time = $row["Timestamp"];
            $row_Pressure = ($row_Pressure / 1000.0);

        }
        echo '<div style="padding-left:16px">
               <br><br><h4>Current Air Quality</h4>
               <p>PM2.5 AQI: ' . AQIPM25($row_PM25) .'</p>
               <p>PM10  AQI: ' . AQIPM10($row_PM10) .'</p>
               </div>';
              
      }
      




      function AQIPM25($PM25){
        $PM25 = floor($PM25);
        if($PM25 <= 12.0){//GOOD
          return round((((50-0)/(12.0-0))*($PM25 - 0.0)+0));

        } elseif($PM25 > 12.0 && $PM25 <= 35.4){//MODERATE
          return round((((100-51)/(35.4-12.1))*($PM25 - 12.1)+51));

        } elseif($PM25 > 35.4 && $PM25 <= 55.4){//UNHEALTHY FOR SENSITIVE
          return round((((150-101)/(55.4-35.5))*($PM25 - 35.5)+101));

        } elseif($PM25 > 55.4 && $PM25 <= 150.4){//UNHEALTHY
          return round((((200-151)/(150.4-55.5))*($PM25 - 55.5)+151));

        }elseif($PM25 > 150.5 && $PM25 <= 250.4){//VERY UNHEALTHY
          return round((((300-201)/(250.4-150.5))*($PM25 - 150.5)+201));

        }elseif($PM25 > 250.5 && $PM25 <= 500.4){//HAZARDOUS
          return round((((500-301)/(500.4-250.5))*($PM25 - 250.5)+301));

        }elseif($PM25 > 500.4 && $PM25 < 99999.9){//TOO HIGH
          return round((((999-501)/(99999.9-500.5))*($PM25 - 500.5)+500.5));
          
        }
      }
      function AQIPM10($PM10){
        $PM10 = floor($PM10);
        if($PM10 <= 54.0){//GOOD
          return round((((50-0)/(54-0))*($PM10 - 0.0)+0));

        } elseif($PM10 > 54 && $PM10 <= 154){//MODERATE
          return round((((100-51)/(154-55))*($PM10 - 55)+51));

        } elseif($PM10 > 155 && $PM10 <= 254){//UNHEALTHY FOR SENSITIVE
          return round((((150-101)/(254-155))*($PM10 - 155)+101));

        } elseif($PM10 > 255 && $PM10 <= 354){//UNHEALTHY
          return round((((200-151)/(354-255))*($PM10 - 255)+151));

        }elseif($PM10 > 355 && $PM10 <= 424){//VERY UNHEALTHY
          return round((((300-201)/(424-355))*($PM10 - 355)+201));

        }elseif($PM10 > 425 && $PM10 <= 604){//HAZARDOUS
          return round((((500-301)/(604-425))*($PM10 - 425)+301));

        }elseif($PM10 > 605 && $PM10 < 99999.9){//TOO HIGH
          return round((((999-501)/(99999.9-605))*($PM10 - 605)+500.5));
          
        }
      }
      function AQIO3($PM10){
        $PM10 = floor($PM10);
        if($PM10 <= 54.0){//GOOD
          return round((((50-0)/(54-0))*($PM10 - 0.0)+0));

        } elseif($PM10 > 54 && $PM10 <= 154){//MODERATE
          return round((((100-51)/(154-55))*($PM10 - 55)+51));

        } elseif($PM10 > 155 && $PM10 <= 254){//UNHEALTHY FOR SENSITIVE
          return round((((150-101)/(254-155))*($PM10 - 155)+101));

        } elseif($PM10 > 255 && $PM10 <= 354){//UNHEALTHY
          return round((((200-151)/(354-255))*($PM10 - 255)+151));

        }elseif($PM10 > 355 && $PM10 <= 424){//VERY UNHEALTHY
          return round((((300-201)/(424-355))*($PM10 - 355)+201));

        }elseif($PM10 > 425 && $PM10 <= 604){//HAZARDOUS
          return round((((500-301)/(604-425))*($PM10 - 425)+301));

        }elseif($PM10 > 605 && $PM10 < 99999.9){//TOO HIGH
          return round((((999-501)/(99999.9-605))*($PM10 - 605)+500.5));
          
        }
      }
  ?>
  <!--span class="dot"></span//-->
  </body>
</html>
