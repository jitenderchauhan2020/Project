
var clickNumber = 0;
var rand = Math.random() * 100;
var otp = Math.floor(rand);
var count = 0;
var found = 0;

console.log(otp);

function pushz(elem) {
  //chances
  count++;
  var chance = 5 - count;

  if (chance <= 5 && chance > 0) {
    document.getElementById("remaining").innerHTML =
      chance + " chance left";
  } else {
    document.getElementById("remaining").innerHTML = " ";
  }

  var x = elem.value;
  clickNumber = x;
  if (clickNumber == otp || found == 1) {
    // quit = 1;
    document.getElementById("alert").innerHTML =
      "Hurray ! You Done Successfully";
    document.getElementById("remaining").innerHTML = "";
    found = 1;
  } else if (count == 5 && found == 0) {
    document.getElementById("alert").innerHTML =
      "<h5>Better Luck Next Time !</h5> ";
    document.getElementById("remaining").innerHTML = "";
  } else if (otp < clickNumber) {
    document.getElementById("logical").innerHTML =
      "Number is Smaller than " + clickNumber;
  } else if (otp > clickNumber) {
    document.getElementById("logical").innerHTML =
      "Number is Greater than " + clickNumber;
  } else {
    document.getElementById("alert").innerHTML =
      "<h5>Better Luck Next Time !</h5> ";
    document.getElementById("remaining").innerHTML = "";
  }
  // if (chance <= 5 && chance > 0) {
  //   document.getElementById("remaining").innerHTML =
  //     chance + " chance left";
  // }
}


