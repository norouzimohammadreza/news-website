<?php
require_once(BASE_PATH . '/template/admin/layout/header.php');


?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h5"><i class="fas fa-newspaper"></i> Articles</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a role="button" href="<?= url('admin/post/create'); ?>" class="btn btn-sm btn-success">create</a>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <caption>List of posts</caption>
        <thead>
            <tr>
                <th>#</th>
                <th>title</th>
                <th>summary</th>
                <th>view</th>
                <th>status</th>
                <th>user ID</th>
                <th>cat ID</th>
                <th>image</th>
                <th>setting</th>
            </tr>
        </thead>

        <tbody>

            <?php
            $c = 0;
            foreach ($posts as $post) { ?>
                <tr>
                    <td>
                        <a class="text-primary" href="">
                            <?= ++$c; ?>
                        </a>
                    </td>
                    <td>
                        <?= $post['title']; ?>
                    <td><?= substr($post['summary'], 0, 20); ?> </td>
                    <td>
                        <?= $post['view']; ?>
                    </td>
                    <td><?php if ($post['breaking_news'] == 1) { ?>
                            <span class="badge badge-success">#breaking_news</span>
                        <?php } ?>
                        <?php if ($post['selected'] == 1) { ?>
                            <span class="badge badge-dark" >#editor_selected</span>
                        <?php } ?>

                    </td>
                    <td>
                        <?= $post['user_id']; ?>
                    </td>
                    <td>
                        <?= $post['cat_id']; ?>
                    </td>
                    <td><img style="width: 80px;" src="<?= asset($post['image']) ?>" alt=""></td>
                    <td style="width: 25rem;">
                        <a role="button" class="btn btn-sm btn-warning btn-dark text-white" href="<?= url('admin/post/breaking-news'.'/'.$post['id']); ?>">
                        <?php if ($post['breaking_news'] == 1) { ?> remove breaking news <?php } else {  ?> add breaking news <?php } ?>
                        </a>
                        <a role="button" class="btn btn-sm btn-warning btn-dark text-white" href="<?= url('admin/post/selected'.'/'.$post['id']); ?>">
                            <?php if ($post['selected'] == 1) { ?> remove selcted <?php } else {  ?> add selected <?php } ?>
                        </a>
                        <hr class="my-1" />
                        <a role="button" class="btn btn-sm btn-primary text-white" href="<?= url('admin/post/edit').'/'.$post['id']; ?>">edit</a>
                        <a role="button" class="btn btn-sm btn-danger text-white" href="<?= url('admin/post/delete').'/'.$post['id']; ?>">delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>

    </table>
</div>
<?php
require_once(BASE_PATH . '/template/admin/layout/footer.php');


?>