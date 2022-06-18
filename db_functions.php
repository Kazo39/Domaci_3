<?php

    include "connect_db.php";

    function getContactsFromDataBase($searchTerm = ""){
        global $db_connect;
        $user_id = $_SESSION['user']['id'];
        $sql = "SELECT contacts.id,
                        contacts.first_name,
                        contacts.last_name,
                        contacts.email,
                        cities.name AS city,
                        countries.name AS country
                        FROM `contacts`,cities,countries WHERE
                        contacts.city_id = cities.id AND
                        cities.country_id = countries.id AND
                contacts.user_id = $user_id";

        if($searchTerm != ""){
            $term = strtolower($searchTerm);
            $sql .= " AND (lower(first_name) like '%$term%' or lower(last_name) like '%$term%')";
        }
        $res = mysqli_query($db_connect,$sql);


        $contacts = [];
        while($contact = mysqli_fetch_assoc($res)){
            $contacts[] = $contact;
        }

        return $contacts;
    }

    function saveContactToDataBase($first_name,$last_name,$email,$user_id,$city_id){
        global $db_connect;

        $sql = "INSERT INTO contacts(first_name,last_name,email,user_id,city_id)
         VALUES('$first_name','$last_name','$email',$user_id,$city_id)";
        return $res = mysqli_query($db_connect,$sql);
    }

    function findContactByIdInDb($id){
        global $db_connect;

        $sql = "SELECT contacts.*,countries.id as country_id FROM contacts,cities,countries
                    WHERE contacts.id = $id
                    AND contacts.city_id = cities.id 
                    AND cities.country_id = countries.id";

        $res = mysqli_query($db_connect,$sql);

        return $contact = mysqli_fetch_assoc($res);

    }

    function updateContactInDb($first_name,$last_name,$email,$id,$city_id){
        global $db_connect;
       

        $sql = "UPDATE contacts SET first_name = '$first_name', last_name = '$last_name', email = '$email',city_id = $city_id WHERE id = $id ";

        return mysqli_query($db_connect,$sql);
    }

    function deleteContactFromDB($id){

        global $db_connect;

        $sql = "DELETE FROM contacts WHERE id = $id ";

        return mysqli_query($db_connect,$sql);

    }

    function findUserByUsernameAndPassword($username,$password){
        global $db_connect;
        $sql = "SELECT * FROM users WHERE
                    username = '$username' AND 
                    password = '$password'";
        
        $res = mysqli_query($db_connect,$sql);

        return mysqli_fetch_assoc($res);
    }

    function getCountries($searchTerm = ""){
        global $db_connect;

        $sql = "SELECT * FROM countries ORDER BY name";

        if($searchTerm != ""){
            $term = strtolower($searchTerm);
            $sql = "SELECT * FROM countries WHERE lower(name) like '%$term%' ORDER BY name";
        }

        return mysqli_query($db_connect,$sql);
    }

    function getCitiesByCountryFromDb($country_id){
        global $db_connect;
        $sql = "SELECT * FROM cities WHERE country_id = $country_id ORDER BY name";

        return mysqli_query($db_connect,$sql);
    }

    function getCities($searchTerm = ""){
        global $db_connect;

        $sql = "SELECT * FROM cities ORDER BY name";

        if($searchTerm != ""){
            $term = strtolower($searchTerm);
            $sql = "SELECT * FROM cities WHERE lower(name) like '%$term%' ORDER BY name";
        }

        $res =  mysqli_query($db_connect,$sql);

        $cities = [];

        while($row = mysqli_fetch_assoc($res)){
            $cities[] = $row;
        }

        return $cities;
    }

    function findCityById($id){
        global $db_connect;

        $sql = "SELECT * FROM cities WHERE id = $id";

        $res = mysqli_query($db_connect,$sql);

        return mysqli_fetch_assoc($res);
    }

    function updateCityInDB($id,$city_name,$country_id){
        global $db_connect;

        $sql = "UPDATE cities SET name = '$city_name',country_id = '$country_id' WHERE id = $id";

        return mysqli_query($db_connect,$sql);
    }

    function deleteCityInDB($id){
        global $db_connect;

        $sql = "DELETE FROM cities WHERE id = $id";

        return mysqli_query($db_connect,$sql);
    }

    function saveCityInDB($city_name,$country_id){
        global $db_connect;

        $sql = "INSERT INTO cities(name,country_id) VALUES('$city_name',$country_id)";

        return mysqli_query($db_connect,$sql);
    }

    function saveCountryInDB($country_name){
        global $db_connect;

        $sql = "INSERT INTO countries(name) VALUES('$country_name')";

        return mysqli_query($db_connect,$sql);
    }

    function findCountryById($id){
        global $db_connect;

        $sql = "SELECT * FROM countries WHERE id = $id";

        $res = mysqli_query($db_connect,$sql);

        return mysqli_fetch_assoc($res);
    }

    function updateCountryInDB($id,$country_name){
        global $db_connect;

        $sql = "UPDATE countries SET name = '$country_name' WHERE id = $id";

        return mysqli_query($db_connect,$sql);
    }

    function deleteCountryInDB($id){
        global $db_connect;

        $sql = "DELETE FROM countries WHERE id = $id";

        return mysqli_query($db_connect,$sql);
    }

?>