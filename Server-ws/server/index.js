import express from 'express'
import logger from 'morgan'

import { Server } from 'socket.io';
import {createServer} from 'node:http';


const port = process.env.PORT ?? 8100;
const app = express();
const server = createServer(app)
const io = new Server(server,{
    connectionStateRecovery:{},
    cors: {
        origin: "http://localhost:8000",
        methods: ["GET", "POST"]
      }
});


io.on('connection',(socket )=>{
    console.log("user connected")

    socket.on('disconnect',()=>{
        console.log("user disconected")
    })

    socket.on('setConecction',(mensage)=>{
        //load all list channels
        console.log("evento setConnection")
        let channelList = [1,2,3,4]
        if(mensage.user === "pepe"){
            console.log(true)
            io.emit('setConecction',{channelList});
        }
        
    })







    socket.on('message',(mensage)=>{
        console.log("evento message :"+mensage.user);
        console.log("mensaje "+(mensage.mensaje))
        io.emit('message',mensage)
        
    })
    socket.on('error',(error)=>{
        console.log("error "+error)
    })
})


//logger
app.use(logger('dev'))

//route
app.get('/',(req,res) =>{
    res.sendFile(process.cwd()+'/client/index.html');

})


//listen
server.listen(port,()=>{
    console.log(`server running on port ${port}`)
})
