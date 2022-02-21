const cambiar=document.querySelector("#cambiar");
const tabla=document.querySelector("#lista");

cambiar.addEventListener("click", async()=>{
    if(tabla.childNodes.length>1){
        tabla_array=tabla.getElementsByTagName("tr");
        let tamaño=tabla_array.length;
        for(let i=0;i<tamaño;i++){
            lista.removeChild(tabla_array[0]);
        }
    }
    const respuesta=await fetch("https://dog.ceo/api/breeds/image/random/3");
    const datos=await respuesta.json();
    const datos_array=datos["message"];
    console.log(datos_array);
    console.log("pepe");
    console.log(datos_array[0]);  
    console.log(datos_array[1]);  
    console.log(datos_array[2]);       
    const img1=datos_array[0];
    const img2=datos_array[1];
    const img3=datos_array[2];
    const fila=crearFila(img1,img2,img3);
    tabla.appendChild(fila);
});

/* FUNCION PARA CREAR LAS FILAS DE LA GALERIA */
function crearFila(img1,img2,img3){
    const fila=document.createElement("tr");
    const imagen1=document.createElement("img");
    imagen1.src=img1;
    imagen1.width=300;
    const td_imagen1=document.createElement("td");
    td_imagen1.classList.add("text-center");
    td_imagen1.appendChild(imagen1);

    const imagen2=document.createElement("img");
    imagen2.src=img2;
    imagen2.width=300;
    const td_imagen2=document.createElement("td");
    td_imagen2.classList.add("text-center");
    td_imagen2.appendChild(imagen2);

    const imagen3=document.createElement("img");
    imagen3.src=img3;
    imagen3.width=300;
    const td_imagen3=document.createElement("td");
    td_imagen3.classList.add("text-center");
    td_imagen3.appendChild(imagen3);

    fila.appendChild(td_imagen1);
    fila.appendChild(td_imagen2);
    fila.appendChild(td_imagen3);
    return fila;
}