<?php use Phalcon\Tag; ?>

<div class="col-6">
    {{ link_to("latecomers", '<span class="oi oi-chevron-left" title="chevron-left" aria-hidden="true"></span> Go Back', "class": "btn btn-outline-primary") }}
</div>

<div class="page-header">
    <h1>Search results</h1>
</div>

<?php echo $this->getContent(); ?>

<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
            <th>Employee Name</th>
            <th>Started Time</th>
            <th>Action</th>
            </tr>
        </thead>
            <tbody>
            {% for latecomers in page.items  %}
                    <tr>
                        <td>{{  latecomers.users.name }}</td>
                        <td>{{  latecomers.time }}</td>
                        <td width="12%">{{ link_to("latecomers/delete/" ~ latecomers.id, '<span class="oi oi-x" title="X" aria-hidden="true"></span> Remove', "class": "btn btn-danger btn-sm") }}</td>
                    </tr>
            {% endfor %}
        <tr>
        </tr>
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-sm-1">
        <p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">
            <?php echo $page->current, "/", $page->total_pages ?>
        </p>
    </div>
    <div class="col-sm-11">
        <nav>
            <ul class="pagination">
                <li><?php echo $this->tag->linkTo(["latecomers/search", "First", 'class' => 'page-link']) ?></li>
                <li><?php echo $this->tag->linkTo(["latecomers/search?page=" . $page->before, "Previous", 'class' => 'page-link']) ?></li>
                <li><?php echo $this->tag->linkTo(["latecomers/search?page=" . $page->next, "Next", 'class' => 'page-link']) ?></li>
                <li><?php echo $this->tag->linkTo(["latecomers/search?page=" . $page->last, "Last", 'class' => 'page-link']) ?></li>
            </ul>
        </nav>
    </div>
</div>