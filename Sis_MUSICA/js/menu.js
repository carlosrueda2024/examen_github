particlesJS("particles-js", {
  // Configuración de las partículas
  "particles": {
    // Número y densidad de las partículas
    "number": {
      "value": 80,
      "density": {
        "enable": true,
        "value_area": 800
      }
    },
    // Color de las partículas
    "color": {
      "value": "#01FFFF" // Color azul neón para los puntos
    },
    // Forma de las partículas
    /*
      "shape": {
      "type": "edge"
      }
      "shape": {
        "type": "triangle"
      }
      "shape": {
        "type": "star",
        "polygon": {
          "nb_sides": 5 // Número de puntas de la estrella
        }
      }
      "shape": {
        "type": "polygon",
        "polygon": {
          "nb_sides": 6 // Número de lados del polígono
        }
      }
      "shape": {
        "type": "image",
        "image": {
          "src": "path/to/image.png",
          "width": 100, // Ancho de la imagen
          "height": 100 // Alto de la imagen
        }
      }

    
    */
    "shape": {
      "type": "circle",
      "stroke": {
        "width": 0,
        "color": "#000000"
      },
      "polygon": {
        "nb_sides": 5
      }
    },
    // Opacidad de las partículas
    "opacity": {
      "value": 0.5,
      "random": false,
      "anim": {
        "enable": false,
        "speed": 1,
        "opacity_min": 0.1,
        "sync": false
      }
    },
    // Tamaño de las partículas
    "size": {
      "value": 3,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 40,
        "size_min": 0.1,
        "sync": false
      }
    },
    // Líneas que conectan las partículas
    "line_linked": {
      "enable": true,
      "distance": 150,
      "color": "#01FFFF", // Color azul neón para las líneas
      "opacity": 0.4,
      "width": 1
    },
    // Movimiento de las partículas
    "move": {
      "enable": true,
      "speed": 1, // Reducir la velocidad aquí
      "direction": "none",
      "random": false,
      "straight": false,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 1200
      }
    }
  },
  // Interactividad de las partículas
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      // Eventos al interactuar con las partículas
      "onhover": {
        "enable": false,
        "mode": "grab"
      },
      "onclick": {
        "enable": true,
        "mode": "push"
      },
      "resize": true
    },
    // Modos de interacción
    "modes": {
      "grab": {
        "distance": 140,
        "line_linked": {
          "opacity": 1
        }
      },
      "bubble": {
        "distance": 400,
        "size": 40,
        "duration": 2,
        "opacity": 8,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  // Detección de pantalla retina
  "retina_detect": true
});
