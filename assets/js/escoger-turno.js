const botonesTurnoDia = document.querySelectorAll('.btn_turno');
const h1FechaCronograma = document.getElementById('h1FechaCronograma');

let fecha = new Date();
do {
    fecha.setDate(fecha.getDate()-1);
    
}while(fecha.getDay()!=0);

fechaInicio = fecha.getFullYear()+'-'+(fecha.getMonth()+1)+'-'+fecha.getDate();
fecha.setDate(fecha.getDate()+6);
fechaFin = fecha.getFullYear()+'-'+(fecha.getMonth()+1)+'-'+fecha.getDate();

h1FechaCronograma.innerText = `Cronograma del ${fechaInicio} al ${fechaFin}`;


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


for (let boton of botonesTurnoDia){
    boton.addEventListener('click', async ()=>{
        // console.log("Dia "+boton.getAttribute('dia'));
        // console.log("Horario "+boton.getAttribute('horario'));
        // console.log();
        let mensaje = await TomarTurno(boton.getAttribute('dia'), boton.getAttribute('horario'), fechaInicio);
        console.log(mensaje);
    })
}

