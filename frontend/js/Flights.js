let flights = new Flight()




flights.getFlights()


const dash = document.querySelector('#flights');
const showFlights = async () => {
    setTimeout(() => {
        flights.all.map((f) => {
            color = f.available_places > 10 ? `<span class="badge badge-success">${f.available_places}</span>` : `<span class="badge badge-failed">${f.available_places}</span>`
            let tr = document.createElement('tr')
            /*html*/
            tr.innerHTML = `
            <tr>
            <th scope="row"> ${f.airport}</th>
            <td colspan="">${f.CityFrom}</td>
            <td> ${f.CityTo}</td>
            <td colspan=""> ${f.going_time.split(' ')[0]}</td>
            <td>${f.going_time.split(' ')[1]}</td>
            <td>${f.price} DH</td>
            <td class="d-flex flex-row justify-content-between">
            ${color}
            <button class="btn btn-sm btn-warning" onclick="EditFlight(${f.id})"><i class="fa fa-edit"></i></button>
            <button class="btn btn-sm btn-danger" onclick="DeleteFlight(${f.id})" type="button" data-mdb-toggle="modal" data-mdb-target="#deleteModal"><i class="fa fa-trash"></i></button>
            </td>
            </tr>`
            tr.setAttribute('id', f.id)
            dash.appendChild(tr)
        })
    }, 300);
}

const resDash = document.querySelector('#reservations');
const showFlightsReserve = async () => {
    setTimeout(() => {
        flights.all.map((f) => {
            color = f.available_places > 10 ? `<span class="badge badge-success">${f.available_places}</span>` : `<span class="badge badge-failed">${f.available_places}</span>`
            let tr = document.createElement('tr')
            /*html*/
            tr.innerHTML = `
            <tr>
            <th scope="row"> ${f.airport}</th>
            <td colspan="">${f.CityFrom}</td>
            <td> ${f.CityTo}</td>
            <td colspan=""> ${f.going_time.split(' ')[0]}</td>
            <td>${f.going_time.split(' ')[1]}</td>
            <td>${f.price} DH</td>
            <td class="d-flex flex-row justify-content-between">
            ${color}
                <button id="reserve" class="btn btn-sm btn-warning" onclick="reservePop(${f.id})">Reserve Now</button>
            </td>
        </tr>`
            tr.setAttribute('id', f.id)
            resDash.appendChild(tr)
        })
    }, 300);
}


resDash ? showFlightsReserve() : null
dash ? showFlights() : null

const DeleteFlight = (id) => {
    const confirme = document.querySelector('#ConfimeDeleteFlight')
    console.log(confirme);
    confirme.setAttribute('onclick', `ConfimeDeletet(${id})`)
}


const ConfimeDeletet = (id) => {
    const modal = document.querySelector('#deleteModal')
    const dash = document.querySelector('#flights');
    flights.delete(id).then(() => {
        flights.getFlights().then(() => {
            dash.innerHTML = ''
            showFlights()
        })

    })

}


const showModal = () => {
    const modal = document.querySelector('#addModal')
    const dash = document.querySelector('#flights');
    modal.style.display = 'flex'

}
const closeModal = () => {
    const dash = document.querySelector('#flights');
    const modal = document.querySelector('#addModal')
    flights.getFlights().then(() => {
        dash.innerHTML = ''
        showFlights()
        modal.style.display = 'none'
    })
    const form = document.querySelector('#addForm')
    const going_time = document.querySelector('#going_time')
    const arriving_time = document.querySelector('#arriving_time')
    const Country_from = document.querySelector('#Country_from')
    const Country_to = document.querySelector('#Country_to')
    const CityFrom = document.querySelector('#CityFrom')
    const CityTo = document.querySelector('#CityTo')
    const available_places = document.querySelector('#available_places')
    const price = document.querySelector('#price')
    const airport = document.querySelector('#airport')
    going_time.value = ""
    arriving_time.value = ""
    Country_from.value = ""
    Country_to.value = ""
    CityFrom.value = ""
    CityTo.value = ""
    available_places.value = ""
    price.value = ""
    airport.value = ""
    form.querySelectorAll('input').forEach(e => {
        e.classList.remove('active')
        e.blur()
    });
}



