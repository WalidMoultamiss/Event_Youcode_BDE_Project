let authUser = new User()
setTimeout(() => {
    authUser.checkAuth().then(result => {
        if (result.error) {
            console.log(result.error);
            localStorage.getItem('Token') ? localStorage.removeItem('Token') : null
            window.location.replace('http://localhost:3000/assets/pages/login.html')
        }
    })
}, 500);



