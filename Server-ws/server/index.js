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
const io = new Server(server, {
    connectionStateRecovery: {},
    cors: {
        origin: ["http://localhost:8000","http://localhost:8000/*", "http://127.0.0.1:8000"],
        methods: ["GET", "POST"],
        credentials: true,
        allowedHeaders: ["*"]
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

    // Validar datos recibidos
    if (!data.tournamentId || !data.player || !data.throws || !Array.isArray(data.throws) || data.throws.length !== 3) {
        console.error("Datos de puntuación incompletos o incorrectos:", data);
        socket.emit('scoreError', {
            success: false,
            message: 'Datos de puntuación inválidos'
        });
        return;
    }

    // Emitir a todos los clientes en el canal del torneo para actualización en tiempo real
    io.to(data.tournamentId).emit('submitScore', data);

    // Guardar en la base de datos
    try {
        // Preparar los datos para guardar
        const t1 = parseInt(data.throws[0]) || 0;
        const t2 = parseInt(data.throws[1]) || 0;
        const t3 = parseInt(data.throws[2]) || 0;
        const roundNumber = data.round || 1;

        // Calcular total de puntos para este lanzamiento
        const totalPoints = t1 + t2 + t3;

        // Buscar el registro existente o crear uno nuevo
        const checkExistingQuery = "SELECT id, t1, t2, t3 FROM rounds WHERE id_tournament = ? AND id_field = ? AND id_player = ? AND round_number = ?";

        con.query(checkExistingQuery, [data.tournamentId, data.fieldId, data.player, roundNumber], (err, result) => {
            if (err) {
                console.error("Error al buscar registro existente:", err);
                socket.emit('scoreError', {
                    success: false,
                    message: 'Error al buscar datos de puntuación'
                });
                return;
            }

            if (result.length > 0) {
                // Actualizar registro existente
                const updateQuery = "UPDATE rounds SET t1 = ?, t2 = ?, t3 = ? WHERE id = ?";
                con.query(updateQuery, [t1, t2, t3, result[0].id], (err) => {
                    if (err) {
                        console.error("Error al actualizar puntuación:", err);
                        socket.emit('scoreError', {
                            success: false,
                            message: 'Error al actualizar puntuación'
                        });
                    } else {
                        console.log("Puntuación actualizada en la BD. Ronda:", roundNumber, "Jugador:", data.player);

                        // También actualizar las estadísticas del jugador en stats_player_tournaments
                        updatePlayerStats(data.tournamentId, data.player);

                        // Confirmar éxito al cliente
                        socket.emit('scoreSubmitted', {
                            success: true,
                            message: 'Puntuación guardada correctamente',
                            round: roundNumber
                        });
                    }
                });
            } else {
                // Crear nuevo registro
                const insertQuery = "INSERT INTO rounds (id_tournament, id_field, id_player, round_number, t1, t2, t3, id_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                con.query(insertQuery, [data.tournamentId, data.fieldId, data.player, roundNumber, t1, t2, t3, 1], (err) => {
                    if (err) {
                        console.error("Error al insertar puntuación:", err);
                        socket.emit('scoreError', {
                            success: false,
                            message: 'Error al guardar puntuación'
                        });
                    } else {
                        console.log("Nueva puntuación guardada en la BD. Ronda:", roundNumber, "Jugador:", data.player);

                        // También actualizar las estadísticas del jugador en stats_player_tournaments
                        updatePlayerStats(data.tournamentId, data.player);

                        // Confirmar éxito al cliente
                        socket.emit('scoreSubmitted', {
                            success: true,
                            message: 'Puntuación guardada correctamente',
                            round: roundNumber
                        });
                    }
                });
            }
        });
    } catch (error) {
        console.error("Error al guardar puntuación:", error);
        socket.emit('scoreError', {
            success: false,
            message: 'Error interno al procesar la puntuación'
        });
    }
});

// Función para actualizar las estadísticas globales del jugador en el torneo
function updatePlayerStats(tournamentId, playerId) {
    // Primero obtenemos todas las puntuaciones del jugador en este torneo
    const query = `
        SELECT SUM(t1) + SUM(t2) + SUM(t3) as total_points,
               COUNT(*) as total_throws
        FROM rounds
        WHERE id_tournament = ? AND id_player = ?
    `;

    con.query(query, [tournamentId, playerId], (err, result) => {
        if (err || !result.length) {
            console.error("Error al calcular estadísticas del jugador:", err);
            return;
        }

        const totalPoints = result[0].total_points || 0;
        const totalThrows = result[0].total_throws || 0;

        // Calculamos precisión (podría ser un cálculo más complejo según tus reglas)
        const accuracy = totalThrows > 0 ? Math.min(100, Math.round((totalPoints / (totalThrows * 3 * 10)) * 100)) : 0;

        // Actualizamos la tabla de estadísticas
        const updateStatsQuery = `
            UPDATE stats_player_tournaments
            SET total_points = ?, accuracy = ?
            WHERE id_tournament = ? AND id_player = ?
        `;

        con.query(updateStatsQuery, [totalPoints, accuracy, tournamentId, playerId], (err) => {
            if (err) {
                console.error("Error al actualizar estadísticas:", err);
            } else {
                console.log("Estadísticas actualizadas para jugador:", playerId);
            }
        });
    });
}

socket.on('nextRound2', (data) => {
    console.log(`Avanzando a la ronda ${data.nextRound} en canal ${data.channelId}`);

    // Validar los datos recibidos
    if (!data.channelId || !data.nextRound) {
        console.error("Datos de avance de ronda incompletos:", data);
        return;
    }

    // Actualizar la ronda actual en la base de datos
    const updateRoundQuery = "UPDATE tournaments SET current_round = ? WHERE id = ?";

    con.query(updateRoundQuery, [data.nextRound, data.channelId], (err, result) => {
        if (err) {
            console.error("Error al actualizar la ronda actual:", err);
            socket.emit('roundUpdateError', {
                success: false,
                message: 'Error al avanzar de ronda'
            });
        } else {
            console.log(`Ronda actualizada a ${data.nextRound} para torneo ${data.channelId}`);

            // Notificar a todos los clientes en el canal
            io.to(data.channelId).emit('nextRound2', data);

            // Confirmar éxito al cliente que inició el avance
            socket.emit('roundUpdated', {
                success: true,
                message: `Avanzado a ronda ${data.nextRound}`,
                currentRound: data.nextRound
            });
        }
    });
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
