<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <h2>创建账户</h2>
            <p>请填写表单内容进行注册</p>
            <form action="<?php echo URLROOT; ?>/users/register" method="POST">
                <div class="form-group">
                    <label for="name">姓名：<sup>*</sup></label>
                    <input type="text" name='name' class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                    <span class="invalid-feedback">
                        <?php echo $data['name_err']; ?>
                    </span>
                </div>
                <div class="form-group">
                    <label for="email">邮箱：<sup>*</sup></label>
                    <input type="email" name='email' class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                    <span class="invalid-feedback">
                        <?php echo $data['email_err']; ?>
                    </span>
                </div>
                <div class="form-group">
                    <label for="password">密码：<sup>*</sup></label>
                    <input type="password" name='password' class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                    <span class="invalid-feedback">
                        <?php echo $data['password_err']; ?>
                    </span>
                </div>
                <div class="form-group">
                    <label for="confirm_password">确认密码：<sup>*</sup></label>
                    <input type="password" name='confirm_password' class="form-control form-control-lg <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>">
                    <span class="invalid-feedback">
                        <?php echo $data['confirm_password_err']; ?>
                    </span>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="submit" value="注册" class="btn btn-success btn-block">
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-light btn-block">已有账户，点击登录！</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>