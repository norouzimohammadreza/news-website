<?php
require_once(BASE_PATH . '/template/admin/layout/header.php');
?>
<section class="pt-3 pb-1 mb-2 border-bottom">
    <h1 class="h5">Edit Category</h1>
</section>
<section class="row my-3">
    <section class="col-12">
        <form method="post" action="<?=url('admin/category/update').'/'. $category['id']?>">
            <div class="form-group">
                <label for="name">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= $category['title'] ?>">
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Update</button>
        </form>
    </section>
    <?php
require_once(BASE_PATH .'/template/admin/layout/footer.php');
?>