var baseUrl = "http://localhost/phpObuka/Domaci3/phonebook/";

async function displayCities(){
    let country_id = document.getElementById("country_id").value;

    let response = await fetch(baseUrl + "getCitiesByCountry.php?country_id="+country_id);
    let cities = await response.json();
    

    
    let citiesHTML = '';
    cities.forEach( (city) => {
        citiesHTML += `<option value=${city.id} >${city.name}</option>`;
    });

    document.getElementById("city_id").innerHTML = citiesHTML;
}

var city_id;
var country_id;
function getCityId(id){
    city_id = id;
}

function getCountryId(id){
    country_id = id;
}

async function deleteCity(){
    res = await fetch(baseUrl + "deleteCity.php?city_id="+city_id);
    resJson = await res.json();
    if(resJson.status == 'fail'){
        alert("Nije moguce obrisati podatke koji su uvezani!");
    }
    var myModalEl = document.getElementById('exampleModal');
    var modal = bootstrap.Modal.getOrCreateInstance(myModalEl);
    modal.hide();
    window.location.reload(true);
}

async function deleteCountry(){
    res = await fetch(baseUrl + "deleteCountry.php?country_id="+country_id);
    resJson = await res.json();
    if(resJson.status == 'fail'){
        alert("Nije moguce obrisati podatke koji su uvezani!");
    }
    var myModalEl = document.getElementById('countryModal');
    var modal = bootstrap.Modal.getOrCreateInstance(myModalEl);
    modal.hide();
    window.location.reload(true);
}