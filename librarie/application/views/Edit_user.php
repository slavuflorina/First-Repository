<form>
<?php 	if($this->session->status == 1) {?>
<div class="form-group">
    <label for="exampleInputId">Id</label>
    <input type="text" class="form-control" id="exampleInputId" placeholder="Id" >
</div> <? } ?>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">

  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <?php 	if($this->session->status == 1) {?>
  <select class="browser-default custom-select">
  <option value="0">One</option>
  <option value="1">Two</option>
</select><? } ?>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>