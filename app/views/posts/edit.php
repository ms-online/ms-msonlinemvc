<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i>返回</a>
<div class="card card-body bg-light mt-5">
    <h2>编辑博客</h2>
    <p>请填写表单编辑博客</p>
    <form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['id']; ?>" method="POST">
        <div class="form-group">
            <label for="title">标题：<sup>*</sup></label>
            <input type="text" name='title' class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
            <span class="invalid-feedback">
                <?php echo $data['title_err']; ?>
            </span>
        </div>
        <div class="form-group">
            <label for="body">内容：<sup>*</sup></label>
            <textarea name='body' class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"></textarea>
            <span class="invalid-feedback">
                <?php echo $data['body_err']; ?>
            </span>
        </div>
        <input type="submit" class="btn btn-success" value="提交">
    </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>