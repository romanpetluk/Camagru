var recovery = document.querySelector(".recovery__field");

if (recovery) {
  recovery.addEventListener("submit", function(e) {
    e.preventDefault();
    var emailRecovery = document.querySelector('input[name="email"]').value;

    var bodyRequestRecovery = "&email=" + encodeURIComponent(emailRecovery);

    var requestRecovery = new XMLHttpRequest();

    requestRecovery.open("POST", "/account/recovery", true);
    requestRecovery.setRequestHeader(
      "Content-type",
      "application/x-www-form-urlencoded"
    );
    requestRecovery.send(bodyRequestRecovery);

    requestRecovery.addEventListener("readystatechange", function() {
      if (requestRecovery.readyState == 4 && requestRecovery.status == 200) {
        var responseText = JSON.parse(requestRecovery.response);
        if (responseText.status === "error") {
          alert(responseText.message);
        } else if (responseText.status === "success") {
          alert(responseText.message);
          document.location.href = "./login";
        }
      }
    });
  });
}
