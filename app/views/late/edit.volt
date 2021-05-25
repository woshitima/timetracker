<div class="row">
    <nav>
        <div class="col-6">
            {{ link_to("late", '<span class="oi oi-chevron-left" title="chevron-left" aria-hidden="true"></span> Go Back', "class": "btn btn-outline-primary") }}
        </div>
    </nav>
</div>

<div class="page-header">
    <h1>
        Edit start time
    </h1>
</div>

<?php
    echo $this->tag->form(
        [
            "late/save",
            "autocomplete" => "off",
            "class" => "form-horizontal"
        ]
    );
?>

<div class="form-group">
    <label for="fieldTime" class="control-label">Set time to be present at work</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(["time","size" => 30, "class" => "form-control", "id" => "fieldTime"]) ?>
    </div>
</div>


<?php echo $this->tag->hiddenField("id") ?>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php echo $this->tag->submitButton(["Save", "class" => "btn btn-success"]) ?>
    </div>
</div>

<?php echo $this->tag->endForm(); ?>