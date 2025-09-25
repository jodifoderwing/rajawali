<!DOCTYPE html>
<html>
<head>
  <title>Peta Batas Desa DIY</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol/ol.css">
  <style>
    #map { width: 100%; height: 100vh; }
    #popup {
      position: absolute;
      background: white;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      display: none;
      z-index: 1000;
    }
  </style>
</head>
<body>
  <div id="map"></div>
  <div id="popup"></div>

  <!-- Load OpenLayers dulu -->
  <script src="https://cdn.jsdelivr.net/npm/ol@v8.2.0/dist/ol.js"></script>
  <!-- Load file custom -->
  <script src="/js/petaSurvey.js"></script>
</body>
</html>
