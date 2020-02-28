<form action="#">

    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col mdl-typography--text-center">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input id="inn-input" class="mdl-textfield__input" type="text">
                <label id="inn-label" class="mdl-textfield__label" for="inn-input">Введите ИНН</label>
                <span id="inn-message" class="mdl-textfield__error" style="visibility: visible"></span>
            </div>
        </div>
    </div>

    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col mdl-typography--text-center">
            <button id="submit-button"
                    data-check-path="/check-authenticity"
                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                Проверить достоверность
            </button>

            <div id="loading-spinner" style="display: none" class="mdl-spinner mdl-spinner--single-color mdl-js-spinner is-active"></div>
        </div>
    </div>

</form>

<script>
    let isLoading = false
    let input = document.getElementById('inn-input')
    let message = document.getElementById('inn-message')
    let spinner = document.getElementById('loading-spinner')
    let submitButton = document.getElementById('submit-button')

    submitButton.addEventListener('click', () => {
        if (!checkInnInput()) {
            return;
        }

        isLoading = true
        setTimeout(() => {
            if (isLoading) {
                disableSubmitButton()
                enableSpinner()
            }
        }, 50)

        checkAuthenticity()
            .then((e) => {
                if (e.authenticity !== undefined && e.authenticity) {
                    showSuccessMessage(e.message)
                } else {
                    showErrorMessage(e.message)
                }
            })
            .catch((e) => {
                showErrorMessage(e.message)
            })
            .finally(() => {
                isLoading = false
                enableSubmitButton()
                disableSpinner()
            })
    }, false)

    function checkInnInput() {
        let inn = input.value

        if (inn.length < 10) {
            showErrorMessage('ИНН слишком короткий')
            return false;
        }

        if (inn.length > 12) {
            showErrorMessage('ИНН слишком длинный')
            return false;
        }

        if (!/^\d+$/.test(inn)) {
            showErrorMessage('ИНН должен содержать только цифры')
            return false;
        }

        showEmptyMessage()
        return true;
    }

    async function checkAuthenticity() {
        let checkPath = submitButton.getAttribute('data-check-path')
        let inn = input.value

        return await new Promise(resolve => {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', checkPath);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onload = () => {
                try {
                    let json = JSON.parse(xhr.response)
                    resolve(json);
                } catch (e) {
                    resolve(xhr.response);
                }
            };
            xhr.onerror = function () {
                resolve(undefined);
                console.error("An error occurred during the XMLHttpRequest");
            };
            xhr.send(JSON.stringify({inn: inn}));
        })
    }

    function showSuccessMessage(msg = 'Неизвестная ошибка.') {
        message.textContent = msg
        message.style.color = 'green'
    }

    function showErrorMessage(msg = 'Неизвестная ошибка.') {
        message.textContent = msg
        message.style.color = 'red'
    }

    function showEmptyMessage() {
        message.textContent = ''
    }

    function disableSubmitButton() {
        submitButton.style.display = 'none';
    }

    function enableSubmitButton() {
        submitButton.style.display = 'inline-block';
    }

    function disableSpinner() {
        spinner.style.display = 'none';
    }

    function enableSpinner() {
        spinner.style.display = 'inline-block';
    }
</script>