const ReserverUser = new Reservation()
const Passengers = new Passenger()

const reservePop = async (id) => {
    console.log(Passengers.guests);
    console.log(ReserverUser.flightIds);
    ReserverUser.flightIds.oneTrip = id
    const button = document.querySelector('.next')
    const dash = document.querySelector('.searchTable');
    const passengerForm = document.querySelector('.passengerContainer');
    passengerForm.style.display = 'none'
    dash.style.display = 'block'
    // dash.remove()
    if (Passengers.guests > 0) {
        dash.style.display = 'none'
        document.querySelector('#reservations').innerHTML =""
        Passengers.guests == 1 ? button.innerHTML = 'Reserve Now' : null
        passengerForm.style.display = 'block'
        // getReturnFlights(ReserverUser.flightIds.oneTrip)
    } else {
        if (ReserverUser.acceptedReturn && !ReserverUser.finished) {
            getReturnFlights(ReserverUser.flightIds.oneTrip)
        } else {
            dash.innerHTML = ""
            startReservation().then(result => {
                !result.error ? passengerForm.innerHTML = `<h1>${result.message}</h1>` : passengerForm.innerHTML = `<h1>${result.error}</h1>`
                passengerForm.style.display = 'block'
            })
        }

    }
}


const returnInfo = (id) =>{
    ReserverUser.flightIds.roudTrip = id
    console.log(ReserverUser.flightIds);
    ReserverUser.finished = true
    reservePop(ReserverUser.flightIds.oneTrip)
}

