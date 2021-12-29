<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Kite</title>
    <style>
        .overlay {
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            position: fixed;
            background: #222;
        }

        .overlay__inner {
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            position: absolute;
        }

        .overlay__content {
            left: 50%;
            position: absolute;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        .spinner {
            width: 75px;
            height: 75px;
            display: inline-block;
            border-width: 2px;
            border-color: rgba(255, 255, 255, 0.05);
            border-top-color: #fff;
            animation: spin 1s infinite linear;
            border-radius: 100%;
            border-style: solid;
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="d-flex flex-column justify-content-center align-items-center text-center min-vw-100 min-vh-100">
        <h1 class="m-5">Instrument</h1>
        <div id="data"></div>
    </div>

    <div id="overlay" class="">
        <div class="overlay__inner">
            <div class="overlay__content"><span id="spinner"></span></div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

    <script>
        let ws = '';
        let api_key = "{{ _credential('api_key') }}";
        let access_token = "{{ _credential('access_token') }}";

        $("#overlay").addClass('overlay');
        $("#spinner").addClass('spinner');
        
        $(document).ready(function(){
            _instrument();
            _web_socket();
        });

        function _instrument(){
            $.ajax({
                url: "{{ route('instrument') }}",
                type: 'get',
                dataType: 'json',
                async: false,
                success: function(response) {
                    $("#overlay").removeClass('overlay');
                    $("#spinner").removeClass('spinner');
                    // console.log(response);
                },
                error: function(error) {
                    $("#overlay").removeClass('overlay');
                    $("#spinner").removeClass('spinner');
                    // console.log(error);
                }
            });
        }

        function _web_socket(){
            if ("WebSocket" in window) {
                ws = new WebSocket("wss://ws.kite.trade?api_key="+api_key+"&access_token="+access_token);
                
                ws.onopen = function() {
                    message = {"a": "mode", "v": ["full", [263433]]};
                    ws.send(JSON.stringify(message))
                };
				
                ws.onmessage = function (evt) { 
                    let data = evt.data;
                    console.log(data);
                };
				
                ws.onclose = function() { 
                    _web_socket();
                };
            } else {
               alert("WebSocket NOT supported by your Browser!");
            }
        }
    </script>
    
</body>

</html>