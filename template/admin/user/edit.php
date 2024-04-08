<?php
require_once(BASE_PATH . '/template/admin/layout/header.php');
?>
<section class="pt-3 pb-1 mb-2 border-bottom">
        <h1 class="h5">Edit User</h1>
    </section>

<section class="row my-3">
    <section class="col-12">

        <form method="post" action="<?= url('admin/user/update'. '/'.$user['id']) ?>" >
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>">
        </div>

        <div class="form-group">
            <label for="permission">permission</label>
            <select name="is_admin" id="is_admin" class="form-control" required autofocus>
                        <option value="<?= 0 ?>" <?php if($user['is_admin']==0) echo 'selected' ?>  >User</option>
                        <option value="<?= 1 ?>" <?php if($user['is_admin']==1) echo 'selected' ?>  >Admin</option>
                </select>
        </div>
        <button type="submit" class="btn btn-primary btn-sm">update</button>
        </form>

        </section>
        </section>

<?php
require_once(BASE_PATH . '/template/admin/layout/footer.php');
?>