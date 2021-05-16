var card = new Card({
    form: '#CreditCard',
    container: '.card-wrapper',

    formSelectors: {
        nameInput: 'input[name="first-name"], input[name="last-name"]'
    },
    debug: false,
});