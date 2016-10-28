/**
 * Created by Son on 28/09/2016.
 */

var http = require('http');
// var dispatcher = require('httpdispatcher');
function handleRequest(request, response){
    try {
        response.writeHead(200, {"Content-Type": "text/html"});
        response.write("<!DOCTYPE \"html\">");
        response.write("<html>");
        response.write("<head>");
        response.write("<title>Hello World Page</title>");
        response.write("</head>");
        response.write("<body>");
        response.write("Hello World!");
        response.write("</body>");
        response.write("</html>");
        response.end();
    } catch(err) {
        console.log(err);
    }
}

//Create a server
var servidor = http.createServer(handleRequest);


// var servidor = http.createServer();

var io = require('socket.io').listen(servidor);
var port = 5000;

io.sockets.on('connection', function(socket)
{
    socket.on("cake_event", function(data){
        console.log(data);
        io.sockets.emit("cake_response", data);
    });
});

servidor.listen(port, function(){
    // console.log("http://localhost: " + port);
});
