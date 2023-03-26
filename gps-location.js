// Step 1: Get user coordinates
function getCoordintes() {
    var options = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0
    };

    function success(pos) {
        var crd = pos.coords;
        var lat = crd.latitude.toString();
        var lng = crd.longitude.toString();
        // var lat = "2.93527";
        // var lng = "101.69112";
        var coordinates = [lat, lng];
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
        getCity(coordinates);
        return;

    }

    function error(err) {
        console.warn(`ERROR(${err.code}): ${err.message}`);
    }

    navigator.geolocation.getCurrentPosition(success, error, options);
}

// Step 2: Get city name
function getCity(coordinates) {
    var xhr = new XMLHttpRequest();
    var lat = coordinates[0];
    var lng = coordinates[1];

    // xhr.setRequestHeader('Accept-Language', 'n-US;q=0.8,en;q=0.5');
    // Paste your LocationIQ token below.
    xhr.open('GET', "https://us1.locationiq.com/v1/reverse.php?key=pk.a2c05bfe0d9719fa7a9950a69e692b59&lat=" + lat + "&lon=" + lng + "&format=json", true);
    xhr.send();
    xhr.onreadystatechange = processRequest;
    xhr.addEventListener("readystatechange", processRequest, false);

    function processRequest(e) {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            var city = response.address.city;
            document.getElementById('city-name').value = city;
            return;
        }
    }
}

getCoordintes();