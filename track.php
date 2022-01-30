<!DOCTYPE html>
<html>
  <head>
    <title>demo</title>
    <script>
    var track = {
      
      rider : "", 
      delay : 600000, 
      timer : null, 
      display : null, 

      
      init : function () {
        track.display = document.getElementById("display");
        if (navigator.geolocation) {
          track.update();
          setInterval(track.update, track.delay);
        } else {
          track.display.innerHTML = "Geolocation is not supported!";
        }
      },


      
      
      update : function () {
        navigator.geolocation.getCurrentPosition(function (pos) {
          
          var data = new FormData();
          data.append('req', 'update');
          data.append('rider_id', track.rider);
          data.append('lat', pos.coords.latitude);
          data.append('lng', pos.coords.longitude);
          

          
          var xhr = new XMLHttpRequest();
          xhr.open('POST', "track2.php");
          xhr.onload = function () {
            var res = JSON.parse(this.response);
            if (res.status==1) {
              track.display.innerHTML = Date.now() + " | Lat: " + pos.coords.latitude + " | Lng: " + pos.coords.longitude;
            } else {
              track.display.innerHTML = res.message;
            }
          };
          xhr.send(data);
        });
      }
      
    };
   

    
    window.addEventListener("DOMContentLoaded", track.init);
    </script>
  </head>
  <body>
    <p>หากขึ้นหน้านี้แสดงว่าบันทึกพอกัดให้เรียบร้อยแล้ว</p>
  
  
  </body>
</html>