const addForm = (event) => {
    const form = document.querySelector('#addForm')
    const going_time = document.querySelector('#going_time')
    const arriving_time = document.querySelector('#arriving_time')
    const Country_from = document.querySelector('#Country_from')
    const Country_to = document.querySelector('#Country_to')
    const CityFrom = document.querySelector('#CityFrom')
    const CityTo = document.querySelector('#CityTo')
    const available_places = document.querySelector('#available_places')
    const price = document.querySelector('#price')
    const airport = document.querySelector('#airport')

    event.preventDefault()
    let flight = {
        going_time: going_time.value,
        arriving_time: arriving_time.value,
        Country_from: Country_from.value,
        Country_to: Country_to.value,
        CityFrom: CityFrom.value,
        CityTo: CityTo.value,
        available_places: available_places.value,
        price: price.value,
        airport: airport.value
    }
    flights.add(flight).then(()=>{
        closeModal()
    })

}


const fireEdit = (event, id) => {
    const going_time = document.querySelector('#going_time')
    const arriving_time = document.querySelector('#arriving_time')
    const Country_from = document.querySelector('#Country_from')
    const Country_to = document.querySelector('#Country_to')
    const CityFrom = document.querySelector('#CityFrom')
    const CityTo = document.querySelector('#CityTo')
    const available_places = document.querySelector('#available_places')
    const price = document.querySelector('#price')
    const airport = document.querySelector('#airport')
    event.preventDefault()
    let body = {
        going_time: going_time.value,
        arriving_time: arriving_time.value,
        Country_from: Country_from.value,
        Country_to: Country_to.value,
        CityFrom: CityFrom.value,
        CityTo: CityTo.value,
        available_places: available_places.value,
        price: price.value,
        airport: airport.value
    }
    console.log(body);
    flights.edit(id, body).then((data) => {
        console.log(data);
        closeModal()
    })
}


const EditFlight = (id) => {
    const form = document.querySelector('#addForm')
    const going_time = document.querySelector('#going_time')
    const arriving_time = document.querySelector('#arriving_time')
    const Country_from = document.querySelector('#Country_from')
    const Country_to = document.querySelector('#Country_to')
    const CityFrom = document.querySelector('#CityFrom')
    const CityTo = document.querySelector('#CityTo')
    const available_places = document.querySelector('#available_places')
    const price = document.querySelector('#price')
    const airport = document.querySelector('#airport')
    const button = form.querySelector('button')
    button.innerHTML = 'Edit'
    button.setAttribute('onclick', `fireEdit(event,${id})`)
    flights.all.map((flight) => {
        if (flight.id == id) {
            let a = new Date(flight.going_time)
            let b = new Date(flight.arriving_time)
            console.log(a);
            going_time.value = a.toISOString().slice(0, 16)
            arriving_time.value = b.toISOString().slice(0, 16)
            Country_from.value = flight.Country_from
            Country_to.value = flight.Country_to
            CityFrom.value = flight.CityFrom
            CityTo.value = flight.CityTo
            available_places.value = flight.available_places
            price.value = flight.price
            airport.value = flight.airport

            showModal()
        }
    })
    form.querySelectorAll('input').forEach(e => {
        e.focus()
    });
}




getInfoSearch = (e) => {
    document.querySelector('#smallMess').innerHTML = ""
    const dash = document.querySelector('#reservations');
    const airport = document.querySelector('#airport').value
    const Destination = document.querySelector('#Destination').value
    const Going = document.querySelector('#Going').value
    const ReturnToggle = document.querySelector('#returnButton').classList.contains('accepted')
    const Guests = document.querySelector('#Guests').value
    e.preventDefault()
    let data = {
        airport,
        CityTo: Destination,
        going_time: Going,
    }

    flights.getFlightsBySearch(data).then(result => {
        Passengers.guests = Guests
        ReserverUser.acceptedReturn = ReturnToggle
        ReserverUser.finished = false
        dash.innerHTML = ''
        showFlightsReserve()
    })

}

