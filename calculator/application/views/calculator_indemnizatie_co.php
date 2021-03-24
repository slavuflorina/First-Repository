<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Calculator indemnizatie</title>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style type="text/css">
  
    ::selection { background-color: #E13300; color: white; }
    ::-moz-selection { background-color: #E13300; color: white; }

    body {
        background-color: #fff;
        margin: 40px;
        font: 13px/20px normal Helvetica, Arial, sans-serif;
        color: #4F5155;
    }

    </style>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript"></script>

 <script type="text/javascript">
   
    var zileLucratoare=new Array(20,20,21,20,22,19,23,21,21,23,21,20,20,20,22,20,20,20,23,21,22,22,20,21);
     
	function selectLuni()
	{
		var numarLuna = document.getElementById("selectMonth").selectedIndex;
		if(numarLuna-2<0) arr[numarLuna-2]="";
  if(numarLuna-3<0) arr[numarLuna-3]="";
  if(numarLuna-4<0) arr[numarLuna-4]="";
  document.getElementById("mnth1").innerHTML = arr[numarLuna-2];
  document.getElementById("mnth2").innerHTML = arr[numarLuna-3];
  document.getElementById("mnth3").innerHTML = arr[numarLuna-4];
  document.getElementById("luna1").innerHTML = arr[numarLuna-2];
  document.getElementById("luna2").innerHTML = arr[numarLuna-3];
  document.getElementById("luna3").innerHTML = arr[numarLuna-4];
	}
	 
 function calculDrepturiSalariale()
 {
 	var numarLuna = document.getElementById("selectMonth").selectedIndex;
 	if(arr[numarLuna-2]!=="" && arr[numarLuna-3]!=="" && arr[numarLuna-4]!==""){
     var nrZileLucrateLuna1 = document.getElementById('nrzilelucrateluna1').value;
     var nrZileLucrateLuna2 = document.getElementById('nrzilelucrateluna2').value;
     var nrZileLucrateLuna3 = document.getElementById('nrzilelucrateluna3').value;
     var nrZileLucrate = parseInt(nrZileLucrateLuna1) + parseInt(nrZileLucrateLuna2) + parseInt(nrZileLucrateLuna3);
   
     var drepturiLuna1 = document.getElementById('drepturiluna1').value;
     var drepturiLuna2 = document.getElementById('drepturiluna2').value;
     var drepturiLuna3 = document.getElementById('drepturiluna3').value;
     var drepturi = parseInt(drepturiLuna1) + parseInt(drepturiLuna2) + parseInt(drepturiLuna3);
  
   
    var valoare = drepturi/nrZileLucrate;
    var nrZileIndemnizatie = document.getElementById('nrzileindemnizatie').value;
    var indemnizatie = Math.round(valoare*nrZileIndemnizatie);
    var drepturiLunaRespectiva = document.getElementById('drepturisalariale').value;
    
    
    var salariuPerioadaConcediu=drepturiLunaRespectiva/zileLucratoare[numarLuna-1]*nrZileIndemnizatie;
    var valoareIndemnizatie = Math.max(indemnizatie,parseInt(salariuPerioadaConcediu));
   
    if(!isNaN(parseFloat(valoareIndemnizatie)))
        document.getElementById("indemnizatieco").innerHTML = valoareIndemnizatie + " lei";
    else document.getElementById("indemnizatieco").innerHTML = "";
    }
 }
 
 function windowOpen()
 {
     alert("Salariul de baza, indemnizatiile si sporurile cu caracter permanent");
 }
 
 </script>
</head>
<body>
<h1 align="center" style="color: #444; background-color: transparent; border-bottom: 1px solid #D0D0D0; font-size: 19px; font-weight: normal; margin: 0 0 14px 0; padding: 14px 15px 10px 15px;">Calculator pentru indemnizatie concediu de odihna</h1>
    <div class="row justify-content-center" >
<div  style="border-radio: 5px; background-color: #F5F5F5; padding: 20px; border: 1px solid #B8C7D4;  height: auto;  font-size: 14px; font-weight: bold; font-family: Helvetica Neue,Helvetica,Arial,sans-serif; line-height: 1.42857143;">
            <div class="row">
                <div class="col-md-12">
                        <form action="" method="POST" class="form-horizontal">
                       <table><tr>
                          
        <td><label for="lunaAcordarii"  style="text-align:left;">Luna acordarii:</label></td>
        <td><div class="form-group" style="margin-bottom: 10px !Important">
    <select id='selectMonth' class="custom-select my-1 mr-sm-2" style="padding-right: 0; padding-left: 0;" onchange="selectLuni()">
	<option value="default">-- Selectati luna --</option>
    </select> </td>
    </div>
    </tr>
   <script>
		   var select = document.getElementById("selectMonth"),
                     arr = ["Ianuarie 2019", "Februarie 2019", "Martie 2019", "Aprilie 2019", "Mai 2019", "Iunie 2019", "Iulie 2019", "August 2019", "Septembrie 2019", "Octombrie 2019", "Noiembrie 2019", "Decembrie 2019", "Ianuarie 2020", "Februarie 2020", "Martie 2020", "Aprilie 2020", "Mai 2020", "Iunie 2020", "Iulie 2020", "August 2020", "Septembrie 2020", "Octombrie 2020", "Noiembrie 2020", "Decembrie 2020"];
             
             for(var i = 0; i < arr.length; i++)
             {
                 var option = document.createElement("option"),
                     txt = document.createTextNode(arr[i]);
                 option.appendChild(txt);
                 option.setAttribute("value",arr[i]);
                 select.insertBefore(option,select.lastChild);
             }
			
   </script>
<tr><td><div class="form-group" style="margin-bottom: 10px !Important">
    <label for="nrzileindemnizatie">Nr. zile indemnizatie:</label></td>
    <td><input type="text" class="form-control" id="nrzileindemnizatie" required>
</label></div></td>
</tr>

<tr><td><label for="firstmonth" onclick="windowOpen()" style="color: #0000FF;">Drepturi salariale&nbsp;</label><span id="mnth1" style="color: #FF0000;"> Luna 1 </span></td>
    <td><input type="text" class="form-control" id="drepturiluna1" required></td>
    </tr>
   
   
    <tr><td><label for="secondmonth">Drepturi salariale&nbsp;</label><span id="mnth2" style="color: #FF0000;"> Luna 2 </span></td>
    <td><input type="text" class="form-control" id="drepturiluna2" required></td>
    </tr>
   
    <tr><td><label for="thirdmonth">Drepturi salariale&nbsp;</label><span id="mnth3" style="color: #FF0000;"> Luna 3 </span></td>
    <td><input type="text" class="form-control" id="drepturiluna3" required></td>
    </tr>

   
    <tr><td><div><label for="nrzilelucrateluna1">Numar zile lucrate&nbsp;</label><span id="luna1" style="color: #FF0000;"> Luna 1 </span></div></td>
    <td><div class="form-group" style="margin-bottom: 10px !Important">
    <input type="text" class="form-control" id="nrzilelucrateluna1" required>
</label></div></td>
</tr>

     <tr><td><div><label for="nrzilelucrateluna2">Numar zile lucrate&nbsp;</label><span id="luna2" style="color: #FF0000;"> Luna 2 </span></div></td>
     <td><div class="form-group" style="margin-bottom: 10px !Important">
    <input type="text" class="form-control" id="nrzilelucrateluna2" required>
</label></div></td>
</tr>

     <tr><td><div><label for="nrzilelucrateluna3">Numar zile lucrate&nbsp;</label><span id="luna3" style="color: #FF0000;"> Luna 3 </span></div></td>
     <td><div class="form-group" style="margin-bottom: 10px !Important">
    <input type="text" class="form-control" id="nrzilelucrateluna3" required></div></td>
    </tr>
   
    <tr><td><div><label for="drepturisalariale"><span onclick="windowOpen()" style="color:#0000FF;">Drepturi salariale</span> pentru luna acordării&nbsp;</label><span id="drepturi"> </span></div></td>
     <td><div class="form-group" style="margin-bottom: 10px !Important">
    <input type="text" class="form-control" id="drepturisalariale" required></div></td>
    </tr>
    <tr><td><div><label for="indemnizatieco">Indemnizatie CO</label></div></td>
     <td  align="center" style="box-sizing: border-box; border: solid #0000FF 1px; "><div><span id="indemnizatieco"> </span></div></td>
    </tr>
   
    <tr>
        <td>
            <button type="button" class="btn btn-primary" name="submit" onclick="calculDrepturiSalariale()">Calculeaza</button>
        </td>
        <td></td>
    </tr>
</label></div>
</table>    
</form>
</div>
</div>
</div>
</div>
</body>
</html>