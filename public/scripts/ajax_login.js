var form = document.querySelector(".form");

if (form) {
  form.addEventListener("submit", function(e) {
    e.preventDefault();
    var loginForm = document.querySelector('input[name="login"]').value;
    var passwordForm = document.querySelector('input[name="password"]').value;

    var bodyRequestForm =
      "&login=" +
      encodeURIComponent(loginForm) +
      "&password=" +
      encodeURIComponent(passwordForm);

    var requestForm = new XMLHttpRequest();

    requestForm.open("POST", "/account/login", true);
    requestForm.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );
    requestForm.send(bodyRequestForm);

    requestForm.addEventListener("readystatechange", function() {
      if (requestForm.readyState == 4 && requestForm.status == 200) {
        if (requestForm.response.includes('"status":"error"')) {
          var responseText = JSON.parse(requestForm.response);
          if (responseText && responseText.status === "error") {
            alert(responseText.message);
          }
        } else {
          document.location.href = "../photo/gallery/1";
        }
      }
    });
  });
}
