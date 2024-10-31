	"use strict";
	var v1=/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]*$/;// esto permite validar ñ Ñ y tambien acentos
	var v2=/^[0-9]*$/; //VALIDACION DE NUMEROS ENTEROS POSITIVOS
	var v22=/^[0-9]+[\.]?[0-9]*$/; //VALIDACION DE NUMEROS ENTEROS POSITIVOS INCLUIDO LOS DECIMALES
	var v3=/\S+@\S+\.\S+/; //VALIDACION DE CORREO