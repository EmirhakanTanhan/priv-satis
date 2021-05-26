$("#AdminEdit").submit(function () {
    axios.post('/panel/api/adminedit', $("#AdminEdit").serialize()).then(function (response) {
        console.log(response.data);


    }).catch(function (error) {
        console.log(error);
    })
})