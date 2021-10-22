const botonesTurnoDia = document.querySelectorAll('.turno_no_escogido');
const h1FechaCronograma = document.getElementById('h1FechaCronograma');
const inputIdUsuario = document.getElementById('idUsuario');

const idUsuario = inputIdUsuario.value;

let fecha = new Date();
do {
    fecha.setDate(fecha.getDate()-1);
    
}while(fecha.getDay()!=0);

fechaInicio = fecha.getFullYear()+'-'+(fecha.getMonth()+1)+'-'+fecha.getDate();
fecha.setDate(fecha.getDate()+6);
fechaFin = fecha.getFullYear()+'-'+(fecha.getMonth()+1)+'-'+fecha.getDate();

h1FechaCronograma.innerText = `Cronograma del ${fechaInicio} al ${fechaFin}`;




async function ObtenerTurnos() {
    let data = new URLSearchParams();
    data.append("fecha", fechaInicio);

    let ruta = "http://localhost/senasoft-repositorio/php/scripts/cronograma/obtener-turnos.script.php";

    let request = fetch(ruta, {
        method: 'post',
        body: data
    })

    let peticion = await request;
    let resultado = await peticion.json();
    return resultado;
}


async function LLamarObtenerTurnos(){
    datosCronograma = await ObtenerTurnos();

    for (let boton of botonesTurnoDia){
        boton.setAttribute('class','turno_no_escogido');
    }


    if(datosCronograma['estado']){
        
        let empleadosPorTurno = datosCronograma['cantidadEmpleados'];
        if(empleadosPorTurno%2==1){
            empleadosPorTurno++;
        }
        empleadosPorTurno/=2;

        let dateInicio = new Date(fechaInicio);
        dateInicio.setDate(dateInicio.getDate()+1);

        let combinaciones = {};
        let fechasRecibidas = [];
        let idsRecibidas = [];

        for(let dato of datosCronograma['datos']){  

            let fecha = dato[2];
            let dateTemporal = new Date(fecha);
            dateTemporal.setDate(dateTemporal.getDate()+1);

            let diasDiferencia = (dateTemporal.getTime()-dateInicio.getTime())/(1000 * 3600 * 24);

            let combinacion = dato[1]+"-"+diasDiferencia;
            fechasRecibidas.push(combinacion);
            if(combinaciones[combinacion]!=undefined){
                combinaciones[combinacion]++;

            }else{
                combinaciones[combinacion]=1;

            }
            idsRecibidas.push(dato[0]);
        }


        for(let i=0; i<fechasRecibidas.length; i++){
            let datosAux = fechasRecibidas[i].split("-");
            for (let boton of botonesTurnoDia){
                if(boton.getAttribute('horario')==datosAux[0] && boton.getAttribute('dia')==datosAux[1]){
                    boton.setAttribute('class','turno_en_proceso');

                }  
            }
        }

        for(let i=0; i<Object.keys(combinaciones).length; i++){
            if(Object.values(combinaciones)[i]>=empleadosPorTurno){
                let datosAux = Object.keys(combinaciones)[i].split("-");
                for (let boton of botonesTurnoDia){
                    if(boton.getAttribute('horario')==datosAux[0] && boton.getAttribute('dia')==datosAux[1]){
                        boton.setAttribute('class','turno_no_disponible');
                    }  
                }
            }
        }

        for(let i=0; i<fechasRecibidas.length; i++){
            let datosAux = fechasRecibidas[i].split("-");
            for (let boton of botonesTurnoDia){
                if(boton.getAttribute('horario')==datosAux[0] && boton.getAttribute('dia')==datosAux[1]){
                    if(idsRecibidas[i]==idUsuario){
                        boton.setAttribute('class','turno_escogido');

                    }
                }
            }
        }

    }
    
}

setInterval(()=>{
    LLamarObtenerTurnos();
},1000);







async function TomarTurno(dia, horario, fecha) {
    let data = new URLSearchParams();
    data.append("dia", dia);
    data.append("horario", horario);
    data.append("fecha", fecha);

    let ruta = "http://localhost/senasoft-repositorio/php/scripts/cronograma/tomar-turno.script.php";
    let request = fetch(ruta, {
        method: 'post',
        body: data
    })

    let peticion = await request;
    let resultado = await peticion.json();
    return resultado;
}

async function AbandonarTurno(horario, fecha) {
    let data = new URLSearchParams();
    data.append("horario", horario);
    data.append("fecha", fecha);

    let ruta = "http://localhost/senasoft-repositorio/php/scripts/cronograma/abandonar-turno.script.php";
    let request = fetch(ruta, {
        method: 'post',
        body: data
    })

    let peticion = await request;
    let resultado = await peticion.json();
    return resultado;
}

for (let boton of botonesTurnoDia){
    boton.addEventListener('click', async ()=>{
        let mensaje = await TomarTurno(boton.getAttribute('dia'), boton.getAttribute('horario'), fechaInicio);
        if(mensaje=="Ya tomaste este turno"){
            if(confirm("¿Deseas abadonar el turno?")){
                let fechaTurno = new Date(fechaInicio);
                fechaTurno.setDate((fechaTurno.getDate()+1+parseInt(boton.getAttribute('dia'))));
                fechaTurno = fechaTurno.getFullYear()+'-'+(fechaTurno.getMonth()+1)+'-'+fechaTurno.getDate();
                mensaje = await AbandonarTurno(boton.getAttribute('horario'), fechaTurno);
                
            }

        }else{
            alert(mensaje);
        }
        
    })
}

