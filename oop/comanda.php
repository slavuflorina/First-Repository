<script>
function calculate(){
 var quantityProduct = document.getElementById("quantityProduct");
 var priceProduct = document.getElementById("priceProduct");
 var item_priceProduct = parseFloat(quantityProduct * priceProduct);
 if(!isNaN(parseFloat(item_priceProduct)))
 document.getElementById("item_priceProduct").innerHTML =  item_priceProduct;
  }
</script>
<?php
include 'header.php';

$idProduct = $_GET['idProduct'];
$_POST["quantityProduct"] = 1;

	
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		//if(!empty($_POST["quantity"])) {
			$sql = "SELECT * FROM product where idProduct = ".$idProduct;
			$result = $execute -> query($sql);
			while ($row = $result -> fetch_assoc())
			$productById[] = $row;
		
			$itemArray = array($productById[0]["idProduct"]=>array('nameProduct'=>$productById[0]["nameProduct"], 'idProduct'=>$productById[0]["idProduct"], 'quantityProduct'=> $_POST["quantityProduct"], 'priceProduct'=>$productById[0]["priceProduct"], 'image'=>$productById[0]["image"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productById[0]["idProduct"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productById[0]["idProduct"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantityProduct"])) {
									$_SESSION["cart_item"][$k]["quantityProduct"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantityProduct"] += $_POST["quantityProduct"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		//}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["idProduct"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}

?>
<head>
<style>
body {
	font-family: Arial;
	color: #211a1a;
	font-size: 0.9em;
}

#shopping-cart {
	margin: 40px;
}

#product-grid {
	margin: 40px;
}

#shopping-cart table {
	width: 100%;
	background-color: #F0F0F0;
}

#shopping-cart table td {
	background-color: #FFFFFF;
}

.txt-heading {
	color: #211a1a;
	border-bottom: 1px solid #E0E0E0;
	overflow: auto;
}

#btnEmpty {
	background-color: #ffffff;
	border: #d00000 1px solid;
	padding: 5px 10px;
	color: #d00000;
	float: right;
	text-decoration: none;
	border-radius: 3px;
	margin: 10px 0px;
}

.btnAddAction {
    padding: 5px 10px;
    margin-left: 5px;
    background-color: #efefef;
    border: #E0E0E0 1px solid;
    color: #211a1a;
    float: right;
    text-decoration: none;
    border-radius: 3px;
    cursor: pointer;
}

#product-grid .txt-heading {
	margin-bottom: 18px;
}

.product-item {
	float: left;
	background: #ffffff;
	margin: 30px 30px 0px 0px;
	border: #E0E0E0 1px solid;
}

.product-image {
	height: 155px;
	width: 250px;
	background-color: #FFF;
}

.clear-float {
	clear: both;
}

.demo-input-box {
	border-radius: 2px;
	border: #CCC 1px solid;
	padding: 2px 1px;
}

.tbl-cart {
	font-size: 0.9em;
}

.tbl-cart th {
	font-weight: normal;
}

.product-title {
	margin-bottom: 20px;
}

.product-priceProduct {
	float:left;
}

.cart-action {
	float: right;
}

.product-quantityProduct {
    padding: 5px 10px;
    border-radius: 3px;
    border: #E0E0E0 1px solid;
}

.product-tile-footer {
    padding: 15px 15px 0px 15px;
    overflow: auto;
}

.cart-item-image {
	width: 30px;
    height: 30px;
    border-radius: 50%;
    border: #E0E0E0 1px solid;
    padding: 5px;
    vertical-align: middle;
    margin-right: 15px;
}
.no-records {
	text-align: center;
	clear: both;
	margin: 38px 0px;
}</style>
</head>
<div id="shopping-cart">
<div class="txt-heading">Shopping Cart</div>

<a id="btnEmpty" href="comanda.php?action=empty?idProduct='" . $row['idProduct'] . "'">Empty Cart</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantityProduct = 0;
    $total_priceProduct = 0;
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">nameProduct</th>
<th style="text-align:left;">idProduct</th>
<th style="text-align:right;" width="5%">quantityProduct</th>
<th style="text-align:right;" width="10%">Unit priceProduct</th>
<th style="text-align:right;" width="10%">priceProduct</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        //$item_priceProduct = $item["quantityProduct"]*$item["priceProduct"];
		?>
				<tr>
				<td><img src="productImage/<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["nameProduct"]; ?></td>
				<td><?php echo $item["idProduct"]; ?></td>
				<td style="text-align:right;"><input type="text" onclick="calculate()" name="quantityProduct" style="text-align:right;" id="quantityProduct" value="<?php echo $item["quantityProduct"]; ?>" /></td>
				<td  style="text-align:right;"><input type="text" name="priceProduct" style="text-align:right;" id="priceProduct" value="<?php echo $item["priceProduct"]; ?>" readonly /></td>
				<td  style="text-align:right;"><div><span id="item_priceProduct"></span></div></td>
				<td style="text-align:center;"><a href="comanda.php?action=remove&idProduct=<?php echo $item["idProduct"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantityProduct += $item["quantityProduct"];
				$total_priceProduct += ($item["priceProduct"]*$item["quantityProduct"]);
		}
		?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantityProduct; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_priceProduct, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>		
  <?php
} else {
?>
<div class="no-records">Your Cart is Empty</div>
<?php 
}
?>
</div>


