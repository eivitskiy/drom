<div class="flex-center position-ref m-t-md">
    <div class="container col-6">
        <div class="content m-b-md">

            <div class="card">
                <div class="card-header">
                    Регистрация
                </div>

                <div class="card-body">
                    <form method="POST" action="/auth/register">
                        <div class="form-group row">
                            <label for="email" class="col-2 col-form-label">Email</label>
                            <div class="col-10">
                                <div class="input-group">
                                    <input type="email" class="form-control" name="email" placeholder="E-mail"
                                           value="<?php echo $values['email'] ?? null ?>">
                                    <?php if (isset($errors['email'])): ?>
                                        <div class="input-group-prepend">
                                            <div class="input-group-text alert-danger"><?php echo $errors['email'] ?></div>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-2 col-form-label">Пароль</label>
                            <div class="col-10">
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" placeholder="Пароль"
                                           minlength="6">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="showPassBtn">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <?php if (isset($errors['password'])): ?>
                                            <div class="input-group-text alert-danger">
                                                <?php echo $errors['password'] ?>
                                                &nbsp;
                                                <i class="fa fa-question-circle" data-toggle="tooltip"
                                                   data-placement="top"
                                                   title="Пароль должен быть не менее 6 символов и содежать минимум одну цифру, заглавную и строчную буквы"></i>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-2 col-form-label">Повтор пароля</label>
                            <div class="col-10">
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password_confirm"
                                           placeholder="Повтор пароля"
                                           minlength="6">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="showPassConfirmBtn">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <?php if (isset($errors['password_confirm'])): ?>
                                            <div class="input-group-text alert-danger"><?php echo $errors['password_confirm'] ?></div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-success btn-sm">Зарегистрироваться</button>
                                <a href="/auth/login" class="btn btn-primary btn-sm">У меня уже есть аккаунт</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>