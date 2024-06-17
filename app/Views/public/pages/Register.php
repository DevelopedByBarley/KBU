<div class="container mt-10">
    <div class="row">
        <div class="col-12">

            <form method="GET">
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row mb-4">
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <label class="form-label" for="form6Example1">Név</label>
                            <input type="text" id="form6Example1" class="form-control" name="name" />
                        </div>
                    </div>
                    <div class="col">
                        <div data-mdb-input-init class="form-outline">
                            <label class="form-label" for="form6Example2">Költséghely</label>
                            <input type="text" id="form6Example2" class="form-control" name="class" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="form6Example3">E-mail cím</label>
                            <input type="email" id="form6Example3" class="form-control" name="email" />
                        </div>
                    </div>
                    <div class="col">
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="form6Example4">Törzsszám</label>
                            <input type="text" id="form6Example4" class="form-control" class="work-id" />
                        </div>
                    </div>
                </div>




                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form6Example5">Főcsapat</label>
                    <select class="form-select" aria-label="Default select example" id="main-teams-container" required>

                    </select>
                </div>

                <!-- Number input -->
                <div class="form-outline mb-4 d-none" id="team-sport-container">
                    <label class="form-label" for="form6Example6">Választott csapatsport </label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <label class="form-label" for="form6Example6">Válaszott páros sport </label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>


                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">Jelentkezés</button>
            </form>



        </div>
    </div>
</div>

