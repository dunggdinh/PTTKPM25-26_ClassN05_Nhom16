<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
     
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Map</title>
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}">
  </script>
    <style type="text/css">
        #map {
          height: 400px;
        }
    </style>
</head>
     
<body>
  <div class="container mt-5">
    <h2>Map</h2>
    <button onclick="showMap()" style="margin-bottom:10px;" class="px-4 py-2 bg-green-500 text-white rounded">Chọn từ bản đồ</button>
    <div id="map"></div>
  </div>

  <script type="text/javascript">
    function showMap() {
      const myLatLng = { lat: 22.2734719, lng: 70.7512559 };
      const mapDiv = document.getElementById("map");
      mapDiv.innerHTML = "";
      const map = new google.maps.Map(mapDiv, {
        zoom: 5,
        center: myLatLng,
      });
      new google.maps.Marker({
        position: myLatLng,
        map,
        title: "Hello Rajkot!",
      });
    }
  </script>
</body>
</html>