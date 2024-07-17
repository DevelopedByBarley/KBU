<div class="modal fade rating-modal" id="sendMailModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="sendMailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-main-blue text-white">
                <h5 class="modal-title" id="sendMailModalLabel">Kontakt</h5>
            </div>
            <div class="modal-body py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <form action="/user/mail" method="POST" enctype="multipart/form-data">
                                <div class="mb-4  p-2 text-white  bg-cyan-500 dark-bg-cyan-700 rounded-3">
                                    <p class="m-0 fw-bolder">
                                        Hiermann Rita
                                    </p>
                                    <p class="m-0">
                                        Vállalati kommunikáció, rendezvényszervező
                                    </p>
                                    <p class="m-0">
                                        +36301505077
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" class="mb-2">Email cím</label>
                                    <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" validators='{
                                        "name": "email",
                                        "required": true,
                                        "email": true,
                                        "minLength": 12,
                                        "maxLength": 50
                                        }'>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="exampleFormControlTextarea1" class="mb-2">Üzenet</label>
                                    <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3" validators='{
                                        "name": "message",
                                        "required": true,
                                        "minLength": 30,
                                        "maxLength": 200
                                        }'></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégse</button>
                                    <button type="submit" class="btn bg-main-blue hover-bg-sky-800">Elküld</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>