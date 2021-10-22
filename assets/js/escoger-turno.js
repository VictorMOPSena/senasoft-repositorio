const botonesTurnoDia = document.querySelectorAll('.turno_no_escogido');
const h1FechaCronograma = document.getElementById('h1FechaCronograma');
const inputIdUsuario = document.getElementById('idUsuario');
const calendarioInput = document.getElementById('calendario');



//Ventena emergente de nombres de empleados
const divVentanaEmergente =  document.getElementById('ventana-emergente');
const divNombresEmpleados =  document.getElementById('nombres-empleados');
const botonCerrarVentanaEmergente = document.getElementById('boton-cerrar');
const botonTurno = document.getElementById('boton-turno');
let divContenedorPs;

const idUsuario = inputIdUsuario.value;
let turnosTomados = 0;

let fecha = new Date();
do {
    fecha.setDate(fecha.getDate()-1);
    
}while(fecha.getDay()!=0);

let fechaInicio = fecha.getFullYear()+'-'+(fecha.getMonth()+1)+'-'+fecha.getDate();
let fechaHoy = fechaInicio;
fecha.setDate(fecha.getDate()+6);
let fechaFin = fecha.getFullYear()+'-'+(fecha.getMonth()+1)+'-'+fecha.getDate();

h1FechaCronograma.innerText = `Cronograma del ${fechaInicio} al ${fechaFin}`;



calendarioInput.value = fechaInicio;
calendarioInput.setAttribute("max", fechaHoy);
calendarioInput.addEventListener('input', function(e){
    let dia = new Date(this.value).getUTCDay();
    let fechaAux = new Date(calendarioInput.value);
    

    console.log(fechaAux);
    if(![0].includes(dia)){
      e.preventDefault();
      calendarioInput.value = fechaInicio;
      alert('Seleccione un domingo');
  
    }

    fechaInicio = calendarioInput.value;
    if(fechaHoy!=fechaInicio){
        botonTurno.setAttribute("disabled", true);
        texto = "No es posible editar";
        botonTurno.style.display="none";

    }else{
        botonTurno.style.display="block";

    }
});





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

        turnosTomados = 0;
        for(let i=0; i<fechasRecibidas.length; i++){
            let datosAux = fechasRecibidas[i].split("-");
            for (let boton of botonesTurnoDia){
                if(boton.getAttribute('horario')==datosAux[0] && boton.getAttribute('dia')==datosAux[1]){
                    if(idsRecibidas[i]==idUsuario){
                        boton.setAttribute('class','turno_escogido');
                        turnosTomados++;
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

async function ObtenerEmpleadosTurno(horario, fecha) {
    let data = new URLSearchParams();
    data.append("horario", horario);
    data.append("fecha", fecha);

    let ruta = "http://localhost/senasoft-repositorio/php/scripts/cronograma/obtener-empleados-turno.script.php";
    let request = fetch(ruta, {
        method: 'post',
        body: data
    })

    let peticion = await request;
    let resultado = await peticion.json();
    return resultado;
}




function CerrarVentanaEmergente(){
    divContenedorPs.remove();
    divVentanaEmergente.style.display = "none";
}

botonCerrarVentanaEmergente.addEventListener('click', ()=>{
    CerrarVentanaEmergente();
    
})


async function AccionBotonTurno(){
    if(fechaHoy==fechaInicio){
        let mensaje = await TomarTurno(botonTurno.getAttribute('dia'), botonTurno.getAttribute('horario'), fechaInicio);
        if(botonTurno.innerText=="Dejar turno"){
            let fechaTurno = new Date(fechaInicio);
            fechaTurno.setDate((fechaTurno.getDate()+1+parseInt(botonTurno.getAttribute('dia'))));
            fechaTurno = fechaTurno.getFullYear()+'-'+(fechaTurno.getMonth()+1)+'-'+fechaTurno.getDate();
            mensaje = await AbandonarTurno(botonTurno.getAttribute('horario'), fechaTurno);
        
        }
        CerrarVentanaEmergente();
        console.log(mensaje);

    }
}

botonTurno.addEventListener('click', ()=>{
    AccionBotonTurno();
})


for (let boton of botonesTurnoDia){
    boton.addEventListener('click', async ()=>{

        divVentanaEmergente.style.display = "flex";

        let fechaTurno = new Date(fechaInicio);
        fechaTurno.setDate((fechaTurno.getDate()+1+parseInt(boton.getAttribute('dia'))));
        fechaTurno = fechaTurno.getFullYear()+'-'+(fechaTurno.getMonth()+1)+'-'+fechaTurno.getDate();
        let = mensaje = await ObtenerEmpleadosTurno(boton.getAttribute('horario'), fechaTurno);


        let cajaAux = document.createDocumentFragment();

        if(mensaje['estado']){
            for(let i=0; i<mensaje['datos'][0].length; i++){
                let p = document.createElement('P');
                p.innerText = mensaje['datos'][0][i];
                cajaAux.appendChild(p);
            }

        }else{
            let p = document.createElement('P');
            p.innerText = "No hay empeados";
            cajaAux.appendChild(p);
        }

        let contenedorPsAux = document.createElement('DIV');
        divContenedorPs = contenedorPsAux;
        divContenedorPs.appendChild(cajaAux)
        divNombresEmpleados.appendChild(divContenedorPs);

        let style = window.getComputedStyle(boton, '::before')
        let texto = style.getPropertyValue('content');
        texto=texto.substring(1,texto.length-1);

        if(fechaHoy==fechaInicio){
            if(texto=="Disponible" || texto=="Vacio"){
                if(turnosTomados<5){
                    botonTurno.removeAttribute("disabled");
                    texto = "Tomar turno";
    
                }else{
                    let botonOtroHorario;
                    for (let botonAux of botonesTurnoDia){
                        if(boton.getAttribute('dia')==botonAux.getAttribute('dia') && boton.getAttribute('horario')!=botonAux.getAttribute('horario')){
                            botonOtroHorario = botonAux;
                        }
                    }
    
                    let style = window.getComputedStyle(botonOtroHorario, '::before')
                    let textoAux = style.getPropertyValue('content');
                    textoAux=textoAux.substring(1,textoAux.length-1);
    
                    if(textoAux!="Escogido"){
                        botonTurno.setAttribute("disabled", true);
                        texto = "No puedes tomar más turnos";
    
                    }else {
                        botonTurno.removeAttribute("disabled");
                        texto = "Tomar turno";
    
                    }       
                }
                
    
            }else if(texto=="Escogido"){
                botonTurno.removeAttribute("disabled");
                texto = "Dejar turno";
    
            }else if(texto=="Lleno"){
                botonTurno.setAttribute("disabled", true);
                texto = "Turno lleno";
    
            }

        }

        

        botonTurno.innerText = texto;
        botonTurno.setAttribute("dia", boton.getAttribute('dia'));
        botonTurno.setAttribute("horario", boton.getAttribute('horario'));

    })
}

