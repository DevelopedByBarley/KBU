<div class="modal fade " id="addAdminModal" tabindex="-1" role="dialog" aria-labelledby="addAdminModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between  text-white bg-purple-600">
                <h5 class="modal-title" id="exampleModalLabel">Admin hozzáadása</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="/admin/store">
                    <?= $csrf->generate() ?>
                    <div class="form-group my-2">
                        <label for="exampleInputEmail1">Név</label>
                        <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name " required validators='{
                            "name": "name",
                            "required": true,
                            "minLength": 12,
                            "maxLength": 50,
                            "noSpaces": true
                        }'>
                    </div>
                    <div class="form-outline">
                        <label class="form-label" for="form3Example3">Email</label>
                        <input name="email" type="email" id="form3Example3" class="form-control" validators='{
                                "name": "email",
                                "required": true,
                                "email": true,
                                "minLength": 12,
                                "maxLength": 50
                                }' />
                    </div>
                    <div class="form-outline">
                        <label for="exampleInputEmail1">Jelszó</label>
                        <input type="text" id="password" name="password" class="password form-control" data-password-compare=1 validators='{
                                "name": "password",
                                "password": true,
                                "required": true
                            }' />
                        <button type="button" class="d-inline btn border pw-generator">Generálás</button>
                    </div>

                    <div class="form-outline my-2">
                        <label for="exampleInputEmail1">Jelszó újra</label>
                        <input type="text" id="repeat" name="repeat" class="form-control" validators='{
                                "name": "repeat",
                                "comparePw": true
                            }' />
                    </div>
                    <div class="form-group my-2">
                        <label for="exampleInputPassword1">Szint</label>
                        <select class="form-select" name="level" aria-label="Default select example" required>
                            <option value="" selected disabled>Válassza ki az admin szintjét!</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div class="avatars">
                        <div class="row">
                            <label for="avatars" class="my-3">Avatar kiválasztása</label>
                            <?php foreach (AVATARS as $avatar) : ?>
                                <div class="col-2 d-flex align-items-center justify-content-center mb-2">
                                    <div class="form-check form-check-inline image-radio">
                                        <input required class="form-check-input" type="radio" name="avatar-radio" id="avatar_radio-<?php echo $avatar; ?>" value="<?php echo $avatar; ?>">
                                        <label class="form-check-label" for="avatar_radio-<?php echo $avatar; ?>">
                                            <img src="/public/assets/images/avatars/<?php echo $avatar; ?>.png" class="h-45 w-45" alt="<?php echo ucfirst($avatar); ?>">
                                        </label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn bg-purple-500 hover-bg-purple-600">Elküld</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bezár</button>
            </div>
            </form>
        </div>


    </div>
</div>
</div>