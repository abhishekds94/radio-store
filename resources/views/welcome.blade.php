<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
   <head>
      <link rel="stylesheet" href="/dash/assets/css/styles.min.css" />
   </head>
   <body>
      <div style="padding: 50px 20px" class="container-fluid row d-flex align-items-center justify-content-center">

      <div style="max-width: 500px; margin: auto;">
          <audio style="display:none" id="radio" src="https://s2.radio.co/s4bd265641/listen" controls></audio>
      </div>

      <div  id="radioErrorInfo" class="alert alert-info" role="alert">
         <h4 class="alert-heading">
               <strong role="status">Loading your location...</strong>
               <div class="spinner-border ms-auto spinner-border-sm" aria-hidden="true"></div>
          </h4>
         <p>You have to turn on location on your device and <code>allow</code> this web page to use your location.</p>

      <div class="toast" id="toast">
          <div class="toast-body">
          </div>
      </div>
   </div>

      <script src="/dash/assets/libs/jquery/dist/jquery.min.js"></script>
      <script type = "text/javascript">
         let zipCode = null;
         let fullAddress;

         window.onload = function() {
            getLocation();
         };

         function showLocation(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            var latlongvalue = position.coords.latitude + ","
                              + position.coords.longitude;

            fetch(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${latlongvalue}&key=AIzaSyBm1IHCdNsqfk5MzhNRmu5NIVebUUGWtmQ`)

            .then((responseText) => {
                return responseText.json();
            })
            .then(jsonData => {
               fullAddress = jsonData.results[0].formatted_address
               setClientFullAddress(fullAddress)
               $('#radioErrorInfo').hide();
               $('#radio').show();
               zipCode = extractZipCode(jsonData.results[0].address_components);
            })
            .catch(error => {
               $('#radioErrorInfo').show();
                console.log(error);

              })
         }

         function setClientFullAddress(address) {
            // Send an HTTP GET request to the specified URL
            $.ajax({
               type: "POST",
               url: "{{url('/')}}/api/guest/set_address",
               data: {address},
               success: () => {
                  console.log('HTTP request successful');

               },
            })
         }

         function extractZipCode(addressComponents) {
            for (let i = 0; i < addressComponents.length; i++) {
               const component = addressComponents[i];
               if (component.types.includes("postal_code")) {
                  return component.long_name;
               }
            }
            // Return null if no postal code is found
            return null;
         }
         function errorHandler(err) {
            if(err.code == 1) {
               alert("Error: Access is denied!");
            }else if( err.code == 2) {
               alert("Error: Position is unavailable!");
            }
         }
         function getLocation(){
            if(navigator.geolocation){
               // timeout at 60000 milliseconds (60 seconds)
               var options = {timeout:60000};
               navigator.geolocation.getCurrentPosition
               (showLocation, errorHandler, options);
            }else{
               alert("Sorry, browser does not support geolocation!");
            }
         }
         function sendSetActiveRequest() {

            // Send an HTTP GET request to the specified URL
            $.get(`{{url('/')}}/api/store/${zipCode}/set_active`, function(data, status) {
                if (status === 'success') {
                    console.log('HTTP request successful');
                } else {
                    console.error('HTTP request failed');
                }
            });
        }
        function sendSetPauseRequest() {
            $.get(`{{url('/')}}/api/store/${zipCode}/set_inactive`, function(data, status) {
                if (status === 'success') {
                    console.log('Pause request successful');
                } else {
                    console.error('Pause request failed');
                }
            });
        }

         $('#radio').on('play', function() {
            var audio = $(this)[0]; // Get the actual DOM audio element
            console.log(audio.muted, audio.volume)
            // Call the function to send the HTTP request
            if(!audio.muted) {
               sendSetActiveRequest();
            }
         });

         $('#radio').on('volumechange', function() {
            var audio = $(this)[0]; // Get the actual DOM audio element
            if (audio.muted || audio.volume === 0) {
               // Volume is either muted or set to 0
               if(!audio.paused) {
                  sendSetPauseRequest();
               }
            } else {
               if(!audio.paused) {
                  sendSetActiveRequest();
               }
            }
         });

         $('#radio').on('pause', function() {
            sendSetPauseRequest();
         });
         window.addEventListener('beforeunload', function(e) {
            sendSetPauseRequest();
         })
      </script>
   </body>
</html>
