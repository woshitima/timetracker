<div class=container>
    <ul class="pager">
        <li class="previous pull-left">
            {{ link_to("users/workedhours/" ~ userId, '<span class="oi oi-chevron-left" title="chevron-left" aria-hidden="true"></span> Go Back', "class": "btn btn-outline-primary") }}
        </li>
    </ul>
{{ form('save', 'role': 'form') }}
    <h2>Edit user's worked hours data</h2>

    <fieldset>
        {% for element in form %}
                <div class="form-group">
                    {{ element.label() }}
                    {{ element.render(['class': 'form-control']) }}
                </div>

        {% endfor %}
        <div class="form-group">
                    {{ submit_button('Save', 'class': 'btn btn-info btn') }}
                </div>
    </fieldset>
    {{ content() }}
    </div>
{{  endform() }}