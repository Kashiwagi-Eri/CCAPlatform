<?php

function get_coach_profile(){
    require_once 'db_conn.php';
    $conn = get_conn();
    // how to connect mysql fast
    $get_coach_profile= "select name, industries, detail, img, career from cca.coach";
    $result = $conn->query($get_coach_profile);
    // example even for multiple rows
    
    if (!$result) {
        printf("Error: %s\n", mysqli_error($con));
        exit();
    }
    $ret = array();
    
    while ($row = mysqli_fetch_assoc($result))
    {
    $tmp = array();
    $tmp["name"] = $row['name'];
    $tmp["industries"] = $row['industries'];
    $tmp["detail"] = $row['detail'];
    $tmp["img"] = $row['img'];
    $tmp["career"] = $row['career'];
    $ret[] = $tmp;
    }
    //last row returned
    #print_r($ret);
    return $ret;
}

?>