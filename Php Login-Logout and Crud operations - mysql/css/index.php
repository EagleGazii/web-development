<?php
    header("Content-type: text/css");

?>

a {
    text-decoration: none;
}

ul li{
    width: 120px;
    list-style: none;
    float:left;
    border: 1px #ff0000 solid;
    padding: 10px;
    margin: 0 10px 10px 10px;
    transition: font-size 0.3s linear ;
    -o-transition: font-size 0.3s linear ;
    -webkit-transition: font-size 0.3s linear ;
    -moz-transition: font-size 0.3s linear ;
    text-align: center;
}
ul li:hover{
    font-size: 20px;
}

h1{
    text-align: center;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: center;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #ffffff;
}

form {
    width:300px;
    margin: 20px auto;
   

}
p{
    text-align:center;
}

form label, form a, form input[type="submit"]{
    display:block;
    float:left;
    margin-bottom: 10px;
}
form input[type="text"]{
    display:block;
    float:right;
    margin-bottom: 10px;
}
.clear{
    clear:both;
}