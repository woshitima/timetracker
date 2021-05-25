<?php use Phalcon\Tag; ?>

<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous"><?php echo $this->tag->linkTo(["holiday/index", "Go Back"]); ?></li>
            <li class="next"><?php echo $this->tag->linkTo(["holiday/new", "Create "]); ?></li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>Search results</h1>
</div>

<?php echo $this->getContent(); ?>

<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Id</th>
            <th>Name</th>
            <th>Date Of Holiday</th>
            <th>Active</th>

                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($page->items as $holiday): ?>
            <tr>
                <td><?php echo $holiday->id ?></td>
            <td><?php echo $holiday->name ?></td>
            <td><?php echo $holiday->date_holiday ?></td>
            <td><?php echo $holiday->active ?></td>

                <td><?php echo $this->tag->linkTo(["holiday/edit/" . $holiday->id, "Edit"]); ?></td>
                <td><?php echo $this->tag->linkTo(["holiday/delete/" . $holiday->id, "Delete"]); ?></td>
            </tr>
        <?php endforeach; ?>
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
                <li><?php echo $this->tag->linkTo(["holiday/search", "First", 'class' => 'page-link']) ?></li>
                <li><?php echo $this->tag->linkTo(["holiday/search?page=" . $page->before, "Previous", 'class' => 'page-link']) ?></li>
                <li><?php echo $this->tag->linkTo(["holiday/search?page=" . $page->next, "Next", 'class' => 'page-link']) ?></li>
                <li><?php echo $this->tag->linkTo(["holiday/search?page=" . $page->last, "Last", 'class' => 'page-link']) ?></li>
            </ul>
        </nav>
    </div>
</div>