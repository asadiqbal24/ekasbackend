<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>

<head>
  <title>Pusher Test</title>
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <!-- <script>
    Pusher.logToConsole = true;

    var pusher = new Pusher('9a564bc8b0ad4031db58', {
      cluster: 'ap2'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      alert(JSON.stringify(data));
    });
  </script> -->

  <!-- <script>
    const pusher = new Pusher('9a564bc8b0ad4031db58', {
      cluster: 'ap2',
      encrypted: true
    });

    const channel = pusher.subscribe('my-channel');

    channel.bind('App\\Events\\NotificationEvent', (data) => {
      alert(JSON.stringify(data));
      console.log(data);
      // Update your frontend UI here
    });
  </script> -->


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>
     Pusher.logToConsole = true;
    var pusher = new Pusher('9a564bc8b0ad4031db58', {
      cluster: 'ap2'
    });
    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      if (data && data.post && data.post.title && data.post.description) {
        toastr.success('New Post Created', 'Title: ' + data.post.title + '<br>Description: ' + data.post.description, {
          timeOut: 0,  
          extendedTimeOut: 0,  
        });
      } else {
        console.error('Invalid data structure received:', data);
      }
    });
  </script>


</head>

<body>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>
</body>