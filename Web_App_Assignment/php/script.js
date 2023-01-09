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

function Refresh-Chrome {
    Write-Output 'starting'
    while(1) { # Loop forever
        $sleep_time = 180
        Write-Output "sleeping for $sleep_time seconds"
        sleep -Seconds $sleep_time # Wait 3 minutes
        $wshell = New-Object -ComObject wscript.shell 
        if($wshell.AppActivate('Chrome')) { # Switch to Chrome
            Write-Output 'refreshing'
            Sleep 1 # Wait for Chrome to "activate"
            $wshell.SendKeys('{F5}')  # Send F5 (Refresh)
        }
        else {
            Write-Output 'breaking loop'
            break;
        } # Chrome not open, exit the loop
    }
}
#Refresh-WebPages
Refresh-Chrome
