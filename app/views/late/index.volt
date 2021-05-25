{{ content() }}

<div class="page-header">
    <?php foreach ($late as $data) { ?>
    <h2>
        Work starts at <strong><u><?php echo $data->time ?></u></strong> o'clock
    </h2>
    <?php } ?>
</div>
<br>
<div class="form-group">
   <ul>
        <submit><?php echo $this->tag->linkTo(["late/edit/".$data->id , "Set another time",'class'=>'btn btn-info']) ?></submit>
   </ul>
</div>