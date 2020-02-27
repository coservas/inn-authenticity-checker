<form action="#">

    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col mdl-typography--text-center">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="inn-input">
                <label class="mdl-textfield__label" for="inn-input">Введите ИНН</label>
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

            <div id="loading-spinner" class="mdl-spinner mdl-spinner--single-color mdl-js-spinner is-active"></div>
        </div>
    </div>

</form>

<script>
    let input = document.getElementById('inn-input')
    let spinner = document.getElementById('loading-spinner')
    let submitButton = document.getElementById('submit-button')

    submitButton.addEventListener('click', () => {
        disableSubmitButton()
        enableSpinner()

        checkAuthenticity()
            .then(() => {
            })
            .catch(() => {
            })
            .finally(() => {
                enableSubmitButton()
                disableSpinner()
            })
    }, false)

    async function checkAuthenticity() {
        let checkPath = submitButton.getAttribute('data-check-path')

        let xhr = new XMLHttpRequest();
        xhr.open('POST', checkPath);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = () => {
            if (xhr.status === 200 && xhr.responseText !== newName) {
                alert('Something went wrong.  Name is now ' + xhr.responseText);
            }
            else if (xhr.status !== 200) {
                alert('Request failed.  Returned status of ' + xhr.status);
            }
        };
        xhr.send(encodeURI('name=' + newName));

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

<style>
    #loading-spinner {
        display: none;
    }
</style>