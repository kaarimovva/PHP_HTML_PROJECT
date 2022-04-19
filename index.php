<?php

ob_start();
include 'database.php';
$conn = new database();
$connection = $conn->getConnection();
a:
$sql = "SELECT * FROM table_a";
         $result = $connection->prepare($sql);
         if($result->execute()){
           $row_a = $result->fetchAll();
         }
$sql = "SELECT * FROM table_b";
         $result = $connection->prepare($sql);
         if($result->execute()){
           $row_b = $result->fetchAll();
         }
$sql = "SELECT * FROM table_c";
         $result = $connection->prepare($sql);
         if($result->execute()){
           $row_c = $result->fetchAll();
         }

function tablea(){
  global $row_a;
  for($i = 0; $i<count($row_a); $i++){
    echo "'";
    echo $row_a[$i]['DATA'];
    echo "',";
}
echo "'nullend'";
}

function tableb(){
  global $row_b;
  for($i = 0; $i<count($row_b); $i++){
    echo $row_b[$i]['DATA'];
    echo ",";
}
echo "'nullend'";
}
function tablec(){
  global $row_c;
  for($i = 0; $i<count($row_c); $i++){
    echo "'";
    echo $row_c[$i]['DATA'];
    echo "',";
}
echo "'nullend'";
}
if (isset($_POST['save'])){

  $data1 = $_POST['Input1'];
  $data2 = $_POST['Input2'];
  $data3 = $_POST['Input3'];

$sql = "INSERT INTO `table_a`(`DATA`) VALUES ('$data1');
        INSERT INTO `table_b`(`DATA`) VALUES ('$data2');
        INSERT INTO `table_c`(`DATA`) VALUES ('$data3')";
         $result = $connection->prepare($sql);
         if($result->execute()){
          unset($_POST['save']);
          goto a;
      }


}
 
?>
<html>
    <head>
        <title>Fatima's Page</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <meta charset="utf-8">
        <script type="text/JavaScript">

          function btn1(){
            const datas = [<?php tablea(); ?>] //edval -editing value for editing html page to add bootstrap table :) down is bootstrap script
            edval = `
            <table class="table">
          <thead>
            <tr>
            <th scope="col">#</th>
              <th scope="col">DATA</th>
            </tr>
            <tbody>
            `;
            let i = 0;
            while(datas[i]!="nullend")
            {
                edval = edval+'<tr><th scope="row">'+String(i)+'</th>';
                edval = edval+'<td>'+datas[i]+'</td>'+"\n";
                edval = edval+"</tr>"
                i = i +1;
            }
            edval = edval+'</tbody>';
            document.getElementById("restable").innerHTML = edval;
          }

          function btn2(){
            const datasa = [<?php tablea(); ?>];
            const datasb = [<?php tableb(); ?>];
            const datasc = [<?php tablec(); ?>];
            edval = `
                <table class="table">
              <thead>
                <tr>
                <th scope="col">#</th>
                  <th scope="col">DATAS OF A</th>
                  <th scope="col">DATAS OF B</th>
                  <th scope="col">DATAS OF C</th>
                </tr>
                <tbody>
                `;
                let i = 0;
                while(datasa[i]!="nullend")
                {
                    edval = edval+'<tr><th scope="row">'+String(i)+'</th>';
                    edval = edval+'<td>'+datasa[i]+'</td>'+"\n";
                    edval = edval+'<td>'+String(datasb[i])+'</td>'+"\n";
                    edval = edval+'<td>'+datasc[i]+'</td>'+"\n";
                    edval = edval+"</tr>"
                    i = i +1;
                }
                edval = edval+'</tbody>';
                document.getElementById("restable").innerHTML = edval;
          }

          function btn3(){
            const datasa = [<?php tablea(); ?>];
            const datasb = [<?php tableb(); ?>];
            const datasc = [<?php tablec(); ?>];
            edval = `
                <table class="table">
              <thead>
                <tr>
                <th scope="col">#</th>
                  <th scope="col">DATAS OF C</th>
                  <th scope="col">DATAS OF B</th>
                </tr>
                <tbody>
                `;
                let i = 0;
                while(datasc[i]!="nullend")
                {
                    edval = edval+'<tr><th scope="row">'+String(i)+'</th>';
                    edval = edval+'<td>'+datasc[i]+'</td>'+"\n";
                    edval = edval+'<td>'+String(datasb[i])+'</td>'+"\n";
                    edval = edval+"</tr>"
                    i = i +1;
                }
                edval = edval+'</tbody>';
                document.getElementById("restable").innerHTML = edval;
          }

          function btn4(orderchoice){
            let choicekeyword = "";
            const datasb = [<?php tableb(); ?>];
            if(orderchoice == "1")
            {
              datasb.sort(function(a, b){return a - b});
              choicekeyword = "Ascending";
            }
            if(orderchoice == "2")
            {
              datasb.sort(function(a, b){return b - a});
              choicekeyword = "Descending";
            }
            edval = `
            <table class="table">
          <thead>
            <tr>
            <th scope="col">#</th>
              <th scope="col">DATA in `+choicekeyword+`</th>
            </tr>
            <tbody>
            `;
            let i = 0;
            while(datasb[i]!="nullend")
            {
                edval = edval+'<tr><th scope="row">'+String(i)+'</th>';
                edval = edval+'<td>'+datasb[i]+'</td>'+"\n";
                edval = edval+"</tr>"
                i = i +1;
            }
            edval = edval+'</tbody>';
            document.getElementById("restable").innerHTML = edval;
          }
        </script>

      </head>

    <body>
       
 
            <form method = "post" action="index.php">
                <div class="form-group">
                  <label for="InputLabel1">Data</label>
                  <input type="text" class="form-control" name="Input1"  placeholder="Enter data..">
                </div>
                <div class="form-group">
                  <label for="InputLabel2">Number</label>
                  <input type="number" class="form-control" name="Input2" placeholder="Enter data..">
                </div>
                <div class="form-group">
                    <label for="InputLabel1">Data</label>
                    <input type="text" class="form-control" name="Input3"  placeholder="Enter data..">
                  </div>
                <button type="submit" class="btn btn-primary" name = "save">Save</button>
              </form>
              <button class="btn btn-primary" onclick="btn1()">SEE TABLE A</button>
              <button class="btn btn-primary" onclick="btn2()">SEE TABLE ABC</button>
              <button class="btn btn-primary" onclick="btn3()">SEE TABLE CB</button>
              <button class="btn btn-primary" onclick="btn4(1)">SEE TABLE B ASC</button>
              <button class="btn btn-primary" onclick="btn4(2)">SEE TABLE B DESC</button>
              <div id="restable" class = "text-centered" style="margin-top:7%;"> 
              </div>          
  </body>  
    </html>

<?php

file_put_contents('index.html', ob_get_clean());
header("Location: index.html");
?>