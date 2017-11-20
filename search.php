<?php
#search the livesearch database
$db_host = 'localhost';
$db_username = 'username';
$db_password = 'password';
$db_name = 'livesearch';
$connection = mysqli_connect($db_host, $db_username, $db_password, $db_name);
$output = "";
if(isset($_POST['query'])){
    $query = htmlspecialchars($_POST['query']);
    $search = mysqli_real_escape_string($connection, $query);
    $sql = "SELECT * FROM sites 
    WHERE name LIKE '%".$search."%'
    OR url LIKE '%".$search."%'
    OR type LIKE '&".$search."&'";
}else{
    $sql = "SELECT * FROM sites ORDER BY name ASC";
}

$sqlResult = mysqli_query($connection, $sql);
if(mysqli_num_rows($sqlResult) > 0){
    $output .= '
    <div class="results-table">
     <table>
      <tr>
       <th>Site Name</th>
       <th>Site URL</th>
       <th>Site Type</th>
      </tr>';
    while($row=mysqli_fetch_array($sqlResult)){
        $output .= '
        <tr>
         <td>'.$row['name'].'</td>
         <td><a href='.$row['url'].'target="_blank">'.$row['url'].'</a></td>
         <td>'.$row['type'].'</td>
        </tr>';
    }
    
    echo $output;
}else{
    echo '<div class="results">No Data Found</div>';
}
?>