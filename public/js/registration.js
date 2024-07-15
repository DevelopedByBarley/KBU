document.addEventListener('DOMContentLoaded', () => {


	const identNumberInput = document.getElementById('ident-number');

	const checkIdentNumberBtn = document.getElementById('check-ident-num');
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


	identNumberInput.setCustomValidity('A törzsszám kitöltése és ellenörzése kötlező!');


	identNumberInput.oninput = (e) => {

		identNumberInput.setCustomValidity('A törzsszám kitöltése és ellenörzése kötlező!');
		disableElements([
			mainTeamSelect,
			duelTeamsSelect,
			teamSportsSelect,
			pairStatusSelect,
			pairEligibilitySelect,
			pairingPwInput,
			hiddenChoosePairInput
		]);
		return hideElements([ // CLOSE ALL INPUT WHEN MAINTEAM ID DOESNT EXIST
			duelTeamsCon,
			teamSportsCon,
			pairStatusSelectCon,
			pairEligibilityCon,
			pairingPwCon,
			choosePairCon
		])
	}




	checkIdentNumberBtn.addEventListener('click', (e) => {
		e.preventDefault();
		mainTeamSelect.value = '';
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
		const identNumber = document.getElementById('ident-number').value;
		mainTeamSelect.setAttribute('disabled', 'disabled');
		if (!identNumber || identNumber === '' || identNumber.length < 6 || identNumber.length > 8) {

			return toast(
				{
					title: 'Üzenet!',
					message: 'Nem megfelelő formátum. Kérjük írjon be létező törzsszámot',
					time: 'Most'
				},
				{
					textColor: 'white',
					background: 'red-500'
				}
			);
		}

		let isExist;
		axios.post('/user/is-exist', { identNumber: identNumber })
			.then(res => {
				isExist = res.data ? true : false;
				checkIdentNumberBtn.innerHTML = spinner();





			})
			.catch(err => {
				console.error('Hiba történt a kérés során:', err);
			}).finally(() => {

				setTimeout(() => {
					if (isExist) {
						checkIdentNumberBtn.innerHTML = 'Ellenörzés';
						return toast(
							{
								title: 'Üzenet!',
								message: 'Ezzel a törzsszámmal már regisztráltak!',
								time: 'Most'
							},
							{
								textColor: 'white',
								background: 'orange-500'
							}
						);
					}
					mainTeamSelect.removeAttribute('disabled');
					checkIdentNumberBtn.innerHTML = 'Ellenőrzés';
					identNumberInput.setCustomValidity('');

					return toast(
						{
							title: 'Üzenet!',
							message: 'Törzsszám elfogadva!!',
							time: 'Most'
						},
						{
							textColor: 'white',
							background: 'cyan-500'
						}
					);
				}, 1500);

			})
	})

	mainTeamSelect.onchange = async (e) => {
		const mainTeamId = Number(e.target.value);
		const selected = e.target.selectedOptions[0];

		if (Number(selected.value) === 0) {
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
			addBackgroundToModal(selected);

			return;
		}

		const mainTeamName = selected.getAttribute('data-name') ? selected.getAttribute('data-name') : ''
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
		showAndRenderDuelSportsSelectOptions(mainTeamId)
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
		let teamSports;
		try {
			teamSports = await getTeamSportsByMainTeamId(mainTeamId);
		} catch (error) {

		} finally {
			setTimeout(() => {
				teamSportsCon.classList.remove('d-none')
				teamSportsSelect.innerHTML = renderSelectsByTeamSports(teamSports);
			}, 1500);
		}
	}

	async function showAndRenderDuelSportsSelectOptions(mainTeamId) {
		let duelSports;
		let spinner = duelTeamsCon.querySelector('.spinner');
		let formElement = duelTeamsCon.querySelector('.form-outline');
		try {
			spinner.style.display = 'block';

			duelSports = await getDuelSportsByMainTeamId(mainTeamId);
			duelTeamsCon.classList.remove('d-none')
			formElement.style.display = 'none';

		} catch (error) {
			console.error('error');
		} finally {
			setTimeout(() => {
				formElement.style.display = 'block';
				spinner.style.display = 'none';
				duelTeamsSelect.innerHTML = renderSelectsByDuelSports(duelSports);
			}, 1500);
		}


	}


	// RENDERS---------------------------------

	function spinner(classes = '') {
		return `
      <div class="spinner-border text-primary spinner m-0 p-0 ${classes}" role="status">
				<span class="sr-only">Loading...</span>
			</div>
      `;
	}

	function renderSelectsByTeamSports(teamSports) {
		let temp = `
        <option value="" selected>Válassza ki a csapat sportot</option>
        <option value="0">Nem jelentkezem</option>
    `;

		teamSports.forEach(sport => {
			const freeSpots = sport.max;
			const teamName = sport.name;
			const teamId = sport.id;

			temp += `
            <option value="${teamId}" ${freeSpots > 0 ? '' : 'disabled'}>
                ${teamName} - (${freeSpots} szabad hely)
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

			temp += `
            <option value="${teamId}" ${freeSpots > 0 ? '' : 'disabled'}>
                ${teamName} - (${freeSpots} szabad hely)
            </option>
        `;
		});

		return temp;
	}

	// SET BACKGROUND OF MODAL BY MAIN TEAM COLOR----------------------------------------------------------------------------------------------------------

	function addBackgroundToModal(selected) {
		const selectedBg = selected.getAttribute('data-bg') ? selected.getAttribute('data-bg') : 'none';

		const newBgClass = 'bg-' + selectedBg;

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
            <div">
                <li role="button" data-id="${user.id}" data-eligibility="${userEligibility}" class="text-center rounded-4 pointer mt-1 free-user list-group-item ${userEligibility === 1 ? 'bg-sky-500' : 'bg-amber-500'} text-white">
                   <span class="text-xl"> ${user.name} ${userEligibility === 1 ? '' : '<i class="fa-solid fa-key"></i>'}</span>
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
		const spinner = choosePairCon.querySelector('.spinner');
		const formElement = choosePairCon.querySelector('.form-outline');
		try {
			choosePairCon.classList.remove('d-none');
			spinner.style.display = 'block';
			formElement.style.display = 'none';

		} catch (error) {
			console.log(error);
		} finally {
			setTimeout(async () => {
				spinner.style.display = 'none';
				formElement.style.display = 'block';

				const usersForPairing = await getFreeUsersByDuelSportsId(duelTeamId);
				renderFreeUsersListForPairing(usersForPairing);
				chooseFromFreeUsersList();
			}, 1500);
		}



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

						comparePwContainer.querySelector('#send').addEventListener('click', async (e) => {
							e.preventDefault();
							let response;
							const pairingPwInput = comparePwContainer.querySelector('#pairing-pw').value;

							if (pairingPwInput === '') {
								return toast(
									{
										title: 'Üzenet!',
										message: 'A mező kitöltése kötelező!',
										time: null
									},
									{
										textColor: 'white',
										background: 'red-500'
									}
								);
							}

							try {
								comparePwContainer.innerHTML = spinner();
								response = await axios.post(`/user/pw-compare/${userId}`, {
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
										hiddenChoosePairInput.value = userId;
										toast(
											{
												title: 'Üzenet!',
												message: 'Ön sikeresen megjelölte párjának a kiválasztott felhasználót, a jelentkezés leadását követően párok lesztek!',
												time: null
											},
											{
												textColor: 'white',
												background: 'cyan-500'
											}
										);
										freeUserListItem.style.border = '3px solid lightgreen';
									} else {
										toast(
											{
												title: 'Üzenet!',
												message: 'Sikertelen , jelszó hibás!',
												time: null
											},
											{
												textColor: 'white',
												background: 'red-500'
											}
										);
									}
									comparePwContainer.remove();
								}, 2000);
							}

						})
					}
					return;
				}

				hiddenChoosePairInput.value = userId;

				toast(
					{
						title: 'Üzenet!',
						message: 'Ön sikeresen megjelölte párjának a kiválasztott felhasználót, a jelentkezés leadását követően párok lesztek!',
						time: null
					},
					{
						textColor: 'white',
						background: 'cyan-500'
					}
				);
			});
		});
	}

	function generateComparePwContainer() {
		// Létrehozunk egy div elemet és beállítjuk a belső HTML-jét
		const container = document.createElement('div');
		container.className = 'compare-pw-container d-md-flex gap-3 mb-3 mt-1'; // Adjunk neki egy osztályt az azonosításhoz
		container.innerHTML = `
                <input type="password" autocomplete="off" placeholder="Jelszó beírása..." class="form-control border-2 w-75 my-2 my-md-0" name="pairing-pw" id="pairing-pw" required/>
                <button class="btn bg-green-500 text-white" id="send">Elküld</button>
                <button class="btn bg-red-500 text-white" id="close">Bezár</button>
        `;
		return container;
	}


});



