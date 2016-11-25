<?php
    //database configuration
    $dbHost = '140.127.220.144';
    $dbUsername = 'kaofaeioun';
    $dbPassword = 'qwerqwer';
    $dbName = 'MICMUSIC';
    
    //connect with the database
    $db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
    
    //get search term
    $searchTerm = $_GET['term'];
    
    //get matched data from skills table
    $query = $db->query("SELECT * FROM User WHERE User_ID LIKE '%".$searchTerm."%' ORDER BY User_ID ASC");
    while ($row = $query->fetch_assoc()) {
        $data[] = $row['User_ID'];
    }
    
    //return json data
    echo json_encode($data);
?>