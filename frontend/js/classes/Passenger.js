class Passenger {

    url = 'http://localhost/MVC/Passenger'
    all = []
    Token
    guests = 0
    guestsData = []


    constructor() {
        this.Token = this.Token ? this.Token : localStorage.getItem("Token")
    }

    getPassengers = async () => {
        return fetch(`${this.url}/reservations`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${this.Token}`
            },
        }).then(Response => Response.json()).then(data => {
            this.all = []
            this.all = data
        })
    }

    getMyPassengers = async () => {
        cin = 0;
        return fetch(`${this.url}/myreservations`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${this.Token}`
            },
        }).then(Response => Response.json()).then(data => {
            this.all = []
            this.all = data
        })
    }



    delete = async (id) => {
        return fetch(`${this.url}/delete/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${this.Token}`
            },
        }).then(Response => Response.json()).then(data => {

        })
    }


    add = async (user) => {

        return fetch(`${this.url}/add`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${this.Token}`
            },
            body: JSON.stringify(user)
        })
            .then(Response => Response.json())
            .then(data => {
                return data
            })
    }

    edit = async (id, body) => {
        return fetch(`${this.url}/edit/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${this.Token}`
            },
            body: JSON.stringify(body)
        })
            .then(Response => Response.json())
            .then(data => {
                console.log(data);
            })
    }

    getPassengersByRes = async (res) => {
        return fetch(`${this.url}/resid/${res}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${this.Token}`
            }
        })
            .then(Response => Response.json())
            
    }

}