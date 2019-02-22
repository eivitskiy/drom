<div class="flex-center position-ref m-t-md">
    <div class="container col-6">
        <div class="content m-b-md">

            <div class="card">
                <div class="card-header">
                    Авторизация
                </div>

                <div class="card-body">
                    <form method="POST" action="/auth/login">
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
                                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                                   title="Пароль должен быть не менее 6 символов и содежать минимум одну цифру, заглавную и строчную буквы"></i>
                                            </div>
                                    <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-success btn-sm">Войти</button>
                                <a href="/auth/register" class="btn btn-primary btn-sm">У меня ещё нет аккаунта</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>