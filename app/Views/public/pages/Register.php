<div class="container mt-10">
    <div class="row">
        <div class="col-12">

            <form method="GET">
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row mb-4">
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="form6Example1">Név</label>
                            <input type="text" id="form6Example1" class="form-control" name="name" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline">
                            <label class="form-label" for="form6Example2">Költséghely</label>
                            <input type="text" id="form6Example2" class="form-control" name="class" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form6Example3">E-mail cím</label>
                            <input type="email" id="form6Example3" class="form-control" name="email" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form6Example4">Törzsszám</label>
                            <input type="text" id="form6Example4" class="form-control" class="work-id" />
                        </div>
                    </div>
                </div>




                <!-- Email input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="form6Example5">Főcsapat</label>
                    <select class="form-select" aria-label="Default select example" id="main-teams-container" required>

                    </select>
                </div>

                <!-- Number input -->
                <div class="form-outline mb-4 d-none" id="team-sport-container">
                    <label class="form-label" for="form6Example6">Válassz csapatsportot </label>
                    <select class="form-select" aria-label="Default select example" id="team-sport">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>

                <div class="form-outline mb-4">
                    <label class="form-label" for="form6Example6">Válassz páros sportot </label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="form6Example6">Van párod? </label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">Párnak jelentkezem</option>
                        <option value="2">Van párom</option>
                    </select>
                </div>
                <div class="form-outline mb-4">
                    <label class="form-label" for="form6Example6">Kit szeretnéd hogy bejelölhessen </label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">Bárki bejelölhet</option>
                        <option value="2">Jelszót adok meg</option>
                        
                    </select>
                </div>
                <div class="col">
                    <div class="form-outline mb-4" id="password-container">
                        <label class="form-label" for="form6Example4">Jelszó</label>
                        <div class="d-flex gap-2">
                            <input type="text" id="password" name="password"  class="form-control" class="work-id" required "/>
                            <button type=" button" class="btn border"  id="pw-generator">Generálás</button>
                        </div>
                    </div>
                </div>


                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">Jelentkezés</button>
            </form>



        </div>
    </div>
</div>