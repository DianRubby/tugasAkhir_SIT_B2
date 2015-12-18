<?php

require_once('nusoap/lib/nusoap.php');
$server = new soap_server();

// registrasi method
$server->register('search');
$server->register('getTb');

function getTb(){
     mysql_connect("localhost","root","");
     mysql_select_db("kemendag");

     $result=mysql_query(("SELECT * FROM perdagangan"));
     $index=0;

     while ($data=mysql_fetch_array($result)){

     $tblist[$index]=array(
     "id"=>$data['id'],
     "name"=>$data['name'],
     "price"=>$data['price'],
     "date"=>$data['date']
     );
     $index++;
     }

     mysql_close();
     return $tblist;
}


function search($key) {
     mysql_connect('localhost', 'root', '');
     mysql_select_db('kemendag');

     $query = "SELECT * FROM perdagangan WHERE id = '$key' OR name LIKE '%$key%' OR price LIKE '%$key%' OR 'date' LIKE '%$key%'";
     $hasil = mysql_query($query);
     while ($data = mysql_fetch_array($hasil))
     {
          $result[] = array('id' => $data['id'], 'name' => $data['name'],'price' => $data['price'], 'date' => $data['date']);
     }
     return $result;

}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>