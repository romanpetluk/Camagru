var form = document.querySelector(".register__field");

if (form) {
  form.addEventListener("submit", function(e) {
    e.preventDefault();

    var login = document.querySelector('input[name="login"]').value;
    var email = document.querySelector('input[name="email"]').value;
    var password = document.querySelector('input[name="password"]').value;

    function validateLogin(e) {
      var re = /^(?=.*[a-zA-Z])[\w]{3,15}$/;
      return re.test(String(e));
    }

    function validatePassword(e) {
      var re = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,20}$/;
      return re.test(String(e));
    }

    function validateEmail(e) {
      var re = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
      return re.test(String(e).toLowerCase());
    }

    var conditionVerify =
        validateLogin(login) &&
        validateEmail(email) &&
        validatePassword(password);

    if (!conditionVerify) {
      alert("Please check the entered data in the form!");
    } else if (conditionVerify) {
      var bodyRequest =
          "email=" +
          encodeURIComponent(email) +
          "&login=" +
          encodeURIComponent(login) +
          "&password=" +
          encodeURIComponent(password);

      var request = new XMLHttpRequest();

      request.open("POST", "/account/register", true);

      request.setRequestHeader(
          "Content-type",
          "application/x-www-form-urlencoded"
      );
      request.send(bodyRequest);

      request.addEventListener("readystatechange", function() {
        if (request.readyState == 4 && request.status == 200) {
          alert("Ваша заявка успішно відправлена");
          form.innerHTML = "<h2>Приємного користування нашим ресурсом</h2>";
        }
      });
    }
  });
}
