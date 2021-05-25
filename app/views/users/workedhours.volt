<div class=container>
<ul class="pager">
        <li class="previous pull-left">
            {{ link_to("users/search", '<span class="oi oi-chevron-left" title="chevron-left" aria-hidden="true"></span> Go Back', "class": "btn btn-outline-primary") }}
        </li>
    </ul>

<h1>List of times by user</h2>

<th id="test"></th>
<table class="table table-bordered table-striped" align="center">
    <tr>
        <th>Start time</th>
        <th>End time</th>
        <th>Date</th>
        <th>Action</th>
    </tr>


    {% for time in user.times %}
    <tr>
        <td>{{time.start_time}} </td>
        <td>{{time.end_time}}</td>
        <td>{{time.date}}</td>

    <td width="12%">
        {{ link_to("users/update/" ~ time.id, '<span class="oi oi-pencil" title="pencil" aria-hidden="true"></span> Edit', "class": "btn btn-warning btn-sm") }}
    </td>
    </tr>
    {% endfor %}
</table>
{{ content() }}
</div>

<script>
$( document ).ready(function() {
    $('#select-month').val('{{getMonth}}').attr('selected','selected');
    $('#select-year').val('{{getYear}}').attr('selected','selected');
});
    $('#select-month').change(function(){
        var month = $(this).val();
        console.log(month);
        var year = $('#select-year').val();
          location.assign('/time/index/{{ userId }}?month='+month+ '&year='+year);
    });
    $('#select-year').change(function(){
            var month = $('#select-month').val();
            var year = $(this).val();
              location.assign('/time/index/{{ userId }}?month='+month + '&year='+year);
        });
</script>