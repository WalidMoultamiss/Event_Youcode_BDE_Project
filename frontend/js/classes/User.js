class User {
    token = ""
    url = 'http://localhost/MVC/user'
    userData




    login = (email, password) => {
        fetch(`${this.url}/login`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                email,
                password,
            })
        }).then(response => response.json()).then((data) => {
            localStorage.setItem('Token', data.Token)
            this.currentUser = data
            window.location.replace('http://localhost:3000')
        })
    }

    register = (data) => {
        fetch(`${this.url}/register`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(response => response.json()).then((data) => {
            localStorage.setItem('Token', data.Token)
            this.currentUser = data
            window.location.replace('http://localhost:3000')
        })
    }



    checkAuth = async () => {
        this.token = localStorage.getItem('Token')
        console.log(this.token);
        const result = await fetch(`${this.url}/token`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${this.token}`
            },
        }).then(Response => Response.json()).then((result) => {
            return result
        })
        return result;
    }

    isAdmin = () => {
        if (!this.Token) {
            this.token = localStorage.getItem('Token')
        } 
            var base64Url = this.token.split('.')[1];
            var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
            var jsonPayload = decodeURIComponent(atob(base64).split('').map(function (c) {
                return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
            }).join(''));
            this.role = JSON.parse(jsonPayload).role;
        
    }

    getUserInfo = () => {
        this.Token = localStorage.getItem('Token')
        var base64Url = this.Token.split('.')[1];
        var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        var jsonPayload = decodeURIComponent(atob(base64).split('').map(function (c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));
        this.currentUser = JSON.parse(jsonPayload);
        return this.currentUser
    }

    getUserByCin = async (cin) => {
        return fetch(`${this.url}/user/${cin}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${this.Token}`
            },
        }).then(response => response.json()).then((data) => {
            this.userData = data
        })

    }

    getLogs = () => {

    }

    all = async () => {
        return fetch(`${this.url}/users`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${this.Token}`
            },
        }).then(response => response.json())
    }


}