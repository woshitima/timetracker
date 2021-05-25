{{ content() }}
<div class="col-6">
    {{ link_to("index", '<span class="oi oi-chevron-left" title="chevron-left" aria-hidden="true"></span> Go Back', "class": "btn btn-outline-primary") }}
</div>
<br>
<form action="index" method="GET">
    <div class="col-sm-6">
        <select name="month" onchange="this.form.submit();" class="col-sm-6">
            <option value="all" selected="selected">All</option>
            <option value="1">January</option>
            <option value="2">February</option>
            <option value="3">March</option>
            <option value="4">April</option>
            <option value="5" selected="selected">May</option>
            <option value="6">June</option>
            <option value="7">July</option>
            <option value="8">August</option>
            <option value="9">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>&nbsp;&nbsp;&nbsp;&nbsp;
        <select name="year" onchange="this.form.submit();" class="col-sm-6">
            <option value="2014">2014</option>
            <option value="2015">2015</option>
            <option value="2016">2016</option>
            <option value="2017">2017</option>
            <option value="2018">2018</option>
            <option value="2019">2019</option>
            <option value="2020">2020</option>
            <option value="2021" selected="selected">2021</option>
        </select>&nbsp;&nbsp;&nbsp;&nbsp;
    </div>
</form>
<input id="id" type="hidden" name="id" value=""/>
<br>
<div>
   <a>This month you are assigned <strong><?php echo $numberOfWorkingHours;?></strong> work hours. </a><br>
   <a>You have to be at work at <strong><?php echo $setTime ?></strong> o'clock.</a><br>
   <a>Total time worked: <strong>15</strong> </a><br>
   <a>Being late at work too frequently can lead to particular unpleasant consequences.</a>
</div>
<br>





<div >
    <input id="id" class="btn btn-dark" type="hidden" name="id" value="">
    <input id="timerbutton" class="btn btn-info"  type="button" name="timerbutton" value="start"/>
</div>
<br>
<table class="table table-bordered">
    <thead>
    <tr>
        <td width="5%">
            Date
        </td>
        <td width="7%">
            Weekday
        </td>
        {% for user in users %}
        <th scope="row">{{ user.name }}</th>
        {% endfor %}
    </tr>
    </thead>
    <tbody>

    {% for  dateTime in dates %}

    <tr>
        <td style="background-color:#66bf79">
            <?php echo intval(date('d', strtotime($dateTime))); ?>
        </td>
        <td style="background-color:#66bf79">
            <?php echo date('l', strtotime($dateTime)); ?>
        </td>
            <?php foreach ($users as $user){ ?>
        <td>
            <?php foreach ($user->times as $workTime) { ?>
            <?php if ($dateTime == $workTime->date && $workTime->user_id == $userId) { ?>
            <div>
                <?php echo $workTime->start_time . " : " . $workTime->end_time . "<br>" ; ?>
<!--                     echo "<p> Total time: " . $workTime->total_time . " </p>"; ?> -->
            <?php } ?>

            <?php } ?>
        </td>
        <?php } ?>
    </tr>
    {% endfor %}
    </tbody>
</table>