//OBSERVADOR DE SCROLL QUE HACE EL EFECTO LAZY LOAD
const options = { threshold: 1 };
const noticiaObserver = new IntersectionObserver(
	(entries) => {
		entries.forEach((entry, posicion) => {
			if (entry.isIntersecting) {
				const noticia = entry.target
				const imagen_portada = entry.target.children[3].children[0];
				const datos_noticia=JSON.parse(sessionStorage.getItem(noticia.id));
				setTimeout(() => {
					noticia.style.visibility = "visible";
					imagen_portada.src = datos_noticia["imagen"];
				}, 1000);
				noticiaObserver.unobserve(entry.target);
			}

		});
	}, options);




//datos del formulario
const titulo = document.querySelector("#titulo");
const contenido = document.querySelector("#contenido");
const imagen = document.querySelector("#imagen");
const fecha = document.querySelector("#fecha");


//boton y formulario insertar
const b_nuevo = document.querySelector("#nuevo");
const form_añadir = document.querySelector('#formu');

//TABLA
const tabla_noticias = document.querySelector("#lista_noticias");


const nuevaNoticia = (json) => {
	let nueva_fila = document.createElement("tr");
	nueva_fila.id = "ID_" + json["titulo"].toUpperCase().replaceAll(" ", "");
	nueva_fila.style.visibility = "hidden";
	nueva_fila.style.height="500px";

	//CELDA TITULO
	let td_titulo = document.createElement("td");
	td_titulo.innerText = json["titulo"];
	td_titulo.classList.add("text-center");
	nueva_fila.appendChild(td_titulo);

	//CELDA CONTENIDO
	let td_contenido = document.createElement("td");
	td_contenido.innerText = json["contenido"];
	td_contenido.classList.add("text-center");
	nueva_fila.appendChild(td_contenido);

	//CELDA IMAGEN
	let imagen = document.createElement("img");
	imagen.src = json["imagen"];
	imagen.classList.add("w-50");
	let td_imagen = document.createElement("td");
	imagen.classList.add("w-50");
	td_imagen.appendChild(imagen);
	td_imagen.classList.add("text-center");
	nueva_fila.appendChild(td_imagen);

		//CELDA FECHA
		let td_fecha = document.createElement("td");
		td_fecha.innerText = json["fecha_publicacion"];
		td_fecha.classList.add("text-center");
		nueva_fila.appendChild(td_fecha);

	noticiaObserver.observe(nueva_fila);
	
	return nueva_fila;
}

b_nuevo.addEventListener("click",async (evento) => {
	evento.preventDefault();
	if (titulo.value.trim()==="") {
		mensajeError("ERROR: titulo vacio");
	} else if (contenido.value.trim()==="") {
		mensajeError("ERROR: contenido vacio");
	} else if (fecha.value.trim() === "") {
		mensajeError("ERROR: fecha vacia");
	} else if (imagen.value.trim() === "") {
		mensajeError("ERROR: imagen vacia");
	} else if (sessionStorage.getItem("ID_"+titulo.value.trim().toUpperCase().replaceAll(" ", "")) !== null) {
		mensajeError("la noticia ya existe");
	} else {

		const datos_formulario=new URLSearchParams(new FormData(form_añadir));
		const respuesta=await fetch("noticiaInsertar.php",
		{
			method:"POST",
			body:datos_formulario
		});

		const id_noticia=await respuesta.json();
		
		const datos_noticia = {
			"id":id_noticia,
			"titulo": titulo.value.trim(),
			"contenido": contenido.value.trim(),
			"imagen": imagen.value.trim(),
			"fecha_publicacion": fecha.value.trim()
		};

		const nuevo = nuevaNoticia(datos_noticia);
		tabla_noticias.appendChild(nuevo);
		sessionStorage.setItem("ID_" + titulo.value.trim().toUpperCase().replaceAll(" ", ""), JSON.stringify(datos_noticia));

		
		form_añadir.reset();
		document.documentElement.scrollTop = document.documentElement.scrollHeight;
		mensajeOk("Añadido correctamente");
	}
});





if (sessionStorage.length === 0) {
	

	(async () => {
		
		const respuesta = await fetch("noticiaTabla.php");
		
		const datos_noticias = await respuesta.json();

		datos_noticias.forEach((noticia) => {
			sessionStorage.setItem("ID_" + noticia["titulo"].
				toUpperCase()
				.replaceAll(" ", ""),
				JSON.stringify(noticia))
		});
		
		Object.values(sessionStorage).forEach(
			(noticia) => {
				tabla_noticias.appendChild(nuevaNoticia(JSON.parse(noticia)));
			}
		)
		
	})();
	
} else {

	Object.values(sessionStorage).forEach(
		(noticia) => {
			tabla_noticias.appendChild(nuevaNoticia(JSON.parse(noticia)));
		}
	)
}


