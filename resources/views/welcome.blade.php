<!DOCTYPE html>
<html>

<head>

  <title>GeoJSON tutorial - Leaflet</title>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.5.1/leaflet.css"> -->
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>


  <style>
    html,
    body {
      height: 100%;
      margin: 0;
    }

    #map {
      width: 100%;
      height: 480px;
    }
  </style>


</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-transparant fixed-top" id="main-top">
    <div class="container">
      <a class="navbar-brand font-weight-bold text-white" href="#">SURVEY UANG</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
          @guest
          @if (Route::has('login'))
          <a class="nav-link js-scroll-trigger text-white" href="{{ route('login') }}">Login</a>
          @endif
          @else
          @role('admin')
          <a class="nav-link active js-scroll-trigger text-white" href="{{ route('admin-home') }}">Home <span class="sr-only">(current)</span></a>
          @else
          <a class="nav-link active js-scroll-trigger text-white" href="{{ route('surveyer-home') }}">Home <span class="sr-only">(current)</span></a>
          @endrole
          @endguest
        </div>
      </div>
    </div>
  </nav>

  <div class="jumbotron">
    <div class="container py-1">

      <div id="map"></div>
      <br>
      <p>konten ini mengandung kekerasan dan tindak asusila.</p>
      <a class="btn btn-primary btn-lg" href="#" role="button">pelajari</a>
    </div>
  </div>

  <div class="container px-lg-5">
    <div class="row mx-lg-n5">
      <div class="col py-3 px-lg-5 border bg-light">
        <table class="table table-hover" id="table">
          <thead>
            <tr>
              <th class="bg-success text-white" scope="col">No</th>
              <th class="bg-success text-white" scope="col">Kecamatan</th>
              <th class="bg-success text-white" scope="col">Survey</th>
              <th class="bg-success text-white" scope="col">Kualitas</th>
            </tr>
          </thead>
          <tbody>
          @foreach($table as $val)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $val->kecamatan }}</td>
              <td>{{ $val->disurvey }}</td>
              <td>{{ $val->kualitas }}</td>
            </tr>
          @endforeach
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col py-3 px-lg-5 bg-transparant">
        <h1><span class="font-weight-bold">Kabupaten Jember</span></h1>

      </div>
    </div>
  </div>
  <script>
  var map = L.map('map').setView([-8.264486, 113.668076], 10);

  L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
  }).addTo(map);

  function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
  }

  let data_table = []
  let table = document.getElementById('table');
  console.log()
  for(let i = 1; i < table.rows.length; i++){
    var nested = table.rows[i];
    data_table.push([
      nested.cells.item(1).innerHTML.toUpperCase(),
      nested.cells.item(3).innerHTML
    ]);
  }

  function getColor(d) {
    return d <= 2 ? '#dd2c1c' :
           d <= 3  ? '#e8e812' :
           d <= 4  ? '#31ce0e' :
                      '#f4f4e8';
  }

  axios.get("{{ asset('assets/kecamatan.json') }}")
    .then(r => {
      let geojsonFeature = r.data
      L.geoJSON(geojsonFeature, {
        style: function(feature) {
          let data_geo = feature.properties.kecamatan;
          for(let i = 0; i <= (data_table.length-1); i++) {
            if((data_geo == data_table[i][0])) {
              return { 
                fillColor: getColor(data_table[i][1]),
                color: '#40d3d6' ,
                opacity: 1,
                fillOpacity: 1
              }
            }
          }
        }
      }).addTo(map);
    })
</script>
</body>
</html>