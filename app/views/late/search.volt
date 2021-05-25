<div class="page-header">
    <h1>
        Search late
    </h1>
    <p>
        <?php echo $this->tag->linkTo(["latecomers", "All latecomers"]) ?>
    </p>
</div>

<?php echo $this->getContent() ?>

<div class="form-group">
   <ul>
       <?php foreach ($late as $late) { ?>
           <li><?php echo $late->time ?></li>
           <button> <?php echo $this->tag->linkTo(["late/edit/".$late->id , "Edit data",'class'=>'btn btn-success']) ?></button>
       <?php } ?>
   </ul>
</div>