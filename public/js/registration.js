document.addEventListener('DOMContentLoaded', () => {


    const mainTeamSelect = document.getElementById('main-team');

    const duelTeamsCon = document.getElementById('duel-sports-container'); // d-none
    const duelTeamsSelect = duelTeamsCon.querySelector('select');

    const teamSportsCon = document.getElementById('team-sports-container'); // d-none
    const teamSportsSelect = teamSportsCon.querySelector('select');


    const pairStatusSelectCon = document.getElementById('select-pair-status-container');
    const pairStatusSelect = pairStatusSelectCon.querySelector('select')

    const pairEligibilityCon = document.getElementById('select-pair-eligibility-container');
    const pairEligibilitySelect = pairEligibilityCon.querySelector('select')

    const choosePairCon = document.getElementById('choose-pair-container');
    const choosePairList = choosePairCon.querySelector('#choose-pair-list');
    const hiddenChoosePairInput = choosePairCon.querySelector('#choose-pair-input');

    const pairingPwCon = document.getElementById('pairing-password-container');
    const pairingPwInput = pairingPwCon.querySelector('#password');
    const pwGeneratorBtn = document.getElementById('pw-generator-btn');



    mainTeamSelect.onchange = async (e) => {
        const mainTeamId = Number(e.target.value);
        const selected = e.target.selectedOptions[0];

        const mainTeamName = selected.getAttribute('data-name')
        document.getElementById('team-header-text').innerHTML = "a(z) " + mainTeamName + " csapatba";
        addBackgroundToModal(selected);

        const comparePwContainer = document.querySelector('.compare-pw-container');

        if (comparePwContainer) comparePwContainer.remove();


        disableElements([
            duelTeamsSelect,
            teamSportsSelect,
            pairStatusSelect,
            pairEligibilitySelect,
            pairingPwInput,
            hiddenChoosePairInput
        ]);
        hideElements([ // CLOSE ALL INPUT WHEN MAINTEAM ID DOESNT EXIST
            duelTeamsCon,
            teamSportsCon,
            pairStatusSelectCon,
            pairEligibilityCon,
            pairingPwCon,
            choosePairCon
        ])

        enableElements([
            duelTeamsSelect, teamSportsSelect
        ]);

        showAndRenderTeamSportsSelectOptions(mainTeamId);
        showAndRenderDuelSportsSelectOpions(mainTeamId)
    }

    duelTeamsSelect.onchange = async (e) => {
        const duelTeam = Number(e.target.value);
        const comparePwContainer = document.querySelector('.compare-pw-container');

        if (comparePwContainer) comparePwContainer.remove();

        disableElements([
            pairStatusSelect,
            pairEligibilitySelect,
            pairingPwInput,
            hiddenChoosePairInput
        ]);
        hideElements([
            pairStatusSelectCon,
            pairEligibilityCon,
            pairingPwCon,
            choosePairCon
        ])

        if (duelTeam > 0) {
            enableElements([
                pairStatusSelect,
            ])
            showPairStatusCon(duelTeam);
        }


    }

    pwGeneratorBtn.addEventListener('click', (e) => {
        e.preventDefault();
        let pwInput = e.target.previousElementSibling;
        pwInput.value = generatePassword();
    })




    function showPairStatusCon(duelTeam) {
        pairStatusSelectCon.classList.remove('d-none');

        pairStatusSelectCon.onchange = async (e) => {
            const pairStatus = Number(e.target.value);
            const comparePwContainer = document.querySelector('.compare-pw-container');

            if (comparePwContainer) comparePwContainer.remove();

            // Ha a van párod kérdésre nem választunk értéket
            if (pairStatus === 0) {
                disableElements([pairEligibilitySelect, pairingPwInput, hiddenChoosePairInput]);
                return hideElements([pairEligibilityCon, pairingPwCon, choosePairCon])
            };

            enableElements([pairEligibilitySelect])

            if (pairStatus === 1) {
                hideElements([pairEligibilityCon, pairingPwCon])
                disableElements([pairEligibilitySelect, pairingPwInput]);
                enableElements([hiddenChoosePairInput]);
                // ITT KELL KI RENDERELNI A FREE USERS LISTÁT
                getFreeUsersAndRenderList(duelTeam);
            } else { // Ha a van párod kérdésre PÁRNAK JELENTKEZEM
                hideElements([choosePairCon]);
                disableElements([hiddenChoosePairInput]);
                showPairEligibilityCon();
            }
        }
    }


    function showPairEligibilityCon() {
        pairEligibilityCon.classList.remove('d-none');

        pairEligibilityCon.onchange = async (e) => {
            const pairEligibility = Number(e.target.value);
            if (pairEligibility === 0) {
                disableElements([pairingPwInput]);
                return hideElements([pairingPwCon]);
            }

            if (pairEligibility === 1) {
                disableElements([pairingPwInput]);
                hideElements([pairingPwCon]);
                console.log('Bárki megjelölhet!')
            } else {
                showPairingPwCon(pairingPwCon);
                enableElements([pairingPwInput])
            }

        }


    }

    function showPairingPwCon(pairingPwCon) {
        pairingPwCon.classList.remove('d-none')
    }




    // CONTROLLING ELEMENTS --------------------------------------------------------------------------------------------------------------------------------------------


    function enableElements(elements) {
        elements.forEach(element => {
            // Ellenőrizzük, hogy az elem még nem disabled
            if (element.disabled) {
                // Kapcsoljuk ki az elemet
                element.disabled = false;
            }
        });
    }

    function disableElements(elements) {
        elements.forEach(element => {
            // Ellenőrizzük, hogy az elem még nem disabled
            if (!element.disabled) {
                // Kapcsoljuk ki az elemet
                element.value = '';
                element.disabled = true;
            }
        });
    }

    function hideElements(elements) {
        elements.forEach(element => {
            if (!element.classList.contains('d-none')) element.classList.add('d-none');
        });
    }


    // ASYNC METHODS FOR GET DATAS--------------------

    async function getTeamSportsByMainTeamId(mainTeamId) {
        try {
            const res = await axios.get(`/team-sports/${mainTeamId}`);
            const mainTeams = res.data;
            return mainTeams;
        } catch (err) {
            alert(err);
        }
    }
    async function getDuelSportsByMainTeamId(mainTeamId) {
        try {
            const res = await axios.get(`/duel-sports/${mainTeamId}`);
            const duelTeams = res.data;
            return duelTeams;
        } catch (err) {
            alert(err);
        }
    }


    async function showAndRenderTeamSportsSelectOptions(mainTeamId) {
        const teamSports = await getTeamSportsByMainTeamId(mainTeamId);
        teamSportsCon.classList.remove('d-none')
        teamSportsSelect.innerHTML = renderSelectsByTeamSports(teamSports);
    }

    async function showAndRenderDuelSportsSelectOpions(mainTeamId) {
        const duelSports = await getDuelSportsByMainTeamId(mainTeamId);
        duelTeamsCon.classList.remove('d-none')
        duelTeamsSelect.innerHTML = renderSelectsByDuelSports(duelSports);

    }


    // RENDERS---------------------------------

    function renderSelectsByTeamSports(teamSports) {
        let temp = `
        <option value="" selected>Válassza ki a csapat sportot</option>
        <option value="0">Nem jelentkezem</option>
    `;

        teamSports.forEach(sport => {
            const freeSpots = sport.max;
            const teamName = sport.name;
            const teamId = sport.id;
            const color = sport.color;

            temp += `
            <option value="${teamId}" ${freeSpots > 0 ? '' : 'disabled'}>
                ${teamName} - ${color} (${freeSpots} szabad hely)
            </option>
        `;
        });

        return temp;
    }

    function renderSelectsByDuelSports(teamSports) {
        let temp = `
        <option value="" selected>Válassza ki a csapat sportot</option>
        <option value="0">Nem jelentkezem</option>
    `;

        teamSports.forEach(sport => {
            const freeSpots = sport.max;
            const teamName = sport.name;
            const teamId = sport.id;
            const color = sport.color;

            temp += `
            <option value="${teamId}" ${freeSpots > 0 ? '' : 'disabled'}>
                ${teamName} - ${color} (${freeSpots} szabad hely)
            </option>
        `;
        });

        return temp;
    }

    // SET BACKGROUND OF MODAL BY MAIN TEAM COLOR----------------------------------------------------------------------------------------------------------

    function addBackgroundToModal(selected) {
        // Ellenőrizzük, hogy a selected értéke létezik-e és van-e data-bg attribútuma
        if (!selected || !selected.getAttribute('data-bg')) {
            console.error('Nincs megfelelő kiválasztott elem vagy data-bg attribútum.');
            return;
        }

        // Az új háttérosztály létrehozása
        const newBgClass = 'bg-' + selected.getAttribute('data-bg');

        // A form modal és a modal header elemek kiválasztása
        const formModal = document.getElementById('formModal');
        const modalHeader = document.getElementById('register-modal-header');

        // Ellenőrizzük, hogy a form modal és modal header elemek megtalálhatók-e
        if (!formModal || !modalHeader) {
            console.error('Nem található formModal vagy register-modal-header elem.');
            return;
        }

        // Távolítsuk el az összes bg-* osztályt a formModal elemről
        const bgClasses = formModal.className.match(/\bbg-[a-zA-Z]+-\d{1,3}\b/g);

        if (bgClasses) {
            bgClasses.forEach(bgClass => {
                formModal.classList.remove(bgClass);
            });
        }

        // Adjuk hozzá az új háttérosztályt a formModal elemhez
        formModal.classList.add(newBgClass);

        // Távolítsuk el az összes bg-* osztályt a modalHeader elemről
        const bgClassesHeader = modalHeader.className.match(/\bbg-[a-zA-Z]+-\d{1,3}\b/g);

        if (bgClassesHeader) {
            bgClassesHeader.forEach(bgClassHeader => {
                modalHeader.classList.remove(bgClassHeader);
            });
        }

        // Adjuk hozzá az új háttérosztályt a modalHeader elemhez
        modalHeader.classList.add(newBgClass);
    }

    // GENERATE PASSWORD----------------------------------------------------------------------

    function generatePassword() {
        var length = 8,
            charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
            retVal = "";
        for (var i = 0, n = charset.length; i < length; ++i) {
            retVal += charset.charAt(Math.floor(Math.random() * n));
        }
        return retVal;
    }

    function renderFreeUsersListForPairing(usersForPairing) {
        let temp = '';


        usersForPairing.forEach((user) => {
            console.log(user)
            let userEligibility = Number(user.pair_eligibility);
            temp += `
            <div>
                <li role="button" data-id="${user.id}" data-eligibility="${userEligibility}" class="pointer mt-1 free-user list-group-item ${userEligibility === 1 ? 'bg-cyan-500' : 'bg-amber-500'}">
                    ${user.name} ${userEligibility === 1 ? '' : '<i class="fa-solid fa-key"></i>'}
                </li>
            </div>
        `;
        });

        choosePairList.innerHTML = temp;
    }





    async function getFreeUsersByDuelSportsId(duelTeamId) {
        try {
            const res = await axios.get(`/user/${duelTeamId}`);
            const freeUsers = res.data;
            return freeUsers;
        } catch (err) {
            alert(err);
        }
    }

    async function getFreeUsersAndRenderList(duelTeamId) {


        choosePairCon.classList.remove('d-none');

        const usersForPairing = await getFreeUsersByDuelSportsId(duelTeamId);
        renderFreeUsersListForPairing(usersForPairing);
        chooseFromFreeUsersList();

    }


    function chooseFromFreeUsersList() {
        const freeUsers = document.querySelectorAll('.free-user');

        freeUsers.forEach(userListItem => {
            userListItem.addEventListener('click', (e) => {
                // Először visszaállítjuk az összes elem borderét
                freeUsers.forEach(userItem => {
                    userItem.style.border = 'none';
                });

                const freeUserListItem = e.currentTarget;
                // A kattintott elem kapja meg a border-t
                freeUserListItem.style.border = '2px solid blue';

                // Az userId beállítása a kattintott elem data-id attribútumából
                const userId = Number(freeUserListItem.getAttribute('data-id'));
                const eligibility = Number(freeUserListItem.getAttribute('data-eligibility'));

                if (eligibility === 2) {
                    hiddenChoosePairInput.value = '';

                    // Ellenőrizzük, hogy a comparePwContainer már létezik-e
                    let comparePwContainer = document.querySelector('.compare-pw-container');
                    if (!comparePwContainer) {
                        comparePwContainer = generateComparePwContainer(userId);
                        freeUserListItem.parentElement.appendChild(comparePwContainer);

                        // Eseménykezelők hozzáadása a gombokhoz
                        comparePwContainer.querySelector('#close').addEventListener('click', () => {
                            comparePwContainer.remove();
                        });

                        comparePwContainer.querySelector('#send').addEventListener('click', (e) => {
                            e.preventDefault();
                            hiddenChoosePairInput.value = userId;

                        })
                    }
                    return;
                }

                hiddenChoosePairInput.value = userId;
            });
        });
    }

    function generateComparePwContainer(userId) {
        // Létrehozunk egy div elemet és beállítjuk a belső HTML-jét
        const container = document.createElement('div');
        container.className = 'compare-pw-container'; // Adjunk neki egy osztályt az azonosításhoz
        container.innerHTML = `
                <input required />
                <button id="send">Send</button>
                <button id="close">Close</button>
            </div>
        `;
        return container;
    }


});



