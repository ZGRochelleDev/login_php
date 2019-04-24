/* this file is not used */

<script type="text/javascript">
/* Set Cookie */
function setCookie() {
	var random = Math.floor((Math.random() * 1000000) + 1);
	document.cookie = "KM-Homework-Cookie" + "=" + random;
}

/* check Cookie */
function checkCookie() {
  var user = getCookie("username");
  if (user != "") {
    alert("Welcome again " + user);
  } else {
    user = prompt("Please enter your name:", "");
    if (user != "" && user != null) {
      setCookie("username", user, 365);
    }
  }
}
function hello() {

    alert( 'Hello, world!' );

}
</script>