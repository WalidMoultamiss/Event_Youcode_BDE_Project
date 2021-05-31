register:

raw/body/select type JSON
http://localhost/Flights_booking_MVC/user/register

archive/delete:
check headers
key          | value         |
Autorization | Bearer "token"|

http://localhost/Flights_booking_MVC/user/archive/1


login:
http://localhost/Flights_booking_MVC/user/login