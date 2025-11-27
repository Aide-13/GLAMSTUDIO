
function enviarWhatsappPC(){
    const nombre = document.getElementById("nombre_pc").value;
    const apellidos = document.getElementById("apellidos_pc").value;
    const lada = document.getElementById("lada_pc").value;
    const telefono = document.getElementById("telefono_pc").value;
    const servicio = document.getElementById("servicio_pc").value;
    const descripcion = document.getElementById("descripcion_pc").value;
    const fecha = document.getElementById("fecha_pc").value;
    const hora = document.getElementById("hora_pc").value;

    const mensaje = 
`¡Hola! Me gustaría agendar una cita:
☻ Nombre: ${nombre} ${apellidos}
✦ Teléfono: ${lada} ${telefono}
✿ Servicio: ${servicio}
★ Descripción: ${descripcion}
✽ Fecha: ${fecha}
❀ Hora: ${hora}`;

    const url = "https://wa.me/525574542710?text=" + encodeURIComponent(mensaje);

    window.open(url, "_blank");
}


function enviarWhatsappMovil(){
    const nombre = document.getElementById("nombre").value;
    const apellidos = document.getElementById("apellidos").value;
    const lada = document.getElementById("lada").value;
    const telefono = document.getElementById("telefono").value;
    const servicio = document.getElementById("servicio").value;
    const descripcion = document.getElementById("descripcion").value;
    const fecha = document.getElementById("fecha").value;
    const hora = document.getElementById("hora").value;

    const mensaje = 
`¡Hola! Me gustaría agendar una cita:
☻ Nombre: ${nombre} ${apellidos}
✦ Teléfono: ${lada} ${telefono}
✿ Servicio: ${servicio}
★ Descripción: ${descripcion}
✽ Fecha: ${fecha}
❀ Hora: ${hora}`;

    const url = "https://wa.me/525574542710?text=" + encodeURIComponent(mensaje);

    window.open(url, "_blank");
}

