
<div class="col-6">
    {{ link_to("holidays", '<span class="oi oi-chevron-left" title="chevron-left" aria-hidden="true"></span> Go Back', "class": "btn btn-outline-primary") }}
</div>

<div class="page-header">
    <h1>
        Create holiday
    </h1>
</div>

<?php echo $this->getContent(); ?>

<?php
    echo $this->tag->form(
        [
            "holidays/create",
            "autocomplete" => "off",
            "class" => "form-horizontal"
        ]
    );
?>

<div class="form-group">
    <label for="fieldName" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(["name", "class" => "form-control", "id" => "fieldName"]) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldDateHoliday" class="col-sm-2 control-label">Day</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(["day", "type" => "date", "class" => "form-control", "id" => "fieldDateHoliday"]) ?>
    </div>
</div>
<div class="form-group">
    <label for="fieldDateHoliday" class="col-sm-2 control-label">Month</label>
    <div class="col-sm-10">
        <?php echo $this->tag->textField(["month", "type" => "date", "class" => "form-control", "id" => "fieldDateHoliday"]) ?>
    </div>
</div>

<div class="form-group">
    <label for="fieldActive" class="col-sm-2 control-label">Active</label>
    <div class="col-sm-10">
        <?php echo $this->tag->selectStatic(["active", ['Y','N'], "class" => "form-control", "id" => "fieldActive"]) ?>
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <?php echo $this->tag->submitButton(["Save", "class" => "btn btn-default"]) ?>
    </div>
</div>

<?php echo $this->tag->endForm(); ?>