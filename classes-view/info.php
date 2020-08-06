
<style>
.mainContent{
    width: 80vw;
    height: 100vw;
    /* border: 5px solid black; */
    font-family: Optima, Helvetica, sans-serif;
    white-space: normal;
    box-shadow: -1px 1px 30px gray;
}
.header {
        background-color: #171520;
        color: gold;
        padding: 15px 30px;
        text-align: center;
        box-shadow: 1px 1px 30px gray;
    }
.header>h2 {
        display: inline-block;
        margin: 0;
        font-weight: 500;
    }
.headersTxt{
    border-bottom: 1px lightslategray solid;
    margin-top: 0;
}
.mapField{
    height: 100%;
}
#map{
    height: 600px;  /* The height is 400 pixels */
    width: 100%;  /* The width is the width of the web page */
}

@media (max-width: 768px){
    .mainContent{
        width: 95vw;
    }
    .headersTxt{
        font-size: 20px;
        border-bottom: 1px lightslategray solid;
    }
    #map{
        height: 800px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
    }
}
</style>

<div class = "mainContent">
    <div class= "header">
        <h2>Information</h2>
    </div>
    <div class= "subHeader">
        <h2 class= "headersTxt"> Based on the address you have provided, you can find banks around you using the map below</h2>
    </div>
    <div class="mapField">
        <div id="map"></div>
    </div>
</div>
<!-- <script src="../js/jquery-main-script/jquery-3.4.1.min.js" ></script>
<script src="../js/bs-scripts/bootstrap.min.js" ></script> -->
<!-- <script>
    $(function () {
        console.log($("#latitude").val());
        console.log($("#longtiude").val());

    });
    function initMap() {
      // The location of Uluru 
      let latitude = parseFloat($("#latitude").val());
      let longitude =parseFloat( $("#longtiude").val());
      var coordinates = {lat: latitude, lng: longitude};
      var map = new google.maps.Map(
          document.getElementById('map'), {zoom: 16, center: coordinates});
      var marker = new google.maps.Marker({position: coordinates, map: map});
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPuL5qAhQyqx-6N3KPfivWdzMGvr1G1HA&callback=initMap">
</script> -->
