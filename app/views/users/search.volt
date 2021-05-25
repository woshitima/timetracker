{{ content() }}

<div class="row mb-4">
    <div class="col-6">
        {{ link_to("users/index", '<span class="oi oi-chevron-left" title="chevron-left" aria-hidden="true"></span> Go Back', "class": "btn btn-outline-primary") }}
    </div>
    <div class="col-6 text-right">
        {{ link_to("users/create", '<span class="oi oi-plus" title="plus" aria-hidden="true"></span> Create User', "class": "btn btn-success") }}
    </div>
</div>

<div class="table-responsive">
    {% for user in page.items %}
        {% if loop.first %}
            <table class="table table-bordered table-striped" align="center">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Profile</th>
                        <th>Active?</th>
                        <th>Productivity Info</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                {% endif %}
                <tr>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.profile.name }}</td>
                    <td>{{ user.active == 'Y' ? 'Yes' : 'No' }}</td>
                    <td width="12%">{{ link_to("workedhours/" ~ user.id, '<span class="oi oi-clock" title="clock" aria-hidden="true"></span> Worked Time', "class": "btn btn-info btn-sm") }}</td>
                    <td width="12%">{{ link_to("edit/" ~ user.id, '<span class="oi oi-pencil" title="pencil" aria-hidden="true"></span> Edit', "class": "btn btn-warning btn-sm") }}</td>
                </tr>
                {% if loop.last %}
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="10" class="text-right">
                            <ul class="pagination mb-0">
                                <li class="page-item">
                                    {{ link_to("search", '<span class="oi oi-media-skip-backward" title="skip backward" aria-hidden="true"></span> First', "class": "page-link") }}
                                </li>
                                <li class="page-item">
                                    {{ link_to("users/search?page=" ~ page.before, '<span class="oi oi-media-step-backward" title="step backward" aria-hidden="true"></span> Previous', "class": "page-link") }}
                                </li>
                                <li class="page-item disabled">
                                    {{ link_to("#", page.current ~ "/" ~ page.total_pages, "class":"page-link") }}
                                </li>
                                <li class="page-item">
                                    {{ link_to("search?page=" ~ page.next, '<span class="oi oi-media-step-forward" title="step forward" aria-hidden="true"></span> Next', "class": "page-link") }}
                                </li>
                                <li class="page-item">
                                    {{ link_to("search?page=" ~ page.last, '<span class="oi oi-media-skip-forward" title="skip forward" aria-hidden="true"></span> Last', "class": "page-link") }}
                                </li>

                            </ul>
                        </td>
                    </tr>
                </tfoot>
            </table>
        {% endif %}
    {% else %}
        No users are recorded
    {% endfor %}
</div>