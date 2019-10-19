var profile = document.querySelector(".profile__field");

if (profile) {
  profile.addEventListener("submit", function(e) {
    e.preventDefault();

    var login = document.querySelector('input[name="login"]').value;
    var email = document.querySelector('input[name="email"]').value;
    var password = document.querySelector('input[name="password"]').value;
    var notifyValue = document.querySelector('input[name="notify"]').checked;
    var notify = notifyValue ? 1 : 0;

    var bodyRequest =
      "email=" +
      encodeURIComponent(email) +
      "&login=" +
      encodeURIComponent(login) +
      "&password=" +
      encodeURIComponent(password) +
      "&notify=" +
      encodeURIComponent(notify);

    var bodyRequestV2 =
      "email=" +
      encodeURIComponent(email) +
      "&login=" +
      encodeURIComponent(login) +
      "&password=" +
      encodeURIComponent(password);

    var finishBody = notifyValue ? bodyRequest : bodyRequestV2;

    var request = new XMLHttpRequest();

    request.open("POST", "/account/profile", true);

    request.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );
    request.send(finishBody);

    request.addEventListener("readystatechange", function() {
      if (request.readyState == 4 && request.status == 200) {
        if (request.response.includes('"status":"error"')) {
          var responseText = JSON.parse(request.response);
          if (responseText && responseText.status === "error") {
            alert(responseText.message);
          }
        } else {
          alert("changes saved");
          document.location.reload(true);
        }
      }
    });
  });
}
