axios.get('/feedback').then(res => {
    const feedback = res.data.isExist;
    if (!feedback) {
        let counter = localStorage.getItem('counter') ? Number(localStorage.getItem('counter')) : 0;
        const max = 1000 * 15; // 5 mins (300,000 ms)

        const interval = setInterval(() => {

            if (counter < max) {
                counter += 1000;
                localStorage.setItem('counter', counter);
            } else {
                if (document.querySelectorAll('.modal.show').length === 0) {
                    var myModal = new bootstrap.Modal(document.getElementById('ratingModal'));
                    myModal.show();
                    clearInterval(interval)

                    const submitFeedbackBtn = document.getElementById('submitFeedbackBtn');

                    submitFeedbackBtn.addEventListener('click', (e) => {
                        e.preventDefault();
                        const checkedInput = document.querySelector('input[name="feedback"]:checked');
                        const content = document.querySelector('#additionalFeedback').value;
                        const newValue = checkedInput ? checkedInput.value : 0;

                        axios.post('/feedback', {
                            feedback: newValue,
                            content: content
                        }).then(res => {
                            myModal.hide();
                            toast(
                                {
                                    title: 'KBU program üzenete!',
                                    message: 'Köszönük a visszajelzést!',
                                    time: null
                                },
                                {
                                    textColor: 'white',
                                    background: 'cyan-500'
                                }
                            );
                        }).catch(err => console.log(err));
                    })
                }

            }

        }, 5000)

    }
});
