class Flight {

    url = 'http://localhost/MVC/Flight'
    all = []
    res = []
    Token
    flightId
    

    constructor() {
        this.Token = this.Token ? this.Token : localStorage.getItem("Token")
    }

    getFlights = async () => {
        this.all = []
        return fetch(`${this.url}/flights`, {
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
    add = async (flight) => {

         fetch(`${this.url}/add`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${this.Token}`
            },
            body: JSON.stringify(flight)
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

    getFlightsBySearch = async (body) => {
        return fetch(`${this.url}/search`, {
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
                this.all = data
            })
    }

    getFlightsById = async (id) => {
        return fetch(`${this.url}/info/${id}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${this.Token}`
            }
        })
            .then(Response => Response.json())
            .then(data => {
                this.res.push(data)
            })
    }


    getReturns = async (id) => {
        return fetch(`${this.url}/Return/${id}`, {
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