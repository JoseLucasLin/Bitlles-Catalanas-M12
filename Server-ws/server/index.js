import express from 'express'
import logger from 'morgan'

import { Server } from 'socket.io';
import {createServer} from 'node:http';
import mysql from 'mysql';

//ejemplo de conneccion


//   con.connect(function(err) {
//     if (err) throw err;
//     con.query("SELECT * FROM users", function (err, result, fields) {
//       if (err) throw err;
//       console.log(result);
//     });
//   });

// active tournament
// var con = mysql.createConnection({
//     host: "localhost",
//     user: "root",
//     password: "onlycaL@123",
//     database: "bitlles_catalanas_m12"
//   });
//   con.connect(function(err) {
//     if (err) throw err;
//     con.query("SELECT * FROM `tournaments` WHERE start_date is null", function (err, result, fields) {
//       if (err) throw err;
//       console.log(result);
//     });
//   });



const port = process.env.PORT ?? 8100;
const app = express();
const server = createServer(app)
const io = new Server(server,{
    connectionStateRecovery:{},
    cors: {
        origin: ["http://localhost:8000", "http://localhost:8000/admin/tournament-manager"],
        methods: ["GET", "POST"]
      }
});

const con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "bitlles_catalanas_m12"
  });

con.connect(function (err) {
    if (err) {
        console.error("Error al conectar con MySQL:", err);
        return;
    }
    console.log("Conexión a MySQL establecida.");
});

io.on('connection',(socket )=>{
    console.log("user connected")

    socket.on('disconnect',()=>{
        console.log("user disconected")
    })


    socket.on('getTournaments',(getTournaments)=>{
        //load all list channels
        console.log("evento getTournaments")
        con.query("SELECT * FROM `tournaments` WHERE end_date is null", function (err, result, fields) {
        if (err) throw err;
            console.log(result)
        io.emit('getChanels',{result});
      });


    });


// Función mejorada para obtener fecha/hora en formato MySQL
function getCurrentDateTime() {
    const now = new Date();

    // Asegurar que los valores menores a 10 tengan leading zero
    const pad = num => num.toString().padStart(2, '0');

    const year = now.getFullYear();
    const month = pad(now.getMonth() + 1);
    const day = pad(now.getDate());
    const hours = pad(now.getHours());
    const minutes = pad(now.getMinutes());
    const seconds = pad(now.getSeconds());

    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
  }

  // Uso en tu código del servidor
  socket.on('activateTournament', (data) => {
    try {
      const { channelId, userId } = data;
      const startDate = getCurrentDateTime(); // Usando nuestra función mejorada

      console.log(`Iniciando torneo ${channelId} a las ${startDate}`);

      const query = "UPDATE tournaments SET start_date = ? WHERE id = ?";

      con.query(query, [startDate, channelId], (err, result) => {
        if (err) {
          console.error("Error en BD:", err);
          return socket.emit('tournamentResponse', {
            success: false,
            message: 'Error al actualizar la fecha de inicio'
          });
        }

        // Notificar a todos los clientes en el canal
        io.to(channelId).emit('tournamentUpdate', {
          event: 'tournament_started',
          channelId,
          startDate,
          message: `Torneo iniciado el ${startDate}`
        });

        // Confirmación al cliente que inició el torneo
        socket.emit('tournamentStarted', {
          success: true,
          startDate,
          message: 'Torneo iniciado correctamente'
        });
      });

    } catch (error) {
      console.error("Error general:", error);
      socket.emit('tournamentResponse', {
        success: false,
        message: 'Error interno del servidor'
      });
    }
  });



  // Uso en tu código del servidor
  socket.on('nextRound', (data) => {
    try {
      const { channelId, userId } = data;
      const startDate = getCurrentDateTime(); // Usando nuestra función mejorada

      console.log(`Iniciando torneo ${channelId} a las ${startDate}`);

      const query = "select * from rounds where id_tournament = ? and end_time is null order by id asc limit 1";
      //hacemos un update de start_time en el id mas bajo. y con ese
      const query2 = "select * from player_round where id_rounds = ?"; // id_rounds es id mas bajo del query anterior
      //query 2 dara varios

      con.query(query, [channelId], (err, result) => {
        if (err) {
          console.error("Error en BD:", err);
          return socket.emit('tournamentResponse', {
            success: false,
            message: 'Error al actualizar la fecha de inicio'
          });
        }

        // Notificar a todos los clientes en el canal
        io.to(channelId).emit('tournamentUpdate', {
          event: 'tournament_started',
          channelId,
          startDate,
          message: `Torneo iniciado el ${startDate}`
        });

        // Confirmación al cliente que inició el torneo
        socket.emit('tournamentStarted', {
          success: true,
          startDate,
          message: 'Torneo iniciado correctamente'
        });
      });

    } catch (error) {
      console.error("Error general:", error);
      socket.emit('tournamentResponse', {
        success: false,
        message: 'Error interno del servidor'
      });
    }
  });



    socket.on('joinChannel', (channelId) => {
        console.log(`Usuario ${socket.id} se unió al canal ${channelId}`);
        socket.join(channelId); // Se une al canal
    });


    socket.on('sendMessage', (data) => {
        io.to("1").emit('newMessage', data);
    });

socket.on('submitScore', (data) => {
    console.log('Puntuación recibida:', data);

io.to(data.tournamentId).emit('submitScore', data);






    // Procesar los datos, como guardarlos en la base de datos o hacer alguna otra acción
});



socket.on('nextRound2', (data) => {
    console.log(`Avanzando a la ronda ${data.nextRound} en canal ${data.channelId}`);
    io.to(data.channelId).emit('nextRound2', data); 
});



/*

    socket.on('message',(mensage)=>{
        console.log("evento message :"+mensage.user);
        console.log("mensaje "+(mensage.mensaje))
        io.emit('message',mensage)

    })*/
    socket.on('error',(error)=>{
        console.log("error "+error)
    })
})


//logger
app.use(logger('dev'))

//route
// app.get('/',(req,res) =>{
//     res.sendFile(process.cwd()+'/client/index.html');

// })


//listen
server.listen(port,()=>{
    console.log(`server running on port ${port}`)
})
