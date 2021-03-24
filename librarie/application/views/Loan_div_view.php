	<div class="child">
		<div class="owl-item active">
<div class="material-container" data-reactid=".4.$0.1.$1">
<div class="material-item" data-reactid=".4.$0.1.$1.0">
<a href="#">
<div class="cover"><img id="cover" src="<?php echo base_url('images/books/'.$image);?>">
</div>
</a></div>
<div class="material-description">
<span class="material-title"><?php echo $title; ?></span>
<div class="material-author">
<a href="#"><?php echo $author; ?></a>
</div>
</div>
<?php if(isset($loan_id)){?>
<div class="data-begin">
<?php echo $data_begin; ?>
</div>
<div class="data-end">
<?php echo $data_end; ?>
</div> <?php } else {?>

<form role="form" method="post" action="<?php echo site_url('books/borrow/'.$book_id)?>">
      <input type="submit" name="loan" class="fadeIn fourth"  value="Imprumuta" >
</form>
<?php  }?>
</div>
</div>
</div>


