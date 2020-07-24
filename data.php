<html>
<head>
	<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Banquet Data Entry </title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
	<body style = "margin:10px; padding:20px; font-size: 16px;">
		<div class = "container" >


 <div>
   
  <div class="container"><form action = "#" method= "POST">
    <div class="row clearfix">
        <div class="col-md-12 column">
            <table class="table table-bordered table-hover" id="tab_logic">
                <thead>
                    <tr >
                      
                        <th class="text-center">
                           Hall Name
                        </th>
                        <th class="text-center" >
                            Location
                        </th>
                        <th class="text-center" >
                            Guests
                        </th>
                        <th class="text-center" >
                            Pictures
                        </th>
                        <th class="text-center" >
                            Event Type
                        </th>
                        <th class="text-center" >
                            Themes
                        </th>
                        <th class="text-center" >
                            Catering Type
                        </th>
                        <th class="text-center" >
                            Budget
                        </th>
                        <th class="text-center" >
                            Booked Date
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="addr0">
                      
                        <td>
                          <input type="text" name="hallName" class="form-control"/>
                        </td>
                        <td>
                          <input type="text" name="location" class="form-control"/>
                        </td>
                        <td>
                          <input type="number" name="nog" class="form-control"/>
                        </td>
                        <td>
                          <input type="text" name="pictures" class="form-control"/>
                        </td>
                        <td>
                          <input type="text" name="toe" class="form-control"/>
                        </td>
                        <td>
                          <input type="text" name="themes" class="form-control"/>
                        </td>
                        <td>
                          <input type="text" name="ct" class="form-control"/>
                        </td>
                        <td>
                          <input type="number" name="bg" class="form-control"/>
                        </td>
                        <td>
                          <input type="date" name="bd" class="form-control"/>
                        </td>
                       
                    </tr>
                    <tr id="addr1"></tr>
                </tbody>
            </table>
        </div>
    </div>
   <button type = "submit" name = "add" class = "btn btn-default"> Add Row </button>
  <button name="display" class="btn btn-primary" style = "float:right;"> Display </button>
    </form>
    
</div>

</div>

 </div>
<?php
include("db.php");
if (isset($_POST["display"])){
$select = "select * from hall_details";
$result = $conn->query($select);

echo "<center><h3> Displaying all the data </h3></center>";
echo '

<div class= "table-responsive overflow-auto"> 
<table class= "table "> 
<tr> 
<th> ID </th>
<th> Hall Name </th>
<th> Location </th>
<th> Guests </th>
<th> Pictures </th>
<th> EventType </th>
<th> Themes </th>
<th> Catering Type </th>
<th> Budget </th>
<th> Booked Date </th>
</tr>';
if ($result->num_rows > 0){

 while ($row = $result-> fetch_assoc()){
echo '<tr>
<td  id = "hallID">'.$row["hallID"].'</td>
<td  id = "hallName"> '.$row["hallName"]. '</td> 
<td  id = "location"> '.$row["location"]. '</td>
<td  id= "nog">'.$row["numOfGuests"]. '</td>
<td  id="pics">'.$row["pictures"].'</td>
<td  id = "toe">'.$row["typeOfEvent"].'</td>
<td  id="themes">'.$row["themes"].'</td>
<td  id="ct">'.$row["cateringType"].'</td>
<td  id= "bg">'.$row["budget"].'</td>
<td  id="bd">'.$row["booked_date"].'</td>

</td></tr>
';

 }
}
else {
	echo '<tr>
	<td colspan = "4"> Data not found. </td>
	 </tr>';
}


echo'</table>
</div>';
}

?>
</div>

<div> 
    <?php
    include "db.php";
if (isset($_POST["add"])){
 $stmt = $conn->prepare("INSERT INTO hall_details (hallName, location, numOfGuests, pictures, typeOfEvent, themes, cateringType, budget, booked_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
     $stmt->bind_param("sssssssss", $_POST["hallName"] , $_POST["location"], $_POST["nog"], $_POST["pictures"], $_POST["toe"], $_POST["themes"], $_POST["ct"] , $_POST["bg"], $_POST["bd"]);
if ( $stmt->execute()){
     
     $conn->commit();

echo "Successfully entered";}
 
}

    ?>
  
</body>

</html>