<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <script type="module">
        import { io } from 'https://cdn.socket.io/4.3.2/socket.io.esm.min.js'
        const socket = io('http://localhost:8100');
        const form = document.getElementById('form')
        const input= document.getElementById('mensaje')
        const userInput= document.getElementById('user')
        const menssage= document.getElementById('menssage')

        socket.on('message',(e)=>{
           console.log(e);
            const item = `<li>${e.user}:${e.mensaje}</li>`
            menssage.insertAdjacentHTML('beforeend',item)
        })

        socket.on('setConecction',(e)=>{
           console.log(e);
        })

        form.addEventListener('submit',(e)=>{
            e.preventDefault();
           

            if(input.value){
                var mensaje = { "user" : userInput.value ,
                                "mensaje" : input.value
                };
                console.log(mensaje)
                console.log(mensaje);
                socket.send(mensaje);
                var setConecction = { "user" : userInput.value ,
                                        "mensaje" : input.value
                };
                socket.emit('setConecction',mensaje);
                input.value=""
            }
        })
    </script>
    <style>
        #chat{
            border:1px solid blue;
        }
    </style>
</head>
<body>
    <select value="a"></select>
    <h1>Chat Ejemplo</h1>
    <div id="chat">
        <form id="form" action="">
        <il id="menssage"></il>
        <input type="text" name="user" id="user">
        <input type="text" name="mensaje" id="mensaje">
        <input type="submit" value="send">
    </form>
    </div>
</body>
</html>