{{ content() }}

<div class="page-header">
    <h1 align="center">
        Holidays Info
    </h1>
    <p>
        <?php echo $this->tag->linkTo(["holidays/new", "Create A Holiday", 'class'=>'btn btn-success']) ?>
    </p>
</div>

<div class="form-group">
   <ul>
       <?php foreach ($holidays as $holiday) { ?>
           <h4><li><?php echo $holiday->name ?></li></h4>
           <submit> <?php echo $this->tag->linkTo(["holidays/edit/".$holiday->id , "Edit data",'class'=>'btn btn-info']) ?></submit>
       <?php } ?>
   </ul>
</div>