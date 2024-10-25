const resetForm = document.getElementById('reset-form');
const newPairContainer = document.getElementById('new-pair-container');
const newPairSelectBtn = document.getElementById('new-pair-select');
const chooseNewPairList = document.getElementById('choose-new-pair-list');
const chooseNewPairCon = document.getElementById('choose-new-pair-container');
const hiddenChoosePairInput = chooseNewPairCon.querySelector('#choose-new-pair-input');


newPairSelectBtn.addEventListener('click', async (e) => {
    e.preventDefault();
    hiddenChoosePairInput.removeAttribute('disabled')
    resetForm.classList.remove('d-none')
    newPairContainer.classList.remove('d-none');
    const duelSportRefId = document.getElementById('reset-form').getAttribute('pair-ref-id');
    const userId = document.getElementById('reset-form').getAttribute('user-id');
    const usersForPairing = await getFreeUsersByDuelSportsIdForUpdate(duelSportRefId, userId);
    renderAndUpdateFreeUsersListForPairing(usersForPairing);
    chooseFromFreeUsersListForUpdate();
})


function renderAndUpdateFreeUsersListForPairing(usersForPairing) {
    let temp = '';

    if (usersForPairing.length === 0) {
        temp += `
			<div class="mt-10">
				<h5 class="text-center">Ennél a sportnál nincs egyetlen választható pár sem</h5>
            </div>
			`;
        newPairContainer.innerHTML = temp;
        return;
    }


    usersForPairing.forEach((user) => {
        console.log(user)
        let userEligibility = Number(user.pair_eligibility);
        temp += `
			<div>
				<li role = "button" data-id="${user.id}" data-eligibility="${userEligibility}" class="text-center rounded-4 pointer mt-1 free-user list-group-item ${userEligibility === 1 ? 'bg-sky-500' : 'bg-amber-500'} text-white" >
					<span class="text-xl"> ${user.name} ${userEligibility === 1 ? '' : '<i class="fa-solid fa-key"></i>'}</span>
                </li>
            </div >
			`;
    });

    chooseNewPairList.innerHTML = temp;
}

async function getFreeUsersByDuelSportsIdForUpdate(duelTeamId, userId) {
    try {
        const res = await axios.get(`/user/${duelTeamId}/${userId}`);
        const freeUsers = res.data;
        return freeUsers;
    } catch (err) {
        alert(err);
    }
}

async function getFreeUsersAndRenderListForUpdate(duelTeamId) {
    const formElement = newPairContainer.querySelector('.form-outline');
    try {
        newPairContainer.classList.remove('d-none');
        formElement.style.display = 'none';

    } catch (error) {
        console.log(error);
    } finally {
        setTimeout(async () => {
            formElement.style.display = 'block';

            const usersForPairing = await getFreeUsersByDuelSportsIdForUpdate(duelTeamId, userId);
            renderAndUpdateFreeUsersListForPairing(usersForPairing);
            chooseFromFreeUsersListForUpdate();
        }, 1500);
    }



}


function chooseFromFreeUsersListForUpdate() {
    const freeUsers = document.querySelectorAll('.free-user');

    freeUsers.forEach(userListItem => {
        userListItem.addEventListener('click', (e) => {
            // Először visszaállítjuk az összes elem borderét
            freeUsers.forEach(userItem => {
                userItem.style.border = 'none';
            });

            const freeUserListItem = e.currentTarget;
            // A kattintott elem kapja meg a border-t
            const userId = Number(freeUserListItem.getAttribute('data-id'));
            const eligibility = Number(freeUserListItem.getAttribute('data-eligibility'));
            let comparePwContainer = document.querySelector('.compare-pw-container');
            freeUserListItem.style.border = eligibility === 2 ? '2px solid blue' : '2px solid lightgreen';

            // Az userId beállítása a kattintott elem data-id attribútumából

            comparePwContainer && eligibility === 1 ? comparePwContainer.remove() : '';


            if (eligibility === 2) {
                hiddenChoosePairInput.value = '';

                // Ellenőrizzük, hogy a comparePwContainer már létezik-e
                if (!comparePwContainer) {
                    comparePwContainer = generateComparePwContainerForUpdate(userId);
                    freeUserListItem.parentElement.appendChild(comparePwContainer);

                    // Eseménykezelők hozzáadása a gombokhoz
                    comparePwContainer.querySelector('#close').addEventListener('click', () => {
                        comparePwContainer.remove();
                    });

                    comparePwContainer.querySelector('#send').addEventListener('click', async (e) => {
                        e.preventDefault();
                        let response;
                        const pairingPwInput = comparePwContainer.querySelector('#pairing-pw').value;

                        if (pairingPwInput === '') {
                            return toast({
                                title: 'KBU program üzenete!',
                                message: 'A mező kitöltése kötelező!',
                                time: null
                            }, {
                                textColor: 'white',
                                background: 'red-500'
                            });
                        }

                        try {
                            response = await axios.post(`/user/pw-compare/${userId} `, {
                                pairing_pw: pairingPwInput
                            });
                        } catch (error) {
                            console.error('Error during password comparison:', error);
                            // itt kezelhetjük a hibát, pl.:
                            alert('Password comparison failed. Please try again.');
                        } finally {
                            setTimeout(() => {
                                comparePwContainer.innerHTML = '';

                                const isSuccess = response.data;
                                if (isSuccess) {
                                    console.log(userId);
                                    hiddenChoosePairInput.removeAttribute('disabled');
                                    hiddenChoosePairInput.value = userId;
                                    toast({
                                        title: 'KBU program üzenete!',
                                        message: 'Ön sikeresen megjelölte párjának a kiválasztott felhasználót, a jelentkezés leadását követően párok lesztek!',
                                        time: null
                                    }, {
                                        textColor: 'white',
                                        background: 'lime-500'
                                    });
                                    freeUserListItem.style.border = '3px solid lightgreen';
                                } else {
                                    hiddenChoosePairInput.setAttribute('disabled');

                                    toast({
                                        title: 'KBU program üzenete!',
                                        message: 'Sikertelen , jelszó hibás!',
                                        time: null
                                    }, {
                                        textColor: 'white',
                                        background: 'red-500'
                                    });
                                }
                                comparePwContainer.remove();
                            }, 2000);
                        }

                    })
                }
                return;
            }

            hiddenChoosePairInput.removeAttribute('disabled');

            hiddenChoosePairInput.value = userId;

            toast({
                title: 'KBU program üzenete!',
                message: 'Ön sikeresen megjelölte párjának a kiválasztott felhasználót, a jelentkezés leadását követően párok lesztek!',
                time: null
            }, {
                textColor: 'white',
                background: 'lime-500'
            });
        });
    });
}


function generateComparePwContainerForUpdate() {
    // Létrehozunk egy div elemet és beállítjuk a belső HTML-jét
    const container = document.createElement('div');
    container.className = 'compare-pw-container d-md-flex gap-3 mb-3 mt-1'; // Adjunk neki egy osztályt az azonosításhoz
    container.innerHTML = `
			<input type="password" autocomplete="off" placeholder="Jelszó beírása..." class="form-control border-2 w-75 my-2 my-md-0" name="pairing-pw" id="pairing-pw" required />
                <button class="btn bg-green-500 text-white" id="send">Ellenőrzés</button>
                <button class="btn bg-red-500 text-white" id="close">Bezár</button>
		`;
    return container;
}