const getReturnFlights = (id) => {
    console.log(id);
    const returnForm = document.querySelector('#reservations')
    returnForm.innerHTML = ""
    
    flights.getReturns(id).then((result) => {
        result.map((f) => {
            console.log(f);
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
                    <button id="reserve" class="btn btn-sm btn-warning" onclick="returnInfo(${f.id})">Reserve Now</button>
                </td>
            </tr>`
            tr.setAttribute('id', f.id)
            console.log(tr);
            returnForm.appendChild(tr)
        })
    })
}


const reserveForUser = async () => {
    console.log(ReserverUser.flightIds);
    let UserReservation = {
        cin: authUser.getUserInfo().cin,
        flight: ReserverUser.flightIds.oneTrip,
        return_Flight: ReserverUser.flightIds.roudTrip,
        accepted_return: ReserverUser.acceptedReturn?1:0,
        guests: Passengers.guestsData.length + 1
    }
    console.log(UserReservation);
    return ReserverUser.add(UserReservation)
}



const startReservation = async () => {
    return reserveForUser().then((data) => {
        console.log(data);
        if (data.error) {
            return data
        } else {
            if (Passengers.guestsData.length > 0) {
                Passengers.guestsData.map(guest => {
                    guest.reservation = data.result.id
                    Passengers.add(guest)
                })
            }
        }
        return data
    })
}

const nextPassenger = (event) => {
    event.preventDefault()
    let email = document.querySelector('#PassengerEmail').value
    let cin = document.querySelector('#PassengerCin').value
    let first_name = document.querySelector('#Passengerfirst_name').value
    let last_name = document.querySelector('#Passengerlast_name').value
    let address = document.querySelector('#PassengerAddress').value
    let num_passport = document.querySelector('#PassengerPassport').value
    let birth_date = document.querySelector('#PassengerBirthday').value
    let phone = document.querySelector('#PassengerPhone').value
    let button = document.querySelector('.next')
    let number = document.querySelector('.passengerNumber')
    const passengerForm = document.querySelector('.passengerContainer');


    Passengers.guests = Passengers.guests - 1
    if (Passengers.guests > 0) {
        Passengers.guests == 1 ? button.innerHTML = 'Reserve Now' : null
        const guest = {
            email,
            cin,
            first_name,
            last_name,
            address,
            num_passport,
            birth_date,
            phone
        }

        Passengers.guestsData.push(guest)
        console.log(Passengers.guestsData);
        console.log(Passengers.guests);
        document.querySelector('#PassengerEmail').value = ""
        document.querySelector('#PassengerCin').value = ""
        document.querySelector('#Passengerfirst_name').value = ""
        document.querySelector('#Passengerlast_name').value = ""
        document.querySelector('#PassengerAddress').value = ""
        document.querySelector('#PassengerPassport').value = ""
        document.querySelector('#PassengerBirthday').value = ""
        document.querySelector('#PassengerPhone').value = ""
        number.innerHTML = `Passenger Number ${Passengers.guestsData.length + 1}`
    } else {
        const guest = {
            email,
            cin,
            first_name,
            last_name,
            address,
            num_passport,
            birth_date,
            phone
        }

        Passengers.guestsData.push(guest)
        console.log(Passengers.guestsData);
        console.log(Passengers.guests);
        // startReservation().then(result => {
        //     !result.error ? passengerForm.innerHTML = `<h1>${result.message}</h1>` : passengerForm.innerHTML = `<h1>${result.error}</h1>`
        //     passengerForm.style.display = 'block'
        // })
        reservePop(ReserverUser.flightIds.oneTrip)

    }

}





const dashRes = document.querySelector('#myreservations')
const getMy = () => {
    ReserverUser.getMyReservations().then(() => {
        console.log(ReserverUser.all);
        ReserverUser.all.map(result => {
            let tr = document.createElement('tr')
            console.log(result);
            /*html*/
            tr.innerHTML = `
                <td onclick="guests(${result.id})" class="td-hover" scope="col">
                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#guests" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Guests 
                    </a>
                </td>
                <td class="td-hover" scope="col">${result.airport}</td>
                <td class="td-hover" scope="col">${result.CityFrom}</td>
                <td class="td-hover" scope="col">${result.CityTo}</td>
                <td class="td-hover" scope="col">${result.going_time.split(' ')[0]}</td>
                <td class="td-hover" scope="col">${result.going_time.split(' ')[1]}</td>
                <td class="td-hover" scope="col">${result.price}</td>
                <td class="th-hover" scope="col">
                <button class="btn btn-sm btn-danger" onclick="cancelRes(${result.id})" type="button" data-mdb-toggle="modal" data-mdb-target="#deleteModal"><i class="fa fa-trash"></i></button>
            </td>               
            `

            dashRes.appendChild(tr)
        })
    })
}


dashRes ? getMy() : null

const showGuests = (result) => {
    const modal = document.querySelector('#guestsContainer')
    const table = modal.querySelector('tbody')
    table.innerHTML = ""
    modal.style.display = 'flex'
    result.map((result) => {
        let tr = document.createElement('tr')
        console.log(result);
        /*html*/
        tr.innerHTML = `
            <td onclick="guests(${result.cin})" class="td-hover" scope="col">${result.cin}</td>
            <td class="td-hover" scope="col">${result.first_name}</td>
            <td class="td-hover" scope="col">${result.last_name}</td>
            <td class="td-hover" scope="col">${result.phone}</td>
            <td class="td-hover" scope="col">${result.email}</td>
            <td class="td-hover" scope="col">${result.address}</td>
            <td class="td-hover" scope="col">${result.birth_date}</td>
            <td class="td-hover" scope="col">${result.num_passport}</td>
        `
        table.appendChild(tr)
    })
}
let container = document.querySelector('#guestsContainer')
container ? container.addEventListener('click', () => {
    let chapter = document.querySelector('#bar')
    document.body.style.overflowY = 'scroll'
    container.style.display = 'none'
    chapter.classList.toggle('open');
    document.querySelector('#page-content-wrapper').classList.toggle('toggled')
    document.querySelector('#sidebar-wrapper').classList.toggle('toggled')
}) : null

const guests = (id) => {
    let chapter = document.querySelector('#bar')
    document.body.style.overflow = 'hidden'
    document.body.scrollTop = 0;
    chapter.classList.toggle('open');
    document.querySelector('#page-content-wrapper').classList.toggle('toggled')
    document.querySelector('#sidebar-wrapper').classList.toggle('toggled')
    document.documentElement.scrollTop = 0;
    Passengers.getPassengersByRes(id).then((result) => {
        showGuests(result)
        console.log(result);

    })

}




const cancelRes = (id) => {
    document.querySelector('#ConfimeDeleteFlight').addEventListener('click', () => {
        console.log("started");
        ReserverUser.delete(id).then((result) => {
            dashRes.innerHTML = ""
            getMy()
            console.log(result);
        })
    })
}


let returnButton = document.querySelector('#returnButton')
returnButton.addEventListener('click', () => {
    returnButton.classList.toggle('accepted');
});

