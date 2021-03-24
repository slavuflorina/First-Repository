<?php
class product {

	protected $idProduct;
	protected $nameProduct;
	protected $priceProduct;
	protected $typeProduct;
	protected $quantityProduct;
	protected $descriptionProduct;
	protected $image;

	public function setIdProduct($idProduct) {
		$this -> idProduct = $idProduct;
	}

	public function getIdProduct() {
		return $this -> idProduct;
	}

	public function setNameProduct($nameProduct) {
		$this -> nameProduct = $nameProduct;
	}

	public function getNameProduct() {
		return $this -> nameProduct;
	}

	public function setPriceProduct($priceProduct) {
		$this -> priceProduct = $priceProduct;
	}

	public function getPriceProduct() {
		return $this -> priceProduct;
	}

	public function setTypeProduct($typeProduct) {
		$this -> typeProduct = $typeProduct;
	}

	public function getTypeProduct() {
		return $this -> typeProduct;
	}

	public function setQuantityProduct($quantityProduct) {
		$this -> quantityProduct = $quantityProduct;
	}

	public function getQuantityProduct() {
		return $this -> quantityProduct;
	}

	public function setDescriptionProduct($descriptionProduct) {
		$this -> descriptionProduct = $descriptionProduct;
	}

	public function getDescriptionProduct() {
		return $this -> descriptionProduct;
	}

	public function setImage($image) {
		$this -> image = $image;
	}

	public function getImage() {
		return $this -> image;
	}

}
?>