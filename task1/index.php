<!DOCTYPE html>
<html>

<head>
    <script src="https://unpkg.com/htmx.org"></script>
    <style>
        #notifications div {
            padding: 10px;
            border: 1px solid gray;
            width: auto;
        }
    </style>
</head>

<body>
    <h1>Notifications</h1>
    <div id="notifications" hx-get="sse.php" hx-trigger="load" hx-swap="innerHTML">
        <!-- Empty div for notifications -->
    </div>
    <script>
        const evtSource = new EventSource("sse.php");
        evtSource.onmessage = function(event) {
            const newElement = document.createElement("div");
            newElement.innerHTML = event.data;
            document.getElementById("notifications").prepend(newElement);
        };
    </script>
</body>

</html>