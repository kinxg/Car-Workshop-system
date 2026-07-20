// Check available slots when appointment date changes

let dateInput = document.getElementById("appointment_date");

dateInput.addEventListener("change", function () {

    let date = this.value;

    let xhr = new XMLHttpRequest();

    xhr.open("GET", "get_slots.php?date=" + date, true);

    xhr.onload = function () {

        if (this.status == 200) {

            let data = JSON.parse(this.responseText);

            data.forEach(function (mechanic) {

                let slot = document.getElementById("slot" + mechanic.mechanic_id);

                // Get the radio button inside the mechanic card
                let radio = slot.parentElement.querySelector("input[type='radio']");

                if (mechanic.remaining > 0) {

                    slot.innerHTML = "Available : " + mechanic.remaining + "/4";
                    slot.className = "slot success";

                    radio.disabled = false;

                } else {

                    slot.innerHTML = "FULL";
                    slot.className = "slot full";

                    // Disable selecting this mechanic
                    radio.disabled = true;

                    // If it was selected before, unselect it
                    radio.checked = false;
                }

            });

        }

    }

    xhr.send();

});


// Form Validation

function validateForm() {

    let name = document.getElementsByName("client_name")[0].value.trim();
    let address = document.getElementsByName("address")[0].value.trim();
    let phone = document.getElementsByName("phone")[0].value.trim();
    let license = document.getElementsByName("car_license")[0].value.trim();
    let engine = document.getElementsByName("engine_number")[0].value.trim();
    let date = document.getElementById("appointment_date").value;

    if (name == "") {
        alert("Please enter your name.");
        return false;
    }

    if (address == "") {
        alert("Please enter your address.");
        return false;
    }

    if (!/^[0-9]{11}$/.test(phone)) {
        alert("Phone number must contain exactly 11 digits.");
        return false;
    }

    if (!/^[0-9]+$/.test(engine)) {
        alert("Engine number must contain only numbers.");
        return false;
    }

    if (license == "") {
        alert("Please enter the car license number.");
        return false;
    }

    if (date == "") {
        alert("Please select an appointment date.");
        return false;
    }

    let today = new Date().toISOString().split("T")[0];

    if (date < today) {
        alert("Appointment date cannot be in the past.");
        return false;
    }

    if (document.querySelector("input[name='mechanic_id']:checked") == null) {
        alert("Please select a mechanic.");
        return false;
    }

    return true;
}


// Address Character Counter

let address = document.getElementById("address");

if (address) {

    address.addEventListener("keyup", function () {

        document.getElementById("count").innerHTML =
            this.value.length + " / 200";

    });

}